<?php
get_header();

while ( have_posts() ) :
	the_post();
	?>
	<article <?php post_class( 'nab-container py-24' ); ?>>
		<h1 class="font-display text-lime text-[64px] leading-[1.15]"><?php the_title(); ?></h1>
	</article>
	<?php
endwhile;

get_footer();
