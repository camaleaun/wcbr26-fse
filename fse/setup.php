<?php
/**
 * Blueprint setup: importa imagens para mídia WP, cria template parts
 * (header/footer) e global styles no banco.
 * Executado via runPHP no blueprint.json.
 */

require '/wordpress/wp-load.php';
wp_set_current_user( 1 );

$uploads_base = content_url( 'uploads/wcbr2026/' );
$uploads_dir  = WP_CONTENT_DIR . '/uploads/wcbr2026/';

// ── 0. Media Import ───────────────────────────────────────────────────────────

require_once ABSPATH . 'wp-admin/includes/image.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/media.php';

$wp_upload = wp_upload_dir();
$media_dir = $wp_upload['path'];
$media_url = $wp_upload['url'];
wp_mkdir_p( $media_dir );

$mime_map = [
	'jpg'  => 'image/jpeg',
	'jpeg' => 'image/jpeg',
	'png'  => 'image/png',
	'webp' => 'image/webp',
	'avif' => 'image/avif',
	'gif'  => 'image/gif',
];

// Builds $url_map: '/wp-content/uploads/wcbr2026/img/FILE' => 'https://.../YYYY/MM/FILE'
$url_map = [];

function wcbr_import_image( $src, $dest_filename, $old_rel, $media_dir, $media_url, $mime_map, &$url_map ) {
	$ext = strtolower( pathinfo( $dest_filename, PATHINFO_EXTENSION ) );
	if ( ! isset( $mime_map[ $ext ] ) ) {
		return;
	}

	$dest    = $media_dir . '/' . $dest_filename;
	$new_url = $media_url . '/' . $dest_filename;

	$url_map[ '/wp-content/uploads/wcbr2026/img/' . $old_rel ] = $new_url;

	if ( ! file_exists( $src ) ) {
		return;
	}

	if ( ! file_exists( $dest ) ) {
		copy( $src, $dest );
	}

	$year_month    = date( 'Y/m' );
	$existing_meta = get_posts( [
		'post_type'      => 'attachment',
		'meta_key'       => '_wp_attached_file',
		'meta_value'     => $year_month . '/' . $dest_filename,
		'posts_per_page' => 1,
	] );
	if ( $existing_meta ) {
		return;
	}

	$attach_id = wp_insert_attachment( [
		'guid'           => $new_url,
		'post_mime_type' => $mime_map[ $ext ],
		'post_title'     => sanitize_file_name( $dest_filename ),
		'post_content'   => '',
		'post_status'    => 'inherit',
	], $dest );

	if ( $attach_id && ! is_wp_error( $attach_id ) ) {
		$meta = wp_generate_attachment_metadata( $attach_id, $dest );
		wp_update_attachment_metadata( $attach_id, $meta );
	}
}

// Flat images in wcbr2026/img/ (skip icon-* utility files)
$img_dir = $uploads_dir . 'img/';
if ( is_dir( $img_dir ) ) {
	foreach ( scandir( $img_dir ) as $file ) {
		if ( $file === '.' || $file === '..' || is_dir( $img_dir . $file ) ) {
			continue;
		}
		if ( strpos( $file, 'icon-' ) === 0 ) {
			continue; // nav icons stay at wcbr2026/img/
		}
		wcbr_import_image(
			$img_dir . $file,
			$file,
			$file,
			$media_dir, $media_url, $mime_map, $url_map
		);
	}
}

// Organizer photos in wcbr2026/img/organizers/
$org_dir = $uploads_dir . 'img/organizers/';
if ( is_dir( $org_dir ) ) {
	foreach ( scandir( $org_dir ) as $file ) {
		if ( $file === '.' || $file === '..' ) {
			continue;
		}
		wcbr_import_image(
			$org_dir . $file,
			'organizer-' . $file,
			'organizers/' . $file,
			$media_dir, $media_url, $mime_map, $url_map
		);
	}
}

