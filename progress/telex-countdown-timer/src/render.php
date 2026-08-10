<?php
/**
 * Server-side rendering for the WordCamp Countdown Timer block.
 *
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Block default content.
 * @var WP_Block $block      Block instance.
 */

$event_title        = $attributes['eventTitle'] ?? '';
$target_date        = $attributes['targetDate'] ?? '';
$completion_message = $attributes['completionMessage'] ?? '';

$has_target   = ! empty( $target_date );
$is_complete  = false;

if ( $has_target ) {
	$target_timestamp = strtotime( $target_date );
	$is_complete      = $target_timestamp !== false && $target_timestamp <= time();
}

$wrapper_attributes = get_block_wrapper_attributes(
	array(
		'class'            => 'telex-countdown-timer',
		'data-target-date' => esc_attr( $target_date ),
	)
);

// Calculate initial values for server-side render (progressive enhancement).
$days    = 0;
$hours   = 0;
$minutes = 0;
$seconds = 0;

if ( $has_target && ! $is_complete ) {
	$diff    = max( 0, $target_timestamp - time() );
	$days    = (int) floor( $diff / 86400 );
	$hours   = (int) floor( ( $diff % 86400 ) / 3600 );
	$minutes = (int) floor( ( $diff % 3600 ) / 60 );
	$seconds = (int) ( $diff % 60 );
}

$units = array(
	array(
		'value' => $days,
		'label' => __( 'Days', 'telex-countdown-timer' ),
	),
	array(
		'value' => $hours,
		'label' => __( 'Hours', 'telex-countdown-timer' ),
	),
	array(
		'value' => $minutes,
		'label' => __( 'Minutes', 'telex-countdown-timer' ),
	),
	array(
		'value' => $seconds,
		'label' => __( 'Seconds', 'telex-countdown-timer' ),
	),
);
?>
<div <?php echo $wrapper_attributes; ?>>
	<div class="telex-countdown-timer__inner">
		<?php if ( ! empty( $event_title ) ) : ?>
			<h2 class="telex-countdown-timer__title">
				<?php echo wp_kses_post( $event_title ); ?>
			</h2>
		<?php endif; ?>

		<?php if ( ! $has_target ) : ?>
			<p class="telex-countdown-timer__notice">
				<?php esc_html_e( 'No target date has been set for this countdown.', 'telex-countdown-timer' ); ?>
			</p>
		<?php endif; ?>

		<?php if ( $has_target && $is_complete ) : ?>
			<p class="telex-countdown-timer__complete">
				<?php echo esc_html( $completion_message ); ?>
			</p>
		<?php endif; ?>

		<?php if ( $has_target && ! $is_complete ) : ?>
			<div
				class="telex-countdown-timer__grid"
				role="timer"
				aria-live="polite"
				aria-atomic="true"
				aria-label="<?php esc_attr_e( 'Countdown timer', 'telex-countdown-timer' ); ?>"
			>
				<?php foreach ( $units as $unit ) : ?>
					<div class="telex-countdown-timer__card">
						<span class="telex-countdown-timer__value">
							<?php echo esc_html( str_pad( (string) $unit['value'], 2, '0', STR_PAD_LEFT ) ); ?>
						</span>
						<span class="telex-countdown-timer__label">
							<?php echo esc_html( $unit['label'] ); ?>
						</span>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<?php if ( $has_target && ! $is_complete && ! empty( $completion_message ) ) : ?>
			<p class="telex-countdown-timer__complete" hidden aria-hidden="true">
				<?php echo esc_html( $completion_message ); ?>
			</p>
		<?php endif; ?>
	</div>
</div>
