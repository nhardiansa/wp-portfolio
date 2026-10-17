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
	<script>
		( function () {
			var root = document.documentElement;
			if ( window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches ) {
				root.classList.add( 'motion-failed' );
				return;
			}
			root.classList.add( 'motion-ready' );
			window.setTimeout( function () {
				if ( ! window.__nabpMotion ) {
					root.classList.remove( 'motion-ready' );
					root.classList.add( 'motion-failed' );
				}
			}, 2000 );
		} )();
	</script>
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'bg-ink font-body text-fog antialiased overflow-x-hidden' ); ?>>
<?php wp_body_open(); ?>
<a href="#main" class="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-50 focus:bg-lime focus:text-ink focus:px-4 focus:py-2 focus:rounded-[8px] focus:font-medium"><?php esc_html_e( 'Skip to content', 'nab-portfolio' ); ?></a>

<header class="site-header sticky top-0 z-50 hidden md:block">
	<div class="nab-container flex items-center justify-between py-8">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="font-display text-lime text-[24px] sm:text-[28px] leading-none tracking-[0.02em] hover:text-fog transition-colors" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">nhardiansa</a>
		<button type="button" class="nav-hamburger-btn hidden md:flex flex-col items-center justify-center" data-nav-toggle aria-controls="nav-overlay" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle menu', 'nab-portfolio' ); ?>">
			<span class="nav-hamburger-bar" aria-hidden="true"></span>
			<span class="nav-hamburger-bar" aria-hidden="true"></span>
			<span class="nav-hamburger-bar" aria-hidden="true"></span>
		</button>
	</div>
</header>

<button type="button" class="nav-fab-btn fixed bottom-6 right-6 z-50 flex flex-col items-center justify-center md:hidden" data-nav-toggle aria-controls="nav-overlay" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle menu', 'nab-portfolio' ); ?>">
	<span class="nav-hamburger-bar" aria-hidden="true"></span>
	<span class="nav-hamburger-bar" aria-hidden="true"></span>
	<span class="nav-hamburger-bar" aria-hidden="true"></span>
</button>

