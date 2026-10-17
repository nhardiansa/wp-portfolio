<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$nabp_photo = nabp_mod( 'nabp_about_photo' );
$nabp_photo = '' === $nabp_photo ? nabp_placeholder( 620, 775 ) : $nabp_photo;

$nabp_steps = array(
	array(
		'num'   => '01',
		'title' => __( 'Understand', 'nab-portfolio' ),
		'desc'  => __( 'Pahami konteks bisnis & tujuan sebelum menyentuh kode — masalah yang salah difahami berujung solusi salah sasaran.', 'nab-portfolio' ),
	),
	array(
		'num'   => '02',
		'title' => __( 'Define', 'nab-portfolio' ),
		'desc'  => __( 'Rencana solusi & skenario terukur disepakati di awal, termasuk definisi "selesai".', 'nab-portfolio' ),
	),
	array(
		'num'   => '03',
		'title' => __( 'Build & iterate', 'nab-portfolio' ),
		'desc'  => __( 'Bangun bertahap dengan feedback rutin — perubahan kecil, sering, dan terkontrol.', 'nab-portfolio' ),
	),
	array(
		'num'   => '04',
		'title' => __( 'Deliver & measure', 'nab-portfolio' ),
		'desc'  => __( 'Serah terima plus pengukuran dampak — project selesai saat hasilnya terbukti, bukan saat deploy.', 'nab-portfolio' ),
	),
);
?>
<section id="about" class="nab-container py-20 lg:py-24" aria-labelledby="about-heading">
	<p class="font-display text-lime text-[20px] tracking-[0.08em] mb-3" data-reveal>// about</p>
	<h2 id="about-heading" class="font-display text-fog text-[56px] sm:text-[64px] lg:text-[96px] leading-[0.95] mb-12" data-reveal>HOW I APPROACH PROBLEMS</h2>

	<div class="grid gap-12 lg:gap-16 lg:grid-cols-[minmax(0,1fr)_minmax(0,1.25fr)] lg:items-start">
		<div class="relative" data-reveal>
			<div class="absolute -inset-3 border-2 border-lime/40 rounded-[28px] -translate-x-4 translate-y-4" aria-hidden="true"></div>
			<img src="<?php echo esc_url( $nabp_photo ); ?>" alt="<?php esc_attr_e( 'Workspace Nabil Hardiansa', 'nab-portfolio' ); ?>" class="relative w-full aspect-[3/4] object-cover rounded-[24px] grayscale hover:grayscale-0 transition duration-500" loading="lazy" />
		</div>

		<div>
			<div class="text-fog/80 text-[18px] sm:text-[20px] lg:text-[22px] leading-[1.6] [&_p]:mb-6 [&_p:last-child]:mb-0" data-reveal>
				<?php echo wpautop( esc_html( nabp_mod( 'nabp_about_story' ) ) ); ?>
			</div>

			<div class="mt-12 lg:mt-16">
				<p class="font-display text-lime text-[20px] tracking-[0.08em] mb-6" data-reveal>// how i work</p>
				<ol class="border-t border-fog/20" data-reveal-group>
					<?php foreach ( $nabp_steps as $nabp_step ) : ?>
						<li class="group grid grid-cols-[56px_minmax(0,1fr)] gap-4 items-baseline border-b border-fog/20 py-5">
							<span class="font-display text-lime text-[24px] leading-[1]"><?php echo esc_html( $nabp_step['num'] ); ?></span>
							<div>
								<h3 class="font-display text-fog text-[24px] sm:text-[28px] leading-[1.1] mb-1 group-hover:text-lime transition-colors"><?php echo esc_html( $nabp_step['title'] ); ?></h3>
								<p class="text-fog/70 text-[16px] leading-[1.6] max-w-[520px]"><?php echo esc_html( $nabp_step['desc'] ); ?></p>
							</div>
						</li>
					<?php endforeach; ?>
				</ol>
			</div>
		</div>
	</div>
</section>