// Helper: replace photo URLs then fix remaining wcbr2026/ paths
function wcbr_process_content( $content, $uploads_base, $url_map ) {
	if ( ! empty( $url_map ) ) {
		$content = str_replace(
			array_keys( $url_map ),
			array_values( $url_map ),
			$content
		);
	}
	return str_replace( '/wp-content/uploads/wcbr2026/', $uploads_base, $content );
}

// ── 1. Template Parts ────────────────────────────────────────────────────────

$parts = [
	'header' => [ 'title' => 'Header', 'area' => 'header' ],
	'footer' => [ 'title' => 'Footer', 'area' => 'footer' ],
];

foreach ( $parts as $slug => $meta ) {
	$file = $uploads_dir . $slug . '.html';
	if ( ! file_exists( $file ) ) {
		continue;
	}

	$content = wcbr_process_content( file_get_contents( $file ), $uploads_base, $url_map );

	$existing = get_posts( [
		'post_type'      => 'wp_template_part',
		'name'           => $slug,
		'posts_per_page' => 1,
		'tax_query'      => [ [
			'taxonomy' => 'wp_theme',
			'field'    => 'slug',
			'terms'    => 'twentytwentyfive',
		] ],
	] );

	if ( $existing ) {
		wp_update_post( [
			'ID'           => $existing[0]->ID,
			'post_content' => $content,
		] );
	} else {
		$post_id = wp_insert_post( [
			'post_type'    => 'wp_template_part',
			'post_title'   => $meta['title'],
			'post_name'    => $slug,
			'post_status'  => 'publish',
			'post_content' => $content,
		] );

		if ( $post_id && ! is_wp_error( $post_id ) ) {
			wp_set_object_terms( $post_id, 'twentytwentyfive', 'wp_theme' );
			wp_set_object_terms( $post_id, $meta['area'], 'wp_template_part_area' );
		}
	}
}

// ── 2. Global Styles (cores + CSS) ──────────────────────────────────────────

$css_file = $uploads_dir . 'styles.css';
$css      = file_exists( $css_file ) ? file_get_contents( $css_file ) : '';

$font_url = content_url( 'uploads/wcbr2026/fonts/' );
$css      = str_replace( 'WCBR_FONT_PATH/', $font_url, $css );

$palette = [
	[ 'color' => '#00595D', 'name' => 'WCBR Teal',      'slug' => 'wcbr-teal' ],
	[ 'color' => '#004E4D', 'name' => 'WCBR Teal D',    'slug' => 'wcbr-teal-d' ],
	[ 'color' => '#003E3E', 'name' => 'WCBR Teal DD',   'slug' => 'wcbr-teal-dd' ],
	[ 'color' => '#D43900', 'name' => 'WCBR Grenadier', 'slug' => 'wcbr-grenadier' ],
	[ 'color' => '#F56530', 'name' => 'WCBR South',     'slug' => 'wcbr-south' ],
	[ 'color' => '#B52701', 'name' => 'WCBR Brick',     'slug' => 'wcbr-brick' ],
	[ 'color' => '#C94220', 'name' => 'WCBR Brick B',   'slug' => 'wcbr-brick-b' ],
	[ 'color' => '#FFF8F1', 'name' => 'WCBR Cream',     'slug' => 'wcbr-cream' ],
	[ 'color' => '#F5EDE3', 'name' => 'WCBR Cream 2',   'slug' => 'wcbr-cream-2' ],
	[ 'color' => '#BEC9C8', 'name' => 'WCBR Line',      'slug' => 'wcbr-line' ],
	[ 'color' => '#E9E1D8', 'name' => 'WCBR Panel',     'slug' => 'wcbr-panel' ],
	[ 'color' => '#3E4948', 'name' => 'WCBR Ink',       'slug' => 'wcbr-ink' ],
	[ 'color' => '#556260', 'name' => 'WCBR Muted',     'slug' => 'wcbr-muted' ],
	[ 'color' => '#FFB4A3', 'name' => 'WCBR Foot Head', 'slug' => 'wcbr-foot-head' ],
	[ 'color' => '#F7F0E6', 'name' => 'WCBR Foot Text', 'slug' => 'wcbr-foot-text' ],
];

