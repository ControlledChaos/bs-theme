<?php
/**
 * Register widget areas
 *
 * @package    BS_Theme
 * @subpackage Classes
 * @category   Widgets
 * @since      1.0.0
 */

namespace BS_Theme\Classes\Widgets;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Register {

	/**
	 * Constructor magic method
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function __construct() {

		// Register the theme mode widget.
		add_action( 'widgets_init', function() {
			register_widget( __NAMESPACE__ . '\Theme_Mode' );
		} );

		// Register widget areas.
        add_action( 'widgets_init', [ $this, 'widgets' ] );
	}

	/**
	 * Register widgets
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function widgets() {

		// Sidebar position.
		if ( is_rtl() ) {
			$position = __( 'left', 'bs-theme' );
		} else {
			$position = __( 'right', 'bs-theme' );
		}

		// Register sidebar widget area.
		register_sidebar( [
			'name'          => __( 'Default Sidebar', 'bs-theme' ),
			'id'            => 'sidebar-default',
			'description'   => sprintf(
				__( 'Displays to the %s of the main content.', 'bs-theme' ),
				$position
			),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		] );
	}
}
