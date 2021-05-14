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
		add_action( 'BS_Theme\before_header', [ $this, 'navigation_main' ] );

		// Add the default header.
		add_action( 'BS_Theme\header', [ $this, 'page_header' ] );

		// Add the default header.
		add_action( 'BS_Theme\footer', [ $this, 'page_footer' ] );
	}

	/**
	 * Load main navigation
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function navigation_main() {
		get_template_part( 'template-parts/navigation/navigation-main' );
	}

	/**
	 * Load default header
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function page_header() {

		/**
		 * Conditional page header
		 *
		 * Out of the box there is no difference between the two header files.
		 * This condition is provided for demonstration primarily, also
		 * because it is common for a project to have a front page header
		 * that is bigger & bolder than those of subsequent pages.
		 */
		if ( is_front_page() ) {
			get_template_part( 'template-parts/header/header-front-page' );
		} else {
			get_template_part( 'template-parts/header/header-default' );
		}
	}

	/**
	 * Load default footer
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function page_footer() {
		get_template_part( 'template-parts/footer/footer-default' );
	}
}