$gs_content = wp_json_encode( [
	'version'                     => 3,
	'isGlobalStylesUserThemeJSON' => true,
	'settings' => [
		'color'  => [ 'palette' => $palette ],
		'layout' => [ 'contentSize' => '1232px', 'wideSize' => '1440px' ],
	],
	'styles'   => [
		'color' => [
			'background' => '#FFF8F1',
			'text'       => '#3E4948',
		],
		'css'   => $css,
	],
] );

// wp_insert_post/wp_update_post chamam wp_unslash() no conteúdo, removendo
// as barras invertidas do JSON (ex: \" vira ", \n vira n) e quebrando o JSON.
// wp_slash() adiciona uma camada extra de barras para compensar.
$gs_content_slashed = wp_slash( $gs_content );

$query = new WP_Query( [
	'post_type'      => 'wp_global_styles',
	'post_status'    => 'publish',
	'posts_per_page' => 1,
	'tax_query'      => [ [
		'taxonomy' => 'wp_theme',
		'field'    => 'slug',
		'terms'    => 'twentytwentyfive',
	] ],
] );

if ( $query->have_posts() ) {
	wp_update_post( [
		'ID'           => $query->posts[0]->ID,
		'post_content' => $gs_content_slashed,
	] );
} else {
	$post_id = wp_insert_post( [
		'post_type'    => 'wp_global_styles',
		'post_title'   => 'wp-global-styles-twentytwentyfive',
		'post_name'    => 'wp-global-styles-twentytwentyfive',
		'post_status'  => 'publish',
		'post_content' => $gs_content_slashed,
	] );
	if ( $post_id && ! is_wp_error( $post_id ) ) {
		wp_set_object_terms( $post_id, 'twentytwentyfive', 'wp_theme' );
	}
}

// ── 3. Front page com Hero ──────────────────────────────────────────────────

$hero_file    = $uploads_dir . 'hero.html';
$hero_content = file_exists( $hero_file ) ? file_get_contents( $hero_file ) : '';
$hero_content = wcbr_process_content( $hero_content, $uploads_base, $url_map );

$existing_page = get_posts( [
	'post_type'   => 'page',
	'post_name'   => 'inicio',
	'post_status' => 'publish',
	'numberposts' => 1,
] );

if ( $existing_page ) {
	wp_update_post( [
		'ID'           => $existing_page[0]->ID,
		'post_content' => $hero_content,
	] );
	$page_id = $existing_page[0]->ID;
} else {
	$page_id = wp_insert_post( [
		'post_type'    => 'page',
		'post_title'   => 'Início',
		'post_name'    => 'inicio',
		'post_status'  => 'publish',
		'post_content' => $hero_content,
	] );
}

if ( $page_id && ! is_wp_error( $page_id ) ) {
	update_option( 'page_on_front', $page_id );
	update_option( 'show_on_front', 'page' );
}

// ── 4. Page template override (remove post-title) ─────────────────────────

$page_tpl_content = '<!-- wp:template-part {"slug":"header","tagName":"header"} /-->
<!-- wp:post-content {"layout":{"type":"constrained"}} /-->
<!-- wp:template-part {"slug":"footer","tagName":"footer"} /-->';

$existing_tpl = get_posts( [
	'post_type'      => 'wp_template',
	'name'           => 'page',
	'posts_per_page' => 1,
	'tax_query'      => [ [
		'taxonomy' => 'wp_theme',
		'field'    => 'slug',
		'terms'    => 'twentytwentyfive',
	] ],
] );

if ( $existing_tpl ) {
	wp_update_post( [
		'ID'           => $existing_tpl[0]->ID,
		'post_content' => $page_tpl_content,
	] );
} else {
	$tpl_id = wp_insert_post( [
		'post_type'    => 'wp_template',
		'post_title'   => 'Page',
		'post_name'    => 'page',
		'post_status'  => 'publish',
		'post_content' => $page_tpl_content,
	] );
	if ( $tpl_id && ! is_wp_error( $tpl_id ) ) {
		wp_set_object_terms( $tpl_id, 'twentytwentyfive', 'wp_theme' );
	}
}

echo 'WCBR2026 setup concluído.';
