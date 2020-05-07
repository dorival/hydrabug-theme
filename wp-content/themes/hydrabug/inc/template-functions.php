<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package HydraBug
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function hydrabug_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'hydrabug_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function hydrabug_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'hydrabug_pingback_header' );


function hydrabug_enqueue_style() {
	wp_enqueue_style( 'google-font', '//fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Noto+Serif:ital,wght@0,400;0,700;1,400&display=swap', false );
}
add_action( 'wp_enqueue_scripts', 'hydrabug_enqueue_style' );

// function hydrabug_enqueue_script() {
// 	// wp_enqueue_script( 'jquery.dlmenu', get_template_directory_uri() . '/js/jquery.dlmenu.js', array( 'jquery', 'modernizr' ), '1.0.1' );
// 	// wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.custom.js', false, '2.6.2' );
// }
// add_action( 'wp_enqueue_scripts', 'hydrabug_enqueue_script' );



function remove_width_attribute( $html ) {
	$html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
	return $html;
}
add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10 );

/**
 * Remove Wordpress support for Emojis. If people want it, just use the ones provided by the OS
 */
function hydrabug_disable_emojis() {
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('admin_print_scripts', 'print_emoji_detection_script');
	remove_action('wp_print_styles', 'print_emoji_styles');
	remove_action('admin_print_styles', 'print_emoji_styles');
	remove_filter('the_content_feed', 'wp_staticize_emoji');
	remove_filter('comment_text_rss', 'wp_staticize_emoji');
	remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
	add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
	add_filter('wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2);
}
add_action('init', 'hydrabug_disable_emojis');