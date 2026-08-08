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
// Builds $attach_id_map: 'filename-stem' => attach_id (for set_post_thumbnail)
$url_map       = [];
$attach_id_map = [];

function wcbr_import_image( $src, $dest_filename, $old_rel, $media_dir, $media_url, $mime_map, &$url_map ) {
	$ext = strtolower( pathinfo( $dest_filename, PATHINFO_EXTENSION ) );
	if ( ! isset( $mime_map[ $ext ] ) ) {
		return 0;
	}

	$dest    = $media_dir . '/' . $dest_filename;
	$new_url = $media_url . '/' . $dest_filename;

	$url_map[ '/wp-content/uploads/wcbr2026/img/' . $old_rel ] = $new_url;

	if ( ! file_exists( $src ) ) {
		return 0;
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
		return $existing_meta[0]->ID;
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
		return $attach_id;
	}
	return 0;
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
		$id = wcbr_import_image(
			$img_dir . $file,
			$file,
			$file,
			$media_dir, $media_url, $mime_map, $url_map
		);
		if ( $id ) {
			$attach_id_map[ pathinfo( $file, PATHINFO_FILENAME ) ] = $id;
		}
	}
}

// Organizer photos are fetched from Gravatar in Section 6 — no local import needed.

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
	[ 'color' => '#00595d', 'name' => 'Cyan 700',   'slug' => 'cyan-700'   ],
	[ 'color' => '#004c4d', 'name' => 'Cyan 800',   'slug' => 'cyan-800'   ],
	[ 'color' => '#003e3e', 'name' => 'Cyan 900',   'slug' => 'cyan-900'   ],
	[ 'color' => '#c6360b', 'name' => 'Orange 600', 'slug' => 'orange-600' ],
	[ 'color' => '#f56530', 'name' => 'Orange 500', 'slug' => 'orange-500' ],
	[ 'color' => '#fff8f1', 'name' => 'Sand 100',   'slug' => 'sand-100'   ],
	[ 'color' => '#f6eee4', 'name' => 'Sand 200',   'slug' => 'sand-200'   ],
	[ 'color' => '#e9e0d8', 'name' => 'Sand 300',   'slug' => 'sand-300'   ],
	[ 'color' => '#bec9c8', 'name' => 'Gray 400',   'slug' => 'gray-400'   ],
	[ 'color' => '#4a5654', 'name' => 'Gray 700',   'slug' => 'gray-700'   ],
	[ 'color' => '#ffb4a3', 'name' => 'Red 200',    'slug' => 'red-200'    ],
];

$ff_head = '"Poppins", system-ui, -apple-system, "Segoe UI", Roboto, sans-serif';
$ff_body = '"Montserrat", system-ui, -apple-system, "Segoe UI", Roboto, sans-serif';

