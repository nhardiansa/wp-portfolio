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
		NABP_VERSION
	);

	wp_enqueue_script(
		'nabp-main',
		NABP_URI . '/assets/js/main.js',
		array(),
		NABP_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'nabp_enqueue_assets' );
