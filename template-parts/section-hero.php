<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$nabp_photo  = nabp_mod( 'nabp_hero_photo' );
$nabp_photo  = '' === $nabp_photo ? nabp_placeholder( 533, 570 ) : $nabp_photo;
$nabp_mailto = nabp_mailto_url();
?>
<section id="hero" class="nab-container pt-10 pb-20 lg:pt-16 lg:pb-24" aria-labelledby="hero-name">
	<div class="grid gap-12 lg:gap-16 lg:grid-cols-[1.25fr_1fr] lg:items-center">
		<div data-reveal-group>
			<p class="font-display text-lime text-[28px] sm:text-[35px] leading-[1.15] mb-6"><?php echo esc_html( nabp_mod( 'nabp_hero_tagline' ) ); ?></p>
			<h1 id="hero-name" class="font-display text-fog text-display-hero leading-[0.93] whitespace-pre-line mb-6"><?php echo esc_html( nabp_mod( 'nabp_hero_name' ) ); ?></h1>
			<p class="text-fog/80 text-[18px] sm:text-[20px] lg:text-[24px] leading-[1.55] max-w-[560px] mb-10"><?php echo esc_html( nabp_mod( 'nabp_hero_desc' ) ); ?></p>
			<div class="flex flex-wrap items-center gap-4">
				<?php if ( '' !== $nabp_mailto ) : ?>
					<a href="<?php echo esc_url( $nabp_mailto ); ?>" data-ga="email_cta_click" class="inline-flex items-center gap-3 bg-lime text-ink font-medium rounded-[32px] px-[26px] py-[12px] text-[18px] hover:opacity-90 transition-opacity">
						<?php echo nabp_icon( 'mail' ); ?>
						<?php esc_html_e( 'Email me', 'nab-portfolio' ); ?>
					</a>
				<?php endif; ?>
				<a href="#works" class="inline-flex items-center gap-3 border border-[#ffffff] rounded-[32px] px-[26px] py-[12px] text-[18px] opacity-80 hover:opacity-100 hover:border-lime transition">
					<?php esc_html_e( 'See case studies', 'nab-portfolio' ); ?>
					<?php echo nabp_icon( 'arrow-right' ); ?>
				</a>
			</div>
		</div>
		<div data-reveal>
			<img src="<?php echo esc_url( $nabp_photo ); ?>" alt="<?php esc_attr_e( 'Foto Nabil Hardiansa', 'nab-portfolio' ); ?>" class="w-full aspect-[4/3] object-cover rounded-[32px]" />
		</div>
	</div>
</section>
