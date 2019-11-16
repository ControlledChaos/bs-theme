<?php
/**
 * Template functions
 *
 * @package    WordPress/ClassicPress
 * @subpackage BS_Theme
 * @since      1.0.0
 */

// Namespace specificity for theme functions & filters.
namespace BS_Theme\Includes;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Body classes
 *
 * Adds custom classes to the array of body classes.
 *
 * @since  1.0.0
 * @access public
 * @param  array $classes Classes for the body element.
 * @return array Returns the array of body classes.
 */
function body_classes( $classes ) {

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
add_filter( 'body_class', 'BS_Theme\Includes\body_classes' );

/**
 * Pingback header
 *
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 *
 * @since  1.0.0
 * @access public
 * @return string Returns the link element in '<head>`.
 */
function pingback_header() {

	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}

}
add_action( 'wp_head', 'BS_Theme\Includes\pingback_header' );

/**
 * Theme toggle script
 *
 * Toggles a body class and toggles the
 * text of the toggle button.
 *
 * @since  1.0.0
 * @access public
 * @return mixed
 */
function theme_mode_script() {

	?>
<script>jQuery(document).ready(function(e){var t=e('#theme-toggle');localStorage.theme?(e('body').addClass(localStorage.theme),e(t).text(localStorage.text)):(e('body').addClass('light-mode'),e(t).text('<?php esc_html_e( 'Dark Theme', 'bs-theme' ); ?>')),e(t).click(function(){e('body').hasClass('light-mode')?(e('body').removeClass('light-mode').addClass('dark-mode'),e(t).text('<?php esc_html_e( 'Light Theme', 'bs-theme' ); ?>'),localStorage.theme='dark-mode',localStorage.text='<?php esc_html_e( 'Light Theme', 'bs-theme' ); ?>'):(e('body').removeClass('dark-mode').addClass('light-mode'),e(t).text('<?php esc_html_e( 'Dark Theme', 'bs-theme' ); ?>'),localStorage.theme='light-mode',localStorage.text='<?php esc_html_e( 'Dark Theme', 'bs-theme' ); ?>')})});</script>
<?php

}

/**
 * Theme toggle funcionality
 *
 * Prints the toggle button and adds the
 * toggle script to the footer.
 *
 * @since  1.0.0
 * @access public
 * @return mixed
 */
function theme_mode() {

	// Add the toggle script to the footer.
	add_action( 'wp_footer', 'BS_Theme\Includes\theme_mode_script' );

	// Toggle button markup.
	$button = sprintf(
		'<button id="theme-toggle" type="button" name="dark_light" title="%1s">%2s</button>',
		esc_html__( 'Toggle light/dark theme', 'bs-theme' ),
		esc_html__( 'Light Theme', 'bs-theme' )
	);

	// Print the toggle button.
	echo $button;

}