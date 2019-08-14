<?php
/**
 * BS Theme functions
 *
 * @package    WordPress/ClassicPress
 * @subpackage BS_Theme
 * @author     Greg Sweet <greg@ccdzine.com>
 * @copyright  Copyright (c) Greg Sweet
 * @link       https://github.com/ControlledChaos/bs-theme
 * @license    http://www.gnu.org/licenses/gpl-3.0.html
 * @since      1.0.0
 */

namespace BS_Theme\Functions;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get plugins path to check for active plugins.
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

/**
 * BS Theme functions class
 *
 * @since  1.0.0
 * @access public
 */
final class Functions {

	/**
	 * Return the instance of the class
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {

			$instance = new self;

			// Theme dependencies.
			$instance->dependencies();

		}

		return $instance;
	}

	/**
	 * Constructor magic method
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function __construct() {

		// Swap html 'no-js' class with 'js'.
		add_action( 'wp_head', [ $this, 'js_detect' ], 0 );

		// Theme setup.
		add_action( 'after_setup_theme', [ $this, 'setup' ] );

		// Register widgets.
        add_action( 'widgets_init', [ $this, 'widgets' ] );

		// Disable custom colors in the editor.
		add_action( 'after_setup_theme', [ $this, 'editor_custom_color' ] );

		// Remove unpopular meta tags.
		add_action( 'init', [ $this, 'head_cleanup' ] );

		// Frontend scripts.
		add_action( 'wp_enqueue_scripts', [ $this, 'frontend_scripts' ] );

		// Admin scripts.
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_scripts' ] );

		// Frontend styles.
		add_action( 'wp_enqueue_scripts', [ $this, 'frontend_styles' ] );

		/**
		 * Admin styles.
		 *
		 * Call late to override plugin styles.
		 */
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_styles' ], 99 );

		// Login styles.
		add_action( 'login_enqueue_scripts', [ $this, 'login_styles' ] );

		// jQuery UI fallback for HTML5 Contact Form 7 form fields.
		add_filter( 'wpcf7_support_html5_fallback', '__return_true' );

