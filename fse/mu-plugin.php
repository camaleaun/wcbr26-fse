<?php
/**
 * Plugin Name: WCBR2026 Assets & Patterns
 * Description: Enqueue JS e registra o pattern hero para o WordCamp Brasil 2026.
 */

add_action( 'wp_enqueue_scripts', function () {
	$js = content_url( 'uploads/wcbr2026/main.js' );
	wp_enqueue_script( 'wcbr2026-main', $js, [], null, [ 'in_footer' => true ] );
} );

add_action( 'init', function () {
	register_block_pattern_category( 'wcbr2026', [ 'label' => 'WCBR2026' ] );

	$hero_file = WP_CONTENT_DIR . '/uploads/wcbr2026/hero.html';
	if ( file_exists( $hero_file ) ) {
		register_block_pattern( 'wcbr2026/hero', [
			'title'      => 'WCBR2026 Hero',
			'categories' => [ 'wcbr2026' ],
			'content'    => file_get_contents( $hero_file ),
		] );
	}
} );
