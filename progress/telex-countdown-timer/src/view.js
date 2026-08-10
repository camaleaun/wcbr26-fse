/**
 * Frontend countdown timer logic.
 * Each block instance independently manages its own interval.
 * Cleans up intervals when elements are removed from the DOM.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-metadata/#view-script
 */

/**
 * Pads a number with leading zeros to two digits.
 *
 * @param {number} num - The number to pad.
 * @return {string} The zero-padded number string.
 */
function padTwo( num ) {
	return String( num ).padStart( 2, '0' );
}

/**
 * Calculates the time remaining until a target timestamp.
 *
 * @param {number} targetTimestamp - Target time in milliseconds.
 * @return {{ days: number, hours: number, minutes: number, seconds: number, isComplete: boolean }} Remaining time.
 */
function getTimeRemaining( targetTimestamp ) {
	const total = targetTimestamp - Date.now();

	if ( total <= 0 ) {
		return { days: 0, hours: 0, minutes: 0, seconds: 0, isComplete: true };
	}

	return {
		days: Math.floor( total / ( 1000 * 60 * 60 * 24 ) ),
		hours: Math.floor( ( total / ( 1000 * 60 * 60 ) ) % 24 ),
		minutes: Math.floor( ( total / ( 1000 * 60 ) ) % 60 ),
		seconds: Math.floor( ( total / 1000 ) % 60 ),
		isComplete: false,
	};
}

/**
 * Initializes a single countdown block instance.
 *
 * @param {HTMLElement} block - The block wrapper element.
 * @return {number|null} The interval ID, or null if no interval was started.
 */
function initCountdown( block ) {
	const targetDateStr = block.dataset.targetDate;

	if ( ! targetDateStr ) {
		return null;
	}

	const targetTimestamp = new Date( targetDateStr ).getTime();

	if ( isNaN( targetTimestamp ) ) {
		return null;
	}

	const grid = block.querySelector( '.telex-countdown-timer__grid' );
	const completeEl = block.querySelector( '.telex-countdown-timer__complete' );
	const values = block.querySelectorAll( '.telex-countdown-timer__value' );

	if ( ! grid || values.length < 4 ) {
		return null;
	}

	/**
	 * Updates the countdown display.
	 */
	function tick() {
		const remaining = getTimeRemaining( targetTimestamp );

		values[ 0 ].textContent = padTwo( remaining.days );
		values[ 1 ].textContent = padTwo( remaining.hours );
		values[ 2 ].textContent = padTwo( remaining.minutes );
		values[ 3 ].textContent = padTwo( remaining.seconds );

		if ( remaining.isComplete ) {
			clearInterval( intervalId );
			grid.setAttribute( 'aria-hidden', 'true' );
			grid.style.display = 'none';

			if ( completeEl ) {
				completeEl.hidden = false;
				completeEl.removeAttribute( 'aria-hidden' );
			}
		}
	}

	// Initial tick.
	tick();

	// Check if already complete before starting interval.
	const initial = getTimeRemaining( targetTimestamp );
	if ( initial.isComplete ) {
		return null;
	}

	const intervalId = setInterval( tick, 1000 );
	return intervalId;
}

document.addEventListener( 'DOMContentLoaded', function () {
	const blocks = document.querySelectorAll( '.wp-block-telex-block-telex-countdown-timer' );

	/** @type {Map<HTMLElement, number>} */
	const intervals = new Map();

	blocks.forEach( function ( block ) {
		const intervalId = initCountdown( block );
		if ( intervalId !== null ) {
			intervals.set( block, intervalId );
		}
	} );

	// Clean up intervals when blocks are removed from the DOM.
	if ( intervals.size > 0 && typeof MutationObserver !== 'undefined' ) {
		const observer = new MutationObserver( function ( mutations ) {
			mutations.forEach( function ( mutation ) {
				mutation.removedNodes.forEach( function ( node ) {
					if ( node.nodeType !== Node.ELEMENT_NODE ) {
						return;
					}

					intervals.forEach( function ( id, el ) {
						if ( node === el || node.contains( el ) ) {
							clearInterval( id );
							intervals.delete( el );
						}
					} );
				} );
			} );

			if ( intervals.size === 0 ) {
				observer.disconnect();
			}
		} );

		observer.observe( document.body, {
			childList: true,
			subtree: true,
		} );
	}
} );