$gs_content = wp_json_encode( [
	'version'                     => 3,
	'isGlobalStylesUserThemeJSON' => true,
	'settings' => [
		'color'      => [ 'palette' => $palette ],
		'layout'     => [ 'contentSize' => '1232px', 'wideSize' => '1440px' ],
		'typography' => [
			'fluid'        => false,
			'fontFamilies' => [
				[ 'fontFamily' => $ff_head, 'name' => 'Poppins',    'slug' => 'poppins'    ],
				[ 'fontFamily' => $ff_body, 'name' => 'Montserrat', 'slug' => 'montserrat' ],
			],
			'fontSizes' => [
				[ 'slug' => 'small',     'size' => '0.875rem',                        'name' => 'Small'     ],
				[ 'slug' => 'medium',    'size' => '1rem',                            'name' => 'Medium'    ],
				[ 'slug' => 'large',     'size' => '1.25rem',                         'name' => 'Large'     ],
				[ 'slug' => 'x-large',  'size' => 'clamp(1.4rem, 3vw, 1.875rem)',    'name' => 'X Large'   ],
				[ 'slug' => 'xx-large', 'size' => 'clamp(1.9rem, 5vw, 3rem)',        'name' => 'XX Large'  ],
				[ 'slug' => 'xxx-large','size' => 'clamp(2.25rem, 6.2vw, 3.625rem)', 'name' => 'XXX Large' ],
			],
		],
	],
	'styles' => [
		'color' => [
			'background' => 'var:preset|color|sand-100',
			'text'       => 'var:preset|color|gray-700',
		],
		'typography' => [
			'fontFamily' => 'var:preset|font-family|montserrat',
			'fontSize'   => 'var:preset|font-size|medium',
			'lineHeight' => '1.5',
		],
		'elements' => [
			'h1' => [
				'color'      => [ 'text' => 'var:preset|color|cyan-700' ],
				'typography' => [ 'fontFamily' => 'var:preset|font-family|poppins', 'fontWeight' => '900', 'textTransform' => 'uppercase', 'lineHeight' => '1.08', 'fontSize' => 'var:preset|font-size|xxx-large', 'letterSpacing' => '-0.02em' ],
			],
			'h2' => [
				'color'      => [ 'text' => 'var:preset|color|cyan-700' ],
				'typography' => [ 'fontFamily' => 'var:preset|font-family|poppins', 'fontWeight' => '900', 'textTransform' => 'uppercase', 'lineHeight' => '1.08', 'fontSize' => 'var:preset|font-size|xx-large', 'letterSpacing' => '-0.01em' ],
			],
			'h3' => [
				'color'      => [ 'text' => 'var:preset|color|cyan-700' ],
				'typography' => [ 'fontFamily' => 'var:preset|font-family|poppins', 'fontWeight' => '900', 'textTransform' => 'uppercase', 'lineHeight' => '1.08', 'fontSize' => 'var:preset|font-size|x-large' ],
			],
			'h4' => [
				'color'      => [ 'text' => 'var:preset|color|cyan-700' ],
				'typography' => [ 'fontFamily' => 'var:preset|font-family|poppins', 'fontWeight' => '700', 'textTransform' => 'uppercase', 'lineHeight' => '1.1' ],
			],
			'link' => [
				'color'      => [ 'text' => 'inherit' ],
				'typography' => [ 'textDecoration' => 'none' ],
			],
		],
		'blocks' => [
			'core/button' => [
				'color'      => [
					'background' => 'var:preset|color|cyan-700',
					'text'       => '#ffffff',
				],
				'border'     => [ 'radius' => '0', 'color' => 'var:preset|color|cyan-900', 'style' => 'solid', 'width' => '2px' ],
				'typography' => [
					'fontFamily'    => 'var:preset|font-family|poppins',
					'fontWeight'    => '900',
					'textTransform' => 'uppercase',
					'letterSpacing' => '0.05em',
				],
				'spacing'    => [
					'padding' => [ 'top' => '1rem', 'bottom' => '1rem', 'left' => '2rem', 'right' => '2rem' ],
				],
			],
			'core/paragraph' => [
				'typography' => [ 'fontSize' => 'var:preset|font-size|medium' ],
			],
			'core/list' => [
				'spacing' => [ 'padding' => '0' ],
			],
			'core/group' => [
				'spacing' => [ 'margin' => '0' ],
			],
			'core/social-links' => [
				'spacing' => [ 'padding' => '0' ],
			],
		],
		'css' => $css,
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
<!-- wp:post-content /-->
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

// ── 5. News posts ─────────────────────────────────────────────────────────────

$news_data = [
	[ 'title' => 'Chamada para Palestrantes aberta!',         'excerpt' => 'Compartilhe sua experiência com a comunidade. Estamos buscando novas vozes para o palco.',              'category' => 'Convocação',  'img' => 'news-convocacao'  ],
	[ 'title' => 'Apoie o WordCamp Brasil 2026',              'excerpt' => 'Coloque sua marca em destaque no maior evento WordPress do país. Conheça as cotas.',                    'category' => 'Patrocínio',  'img' => 'news-patrocinio'  ],
	[ 'title' => 'Seja parte da equipe organizadora',         'excerpt' => 'Ajudar no WordCamp é uma experiência incrível de aprendizado e networking.',                             'category' => 'Voluntariado','img' => 'news-voluntariado'],
	[ 'title' => 'Por dentro do Campus da FUMEC',             'excerpt' => 'Conheça o local que receberá centenas de entusiastas WordPress em outubro.',                             'category' => 'Local',       'img' => 'news-local'       ],
	[ 'title' => 'Guia de Belo Horizonte para visitantes',    'excerpt' => 'Onde comer pão de queijo e quais museus visitar durante sua estadia.',                                    'category' => 'Turismo',     'img' => 'news-turismo'     ],
	[ 'title' => 'Save the Date: Outubro 2026',               'excerpt' => 'Marque na sua agenda. As vendas de ingressos do primeiro lote começam em breve.',                        'category' => 'Evento',      'img' => 'news-evento'      ],
];

foreach ( $news_data as $item ) {
	$cat = get_term_by( 'name', $item['category'], 'category' );
	if ( ! $cat ) {
		$result = wp_insert_term( $item['category'], 'category' );
		$cat_id = is_wp_error( $result ) ? 0 : $result['term_id'];
	} else {
		$cat_id = $cat->term_id;
	}

	$existing = get_posts( [ 'post_type' => 'post', 'title' => $item['title'], 'post_status' => 'publish', 'numberposts' => 1 ] );
	if ( $existing ) {
		continue;
	}

	$post_id = wp_insert_post( [
		'post_type'    => 'post',
		'post_title'   => $item['title'],
		'post_excerpt' => $item['excerpt'],
		'post_status'  => 'publish',
		'post_content' => '',
		'post_category' => $cat_id ? [ $cat_id ] : [],
	] );

	if ( $post_id && ! is_wp_error( $post_id ) && ! empty( $attach_id_map[ $item['img'] ] ) ) {
		set_post_thumbnail( $post_id, $attach_id_map[ $item['img'] ] );
	}
}

// ── 6. Organizer posts (Gravatar as featured image) ───────────────────────────

$organizers_data = [
	[ 'name' => "Christian van 't Hof", 'role' => 'Liderança e Patrocínios', 'photo' => 'christian', 'username' => 'Brightsol',     'gravatar' => '28c5f3cff8b39f99dd482db0bed1a36db4d9b0f2d471f477d68685dcbabf0683' ],
	[ 'name' => 'Eduardo Zulian',       'role' => 'Financeiro',              'photo' => 'eduardo',   'username' => 'eduardozulian',  'gravatar' => 'd2b86b9638463db3ab4fb8ca2c51713befed32c44728e785fc531ec2d1922ffa'  ],
	[ 'name' => 'Amanda Cardoso',       'role' => 'Local do Evento',         'photo' => 'amanda',    'username' => 'amandacodb',     'gravatar' => 'a262ac5d912dbbb8c1f145ad3342cc6b53a3c37db6fda9f097361859a0468cc5'  ],
	[ 'name' => 'Hans Möhl',            'role' => 'Website e Design',        'photo' => 'hans',      'username' => 'hansmosl',       'gravatar' => 'e22f54b57dbecad0d7645dca2c8747955c7f6087bafaf55046c98d605937a243'  ],
	[ 'name' => 'Sandra Peres',         'role' => 'Rede Social e Textos',    'photo' => 'sandra',    'username' => 'San Prs',        'gravatar' => '7b7eaaa4aadc682d507bfde811645ed2a87632d6a23235c4e69b0b975ed61338'  ],
	[ 'name' => 'André Ribeiro',        'role' => 'Dia do Evento',           'photo' => 'andre',     'username' => 'andr3ribeiro',   'gravatar' => '706eac30b67a39777c3b12288fa5b40f309f8187c37da23f7f5419e97be23535'  ],
	[ 'name' => 'Gilberto Tavares',     'role' => 'Voluntários',             'photo' => 'gilberto',  'username' => 'camaleaun',      'gravatar' => '846dac0ad49da6ec36c808dc932f2a9c2adae7e4b594025eec4e3081a524fefd'  ],
	[ 'name' => 'Pâmela Ribeiro',       'role' => 'Hospitalidade',           'photo' => 'pamela',    'username' => 'pamprn',         'gravatar' => '8cc582cc64177f604d63cc370b7c3168b79edb1b67797bbc29c36e90ca4b3e40'  ],
];

foreach ( $organizers_data as $order => $item ) {
	$term = get_term_by( 'name', $item['role'], 'wcb_organizer_team' );
	if ( ! $term ) {
		$result  = wp_insert_term( $item['role'], 'wcb_organizer_team' );
		$term_id = is_wp_error( $result ) ? 0 : $result['term_id'];
	} else {
		$term_id = $term->term_id;
	}

	$existing = get_posts( [ 'post_type' => 'wcb_organizer', 'title' => $item['name'], 'post_status' => 'publish', 'numberposts' => 1 ] );
	if ( $existing ) {
		continue;
	}

	$post_id = wp_insert_post( [
		'post_type'    => 'wcb_organizer',
		'post_title'   => $item['name'],
		'post_status'  => 'publish',
		'post_content' => '',
		'menu_order'   => $order,
	] );

	if ( ! $post_id || is_wp_error( $post_id ) ) {
		continue;
	}

	if ( $term_id ) {
		wp_set_object_terms( $post_id, $term_id, 'wcb_organizer_team' );
	}
	update_post_meta( $post_id, '_wcpt_user_name', $item['username'] );
	update_post_meta( $post_id, '_gravatar_hash', $item['gravatar'] );

	// Gravatar como fonte primária; foto local como fallback
	$gravatar_url = 'https://secure.gravatar.com/avatar/' . $item['gravatar'] . '?s=96&d=mm&r=g';
	$thumb_id     = media_sideload_image( $gravatar_url, $post_id, $item['name'], 'id' );

	if ( ! $thumb_id || is_wp_error( $thumb_id ) ) {
		$photo_src = $uploads_dir . 'img/organizers/' . $item['photo'] . '.jpg';
		$dest_file = 'organizer-' . $item['photo'] . '.jpg';
		$thumb_id  = wcbr_import_image( $photo_src, $dest_file, 'organizers/' . $item['photo'] . '.jpg', $media_dir, $media_url, $mime_map, $url_map );
	}

	if ( $thumb_id && ! is_wp_error( $thumb_id ) ) {
		set_post_thumbnail( $post_id, $thumb_id );
	}
}

echo 'WCBR2026 setup concluído.';
