<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$nabp_items = array();
$nabp_query = new WP_Query(
	array(
		'post_type'      => 'stack_item',
		'posts_per_page' => 6,
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
		'no_found_rows'  => true,
	)
);

if ( $nabp_query->have_posts() ) {
	while ( $nabp_query->have_posts() ) {
		$nabp_query->the_post();
		$nabp_items[] = array(
			'title' => get_the_title(),
			'desc'  => apply_filters( 'the_content', get_the_content() ),
		);
	}
	wp_reset_postdata();
} else {
	$nabp_items = array(
		array(
			'title' => __( 'Tech Consultant', 'nab-portfolio' ),
			'desc'  => __( 'Audits, architecture, and technical decision-making — from stack selection to scaling strategy.', 'nab-portfolio' ),
		),
		array(
			'title' => __( 'Web & Mobile App Dev', 'nab-portfolio' ),
			'desc'  => __( 'End-to-end web and mobile applications: user flows, APIs, and production deployment.', 'nab-portfolio' ),
		),
		array(
			'title' => __( 'Private Mentoring', 'nab-portfolio' ),
			'desc'  => __( 'One-on-one mentoring for developers levelling up — code reviews, learning roadmaps, and hands-on practice.', 'nab-portfolio' ),
		),
	);
}
?>
<section id="capabilities" class="nab-container py-20 lg:py-24" aria-labelledby="capabilities-heading">
	<p class="font-display text-lime text-[20px] tracking-[0.08em] mb-3" data-reveal>// capabilities</p>
	<h2 id="capabilities-heading" data-reveal-lines class="font-display text-fog text-[56px] sm:text-[64px] lg:text-[96px] leading-[0.95] mb-12">WHAT I DO</h2>

	<ol class="border-t border-fog/20" data-reveal-group>
		<?php foreach ( $nabp_items as $nabp_i => $nabp_item ) : ?>
			<li class="group grid gap-3 lg:grid-cols-[96px_minmax(0,1fr)_minmax(0,380px)] lg:gap-8 lg:items-baseline border-b border-fog/20 py-8 lg:py-10">
				<span class="font-display text-lime text-[28px] lg:text-[36px] leading-[1]"><?php echo esc_html( str_pad( (string) ( $nabp_i + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
				<h3 class="font-display text-fog text-[40px] sm:text-[52px] lg:text-[64px] leading-[0.95] group-hover:text-lime transition-colors"><?php echo esc_html( $nabp_item['title'] ); ?></h3>
				<div class="text-fog/70 text-[16px] lg:text-[18px] leading-[1.6] [&_p:last-child]:mb-0"><?php echo wp_kses_post( $nabp_item['desc'] ); ?></div>
			</li>
		<?php endforeach; ?>
	</ol>
</section>
