<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$nabp_items = array();
$nabp_query = new WP_Query(
	array(
		'post_type'      => 'stack_item',
		'posts_per_page' => 12,
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
		'no_found_rows'  => true,
	)
);

if ( $nabp_query->have_posts() ) {
	while ( $nabp_query->have_posts() ) {
		$nabp_query->the_post();
		$nabp_items[] = get_the_title();
	}
	wp_reset_postdata();
} else {
	$nabp_items = array( 'PHP', 'JavaScript', 'Laravel', 'MySQL' );
}
?>
<section id="stack" class="nab-container py-20 lg:py-24" aria-labelledby="stack-heading">
	<p class="font-display text-lime text-[20px] tracking-[0.08em] mb-3" data-reveal>// stack</p>
	<h2 id="stack-heading" class="font-display text-fog text-[56px] sm:text-[64px] lg:text-[96px] leading-[0.95] mb-12" data-reveal>Stack</h2>

	<ul class="border-t border-fog/20" data-reveal-group>
		<?php foreach ( $nabp_items as $nabp_i => $nabp_item ) : ?>
			<li class="flex items-baseline justify-between gap-4 border-b border-fog/20 py-5 sm:py-6">
				<span class="font-display text-display-skill leading-[1] <?php echo 0 === $nabp_i ? 'text-lime' : 'text-fog'; ?>"><?php echo esc_html( $nabp_item ); ?></span>
				<span class="font-display text-lime text-[28px] sm:text-[32px]"><?php echo esc_html( str_pad( (string) ( $nabp_i + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
			</li>
		<?php endforeach; ?>
	</ul>
</section>