		// Remove WooCommerce styles.
		add_filter( 'woocommerce_enqueue_styles', '__return_false' );

	}

	/**
	 * JS Replace
	 *
	 * Replaces 'no-js' class with 'js' in the <html> element
	 * when JavaScript is detected.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function js_detect() {

		echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";

	}

	/**
	 * Theme setup
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function setup() {

		/**
		 * Load domain for translation
		 *
		 * @since 1.0.0
		 */
		load_theme_textdomain( 'bs-theme' );

		/**
		 * Add theme support
		 *
		 * @since 1.0.0
		 */

		// Browser title tag support.
		add_theme_support( 'title-tag' );

		// Background color & image support.
		add_theme_support( 'custom-background' );

		// RSS feed links support.
		add_theme_support( 'automatic-feed-links' );

		// HTML 5 tags support.
		add_theme_support( 'html5', [
			'search-form',
			'comment-form',
			'comment-list',
			'gscreenery',
			'caption'
		 ] );

		/**
		 * Color arguments
		 *
		 * Match the following HEX codes with SASS color variables.
		 *
		 * @see assets/css/_variables.scss
		 */
		$color_args = [
			[
				'name'  => __( 'Text', 'bs-theme' ),
				'slug'  => 'bst-text',
				'color' => '#333333',
			],
			[
				'name'  => __( 'Light Gray', 'bs-theme' ),
				'slug'  => 'bst-light-gray',
				'color' => '#888888',
			],
			[
				'name'  => __( 'Pale Gray', 'bs-theme' ),
				'slug'  => 'bst-pale-gray',
				'color' => '#cccccc',
			],
			[
				'name'  => __( 'White', 'bs-theme' ),
				'slug'  => 'bst-white',
				'color' => '#ffffff',
			],
			[
				'name'  => __( 'Error Red', 'bs-theme' ),
				'slug'  => 'bst-error',
				'color' => '#dc3232',
			],
			[
				'name'  => __( 'Warning Yellow', 'bs-theme' ),
				'slug'  => 'bst-warning',
				'color' => '#ffb900',
			],
			[
				'name'  => __( 'Success Green', 'bs-theme' ),
				'slug'  => 'bst-success',
				'color' => '#46b450',
			]
		];

		// Apply a filter to editor arguments.
		$colors = apply_filters( 'bst_editor_colors', $color_args );

		// Add color support.
		add_theme_support( 'editor-color-palette', $colors );

		add_theme_support( 'align-wide' );

		/**
		 * Add theme support.
		 *
		 * @since 1.0.0
		 */

		// Customizer widget refresh support.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Featured image support.
		add_theme_support( 'post-thumbnails' );

		/**
		 * Add image sizes.
		 *
		 * Three sizes per aspect ratio so that WordPress
		 * will use srcset for responsive images.
		 *
		 * @since 1.0.0
		 */

		// 16:9 HD Video.
		add_image_size( __( 'video', 'bs-theme' ), 1280, 720, true );
		add_image_size( __( 'video-md', 'bs-theme' ), 960, 540, true );
		add_image_size( __( 'video-sm', 'bs-theme' ), 640, 360, true );

		// 21:9 Cinemascope.
		add_image_size( __( 'banner', 'bs-theme' ), 1280, 549, true );
		add_image_size( __( 'banner-md', 'bs-theme' ), 960, 411, true );
		add_image_size( __( 'banner-sm', 'bs-theme' ), 640, 274, true );

		/**
		 * Custom header for the front page.
		 */
		add_theme_support( 'custom-header', apply_filters( 'bst_custom_header_args', [
			'default-image'      => get_parent_theme_file_uri( '/assets/images/header.jpg' ),
			'width'              => 2048,
			'height'             => 878,
			'flex-height'        => true,
			'video'              => false,
			'wp-head-callback'   => null
		] ) );

		register_default_headers( [
			'default-image' => [
				'url'           => '%s/assets/images/header.jpg',
				'thumbnail_url' => '%s/assets/images/header.jpg',
				'description'   => __( 'Default Header Image', 'bs-theme' ),
			],
		] );

		/**
		 * Custom logo support
		 *
		 * @since 1.0.0
		 */

		// Logo arguments.
		$logo_args = [
			'width'       => 180,
			'height'      => 180,
			'flex-width'  => true,
			'flex-height' => true
		];

		// Apply a filter to logo arguments.
		$logo = apply_filters( 'bst_header_image', $logo_args );

		// Add logo support.
		add_theme_support( 'custom-logo', $logo );

		 /**
		 * Set content width.
		 *
		 * @since 1.0.0
		 */
		$bs_content_width = apply_filters( 'bst_content_width', 1280 );

		if ( ! isset( $content_width ) ) {
			$content_width = $bs_content_width;
		}

		/**
		 * Register theme menus.
		 *
		 * @since  1.0.0
		 */
		register_nav_menus( [
			'main'   => __( 'Main Menu', 'bs-theme' ),
			'footer' => __( 'Footer Menu', 'bs-theme' ),
			'social' => __( 'Social Menu', 'bs-theme' )
		] );

		/**
		 * Add stylesheet for the content editor.
		 *
		 * @since 1.0.0
		 */
		add_editor_style( '/assets/css/editor.min.css', [ 'bst-admin' ], '', 'screen' );

	}

	/**
	 * Register widgets
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function widgets() {

		register_sidebar( [
			'name'          => esc_html__( 'Sidebar', 'bs-theme' ),
			'id'            => 'sidebar',
			'description'   => esc_html__( 'Add widgets here.', 'bs-theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		] );

	}

	/**
	 * Theme support for disabling custom colors in the editor
	 *
	 * @since  1.0.0
	 * @access public
	 * @return bool Returns true for the color picker.
	 */
	public function editor_custom_color() {

		$disable = add_theme_support( 'disable-custom-colors', [] );

		// Apply a filter for conditionally disabling the picker.
		$custom_colors = apply_filters( 'bst_editor_custom_colors', '__return_false' );

		return $custom_colors;

	}

	/**
	 * Clean up meta tags from the <head>
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function head_cleanup() {

		remove_action( 'wp_head', 'rsd_link' );
		remove_action( 'wp_head', 'wlwmanifest_link' );
		remove_action( 'wp_head', 'wp_generator' );
		remove_action( 'wp_head', 'wp_site_icon', 99 );
	}

	/**
	 * Frontend scripts
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function frontend_scripts() {

		// wp_enqueue_script( 'jquery' );

		wp_enqueue_script( 'test-navigation', get_theme_file_uri( '/assets/js/navigation.min.js' ), [], null, true );

		wp_enqueue_script( 'bs-theme-skip-link-focus-fix', get_theme_file_uri( '/assets/js/skip-link-focus-fix.min.js' ), [], null, true );

		// Comments scripts.
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

	}

	/**
	 * Admin scripts
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function admin_scripts() {}

	/**
	 * Frontend styles
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function frontend_styles() {

		// Google fonts.
		// wp_enqueue_style( 'bst-google-fonts', 'add-url-here', [], '', 'screen' );

		/**
		 * Theme sylesheet
		 *
		 * This enqueues the minified stylesheet compiled from SASS (.scss) files.
		 * The main stylesheet, in the root directory, only contains the theme header but
		 * it is necessary for theme activation. DO NOT delete the main stylesheet!
		 */
		wp_enqueue_style( 'bs-theme', get_theme_file_uri( '/assets/css/style.min.css' ), [], '' );

		// Print styles.
		wp_enqueue_style( 'bs-print', get_theme_file_uri( '/assets/css/print.min.css' ), [], '', 'print' );

	}

	/**
	 * Admin styles
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function admin_styles() {}

	/**
	 * Login styles
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function login_styles() {

		wp_enqueue_style( 'custom-login', get_theme_file_uri( '/assets/css/login.css' ), [], '', 'screen' );

	}

	/**
	 * Theme dependencies
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function dependencies() {

		require get_theme_file_path( '/includes/custom-header.php' );
		require get_theme_file_path( '/includes/template-tags.php' );
		require get_theme_file_path( '/includes/template-functions.php' );
		require get_theme_file_path( '/includes/customizer.php' );

	}

}

/**
 * Get an instance of the Functions class
 *
 * This function is useful for quickly grabbing data
 * used throughout the theme.
 *
 * @since  1.0.0
 * @access public
 * @return object
 */
function bst_theme() {

	$bst_theme = Functions::get_instance();

	return $bst_theme;

}

// Run the Functions class.
bst_theme();