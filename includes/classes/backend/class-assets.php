<?php
/**
 * Admin assets
 *
 * Methods for enqueueing and printing assets
 * such as JavaScript and CSS files.
 *
 * @package    BS_Theme
 * @subpackage Classes
 * @category   Admin
 * @since      1.0.0
 */

namespace BS_Theme\Classes\Admin;

// Alias namespaces.
use  BS_Theme\Classes\Core as Core;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Assets {

	/**
	 * Constructor magic method
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function __construct() {

		// Admin scripts.
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_scripts' ] );

		/**
		 * Admin styles
		 * Call late to override plugin styles.
		 */
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_styles' ], 99 );
	}

	/**
	 * Admin scripts
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function admin_scripts() {

		// Instantiate the Assets class.
		$assets = new Core\Assets;
	}

	/**
	 * Admin styles
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function admin_styles() {

		// Instantiate the Assets class.
		$assets = new Core\Assets;

		wp_enqueue_style( 'bst-admin', get_theme_file_uri( '/assets/css/admin' . $assets->suffix() . '.css' ), [], BST_VERSION, 'all' );
	}
}
