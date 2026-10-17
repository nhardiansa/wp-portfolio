<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function nabp_register_post_types(): void {
	register_post_type(
		'case_study',
		array(
			'labels'        => array(
				'name'          => __( 'Case Studies', 'nab-portfolio' ),
				'singular_name' => __( 'Case Study', 'nab-portfolio' ),
				'add_new_item'  => __( 'Add New Case Study', 'nab-portfolio' ),
			),
			'public'        => true,
			'show_ui'       => true,
			'show_in_rest'  => true,
			'supports'      => array( 'title', 'thumbnail', 'excerpt' ),
			'menu_icon'     => 'dashicons-portfolio',
			'menu_position' => 20,
			'has_archive'   => false,
			'rewrite'       => array( 'slug' => 'case-study' ),
		)
	);

	register_post_type(
		'career',
		array(
			'labels'             => array(
				'name'          => __( 'Career', 'nab-portfolio' ),
				'singular_name' => __( 'Career Item', 'nab-portfolio' ),
				'add_new_item'  => __( 'Add New Career Item', 'nab-portfolio' ),
			),
			'public'             => false,
			'show_ui'            => true,
			'publicly_queryable' => false,
			'show_in_rest'       => true,
			'supports'           => array( 'title', 'editor', 'page-attributes' ),
			'menu_icon'          => 'dashicons-businessperson',
			'menu_position'      => 21,
			'has_archive'        => false,
			'rewrite'            => false,
		)
	);

	register_post_type(
		'stack_item',
		array(
			'labels'             => array(
				'name'          => __( 'Capabilities', 'nab-portfolio' ),
				'singular_name' => __( 'Capability', 'nab-portfolio' ),
				'add_new_item'  => __( 'Add New Capability', 'nab-portfolio' ),
			),
			'public'             => false,
			'show_ui'            => true,
			'publicly_queryable' => false,
			'show_in_rest'       => true,
			'supports'           => array( 'title', 'editor', 'page-attributes' ),
			'menu_icon'          => 'dashicons-list-view',
			'menu_position'      => 22,
			'has_archive'        => false,
			'rewrite'            => false,
		)
	);

	register_post_type(
		'client_quote',
		array(
			'labels'             => array(
				'name'          => __( 'Client Quotes', 'nab-portfolio' ),
				'singular_name' => __( 'Client Quote', 'nab-portfolio' ),
				'add_new_item'  => __( 'Add New Client Quote', 'nab-portfolio' ),
			),
			'public'             => false,
			'show_ui'            => true,
			'publicly_queryable' => false,
			'show_in_rest'       => true,
			'supports'           => array( 'title', 'editor' ),
			'menu_icon'          => 'dashicons-format-quote',
			'menu_position'      => 23,
			'has_archive'        => false,
			'rewrite'            => false,
		)
	);
}
add_action( 'init', 'nabp_register_post_types' );

function nabp_add_meta_boxes(): void {
	add_meta_box( 'nabp_case_sections', __( 'Case Study Sections', 'nab-portfolio' ), 'nabp_case_sections_html', 'case_study', 'normal', 'high' );
	add_meta_box( 'nabp_case_details', __( 'Case Study Details', 'nab-portfolio' ), 'nabp_case_details_html', 'case_study', 'side' );
	add_meta_box( 'nabp_career_box', __( 'Career Details', 'nab-portfolio' ), 'nabp_career_box_html', 'career', 'side' );
	add_meta_box( 'nabp_quote_box', __( 'Client Details', 'nab-portfolio' ), 'nabp_quote_box_html', 'client_quote', 'normal' );
}
add_action( 'add_meta_boxes', 'nabp_add_meta_boxes' );

