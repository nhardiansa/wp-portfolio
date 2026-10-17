<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$nabp_photo = nabp_mod( 'nabp_about_photo' );
$nabp_photo = '' === $nabp_photo ? nabp_placeholder( 620, 707 ) : $nabp_photo;
?>
<section id="about" class="nab-container py-20 lg:py-24" aria-labelledby="about-heading">
	<p class="font-display text-lime text-[20px] tracking-[0.08em] mb-3" data-reveal>// about</p>
	<h2 id="about-heading" class="font-display text-fog text-[56px] sm:text-[64px] lg:text-[96px] leading-[0.95] mb-12" data-reveal>HOW I APPROACH PROBLEMS</h2>
	<div class="grid gap-12 lg:gap-16 lg:grid-cols-[1fr_1.25fr] lg:items-center">
		<div data-reveal>
			<img src="<?php echo esc_url( $nabp_photo ); ?>" alt="<?php esc_attr_e( 'Workspace Nabil Hardiansa', 'nab-portfolio' ); ?>" class="w-full aspect-[3/4] object-cover rounded-[32px]" loading="lazy" />
		</div>
		<div class="text-fog/80 text-[18px] sm:text-[20px] lg:text-[24px] leading-[1.6] [&_p]:mb-6 [&_p:last-child]:mb-0" data-reveal>
			<?php echo wpautop( esc_html( nabp_mod( 'nabp_about_story' ) ) ); ?>
		</div>
	</div>
</section>