<div id="nav-overlay" class="nav-overlay-wrapper" data-nav="closed" aria-hidden="true">
	<div class="overlay" data-overlay-close></div>
	<nav class="menu-content" aria-label="<?php esc_attr_e( 'Fullscreen', 'nab-portfolio' ); ?>">
		<div class="menu-bg" aria-hidden="true">
			<div class="backdrop-layer first"></div>
			<div class="backdrop-layer second"></div>
			<div class="backdrop-layer"></div>
			<div class="ambient-background-shapes">
				<svg class="bg-shape bg-shape-1" viewBox="0 0 400 400" fill="none">
					<circle class="shape-element" cx="80" cy="120" r="40" fill="rgba(211, 253, 6, 0.15)" />
					<circle class="shape-element" cx="300" cy="80" r="60" fill="rgba(211, 253, 6, 0.12)" />
					<circle class="shape-element" cx="200" cy="300" r="80" fill="rgba(255, 255, 255, 0.08)" />
					<circle class="shape-element" cx="350" cy="280" r="30" fill="rgba(211, 253, 6, 0.15)" />
				</svg>
				<svg class="bg-shape bg-shape-2" viewBox="0 0 400 400" fill="none">
					<path class="shape-element" d="M0 200 Q100 100, 200 200 T 400 200" stroke="rgba(211, 253, 6, 0.2)" stroke-width="60" fill="none" />
					<path class="shape-element" d="M0 280 Q100 180, 200 280 T 400 280" stroke="rgba(255, 255, 255, 0.12)" stroke-width="40" fill="none" />
				</svg>
				<svg class="bg-shape bg-shape-3" viewBox="0 0 400 400" fill="none">
					<circle class="shape-element" cx="50" cy="50" r="8" fill="rgba(211, 253, 6, 0.3)" />
					<circle class="shape-element" cx="150" cy="50" r="8" fill="rgba(255, 255, 255, 0.25)" />
					<circle class="shape-element" cx="250" cy="50" r="8" fill="rgba(211, 253, 6, 0.3)" />
					<circle class="shape-element" cx="350" cy="50" r="8" fill="rgba(255, 255, 255, 0.25)" />
					<circle class="shape-element" cx="100" cy="150" r="12" fill="rgba(211, 253, 6, 0.25)" />
					<circle class="shape-element" cx="200" cy="150" r="12" fill="rgba(255, 255, 255, 0.2)" />
					<circle class="shape-element" cx="300" cy="150" r="12" fill="rgba(211, 253, 6, 0.25)" />
					<circle class="shape-element" cx="50" cy="250" r="10" fill="rgba(255, 255, 255, 0.25)" />
					<circle class="shape-element" cx="150" cy="250" r="10" fill="rgba(211, 253, 6, 0.3)" />
					<circle class="shape-element" cx="250" cy="250" r="10" fill="rgba(255, 255, 255, 0.25)" />
					<circle class="shape-element" cx="350" cy="250" r="10" fill="rgba(211, 253, 6, 0.25)" />
					<circle class="shape-element" cx="100" cy="350" r="6" fill="rgba(211, 253, 6, 0.3)" />
					<circle class="shape-element" cx="200" cy="350" r="6" fill="rgba(255, 255, 255, 0.25)" />
					<circle class="shape-element" cx="300" cy="350" r="6" fill="rgba(211, 253, 6, 0.3)" />
				</svg>
				<svg class="bg-shape bg-shape-4" viewBox="0 0 400 400" fill="none">
					<path class="shape-element" d="M100 100 Q150 50, 200 100 Q250 150, 200 200 Q150 250, 100 200 Q50 150, 100 100" fill="rgba(211, 253, 6, 0.12)" />
					<path class="shape-element" d="M250 200 Q300 150, 350 200 Q400 250, 350 300 Q300 350, 250 300 Q200 250, 250 200" fill="rgba(255, 255, 255, 0.1)" />
				</svg>
				<svg class="bg-shape bg-shape-5" viewBox="0 0 400 400" fill="none">
					<line class="shape-element" x1="0" y1="100" x2="300" y2="400" stroke="rgba(211, 253, 6, 0.15)" stroke-width="30" />
					<line class="shape-element" x1="100" y1="0" x2="400" y2="300" stroke="rgba(255, 255, 255, 0.12)" stroke-width="25" />
					<line class="shape-element" x1="200" y1="0" x2="400" y2="200" stroke="rgba(211, 253, 6, 0.1)" stroke-width="20" />
				</svg>
			</div>
		</div>

		<div class="menu-content-wrapper nab-container">
			<ul class="menu-list">
				<?php $nabp_front = is_front_page(); ?>
				<li class="menu-list-item" data-shape="1">
					<a href="<?php echo esc_url( $nabp_front ? '#about' : home_url( '/#about' ) ); ?>" class="nav-link">
						<div class="nav-link-hover-bg" aria-hidden="true"></div>
						<span class="nav-link-text" data-menu-fade><?php esc_html_e( 'About', 'nab-portfolio' ); ?></span>
					</a>
				</li>
				<li class="menu-list-item" data-shape="2">
					<a href="<?php echo esc_url( $nabp_front ? '#capabilities' : home_url( '/#capabilities' ) ); ?>" class="nav-link">
						<div class="nav-link-hover-bg" aria-hidden="true"></div>
						<span class="nav-link-text" data-menu-fade><?php esc_html_e( 'What I Do', 'nab-portfolio' ); ?></span>
					</a>
				</li>
				<li class="menu-list-item" data-shape="3">
					<a href="<?php echo esc_url( $nabp_front ? '#career' : home_url( '/#career' ) ); ?>" class="nav-link">
						<div class="nav-link-hover-bg" aria-hidden="true"></div>
						<span class="nav-link-text" data-menu-fade><?php esc_html_e( 'Experience', 'nab-portfolio' ); ?></span>
					</a>
				</li>
				<?php if ( nabp_has_case_studies() ) : ?>
					<li class="menu-list-item" data-shape="4">
						<a href="<?php echo esc_url( $nabp_front ? '#works' : home_url( '/#works' ) ); ?>" class="nav-link">
							<div class="nav-link-hover-bg" aria-hidden="true"></div>
							<span class="nav-link-text" data-menu-fade><?php esc_html_e( 'Works', 'nab-portfolio' ); ?></span>
						</a>
					</li>
				<?php endif; ?>
				<li class="menu-list-item" data-shape="5">
					<a href="<?php echo esc_url( $nabp_front ? '#contact' : home_url( '/#contact' ) ); ?>" class="nav-link">
						<div class="nav-link-hover-bg" aria-hidden="true"></div>
						<span class="nav-link-text" data-menu-fade><?php esc_html_e( 'Contact', 'nab-portfolio' ); ?></span>
					</a>
				</li>
			</ul>
		</div>
	</nav>
</div>

<main id="main">
