<?php
get_header();
?>
<div class="nab-container py-24 text-center">
	<p class="font-display text-display-xl text-lime leading-[0.88] mb-6">404</p>
	<p class="text-fog text-[24px] mb-10"><?php esc_html_e( 'The page you are looking for could not be found.', 'nab-portfolio' ); ?></p>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="inline-block border border-[#ffffff] rounded-[32px] px-[26px] py-[12px] text-[18px] opacity-80 hover:opacity-100 transition-opacity"><?php esc_html_e( 'Back to home', 'nab-portfolio' ); ?></a>
</div>
<?php
get_footer();
