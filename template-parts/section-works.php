<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! nabp_has_case_studies() ) {
	return;
}

$nabp_items = array();
$nabp_query = new WP_Query(
	array(
		'post_type'      => 'case_study',
		'posts_per_page' => 6,
		'no_found_rows'  => true,
	)
);

while ( $nabp_query->have_posts() ) {
	$nabp_query->the_post();
	$nabp_items[] = array(
		'link'    => get_permalink(),
		'title'   => get_the_title(),
		'summary' => nabp_case_summary( get_the_ID() ),
		'cover'   => nabp_case_cover( get_the_ID(), count( $nabp_items ) ),
		'stack'   => nabp_case_stack_items( get_the_ID() ),
	);
}
wp_reset_postdata();
?>
<section id="works" class="nab-container py-20 lg:py-24" aria-labelledby="works-heading">
	<p class="font-display text-lime text-[20px] tracking-[0.08em] mb-3" data-reveal>// selected works</p>
	<h2 id="works-heading" data-reveal-lines class="font-display text-fog text-[56px] sm:text-[64px] lg:text-[96px] leading-[0.95] mb-12">Case Studies</h2>

	<div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3" data-reveal-group>
		<?php foreach ( $nabp_items as $nabp_item ) : ?>
			<a href="<?php echo esc_url( $nabp_item['link'] ); ?>" class="group block">
				<div class="aspect-[4/3] rounded-[24px] overflow-hidden border border-fog/15 group-hover:border-lime transition-colors mb-5">
					<img src="<?php echo esc_url( $nabp_item['cover'] ); ?>" alt="<?php echo esc_attr( $nabp_item['title'] ); ?>" class="w-full h-full object-cover group-hover:opacity-90 transition-opacity" loading="lazy" />
				</div>
				<h3 class="font-display text-fog text-[26px] lg:text-[28px] leading-[1.1] group-hover:text-lime transition-colors mb-2"><?php echo esc_html( $nabp_item['title'] ); ?></h3>
				<?php if ( '' !== $nabp_item['summary'] ) : ?>
					<p class="text-fog/70 text-[16px] leading-[1.55] mb-4 line-clamp-2"><?php echo esc_html( $nabp_item['summary'] ); ?></p>
				<?php endif; ?>
				<?php if ( ! empty( $nabp_item['stack'] ) ) : ?>
					<ul class="flex flex-wrap gap-2">
						<?php foreach ( $nabp_item['stack'] as $nabp_chip ) : ?>
							<li class="border border-fog/25 rounded-full px-3 py-1 text-[13px] text-fog/70"><?php echo esc_html( $nabp_chip ); ?></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</a>
		<?php endforeach; ?>
	</div>
</section>
