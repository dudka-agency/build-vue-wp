<?php

add_action( 'after_setup_theme', function () {
	add_theme_support( 'html5', [ 'script', 'style' ] );
} );

/**
 * Remove wp version param from any enqueued scripts
 *
 * @param string $src Source path.
 *
 * @return string
 */
function remove_wp_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) ) {
		$src = remove_query_arg( 'ver', $src );
	}

	return $src;
}

add_filter( 'style_loader_src', 'remove_wp_ver_css_js' );
add_filter( 'script_loader_src', 'remove_wp_ver_css_js' );

// Убираем emoji
function disable_wp_emojicons() {
	// all actions related to emojis
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

	// filter to remove TinyMCE emojis
	//add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
}

add_action( 'init', 'disable_wp_emojicons' );

/**
 * Cleaning from garbage
 */
function cleaning() {
	// Display the links to the general feeds: Post and Comment Feed
	remove_action( 'wp_head', 'feed_links', 2 );
	// Display the links to the extra feeds such as category feeds
	remove_action( 'wp_head', 'feed_links_extra', 3 );
	// Display the link to the Really Simple Discovery service endpoint, EditURI link
	remove_action( 'wp_head', 'rsd_link' );
	// Display the link to the Windows Live Writer manifest file.
	remove_action( 'wp_head', 'wlwmanifest_link' );
	// Remove oEmbed discovery links.
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );

	// Remove "WordPress version" tag?
	// <meta name="generator" content="WordPress 4.9.8" />
	remove_action( 'wp_head', 'wp_generator' );

	// also hide it from RSS
	add_filter( 'the_generator', '__return_false' );

	// Remove "REST API" link?
	// <link rel='https://api.w.org/' href='https://yourwebsite.com/wp-json/' />
	remove_action( 'wp_head', 'rest_output_link_wp_head' );

	// Removes the following printed within "Response headers":
	// <https://yourwebsite.com/wp-json/>; rel="https://api.w.org/"
	remove_action( 'template_redirect', 'rest_output_link_header', 11 );

	// Remove "Shortlink"?
	// <link rel='shortlink' href="https://yourdomain.com/?p=1">
	remove_action( 'wp_head', 'wp_shortlink_wp_head' );

	// link: <https://yourdomainname.com/wp-json/>; rel="https://api.w.org/", <https://yourdomainname.com/?p=[post_id_here]>; rel=shortlink
	remove_action( 'template_redirect', 'wp_shortlink_header', 11 );

	// Remove "Post's Relational Links"?
	// <link rel='prev' title='Title of adjacent post' href='https://yourdomain.com/adjacent-post-slug-here/' />
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head' );
}

add_action( 'init', 'cleaning' );
