/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps, InspectorControls, RichText } from '@wordpress/block-editor';

import {
	PanelBody,
	DateTimePicker,
	TextControl,
} from '@wordpress/components';

import { useState, useEffect } from '@wordpress/element';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * Calculates the time remaining until a target date.
 *
 * @param {string} targetDate - ISO 8601 date string.
 * @return {{ days: number, hours: number, minutes: number, seconds: number, isComplete: boolean }} Time remaining.
 */
function getTimeRemaining( targetDate ) {
	if ( ! targetDate ) {
		return { days: 0, hours: 0, minutes: 0, seconds: 0, isComplete: false };
	}

	const total = new Date( targetDate ).getTime() - Date.now();

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
 * Pads a number to two digits.
 *
 * @param {number} num - The number to pad.
 * @return {string} Zero-padded string.
 */
function padTwo( num ) {
	return String( num ).padStart( 2, '0' );
}

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @param {Object}   props               - Block props.
 * @param {Object}   props.attributes    - Block attributes.
 * @param {Function} props.setAttributes - Attribute setter.
 * @return {Element} Element to render.
 */
export default function Edit( { attributes, setAttributes } ) {
	const { eventTitle, targetDate, completionMessage } = attributes;
	const blockProps = useBlockProps( {
		className: 'telex-countdown-timer',
	} );

	const [ timeLeft, setTimeLeft ] = useState( () => getTimeRemaining( targetDate ) );

	useEffect( () => {
		setTimeLeft( getTimeRemaining( targetDate ) );

		if ( ! targetDate ) {
			return;
		}

		const interval = setInterval( () => {
			const remaining = getTimeRemaining( targetDate );
			setTimeLeft( remaining );
			if ( remaining.isComplete ) {
				clearInterval( interval );
			}
		}, 1000 );

		return () => clearInterval( interval );
	}, [ targetDate ] );

	const units = [
		{ value: timeLeft.days, label: __( 'Days', 'telex-countdown-timer' ) },
		{ value: timeLeft.hours, label: __( 'Hours', 'telex-countdown-timer' ) },
		{ value: timeLeft.minutes, label: __( 'Minutes', 'telex-countdown-timer' ) },
		{ value: timeLeft.seconds, label: __( 'Seconds', 'telex-countdown-timer' ) },
	];

	return (
		<>
			<InspectorControls>
				<PanelBody
					title={ __( 'Countdown Settings', 'telex-countdown-timer' ) }
					initialOpen={ true }
				>
					<div style={ { marginBottom: '16px' } }>
						<label
							style={ {
								display: 'block',
								marginBottom: '8px',
								fontWeight: 600,
								fontSize: '11px',
								textTransform: 'uppercase',
								letterSpacing: '0.5px',
							} }
						>
							{ __( 'Target Date & Time', 'telex-countdown-timer' ) }
						</label>
						<DateTimePicker
							currentDate={ targetDate || undefined }
							onChange={ ( newDate ) =>
								setAttributes( { targetDate: newDate } )
							}
							is12Hour={ true }
						/>
					</div>
					<TextControl
						__nextHasNoMarginBottom
						__next40pxDefaultSize
						label={ __( 'Completion Message', 'telex-countdown-timer' ) }
						help={ __( 'Displayed when the countdown reaches zero.', 'telex-countdown-timer' ) }
						value={ completionMessage }
						onChange={ ( value ) =>
							setAttributes( { completionMessage: value } )
						}
					/>
				</PanelBody>
			</InspectorControls>

			<div { ...blockProps }>
				<div className="telex-countdown-timer__inner">
					<RichText
						tagName="h2"
						className="telex-countdown-timer__title"
						value={ eventTitle }
						onChange={ ( value ) =>
							setAttributes( { eventTitle: value } )
						}
						placeholder={ __( 'Event Title…', 'telex-countdown-timer' ) }
						allowedFormats={ [
							'core/bold',
							'core/italic',
							'core/link',
						] }
					/>

					{ ! targetDate && (
						<p className="telex-countdown-timer__notice">
							{ __( 'Select a target date in the block settings sidebar.', 'telex-countdown-timer' ) }
						</p>
					) }

					{ targetDate && timeLeft.isComplete && (
						<p className="telex-countdown-timer__complete">
							{ completionMessage }
						</p>
					) }

					{ targetDate && ! timeLeft.isComplete && (
						<div
							className="telex-countdown-timer__grid"
							role="timer"
							aria-live="polite"
							aria-atomic="true"
							aria-label={ __( 'Countdown timer', 'telex-countdown-timer' ) }
						>
							{ units.map( ( unit ) => (
								<div
									className="telex-countdown-timer__card"
									key={ unit.label }
								>
									<span className="telex-countdown-timer__value">
										{ padTwo( unit.value ) }
									</span>
									<span className="telex-countdown-timer__label">
										{ unit.label }
									</span>
								</div>
							) ) }
						</div>
					) }
				</div>
			</div>
		</>
	);
}
