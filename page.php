<?php
get_header();

while ( have_posts() ) :
	the_post();
	?>
	<div class="nab-container py-24">
		<h1 class="font-display text-lime text-[64px] leading-[1.15] mb-8"><?php the_title(); ?></h1>
		<div class="entry-content text-fog text-[24px] leading-[1.55] max-w-[720px]">
			<?php the_content(); ?>
		</div>
	</div>
	<?php
endwhile;

get_footer();
