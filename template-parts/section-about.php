<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$nabp_photo = nabp_mod( 'nabp_about_photo' );
$nabp_photo = '' === $nabp_photo ? nabp_placeholder( 620, 775 ) : $nabp_photo;

$nabp_steps = array(
	array(
		'num'   => '01',
		'title' => __( 'Understand', 'nab-portfolio' ),
		'desc'  => __( 'Understand the business context and goals before touching code — a misread problem leads to a solution aimed at the wrong target.', 'nab-portfolio' ),
	),
	array(
		'num'   => '02',
		'title' => __( 'Define', 'nab-portfolio' ),
		'desc'  => __( 'Agree on the solution plan and measurable scenarios up front, including the definition of "done".', 'nab-portfolio' ),
	),
	array(
		'num'   => '03',
		'title' => __( 'Build & iterate', 'nab-portfolio' ),
		'desc'  => __( 'Build incrementally with regular feedback — small, frequent, controlled changes.', 'nab-portfolio' ),
	),
	array(
		'num'   => '04',
		'title' => __( 'Deliver & measure', 'nab-portfolio' ),
		'desc'  => __( 'Hand over and measure impact — a project is complete when the results are proven, not when it ships.', 'nab-portfolio' ),
	),
);
?>
<section id="about" class="nab-container py-20 lg:py-24" aria-labelledby="about-heading">
	<p class="font-display text-lime text-[20px] tracking-[0.08em] mb-3" data-reveal>// about</p>
	<h2 id="about-heading" data-reveal-lines class="font-display text-fog text-[56px] sm:text-[64px] lg:text-[96px] leading-[0.95] mb-12">HOW I APPROACH PROBLEMS</h2>

	<div class="grid gap-12 lg:gap-16 lg:grid-cols-[minmax(0,1fr)_minmax(0,1.25fr)] lg:items-stretch">
		<div class="group relative aspect-[3/4] lg:aspect-auto lg:h-full lg:min-h-[520px]" data-reveal>
			<div class="absolute -inset-3 border-2 border-lime/40 rounded-[28px] -translate-x-4 translate-y-4 transition-transform duration-500 ease-out group-hover:-translate-x-5 group-hover:translate-y-5" aria-hidden="true"></div>
			<div class="relative h-full w-full overflow-hidden rounded-[24px]">
				<img src="<?php echo esc_url( $nabp_photo ); ?>" alt="<?php esc_attr_e( 'Workspace of Nabil Hardiansa', 'nab-portfolio' ); ?>" class="h-full w-full object-cover grayscale transition duration-700 ease-out group-hover:grayscale-0 group-hover:scale-[1.06]" loading="lazy" />
			</div>
		</div>

		<div>
			<div class="text-fog/80 text-[18px] sm:text-[20px] lg:text-[22px] leading-[1.6] [&_p]:mb-6 [&_p:last-child]:mb-0" data-reveal>
				<?php echo wpautop( esc_html( nabp_mod( 'nabp_about_story' ) ) ); ?>
			</div>

			<div class="mt-12 lg:mt-16">
				<p class="font-display text-lime text-[20px] tracking-[0.08em] mb-6" data-reveal>// how i work</p>
				<ol class="border-t border-fog/20" data-reveal-group>
					<?php foreach ( $nabp_steps as $nabp_step ) : ?>
						<li class="group grid grid-cols-[56px_minmax(0,1fr)] gap-4 items-baseline border-b border-fog/20 py-5">
							<span class="font-display text-lime text-[24px] leading-[1]"><?php echo esc_html( $nabp_step['num'] ); ?></span>
							<div>
								<h3 class="font-display text-fog text-[24px] sm:text-[28px] leading-[1.1] mb-1 group-hover:text-lime transition-colors"><?php echo esc_html( $nabp_step['title'] ); ?></h3>
								<p class="text-fog/70 text-[16px] leading-[1.6] max-w-[520px]"><?php echo esc_html( $nabp_step['desc'] ); ?></p>
							</div>
						</li>
					<?php endforeach; ?>
				</ol>
			</div>
		</div>
	</div>
</section>