function nabp_case_sections_html( WP_Post $post ): void {
	wp_nonce_field( 'nabp_save_meta', 'nabp_meta_nonce' );

	$sections = array(
		'_nabp_cs_problem'  => array(
			'label' => __( 'Problem', 'nab-portfolio' ),
			'hint'  => __( 'What problem was solved? Explain the context.', 'nab-portfolio' ),
		),
		'_nabp_cs_approach' => array(
			'label' => __( 'Approach', 'nab-portfolio' ),
			'hint'  => __( 'How did you approach and work through the problem?', 'nab-portfolio' ),
		),
		'_nabp_cs_solution' => array(
			'label' => __( 'Solution', 'nab-portfolio' ),
			'hint'  => __( 'What did you build? Key features and decisions.', 'nab-portfolio' ),
		),
		'_nabp_cs_result'   => array(
			'label' => __( 'Result', 'nab-portfolio' ),
			'hint'  => __( 'Measurable impact — numbers/metrics before → after where available.', 'nab-portfolio' ),
		),
	);

	foreach ( $sections as $key => $conf ) {
		$value     = (string) get_post_meta( $post->ID, $key, true );
		$editor_id = ltrim( $key, '_' );
		?>
		<div style="margin-bottom: 24px;">
			<h3 style="margin: 0;"><?php echo esc_html( $conf['label'] ); ?></h3>
			<p class="description"><?php echo esc_html( $conf['hint'] ); ?></p>
			<?php
			wp_editor(
				$value,
				$editor_id,
				array(
					'textarea_name' => $key,
					'media_buttons' => true,
					'textarea_rows' => 8,
				)
			);
			?>
		</div>
		<?php
	}
}

function nabp_case_details_html( WP_Post $post ): void {
	$fields = array(
		'_nabp_cs_role'   => array( 'label' => __( 'Role', 'nab-portfolio' ), 'type' => 'text' ),
		'_nabp_cs_client' => array( 'label' => __( 'Client / Context', 'nab-portfolio' ), 'type' => 'text' ),
		'_nabp_cs_period' => array( 'label' => __( 'Period', 'nab-portfolio' ), 'type' => 'text' ),
		'_nabp_cs_stack'  => array( 'label' => __( 'Tech Stack (comma separated)', 'nab-portfolio' ), 'type' => 'text' ),
		'_nabp_cs_url'    => array( 'label' => __( 'External URL (optional)', 'nab-portfolio' ), 'type' => 'url' ),
	);

	foreach ( $fields as $key => $conf ) {
		$value = (string) get_post_meta( $post->ID, $key, true );
		?>
		<p>
			<label for="<?php echo esc_attr( $key ); ?>"><strong><?php echo esc_html( $conf['label'] ); ?></strong></label>
			<input type="<?php echo esc_attr( $conf['type'] ); ?>" id="<?php echo esc_attr( $key ); ?>" name="<?php echo esc_attr( $key ); ?>" value="<?php echo esc_attr( $value ); ?>" class="widefat" />
		</p>
		<?php
	}
}

function nabp_career_box_html( WP_Post $post ): void {
	wp_nonce_field( 'nabp_save_meta', 'nabp_meta_nonce' );

	$fields = array(
		'_nabp_career_period' => __( 'Period (e.g. 2023 — present)', 'nab-portfolio' ),
		'_nabp_career_role'   => __( 'Role', 'nab-portfolio' ),
	);

	foreach ( $fields as $key => $label ) {
		$value = (string) get_post_meta( $post->ID, $key, true );
		?>
		<p>
			<label for="<?php echo esc_attr( $key ); ?>"><strong><?php echo esc_html( $label ); ?></strong></label>
			<input type="text" id="<?php echo esc_attr( $key ); ?>" name="<?php echo esc_attr( $key ); ?>" value="<?php echo esc_attr( $value ); ?>" class="widefat" />
		</p>
		<?php
	}
}

function nabp_quote_box_html( WP_Post $post ): void {
	wp_nonce_field( 'nabp_save_meta', 'nabp_meta_nonce' );

	$fields = array(
		'_nabp_cq_name' => __( 'Client name', 'nab-portfolio' ),
		'_nabp_cq_role' => __( 'Client role / company', 'nab-portfolio' ),
	);

	foreach ( $fields as $key => $label ) {
		$value = (string) get_post_meta( $post->ID, $key, true );
		?>
		<p>
			<label for="<?php echo esc_attr( $key ); ?>"><strong><?php echo esc_html( $label ); ?></strong></label>
			<input type="text" id="<?php echo esc_attr( $key ); ?>" name="<?php echo esc_attr( $key ); ?>" value="<?php echo esc_attr( $value ); ?>" class="widefat" />
		</p>
		<?php
	}
}

function nabp_sanitize_editor( string $value ): string {
	return wp_kses_post( $value );
}

