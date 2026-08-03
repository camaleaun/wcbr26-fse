<?php
/**
 * Plugin Name: WCBR2026 Assets & Post Types
 * Description: Registra CPTs, taxonomias e assets do WordCamp Brasil 2026.
 */

// ── Custom Post Types & Taxonomias ──────────────────────────────────────────

add_action( 'init', function () {

	register_post_type( 'wcb_organizer', [
		'label'        => 'Organizadores',
		'public'       => true,
		'show_in_rest' => true,
		'menu_icon'    => 'dashicons-groups',
		'supports'     => [ 'title', 'thumbnail', 'page-attributes' ],
		'has_archive'  => false,
		'rewrite'      => [ 'slug' => 'organizadores' ],
	] );

	register_taxonomy( 'wcb_organizer_team', 'wcb_organizer', [
		'label'        => 'Time',
		'public'       => true,
		'show_in_rest' => true,
		'hierarchical' => false,
		'rewrite'      => [ 'slug' => 'time-organizador' ],
	] );

	register_post_type( 'wcb_sponsor', [
		'label'        => 'Patrocinadores',
		'public'       => true,
		'show_in_rest' => true,
		'menu_icon'    => 'dashicons-star-filled',
		'supports'     => [ 'title', 'thumbnail', 'page-attributes', 'editor' ],
		'has_archive'  => false,
		'rewrite'      => [ 'slug' => 'patrocinadores' ],
	] );

	register_taxonomy( 'wcb_sponsor_level', 'wcb_sponsor', [
		'label'        => 'Cota',
		'public'       => true,
		'show_in_rest' => true,
		'hierarchical' => true,
		'rewrite'      => [ 'slug' => 'cota-patrocinio' ],
	] );

} );

// ── Assets ──────────────────────────────────────────────────────────────────

add_action( 'wp_enqueue_scripts', function () {
	$js = content_url( 'uploads/wcbr2026/main.js' );
	wp_enqueue_script( 'wcbr2026-main', $js, [], null, [ 'in_footer' => true ] );
} );
