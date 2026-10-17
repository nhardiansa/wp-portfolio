<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function nabp_setup(): void {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
}
add_action( 'after_setup_theme', 'nabp_setup' );

function nabp_asset_version( string $relative_path ): string {
	$file = NABP_DIR . '/' . $relative_path;
	$time = @filemtime( $file );
	return false !== $time ? (string) $time : NABP_VERSION;
}

function nabp_enqueue_assets(): void {
	wp_enqueue_style(
		'nabp-fonts',
		'https://fonts.googleapis.com/css2?family=Staatliches&family=Roboto:wght@400;500&display=swap',
		array(),
		null
	);

	wp_enqueue_style(
		'nabp-tailwind',
		NABP_URI . '/assets/css/tailwind.css',
		array( 'nabp-fonts' ),
		nabp_asset_version( 'assets/css/tailwind.css' )
	);

	wp_enqueue_script(
		'nabp-anime',
		NABP_URI . '/assets/js/vendor/anime.min.js',
		array(),
		nabp_asset_version( 'assets/js/vendor/anime.min.js' ),
		true
	);

	wp_enqueue_script(
		'nabp-gsap',
		NABP_URI . '/assets/js/vendor/gsap.min.js',
		array(),
		nabp_asset_version( 'assets/js/vendor/gsap.min.js' ),
		true
	);

	wp_enqueue_script(
		'nabp-customease',
		NABP_URI . '/assets/js/vendor/CustomEase.min.js',
		array( 'nabp-gsap' ),
		nabp_asset_version( 'assets/js/vendor/CustomEase.min.js' ),
		true
	);

	wp_enqueue_script(
		'nabp-main',
		NABP_URI . '/assets/js/main.js',
		array( 'nabp-anime', 'nabp-gsap', 'nabp-customease' ),
		nabp_asset_version( 'assets/js/main.js' ),
		true
	);
}
add_action( 'wp_enqueue_scripts', 'nabp_enqueue_assets' );

function nabp_enqueue_analytics(): void {
	$ga4 = trim( nabp_mod( 'nabp_ga4_id' ) );
	if ( '' === $ga4 ) {
		return;
	}

	wp_enqueue_script(
		'nabp-gtag',
		'https://www.googletagmanager.com/gtag/js?id=' . rawurlencode( $ga4 ),
		array(),
		null,
		false
	);

	wp_add_inline_script(
		'nabp-gtag',
		"window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','" . esc_js( $ga4 ) . "');"
	);
}
add_action( 'wp_enqueue_scripts', 'nabp_enqueue_analytics', 20 );
