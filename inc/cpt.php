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
				'name'          => __( 'Stack', 'nab-portfolio' ),
				'singular_name' => __( 'Stack Item', 'nab-portfolio' ),
				'add_new_item'  => __( 'Add New Stack Item', 'nab-portfolio' ),
			),
			'public'             => false,
			'show_ui'            => true,
			'publicly_queryable' => false,
			'show_in_rest'       => true,
			'supports'           => array( 'title', 'page-attributes' ),
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
			'hint'  => __( 'Masalah apa yang diselesaikan? Jelaskan konteksnya.', 'nab-portfolio' ),
		),
		'_nabp_cs_approach' => array(
			'label' => __( 'Approach', 'nab-portfolio' ),
			'hint'  => __( 'Bagaimana Anda mendekati & memproses masalahnya?', 'nab-portfolio' ),
		),
		'_nabp_cs_solution' => array(
			'label' => __( 'Solution', 'nab-portfolio' ),
			'hint'  => __( 'Apa yang Anda bangun / kerjakan? Fitur & keputusan kunci.', 'nab-portfolio' ),
		),
		'_nabp_cs_result'   => array(
			'label' => __( 'Result', 'nab-portfolio' ),
			'hint'  => __( 'Dampak terukur — angka/metrik before → after bila tersedia.', 'nab-portfolio' ),
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
		'_nabp_cs_stack'  => array( 'label' => __( 'Tech Stack (pisahkan dengan koma)', 'nab-portfolio' ), 'type' => 'text' ),
		'_nabp_cs_url'    => array( 'label' => __( 'External URL (opsional)', 'nab-portfolio' ), 'type' => 'url' ),
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
		'_nabp_career_period' => __( 'Period (mis. 2023 — sekarang)', 'nab-portfolio' ),
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
		'_nabp_cq_name' => __( 'Nama klien', 'nab-portfolio' ),
		'_nabp_cq_role' => __( 'Role / perusahaan klien', 'nab-portfolio' ),
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

function nabp_seed_mock_case_studies(): void {
	if ( get_option( 'nabp_seeded' ) ) {
		return;
	}

	$counts = wp_count_posts( 'case_study' );
	if ( 0 < (int) $counts->publish ) {
		return;
	}

	$mockups = array(
		array(
			'post_title' => 'Redesign Website Company Profile Manufaktur B2B',
			'meta_input' => array(
				'_nabp_cs_role'     => 'Web Developer (freelance)',
				'_nabp_cs_client'   => 'Perusahaan manufaktur B2B',
				'_nabp_cs_period'   => '2024',
				'_nabp_cs_stack'    => 'WordPress, PHP, Tailwind CSS',
				'_nabp_cs_url'      => '',
				'_nabp_cs_problem'  => '<p>Website lama dibangun bertumpuk page builder: skor Lighthouse Performance 34, waktu load 6,2 detik, dan tata letak rusak di ponsel — padahal 70% trafik datang dari mobile. Calon klien B2B pergi sebelum membaca satu paragraf pun.</p>',
				'_nabp_cs_approach' => '<p>Audit performa menunjukkan beban utama ada di markup dan aset, bukan di server, sehingga solusi dipilih konservatif agar hosting tetap sama: konten dipetakan ulang, desain dibangun ulang mobile-first, dan seluruh styling diganti tema kustom tanpa page builder.</p>',
				'_nabp_cs_solution' => '<p>Tema WordPress kustom ringan: HTML semantik, CSS terkompresi dan di-commit, gambar responsif, caching standar hosting, serta struktur konten yang bisa dikelola staf non-teknis lewat WP Admin.</p>',
				'_nabp_cs_result'   => '<p>Situs baru memuat 5x lebih cepat dan inquiry via website naik 3x dalam 2 bulan pertama.</p><ul><li>Lighthouse Performance: 34 → 96</li><li>Waktu load: 6,2 detik → 1,1 detik</li><li>Inquiry via website naik 3x dalam 2 bulan</li></ul>',
			),
		),
		array(
			'post_title' => 'Dashboard Inventory Terpusat untuk Retail 3 Cabang',
			'meta_input' => array(
				'_nabp_cs_role'     => 'Fullstack Developer',
				'_nabp_cs_client'   => 'Retail lokal, 3 cabang',
				'_nabp_cs_period'   => '2024–2025',
				'_nabp_cs_stack'    => 'React, Node.js, PostgreSQL',
				'_nabp_cs_url'      => '',
				'_nabp_cs_problem'  => '<p>Stok dicatat di file Excel terpisah per cabang dan dikumpulkan mingguan. Selisih stok bulanan rata-rata 12%, pengadaan diatur lewat pesan WhatsApp, dan tidak ada yang tahu margin per produk sampai akhir bulan.</p>',
				'_nabp_cs_approach' => '<p>Satu minggu observasi kerja lapangan sebelum menulis kode: mencatat kapan data salah masuk, siapa butuh laporan apa, dan alur fisik barang. Data model stok terpusat dirancang dulu, dashboard dibangun bertahap per cabang agar tim tidak dipaksa berpindah alat sekaligus.</p>',
				'_nabp_cs_solution' => '<p>Dashboard stok real-time lintas cabang dengan sinkronisasi transaksi harian, alert reorder otomatis saat stok menyentuh ambang, dan laporan margin per produk yang bisa diunduh kapan saja.</p>',
				'_nabp_cs_result'   => '<p>Selisih stok turun dari 12% ke bawah 2% dan opname yang tadinya dua hari selesai dalam tiga jam.</p><ul><li>Selisih stok: 12% → &lt; 2%</li><li>Waktu opname: 2 hari → 3 jam</li><li>Reorder terlambat: hampir 0 kejadian</li></ul>',
			),
		),
		array(
			'post_title' => 'Sistem Booking Online untuk Studio Foto Lokal',
			'meta_input' => array(
				'_nabp_cs_role'     => 'Fullstack Developer (freelance)',
				'_nabp_cs_client'   => 'Studio foto UMKM, Makassar',
				'_nabp_cs_period'   => '2025',
				'_nabp_cs_stack'    => 'Laravel, MySQL, Tailwind CSS, Alpine.js',
				'_nabp_cs_url'      => '',
				'_nabp_cs_problem'  => '<p>Booking dilayani lewat DM Instagram: jadwal sering bentrok karena tidak ada satu sumber kebenaran, pembayaran DP dicatat manual, dan permintaan klien tenggelam di antara chat lain — rata-rata baru dibalas 4 jam kemudian.</p>',
				'_nabp_cs_approach' => '<p>Saya mulai dari alur, bukan teknologi: memetakan langkah booking dari sisi pemilik studio dan klien, lalu merancang alur tiga langkah — pilih paket, ambil slot kalender, bayar DP. MVP dibangun dalam 4 sprint dengan feedback mingguan agar keputusan UI mengikuti kebiasaan nyata, bukan asumsi.</p>',
				'_nabp_cs_solution' => '<p>Aplikasi booking online dengan kalender slot real-time, link pembayaran DP otomatis, dashboard ringkas untuk pemilik studio, dan notifikasi otomatis ke kedua pihak. Aturan bisnis — durasi sesi, slot ganda, deposit — dipusatkan di satu modul agar mudah diubah tanpa menyentuh alur lain.</p>',
				'_nabp_cs_result'   => '<p>Waktu balas booking turun drastis dan tidak ada lagi jadwal bentrok dalam tiga bulan pertama.</p><ul><li>Waktu balas booking: ±4 jam → &lt; 5 menit</li><li>Jadwal bentrok: 0 dalam 3 bulan pertama</li><li>40% booking masuk di luar jam kerja — tanpa operator</li></ul>',
			),
		),
	);

	foreach ( $mockups as $mockup ) {
		wp_insert_post(
			array(
				'post_type'   => 'case_study',
				'post_status' => 'publish',
				'post_title'  => $mockup['post_title'],
				'meta_input'  => $mockup['meta_input'],
			)
		);
	}

	update_option( 'nabp_seeded', 1 );
}

function nabp_after_switch_theme(): void {
	nabp_register_post_types();
	flush_rewrite_rules();
	nabp_seed_mock_case_studies();
}
add_action( 'after_switch_theme', 'nabp_after_switch_theme' );
