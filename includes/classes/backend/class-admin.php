<?php
/**
 * Theme setup
 *
 * @package    BS_Theme
 * @subpackage Classes
 * @category   Admin
 * @since      1.0.0
 */

namespace BS_Theme\Classes\Admin;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Admin {

	/**
	 * Constructor magic method
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function __construct() {

		/**
		 * Admin styles
		 * Call late to override plugin styles.
		 */
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_styles' ], 99 );
	}

	/**
	 * Admin styles
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function admin_styles() {
		wp_enqueue_style( 'bst-admin', get_theme_file_uri( '/assets/css/admin.min.css' ), [], BST_VERSION, 'all' );
	}
}
