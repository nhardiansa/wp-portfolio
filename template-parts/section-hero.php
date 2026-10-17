<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$nabp_photo  = nabp_mod( 'nabp_hero_photo' );
$nabp_photo  = '' === $nabp_photo ? nabp_placeholder( 533, 667 ) : $nabp_photo;
$nabp_mailto = nabp_mailto_url();

$nabp_name_lines = array_values( array_filter( array_map( 'trim', explode( "\n", nabp_mod( 'nabp_hero_name' ) ) ) ) );
if ( empty( $nabp_name_lines ) ) {
	$nabp_name_lines = array( 'Nabil Hardiansa' );
}
$nabp_last_index = count( $nabp_name_lines ) - 1;
?>
<section id="hero" class="nab-container pt-12 pb-20 lg:pt-20 lg:pb-24" aria-labelledby="hero-name">
	<div class="grid gap-3 lg:grid-cols-[minmax(0,1fr)_minmax(0,1.35fr)] lg:gap-x-16 lg:gap-y-6">
		<div class="lg:col-start-2 lg:row-start-1">
			<p class="hero-fade flex items-center gap-3 mb-6 lg:mb-8" style="--d: 60ms">
				<span class="w-2 h-2 rounded-full bg-lime" aria-hidden="true"></span>
				<span class="font-display text-lime text-[20px] sm:text-[24px] tracking-[0.08em]"><?php echo esc_html( nabp_mod( 'nabp_hero_tagline' ) ); ?></span>
			</p>

			<h1 id="hero-name" class="font-display text-display-hero leading-[0.92] mb-8">
				<?php foreach ( $nabp_name_lines as $nabp_i => $nabp_line ) : ?>
					<span class="hero-mask"><span class="hero-mask-line <?php echo $nabp_i === $nabp_last_index ? 'hero-outline' : 'text-fog'; ?>" style="--d: <?php echo esc_attr( (string) ( 140 + $nabp_i * 140 ) ); ?>ms"><?php echo esc_html( $nabp_line ); ?></span></span>
				<?php endforeach; ?>
			</h1>
		</div>

		<div class="hero-photo group relative lg:col-start-1 lg:row-start-1 lg:row-span-2 lg:h-full lg:min-h-[420px]" style="--d: 400ms">
			<div class="hero-photo-frame absolute left-4 top-4 -right-4 -bottom-4 border-2 border-lime/40 rounded-[28px]" aria-hidden="true"></div>
			<div class="relative aspect-[4/5] w-full overflow-hidden rounded-[24px] lg:aspect-auto lg:h-full">
				<img src="<?php echo esc_url( $nabp_photo ); ?>" alt="<?php esc_attr_e( 'Nabil Hardiansa portrait', 'nab-portfolio' ); ?>" class="w-full h-full object-cover grayscale transition-[filter] duration-500 group-hover:grayscale-0 rounded-[24px]" />
			</div>
			<div class="absolute bottom-4 left-4 flex items-center gap-2 bg-ink/85 backdrop-blur border border-lime/40 rounded-full px-4 py-2">
				<span class="hero-dot w-2 h-2 rounded-full bg-lime" aria-hidden="true"></span>
				<span class="text-fog text-[14px]"><?php esc_html_e( 'Available for freelance', 'nab-portfolio' ); ?></span>
			</div>
		</div>

		<div class="lg:col-start-2 lg:row-start-2">
			<div class="hero-rule max-w-[420px] mb-8" style="--d: 480ms" aria-hidden="true"></div>

			<p class="hero-fade text-fog/80 text-[18px] sm:text-[20px] lg:text-[24px] leading-[1.55] max-w-[560px] mb-10" style="--d: 560ms"><?php echo esc_html( nabp_mod( 'nabp_hero_desc' ) ); ?></p>

			<div class="hero-fade flex flex-wrap items-center gap-4" style="--d: 700ms">
				<?php if ( '' !== $nabp_mailto ) : ?>
					<a href="<?php echo esc_url( $nabp_mailto ); ?>" data-ga="email_cta_click" class="group inline-flex items-center gap-3 bg-lime text-ink font-medium rounded-[32px] px-[26px] py-[12px] text-[18px] hover:opacity-90 transition-opacity">
						<?php echo nabp_icon( 'mail' ); ?>
						<?php esc_html_e( 'Email me', 'nab-portfolio' ); ?>
					</a>
				<?php endif; ?>
				<?php if ( nabp_has_case_studies() ) : ?>
					<a href="#works" class="group inline-flex items-center gap-3 border border-[#ffffff] rounded-[32px] px-[26px] py-[12px] text-[18px] opacity-80 hover:opacity-100 hover:border-lime transition">
						<?php esc_html_e( 'See case studies', 'nab-portfolio' ); ?>
						<span class="inline-block transition-transform group-hover:translate-x-1"><?php echo nabp_icon( 'arrow-right' ); ?></span>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
