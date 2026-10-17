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



function nabp_after_switch_theme(): void {
	nabp_register_post_types();
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'nabp_after_switch_theme' );

function nabp_seed_titles(): array {
	return array(
		'B2B Manufacturing Company Profile Redesign',
		'Centralized Inventory Dashboard for a 3-Branch Retailer',
		'Online Booking System for a Local Photo Studio',
	);
}

function nabp_migrate_content_english(): void {
	if ( 3 <= (int) get_option( 'nabp_content_version', 1 ) ) {
		return;
	}

	$story     = (string) get_theme_mod( 'nabp_about_story', '' );
	$signature = 'pengalaman membangun aplikasi bersama tim di beberapa perusahaan';
	if ( false !== stripos( $story, $signature ) ) {
		$defaults = nabp_defaults();
		set_theme_mod( 'nabp_about_story', $defaults['nabp_about_story'] );
	}

	$titles = nabp_seed_titles();
	$posts  = get_posts(
		array(
			'post_type'      => 'case_study',
			'post_status'    => 'any',
			'posts_per_page' => -1,
			'no_found_rows'  => true,
		)
	);

	foreach ( $posts as $post ) {
		if ( ! in_array( $post->post_title, $titles, true ) ) {
			continue;
		}

		wp_update_post(
			array(
				'ID'        => $post->ID,
				'post_name' => sanitize_title( $post->post_title ),
			)
		);
	}

	update_option( 'nabp_content_version', 3 );
}
add_action( 'init', 'nabp_migrate_content_english', 30 );

function nabp_delete_seed_case_studies(): void {
	if ( 4 <= (int) get_option( 'nabp_content_version', 1 ) ) {
		return;
	}

	$titles = nabp_seed_titles();
	$posts  = get_posts(
		array(
			'post_type'      => 'case_study',
			'post_status'    => 'any',
			'posts_per_page' => -1,
			'no_found_rows'  => true,
		)
	);

	foreach ( $posts as $post ) {
		if ( ! in_array( $post->post_title, $titles, true ) ) {
			continue;
		}
		wp_delete_post( $post->ID, true );
	}

	update_option( 'nabp_content_version', 4 );
}
add_action( 'init', 'nabp_delete_seed_case_studies', 40 );
