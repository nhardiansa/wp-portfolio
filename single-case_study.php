<?php
get_header();

while ( have_posts() ) :
	the_post();

	$nabp_url     = (string) get_post_meta( get_the_ID(), '_nabp_cs_url', true );
	$nabp_role    = (string) get_post_meta( get_the_ID(), '_nabp_cs_role', true );
	$nabp_client  = (string) get_post_meta( get_the_ID(), '_nabp_cs_client', true );
	$nabp_period  = (string) get_post_meta( get_the_ID(), '_nabp_cs_period', true );
	$nabp_stack   = nabp_case_stack_items( get_the_ID() );
	$nabp_cover   = nabp_case_cover( get_the_ID(), 0 );
	$nabp_prev    = get_previous_post();
	$nabp_next    = get_next_post();
	$nabp_mailto  = nabp_mailto_url();

	$nabp_sections = array(
		array(
			'key'   => '_nabp_cs_problem',
			'num'   => '01',
			'label' => __( 'Problem', 'nab-portfolio' ),
			'lime'  => false,
		),
		array(
			'key'   => '_nabp_cs_approach',
			'num'   => '02',
			'label' => __( 'Approach', 'nab-portfolio' ),
			'lime'  => false,
		),
		array(
			'key'   => '_nabp_cs_solution',
			'num'   => '03',
			'label' => __( 'Solution', 'nab-portfolio' ),
			'lime'  => false,
		),
		array(
			'key'   => '_nabp_cs_result',
			'num'   => '04',
			'label' => __( 'Result', 'nab-portfolio' ),
			'lime'  => true,
		),
	);
	?>
	<article <?php post_class(); ?> data-ga-case-study="<?php echo esc_attr( get_the_title() ); ?>">

		<header class="nab-container pt-12 pb-12 lg:pt-16" aria-labelledby="case-title">
			<p class="font-display text-lime text-[20px] tracking-[0.08em] mb-3" data-reveal>// case study</p>
			<h1 id="case-title" class="font-display text-fog text-display-tag leading-[0.95] max-w-[900px] mb-10" data-reveal><?php the_title(); ?></h1>

			<dl class="grid grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8 border-y border-fog/15 py-8" data-reveal>
				<div>
					<dt class="text-fog/50 text-[14px] uppercase tracking-[0.08em] mb-2"><?php esc_html_e( 'Role', 'nab-portfolio' ); ?></dt>
					<dd class="text-fog text-[17px] font-medium"><?php echo esc_html( '' !== $nabp_role ? $nabp_role : '—' ); ?></dd>
				</div>
				<div>
					<dt class="text-fog/50 text-[14px] uppercase tracking-[0.08em] mb-2"><?php esc_html_e( 'Client / Context', 'nab-portfolio' ); ?></dt>
					<dd class="text-fog text-[17px] font-medium"><?php echo esc_html( '' !== $nabp_client ? $nabp_client : '—' ); ?></dd>
				</div>
				<div>
					<dt class="text-fog/50 text-[14px] uppercase tracking-[0.08em] mb-2"><?php esc_html_e( 'Period', 'nab-portfolio' ); ?></dt>
					<dd class="text-fog text-[17px] font-medium"><?php echo esc_html( '' !== $nabp_period ? $nabp_period : '—' ); ?></dd>
				</div>
				<div>
					<dt class="text-fog/50 text-[14px] uppercase tracking-[0.08em] mb-2"><?php esc_html_e( 'Tech Stack', 'nab-portfolio' ); ?></dt>
					<dd class="text-fog text-[17px] font-medium"><?php echo esc_html( ! empty( $nabp_stack ) ? implode( ', ', $nabp_stack ) : '—' ); ?></dd>
				</div>
			</dl>
		</header>

		<div class="nab-container pb-16 lg:pb-20" data-reveal>
			<img src="<?php echo esc_url( $nabp_cover ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" class="w-full aspect-[16/9] object-cover rounded-[32px]" />
			<?php if ( '' !== $nabp_url ) : ?>
				<p class="mt-6">
					<a href="<?php echo esc_url( $nabp_url ); ?>" target="_blank" rel="noopener" class="inline-flex items-center gap-2 text-lime hover:text-fog transition-colors">
						<?php echo nabp_icon( 'external' ); ?>
						<?php esc_html_e( 'Visit project', 'nab-portfolio' ); ?>
					</a>
				</p>
			<?php endif; ?>
		</div>

		<?php foreach ( $nabp_sections as $nabp_section ) : ?>
			<?php $nabp_content = trim( (string) get_post_meta( get_the_ID(), $nabp_section['key'], true ) ); ?>
			<?php if ( '' !== $nabp_content ) : ?>
				<section class="nab-container pb-16 lg:pb-20" aria-labelledby="case-<?php echo esc_attr( ltrim( $nabp_section['key'], '_' ) ); ?>">
					<p class="font-display text-lime text-[20px] tracking-[0.08em] mb-3" data-reveal><?php echo esc_html( $nabp_section['num'] . ' — ' . strtolower( $nabp_section['label'] ) ); ?></p>
					<h2 id="case-<?php echo esc_attr( ltrim( $nabp_section['key'], '_' ) ); ?>" data-reveal class="font-display text-[48px] lg:text-[64px] leading-[0.95] mb-8 <?php echo $nabp_section['lime'] ? 'text-lime' : 'text-fog'; ?>" data-reveal><?php echo esc_html( $nabp_section['label'] ); ?></h2>
					<div class="text-fog/85 text-[18px] sm:text-[20px] leading-[1.7] max-w-[720px] [&_p]:mb-6 [&_p:last-child]:mb-0 [&_ul]:list-disc [&_ul]:pl-6 [&_ul]:mb-6 [&_ul:last-child]:mb-0 [&_li]:mb-2 [&_a]:text-lime [&_a:hover]:underline" data-reveal>
						<?php echo wp_kses_post( $nabp_content ); ?>
					</div>
				</section>
			<?php endif; ?>
		<?php endforeach; ?>

		<?php if ( '' !== $nabp_mailto ) : ?>
			<section class="nab-container pb-16 lg:pb-20" data-reveal>
				<div class="border border-lime/40 rounded-[32px] p-10 lg:p-16 text-center">
					<h2 class="font-display text-lime text-[36px] sm:text-[48px] leading-[1] mb-4"><?php esc_html_e( 'Have a similar problem?', 'nab-portfolio' ); ?></h2>
					<p class="text-fog/70 text-[18px] mb-8"><?php esc_html_e( 'Let us discuss how the same approach could work for you.', 'nab-portfolio' ); ?></p>
					<a href="<?php echo esc_url( $nabp_mailto ); ?>" data-ga="email_cta_click" class="inline-flex items-center gap-3 bg-lime text-ink font-medium rounded-[32px] px-[26px] py-[12px] text-[18px] hover:opacity-90 transition-opacity">
						<?php echo nabp_icon( 'mail' ); ?>
						<?php esc_html_e( 'Let us talk over email', 'nab-portfolio' ); ?>
					</a>
				</div>
			</section>
		<?php endif; ?>

		<?php if ( $nabp_prev instanceof WP_Post || $nabp_next instanceof WP_Post ) : ?>
			<nav class="nab-container pb-20 lg:pb-24" aria-label="<?php esc_attr_e( 'Project navigation', 'nab-portfolio' ); ?>" data-reveal>
				<div class="grid gap-6 <?php echo ( $nabp_prev instanceof WP_Post && $nabp_next instanceof WP_Post ) ? 'md:grid-cols-2' : ''; ?>">
					<?php if ( $nabp_prev instanceof WP_Post ) : ?>
						<a href="<?php echo esc_url( get_permalink( $nabp_prev ) ); ?>" class="group border border-fog/15 rounded-[24px] p-8 hover:border-lime transition-colors">
							<p class="font-display text-lime text-[18px] mb-2"><span aria-hidden="true">←</span> <?php esc_html_e( 'Previous project', 'nab-portfolio' ); ?></p>
							<p class="font-display text-fog text-[24px] leading-[1.1] group-hover:text-lime transition-colors"><?php echo esc_html( get_the_title( $nabp_prev ) ); ?></p>
						</a>
					<?php endif; ?>
					<?php if ( $nabp_next instanceof WP_Post ) : ?>
						<a href="<?php echo esc_url( get_permalink( $nabp_next ) ); ?>" class="group border border-fog/15 rounded-[24px] p-8 text-right hover:border-lime transition-colors">
							<p class="font-display text-lime text-[18px] mb-2"><?php esc_html_e( 'Next project', 'nab-portfolio' ); ?> <span aria-hidden="true">→</span></p>
							<p class="font-display text-fog text-[24px] leading-[1.1] group-hover:text-lime transition-colors"><?php echo esc_html( get_the_title( $nabp_next ) ); ?></p>
						</a>
					<?php endif; ?>
				</div>
			</nav>
		<?php endif; ?>

	</article>
	<?php
endwhile;

get_footer();