function nabp_save_meta( int $post_id ): void {
	if ( ! isset( $_POST['nabp_meta_nonce'] ) || ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['nabp_meta_nonce'] ) ), 'nabp_save_meta' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$fields = array(
		'case_study'  => array(
			'_nabp_cs_problem'  => 'nabp_sanitize_editor',
			'_nabp_cs_approach' => 'nabp_sanitize_editor',
			'_nabp_cs_solution' => 'nabp_sanitize_editor',
			'_nabp_cs_result'   => 'nabp_sanitize_editor',
			'_nabp_cs_role'     => 'sanitize_text_field',
			'_nabp_cs_client'   => 'sanitize_text_field',
			'_nabp_cs_period'   => 'sanitize_text_field',
			'_nabp_cs_stack'    => 'sanitize_text_field',
			'_nabp_cs_url'      => 'esc_url_raw',
		),
		'career'      => array(
			'_nabp_career_period' => 'sanitize_text_field',
			'_nabp_career_role'   => 'sanitize_text_field',
		),
		'client_quote' => array(
			'_nabp_cq_name' => 'sanitize_text_field',
			'_nabp_cq_role' => 'sanitize_text_field',
		),
	);

	$post_type = get_post_type( $post_id );
	if ( ! isset( $fields[ $post_type ] ) ) {
		return;
	}

	foreach ( $fields[ $post_type ] as $key => $sanitize ) {
		if ( ! isset( $_POST[ $key ] ) ) {
			continue;
		}
		update_post_meta( $post_id, $key, call_user_func( $sanitize, wp_unslash( $_POST[ $key ] ) ) );
	}
}
add_action( 'save_post', 'nabp_save_meta' );

function nabp_seed_mock_data(): array {
	return array(
		'B2B Manufacturing Company Profile Redesign' => array(
			'_nabp_cs_role'     => 'Web Developer (freelance)',
			'_nabp_cs_client'   => 'B2B manufacturing company',
			'_nabp_cs_period'   => '2024',
			'_nabp_cs_stack'    => 'WordPress, PHP, Tailwind CSS',
			'_nabp_cs_url'      => '',
			'_nabp_cs_problem'  => '<p>The old website was stacked with page builders: Lighthouse Performance score 34, 6.2s load time, and broken layouts on mobile — even though 70% of traffic came from phones. B2B prospects left before reading a single paragraph.</p>',
			'_nabp_cs_approach' => '<p>A performance audit showed the bottleneck was markup and assets, not the server, so the solution was deliberately conservative to keep the existing hosting: content re-mapped, design rebuilt mobile-first, and all styling replaced with a custom theme without page builders.</p>',
			'_nabp_cs_solution' => '<p>A lightweight custom WordPress theme: semantic HTML, minified and committed CSS, responsive images, standard hosting caching, and a content structure non-technical staff can manage through WP Admin.</p>',
			'_nabp_cs_result'   => '<p>The new site loads 5x faster and website inquiries tripled within the first two months.</p><ul><li>Lighthouse Performance: 34 → 96</li><li>Load time: 6.2s → 1.1s</li><li>Website inquiries: 3x in 2 months</li></ul>',
		),
		'Centralized Inventory Dashboard for a 3-Branch Retailer' => array(
			'_nabp_cs_role'     => 'Fullstack Developer',
			'_nabp_cs_client'   => 'Local retail, 3 branches',
			'_nabp_cs_period'   => '2024–2025',
			'_nabp_cs_stack'    => 'React, Node.js, PostgreSQL',
			'_nabp_cs_url'      => '',
			'_nabp_cs_problem'  => '<p>Stock was recorded in separate Excel files per branch and collected weekly. Monthly stock discrepancy averaged 12%, procurement was coordinated over WhatsApp, and nobody knew per-product margins until month end.</p>',
			'_nabp_cs_approach' => '<p>One week of on-site observation before writing code: noting when bad data entered, who needed which report, and the physical flow of goods. A centralized stock data model was designed first, and the dashboard was rolled out branch by branch so the team was not forced to switch tools all at once.</p>',
			'_nabp_cs_solution' => '<p>A real-time cross-branch stock dashboard with daily transaction sync, automatic reorder alerts when stock hits the threshold, and downloadable per-product margin reports.</p>',
			'_nabp_cs_result'   => '<p>Stock discrepancy dropped from 12% to under 2%, and stocktaking that used to take two days now finishes in three hours.</p><ul><li>Stock discrepancy: 12% → &lt; 2%</li><li>Stocktaking time: 2 days → 3 hours</li><li>Late reorders: nearly 0 incidents</li></ul>',
		),
		'Online Booking System for a Local Photo Studio' => array(
			'_nabp_cs_role'     => 'Fullstack Developer (freelance)',
			'_nabp_cs_client'   => 'Small photo studio, Makassar',
			'_nabp_cs_period'   => '2025',
			'_nabp_cs_stack'    => 'Laravel, MySQL, Tailwind CSS, Alpine.js',
			'_nabp_cs_url'      => '',
			'_nabp_cs_problem'  => '<p>Bookings were handled through Instagram DMs: schedules often collided because there was no single source of truth, deposits were recorded manually, and client requests sank among other chats — with a 4-hour average reply time.</p>',
			'_nabp_cs_approach' => '<p>I started from the flow, not the technology: mapping the booking steps from both the studio owner\'s and the client\'s side, then designing a three-step flow — pick a package, grab a calendar slot, pay the deposit. The MVP was built in 4 sprints with weekly feedback so UI decisions followed real habits, not assumptions.</p>',
			'_nabp_cs_solution' => '<p>An online booking app with a real-time slot calendar, automatic deposit payment links, a compact dashboard for the studio owner, and automatic notifications to both parties. Business rules — session duration, double-booking, deposits — are centralized in one module so they can change without touching other flows.</p>',
			'_nabp_cs_result'   => '<p>Booking response time dropped sharply and schedule collisions stopped entirely in the first three months.</p><ul><li>Booking response time: ~4 hours → &lt; 5 minutes</li><li>Schedule collisions: 0 in the first 3 months</li><li>40% of bookings arrive outside business hours — with no operator</li></ul>',
		),
	);
}

