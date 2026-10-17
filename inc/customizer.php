<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function nabp_defaults(): array {
	return array(
		'nabp_hero_name'      => "i'm\nNabil\nhardiansa",
		'nabp_hero_tagline'   => '// fullstack developer // problem solver',
		'nabp_hero_desc'      => 'Saya membangun website & aplikasi yang menyelesaikan masalah bisnis — bukan sekadar menulis kode. Setiap case study di bawah mendokumentasikan cara saya berpikir, dari masalah sampai hasil terukur.',
		'nabp_hero_photo'     => NABP_URI . '/assets/img/me.jpg',
		'nabp_about_story'    => "Berangkat dari pengalaman membangun aplikasi bersama tim di beberapa perusahaan, saya terbiasa bekerja dari masalah — bukan dari daftar fitur.\n\nSetiap project saya mulai dengan pertanyaan yang sama: masalah bisnis apa yang sebenarnya perlu selesai? Kode hanyalah alat — ukuran keberhasilan saya adalah hasil yang terlihat setelah deploy.",
		'nabp_about_photo'    => NABP_URI . '/assets/img/desk.jpg',
		'nabp_contact_email'  => 'hello@nabilhardiansa.com',
		'nabp_github'         => 'https://github.com/',
		'nabp_linkedin'       => 'https://www.linkedin.com/',
		'nabp_instagram'      => 'https://www.instagram.com/',
		'nabp_resume_url'     => '',
		'nabp_ga4_id'         => '',
		'nabp_copyright_name' => 'Nabil Hardiansa',
	);
}

function nabp_customize_register( WP_Customize_Manager $wp_customize ): void {
	$sections = array(
		'nabp_hero'      => array( 'title' => __( 'Hero', 'nab-portfolio' ), 'priority' => 30 ),
		'nabp_about'     => array( 'title' => __( 'About', 'nab-portfolio' ), 'priority' => 31 ),
		'nabp_contact'   => array( 'title' => __( 'Kontak & Sosial', 'nab-portfolio' ), 'priority' => 32 ),
		'nabp_analytics' => array( 'title' => __( 'Analytics', 'nab-portfolio' ), 'priority' => 33 ),
		'nabp_branding' => array( 'title' => __( 'Branding', 'nab-portfolio' ), 'priority' => 34 ),
	);

	foreach ( $sections as $id => $args ) {
		$wp_customize->add_section( $id, $args );
	}

	$defaults = nabp_defaults();

	$text_fields = array(
		'nabp_hero_tagline'   => array( 'nabp_hero', __( 'Tagline', 'nab-portfolio' ) ),
		'nabp_contact_email'  => array( 'nabp_contact', __( 'Email (untuk CTA & kontak)', 'nab-portfolio' ) ),
		'nabp_ga4_id'         => array( 'nabp_analytics', __( 'GA4 Tracking ID (mis. G-XXXXXXXXXX) — kosong = tidak dimuat', 'nab-portfolio' ) ),
		'nabp_copyright_name' => array( 'nabp_branding', __( 'Nama copyright', 'nab-portfolio' ) ),
	);

	$textarea_fields = array(
		'nabp_hero_name'   => array( 'nabp_hero', __( 'Nama (headline) — baris baru = baris tampil', 'nab-portfolio' ) ),
		'nabp_hero_desc'   => array( 'nabp_hero', __( 'Deskripsi singkat', 'nab-portfolio' ) ),
		'nabp_about_story' => array( 'nabp_about', __( 'Story — paragraf dipisah baris kosong', 'nab-portfolio' ) ),
	);

	$url_fields = array(
		'nabp_github'    => array( 'nabp_contact', __( 'GitHub URL', 'nab-portfolio' ) ),
		'nabp_linkedin'  => array( 'nabp_contact', __( 'LinkedIn URL', 'nab-portfolio' ) ),
		'nabp_instagram' => array( 'nabp_contact', __( 'Instagram URL', 'nab-portfolio' ) ),
		'nabp_resume_url' => array( 'nabp_contact', __( 'Resume URL (PDF)', 'nab-portfolio' ) ),
	);

	$images = array(
		'nabp_hero_photo'  => array( 'nabp_hero', __( 'Foto hero', 'nab-portfolio' ) ),
		'nabp_about_photo' => array( 'nabp_about', __( 'Foto about', 'nab-portfolio' ) ),
	);

	foreach ( $text_fields as $mod => $conf ) {
		$wp_customize->add_setting(
			$mod,
			array(
				'default'           => $defaults[ $mod ],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			$mod,
			array(
				'label'   => $conf[1],
				'section' => $conf[0],
				'type'    => 'text',
			)
		);
	}

	foreach ( $textarea_fields as $mod => $conf ) {
		$wp_customize->add_setting(
			$mod,
			array(
				'default'           => $defaults[ $mod ],
				'sanitize_callback' => 'sanitize_textarea_field',
			)
		);
		$wp_customize->add_control(
			$mod,
			array(
				'label'   => $conf[1],
				'section' => $conf[0],
				'type'    => 'textarea',
			)
		);
	}

	foreach ( $url_fields as $mod => $conf ) {
		$wp_customize->add_setting(
			$mod,
			array(
				'default'           => $defaults[ $mod ],
				'sanitize_callback' => 'esc_url_raw',
			)
		);
		$wp_customize->add_control(
			$mod,
			array(
				'label'   => $conf[1],
				'section' => $conf[0],
				'type'    => 'url',
			)
		);
	}

	foreach ( $images as $mod => $conf ) {
		$wp_customize->add_setting(
			$mod,
			array(
				'default'           => $defaults[ $mod ],
				'sanitize_callback' => 'esc_url_raw',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				$mod,
				array(
					'label'   => $conf[1],
					'section' => $conf[0],
				)
			)
		);
	}
}
add_action( 'customize_register', 'nabp_customize_register' );
