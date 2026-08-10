<?php
/**
 * Plugin Name:       WordCamp Countdown Timer
 * Description:       A beautiful countdown timer block for WordCamp and future events with live preview, translucent cards, and full Gutenberg color support.
 * Version:           0.1.0
 * Requires at least: 6.4
 * Requires PHP:      7.4
 * Author:            WordPress Telex
 * License:           GPLv2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       telex-countdown-timer
 *
 * @package TelexCountdownTimer
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
if ( ! function_exists( 'telex_countdown_timer_telex_countdown_timer_block_init' ) ) {
	function telex_countdown_timer_telex_countdown_timer_block_init(): void {
		register_block_type( __DIR__ . '/build/' );
	}
}
add_action( 'init', 'telex_countdown_timer_telex_countdown_timer_block_init' );