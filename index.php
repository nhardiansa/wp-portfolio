<?php
get_header();
?>
<div class="nab-container py-24">
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<article <?php post_class( 'mb-16' ); ?>>
				<h2 class="font-display text-lime text-[40px] leading-[1.15] mb-3">
					<a href="<?php the_permalink(); ?>" class="hover:text-fog transition-colors"><?php the_title(); ?></a>
				</h2>
				<div class="text-fog text-[18px] leading-[1.55] max-w-[720px]"><?php the_excerpt(); ?></div>
			</article>
		<?php endwhile; ?>
	<?php else : ?>
		<p class="text-fog text-[24px]"><?php esc_html_e( 'Nothing found.', 'nab-portfolio' ); ?></p>
	<?php endif; ?>
</div>
<?php
get_footer();
