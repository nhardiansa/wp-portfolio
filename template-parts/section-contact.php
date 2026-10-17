<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$nabp_mailto  = nabp_mailto_url();
$nabp_socials = nabp_social_links();
$nabp_resume  = nabp_mod( 'nabp_resume_url' );
?>
<section id="contact" class="nab-container pt-20 lg:pt-24 pb-12" aria-labelledby="contact-heading">
	<p class="font-display text-lime text-[20px] tracking-[0.08em] mb-3" data-reveal>// contact</p>
	<h2 id="contact-heading" data-reveal-lines class="font-display text-lime text-display-xl leading-[0.88] mb-10">LET'S WORK TOGETHER</h2>

	<div class="grid gap-10 lg:grid-cols-[1.2fr_1fr] lg:items-end" data-reveal>
		<div>
			<?php if ( '' !== $nabp_mailto ) : ?>
				<p class="text-fog/70 text-[18px] mb-4"><?php esc_html_e( 'Tell me about the problem you are facing — I usually reply within 24 hours.', 'nab-portfolio' ); ?></p>
				<a href="<?php echo esc_url( $nabp_mailto ); ?>" data-ga="email_cta_click" class="inline-flex items-center gap-3 bg-lime text-ink font-medium rounded-[32px] px-[26px] py-[12px] text-[18px] hover:opacity-90 transition-opacity">
					<?php echo nabp_icon( 'mail' ); ?>
					<span class="break-all"><?php echo esc_html( nabp_mod( 'nabp_contact_email' ) ); ?></span>
				</a>
			<?php endif; ?>
		</div>
		<div class="flex flex-col gap-6 lg:items-end">
			<?php if ( ! empty( $nabp_socials ) ) : ?>
				<ul class="flex flex-wrap lg:justify-end gap-3">
					<?php foreach ( $nabp_socials as $nabp_label => $nabp_url ) : ?>
						<li>
							<a href="<?php echo esc_url( $nabp_url ); ?>" class="inline-block border border-[#ffffff] rounded-[32px] px-[20px] py-[10px] text-[16px] opacity-80 hover:opacity-100 hover:border-lime transition"><?php echo esc_html( $nabp_label ); ?></a>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
			<?php if ( '' !== $nabp_resume ) : ?>
				<a href="<?php echo esc_url( $nabp_resume ); ?>" data-ga="resume_download" target="_blank" rel="noopener" class="inline-flex items-center gap-2 text-lime hover:text-fog transition-colors">
					<?php echo nabp_icon( 'download' ); ?>
					<?php esc_html_e( 'Download resume (PDF)', 'nab-portfolio' ); ?>
				</a>
			<?php endif; ?>
		</div>
	</div>
</section>
