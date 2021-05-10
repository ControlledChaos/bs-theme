<?php
/**
 * Frontend template tags
 *
 * Call new instance of this class in header files.
 * Use of the `$bst_tags` variable is recommended
 * to instantiate, where the prefix matches the
 * rest of this theme's prefixes.
 *
 * @package    BS_Theme
 * @subpackage Classes
 * @category   Frontend
 * @since      1.0.0
 */

namespace BS_Theme\Classes\Front;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Layout {

	/**
	 * Constructor magic method
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function __construct() {

		// Add main navigation before header.
		add_action( 'BS_Theme\before_header', [ $this, 'main_navigation' ] );

		// Add the default header.
		add_action( 'BS_Theme\header', [ $this, 'default_header' ] );

		// Add the default header.
		add_action( 'BS_Theme\footer', [ $this, 'default_footer' ] );
	}

	/**
	 * Load main navigation
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function main_navigation() {
		include get_theme_file_path( '/template-parts/navigation/main-navigation.php' );
	}

	/**
	 * Load default header
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function default_header() {
		include get_theme_file_path( '/template-parts/header/default-header.php' );
	}

	/**
	 * Load default footer
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function default_footer() {
		include get_theme_file_path( '/template-parts/footer/default-footer.php' );
	}
}
