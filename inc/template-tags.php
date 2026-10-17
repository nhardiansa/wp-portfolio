<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function nabp_mod( string $key ): string {
	$defaults = nabp_defaults();
	return (string) get_theme_mod( $key, $defaults[ $key ] ?? '' );
}

function nabp_icon( string $name ): string {
	$icons = array(
		'arrow-right' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" width="1em" height="1em" fill="currentColor" aria-hidden="true" focusable="false"><path d="M32 116 H176 V64 L240 128 L176 192 V140 H32 Z"/></svg>',
		'mail'        => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" width="1em" height="1em" fill="none" stroke="currentColor" stroke-width="16" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><rect x="32" y="64" width="192" height="128" rx="16"/><path d="M40 76 L128 148 L216 76"/></svg>',
		'download'    => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" width="1em" height="1em" fill="none" stroke="currentColor" stroke-width="16" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M128 32 V152"/><path d="M88 112 L128 152 L168 112"/><path d="M40 176 V208 H216 V176"/></svg>',
		'external'    => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" width="1em" height="1em" fill="none" stroke="currentColor" stroke-width="16" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M112 48 H48 V208 H208 V144"/><path d="M144 48 H208 V112"/><path d="M208 48 L112 144"/></svg>',
	);
	return $icons[ $name ] ?? '';
}

function nabp_placeholder( int $w, int $h ): string {
	$svg  = '<svg xmlns="http://www.w3.org/2000/svg" width="' . $w . '" height="' . $h . '" role="img">';
	$svg .= '<rect width="100%" height="100%" fill="#c4c4c4"/>';
	$svg .= '<text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" font-family="sans-serif" font-size="' . (int) round( max( 14, min( $w, $h ) / 12 ) ) . '" fill="#000000">Placeholder ' . $w . ' x ' . $h . '</text>';
	$svg .= '</svg>';
	return 'data:image/svg+xml;charset=utf-8,' . rawurlencode( $svg );
}

function nabp_mailto_url(): string {
	$email = sanitize_email( nabp_mod( 'nabp_contact_email' ) );
	if ( ! is_email( $email ) ) {
		return '';
	}
	$subject = rawurlencode( 'Project inquiry via portfolio website' );
	return 'mailto:' . $email . '?subject=' . $subject;
}

function nabp_social_links(): array {
	$keys = array(
		'GitHub'    => 'nabp_github',
		'LinkedIn'  => 'nabp_linkedin',
		'Instagram' => 'nabp_instagram',
	);

	$links = array();
	foreach ( $keys as $label => $key ) {
		$url = nabp_mod( $key );
		if ( '' !== $url ) {
			$links[ $label ] = $url;
		}
	}
	return $links;
}

function nabp_case_summary( int $post_id ): string {
	$excerpt = get_the_excerpt( $post_id );
	if ( '' !== $excerpt ) {
		return $excerpt;
	}

	$problem = wp_strip_all_tags( (string) get_post_meta( $post_id, '_nabp_cs_problem', true ) );
	$problem = trim( preg_replace( '/\s+/u', ' ', $problem ) ?? '' );

	if ( '' === $problem ) {
		return '';
	}

	return wp_html_excerpt( $problem, 116, '…' );
}

function nabp_case_cover( int $post_id, int $index ): string {
	$cover = get_the_post_thumbnail_url( $post_id, 'full' );
	if ( is_string( $cover ) && '' !== $cover ) {
		return $cover;
	}

	$covers = array( 'cover-01.png', 'cover-02.png', 'cover-03.png' );
	return NABP_URI . '/assets/img/' . $covers[ $index % 3 ];
}

function nabp_case_stack_items( int $post_id ): array {
	$stack = (string) get_post_meta( $post_id, '_nabp_cs_stack', true );
	return array_values( array_filter( array_map( 'trim', explode( ',', $stack ) ) ) );
}
