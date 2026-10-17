<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

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
<section id="how-i-work" class="nab-container py-20 lg:py-24" aria-labelledby="how-heading">
	<p class="font-display text-lime text-[20px] tracking-[0.08em] mb-3" data-reveal>// process</p>
	<h2 id="how-heading" class="font-display text-fog text-[56px] sm:text-[64px] lg:text-[96px] leading-[0.95] mb-12" data-reveal>How I Work</h2>
	<ol class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4" data-reveal-group>
		<?php foreach ( $nabp_steps as $nabp_step ) : ?>
			<li class="border border-fog/15 rounded-[24px] p-8 hover:border-lime/70 transition-colors">
				<p class="font-display text-lime text-[48px] leading-[1] mb-4"><?php echo esc_html( $nabp_step['num'] ); ?></p>
				<h3 class="font-display text-fog text-[26px] leading-[1.1] mb-3"><?php echo esc_html( $nabp_step['title'] ); ?></h3>
				<p class="text-fog/70 text-[16px] leading-[1.6]"><?php echo esc_html( $nabp_step['desc'] ); ?></p>
			</li>
		<?php endforeach; ?>
	</ol>
</section>
