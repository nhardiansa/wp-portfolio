<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'NABP_VERSION', '1.0.0' );
define( 'NABP_DIR', get_template_directory() );
define( 'NABP_URI', get_template_directory_uri() );

require NABP_DIR . '/inc/setup.php';
require NABP_DIR . '/inc/cpt.php';
require NABP_DIR . '/inc/customizer.php';
require NABP_DIR . '/inc/template-tags.php';
