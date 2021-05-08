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

		// Register sidebar widget area.
		register_sidebar( [
			'name'          => esc_html__( 'Default Sidebar', 'bs-theme' ),
			'id'            => 'sidebar-default',
			'description'   => esc_html__( 'Add widgets here.', 'bs-theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		] );
	}
}
