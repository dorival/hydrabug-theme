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




function themeslug_enqueue_style() {
	wp_enqueue_style( 'google-font', '//fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Noto+Serif:ital,wght@0,400;0,700;1,400&display=swap', false );
}
add_action( 'wp_enqueue_scripts', 'themeslug_enqueue_style' );


function themeslug_enqueue_script() {
	// wp_enqueue_script( 'jquery.dlmenu', get_template_directory_uri() . '/js/jquery.dlmenu.js', array( 'jquery', 'modernizr' ), '1.0.1' );
	// wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.custom.js', false, '2.6.2' );
}
add_action( 'wp_enqueue_scripts', 'themeslug_enqueue_script' );