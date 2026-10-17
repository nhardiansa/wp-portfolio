<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$nabp_query = new WP_Query(
	array(
		'post_type'      => 'client_quote',
		'posts_per_page' => 6,
		'no_found_rows'  => true,
	)
);

if ( ! $nabp_query->have_posts() ) {
	return;
}
?>
<section id="testimonial" class="nab-container py-20 lg:py-24" aria-labelledby="testimonial-heading">
	<p class="font-display text-lime text-[20px] tracking-[0.08em] mb-3" data-reveal>// testimonial</p>
	<h2 id="testimonial-heading" class="font-display text-fog text-[56px] sm:text-[64px] lg:text-[96px] leading-[0.95] mb-12" data-reveal>What Clients Say</h2>

	<div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3" data-reveal-group>
		<?php while ( $nabp_query->have_posts() ) : $nabp_query->the_post(); ?>
			<figure class="bg-smoke rounded-[16px] p-8 flex flex-col">
				<div class="font-display text-lime text-[64px] leading-[0.8] mb-4" aria-hidden="true">&ldquo;</div>
				<blockquote class="text-fog text-[18px] leading-[1.6] mb-6 [&_p:last-child]:mb-0">
					<?php echo apply_filters( 'the_content', get_the_content() ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				</blockquote>
				<figcaption class="mt-auto">
					<p class="text-[#ffffff] font-medium text-[18px] mb-1"><?php echo esc_html( (string) get_post_meta( get_the_ID(), '_nabp_cq_name', true ) ); ?></p>
					<p class="text-fog/70 text-[16px]"><?php echo esc_html( (string) get_post_meta( get_the_ID(), '_nabp_cq_role', true ) ); ?></p>
				</figcaption>
			</figure>
		<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>
	</div>
</section>
