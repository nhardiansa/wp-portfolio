<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
</main>
<?php get_template_part( 'template-parts/section', 'contact' ); ?>
<footer class="nab-container pb-8">
	<hr class="border-fog/20 mb-8" />
	<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
		<p class="text-fog/60 text-[16px]">
			<?php
			printf(
				esc_html__( '© %1$s %2$s. All rights reserved.', 'nab-portfolio' ),
				esc_html( gmdate( 'Y' ) ),
				esc_html( nabp_mod( 'nabp_copyright_name' ) )
			);
			?>
		</p>
		<p class="font-display text-lime text-[18px] tracking-[0.08em]"><?php echo esc_html( nabp_mod( 'nabp_hero_tagline' ) ); ?></p>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