function nabp_seed_mock_case_studies(): void {
	if ( get_option( 'nabp_seeded' ) ) {
		return;
	}

	$counts = wp_count_posts( 'case_study' );
	if ( 0 < (int) $counts->publish ) {
		return;
	}

	foreach ( nabp_seed_mock_data() as $title => $meta ) {
		wp_insert_post(
			array(
				'post_type'   => 'case_study',
				'post_status' => 'publish',
				'post_title'  => $title,
				'meta_input'  => $meta,
			)
		);
	}

	update_option( 'nabp_seeded', 1 );
	update_option( 'nabp_seed_version', 2 );
}

function nabp_seed_legacy_titles(): array {
	return array(
		'B2B Manufacturing Company Profile Redesign'                     => 'Redesign Website Company Profile Manufaktur B2B',
		'Centralized Inventory Dashboard for a 3-Branch Retailer'         => 'Dashboard Inventory Terpusat untuk Retail 3 Cabang',
		'Online Booking System for a Local Photo Studio'                  => 'Sistem Booking Online untuk Studio Foto Lokal',
	);
}

function nabp_upgrade_seed_content(): void {
	if ( 2 <= (int) get_option( 'nabp_seed_version', 1 ) ) {
		return;
	}

	$seed    = nabp_seed_mock_data();
	$legacy  = nabp_seed_legacy_titles();
	$targets = array_merge( array_keys( $seed ), array_values( $legacy ) );

	$posts = get_posts(
		array(
			'post_type'      => 'case_study',
			'post_status'    => 'any',
			'posts_per_page' => -1,
			'fields'         => 'ids',
			'no_found_rows'  => true,
		)
	);

	foreach ( $posts as $post_id ) {
		$title = get_the_title( $post_id );
		if ( ! in_array( $title, $targets, true ) ) {
			continue;
		}

		$new_title = $title;
		foreach ( $legacy as $english => $old ) {
			if ( $old === $title ) {
				$new_title = $english;
				break;
			}
		}

		wp_update_post(
			array(
				'ID'         => $post_id,
				'post_title' => $new_title,
			)
		);

		foreach ( $seed[ $new_title ] as $key => $value ) {
			update_post_meta( $post_id, $key, $value );
		}
	}

	update_option( 'nabp_seed_version', 2 );
}
add_action( 'init', 'nabp_upgrade_seed_content', 20 );

function nabp_after_switch_theme(): void {
	nabp_register_post_types();
	flush_rewrite_rules();
	nabp_seed_mock_case_studies();
}
add_action( 'after_switch_theme', 'nabp_after_switch_theme' );
