<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$nabp_items = array();
$nabp_query = new WP_Query(
	array(
		'post_type'      => 'career',
		'posts_per_page' => 10,
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
		'no_found_rows'  => true,
	)
);

if ( $nabp_query->have_posts() ) {
	while ( $nabp_query->have_posts() ) {
		$nabp_query->the_post();
		$nabp_items[] = array(
			'period' => (string) get_post_meta( get_the_ID(), '_nabp_career_period', true ),
			'role'   => (string) get_post_meta( get_the_ID(), '_nabp_career_role', true ),
			'title'  => get_the_title(),
			'desc'   => apply_filters( 'the_content', get_the_content() ),
		);
	}
	wp_reset_postdata();
} else {
	$nabp_items = array(
		array(
			'period' => '2021 — 2022',
			'role'   => 'Web Developer',
			'title'  => 'Widantech',
			'desc'   => '<p>' . esc_html__( 'Membangun dan memelihara aplikasi web internal berbasis PHP untuk alur operasional klien.', 'nab-portfolio' ) . '</p>',
		),
		array(
			'period' => '2022 — 2023',
			'role'   => 'Fullstack Web Developer',
			'title'  => 'Nusacodes',
			'desc'   => '<p>' . esc_html__( 'Mengembangkan fitur layanan web pada tim produk, dari UI hingga integrasi API.', 'nab-portfolio' ) . '</p>',
		),
		array(
			'period' => '2023 — sekarang',
			'role'   => 'Fullstack Web Developer',
			'title'  => 'PT. Chakra Giri Indonesia',
			'desc'   => '<p>' . esc_html__( 'Mengerjakan project web klien lintas industri sebagai bagian dari tim pengembangan.', 'nab-portfolio' ) . '</p>',
		),
	);
}
?>
<section id="career" class="nab-container py-20 lg:py-24" aria-labelledby="career-heading">
	<p class="font-display text-lime text-[20px] tracking-[0.08em] mb-3" data-reveal>// experience</p>
	<h2 id="career-heading" class="font-display text-fog text-[56px] sm:text-[64px] lg:text-[96px] leading-[0.95] mb-12" data-reveal>Experience</h2>

	<ol class="relative border-l-2 border-fog/20 max-w-[820px]" data-reveal-group>
		<?php foreach ( $nabp_items as $nabp_item ) : ?>
			<li class="relative pl-10 pb-12 last:pb-0">
				<span class="absolute -left-[9px] top-2 w-4 h-4 rounded-full bg-lime" aria-hidden="true"></span>
				<p class="font-display text-lime text-[20px] leading-[1.15] mb-1"><?php echo esc_html( $nabp_item['period'] ); ?></p>
				<h3 class="font-display text-fog text-[30px] sm:text-[36px] leading-[1.05] mb-1"><?php echo esc_html( $nabp_item['title'] ); ?></h3>
				<p class="text-fog text-[18px] font-medium mb-2"><?php echo esc_html( $nabp_item['role'] ); ?></p>
				<?php if ( '' !== trim( $nabp_item['desc'] ) ) : ?>
					<div class="text-fog/70 text-[16px] leading-[1.6] max-w-[640px] [&_p:last-child]:mb-0"><?php echo wp_kses_post( $nabp_item['desc'] ); ?></div>
				<?php endif; ?>
			</li>
		<?php endforeach; ?>
	</ol>
</section>
