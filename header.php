<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<script>document.documentElement.classList.add( 'js' );</script>
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'bg-ink font-body text-fog antialiased overflow-x-hidden' ); ?>>
<?php wp_body_open(); ?>
<a href="#main" class="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-50 focus:bg-lime focus:text-ink focus:px-4 focus:py-2 focus:rounded-[8px] focus:font-medium"><?php esc_html_e( 'Skip to content', 'nab-portfolio' ); ?></a>
<header class="nab-container flex items-center justify-between py-8">
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex items-center justify-center w-10 h-12 rounded-[8px] bg-lime font-display text-ink text-2xl" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">N</a>
	<nav aria-label="<?php esc_attr_e( 'Primary', 'nab-portfolio' ); ?>">
		<ul class="flex items-center gap-3 sm:gap-4">
			<li><a href="<?php echo esc_url( is_front_page() ? '#works' : home_url( '/#works' ) ); ?>" data-nav-link class="nav-link inline-block border border-[#ffffff] rounded-[32px] px-[22px] py-[10px] text-[16px] sm:px-[26px] sm:py-[12px] sm:text-[18px] opacity-80 hover:opacity-100 transition-opacity"><?php esc_html_e( 'WORKS', 'nab-portfolio' ); ?></a></li>
			<li><a href="<?php echo esc_url( is_front_page() ? '#contact' : home_url( '/#contact' ) ); ?>" data-nav-link class="nav-link inline-block border border-[#ffffff] rounded-[32px] px-[22px] py-[10px] text-[16px] sm:px-[26px] sm:py-[12px] sm:text-[18px] opacity-80 hover:opacity-100 transition-opacity"><?php esc_html_e( 'CONTACT', 'nab-portfolio' ); ?></a></li>
		</ul>
	</nav>
</header>
<main id="main">
