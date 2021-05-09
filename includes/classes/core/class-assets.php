<?php
/**
 * Assets class
 *
 * Methods for enqueueing and printing assets
 * such as JavaScript and CSS files.
 *
 * @package    BS_Theme
 * @subpackage Classes
 * @category   Core
 * @since      1.0.0
 */

namespace BS_Theme\Classes\Core;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

final class Assets {

	/**
	 * Plugin version
	 *
	 * @since  1.0.0
	 * @access private
	 * @var    string The version number.
	 */
	private $version = BST_VERSION;

	/**
	 * Constructor magic method
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function __construct() {

		// Toolbar styles.
		add_action( 'wp_enqueue_scripts', [ $this, 'toolbar_styles' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'toolbar_styles' ], 99 );

		// Login styles.
		add_action( 'login_enqueue_scripts', [ $this, 'login_styles' ] );
	}

	/**
	 * Toolbar styles
	 *
	 * Enqueues if user is logged in and user toolbar is showing.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function toolbar_styles() {

		if ( is_user_logged_in() && is_admin_bar_showing() ) {
			wp_enqueue_style( 'bst-toolbar', get_theme_file_uri( '/assets/css/toolbar' . $this->suffix() . '.css' ), [], BST_VERSION, 'screen' );
		}
	}

	/**
	 * Login styles
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function login_styles() {
		wp_enqueue_style( 'bst-login', get_theme_file_uri( '/assets/css/login' . $this->suffix() . '.css' ), [], BST_VERSION, 'screen' );
	}

	/**
	 * Plugin version
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Returns the version number.
	 */
	public function version() {
		return $this->version;
	}

	/**
	 * File suffix
	 *
	 * Adds the `.min` filename suffix if
	 * the system is not in debug mode.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string $suffix The string returned
	 * @return string Returns the `.min` suffix or
	 *                an empty string.
	 */
	public function suffix() {

		// If in one of the debug modes do not minify.
		if (
			( defined( 'WP_DEBUG' ) && WP_DEBUG ) ||
			( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG )
		) {
			$suffix = '';
		} else {
			$suffix = '.min';
		}

		// Return the suffix or not.
		return $suffix;
	}
}
