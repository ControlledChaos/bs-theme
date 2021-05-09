<?php
/**
 * Theme setup
 *
 * @package    BS_Theme
 * @subpackage Classes
 * @category   Setup
 * @since      1.0.0
 */

namespace BS_Theme\Classes\Core;

// Alias namespaces.
use  BS_Theme\Classes\Core as Core;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Setup {

	/**
	 * Constructor magic method
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function __construct() {

		// Theme setup.
		add_action( 'after_setup_theme', [ $this, 'setup' ] );

		// Body element classes.
		add_filter( 'body_class', [ $this, 'body_classes' ] );

		// Disable custom colors in the editor.
		add_action( 'after_setup_theme', [ $this, 'editor_custom_color' ] );

		// Frontend scripts.
		add_action( 'wp_enqueue_scripts', [ $this, 'frontend_scripts' ] );

		// Frontend styles.
		add_action( 'wp_enqueue_scripts', [ $this, 'frontend_styles' ] );

		// Toolbar styles.
		add_action( 'wp_enqueue_scripts', [ $this, 'toolbar_styles' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'toolbar_styles' ], 99 );

		// Login styles.
		add_action( 'login_enqueue_scripts', [ $this, 'login_styles' ] );

		// jQuery UI fallback for HTML5 Contact Form 7 form fields.
		add_filter( 'wpcf7_support_html5_fallback', '__return_true' );

		// Remove WooCommerce styles.
		add_filter( 'woocommerce_enqueue_styles', '__return_false' );

		// User color scheme classes.
		add_filter( 'body_class', [ $this, 'color_scheme_classes' ] );
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

		 // Refresh widgets.
		 add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Block editor colors
		 *
		 * Match the following HEX codes with SASS color variables.
		 * @see assets/css/_variables.scss
		 *
		 * @since 1.0.0
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

		// Add theme color support.
		add_theme_support( 'editor-color-palette', $colors );

		/**
		 * Set default image sizes
		 *
		 * Define the dimensions and the crop options.
		 *
		 * @since 1.0.0
		 */
		// Featured image support.
		add_theme_support( 'post-thumbnails' );

		// Thumbnail size.
		update_option( 'thumbnail_size_w', 160 );
		update_option( 'thumbnail_size_h', 160 );
		update_option( 'thumbnail_crop', 1 );

		// Medium size.
		update_option( 'medium_size_w', 320 );
		update_option( 'medium_size_h', 240 );
		update_option( 'medium_crop', 1 );

		// Medium-large size.
		update_option( 'medium_large_size_w', 480 );
		update_option( 'medium_large_size_h', 360 );

		// Large size.
		update_option( 'large_size_w', 640 );
		update_option( 'large_size_h', 480 );
		update_option( 'large_crop', 1 );

		// Set the post thumbnail size, 16:9 HD Video.
		set_post_thumbnail_size( 1280, 720, [ 'center', 'center' ] );

		// Add wide image support for the block editor.
		add_theme_support( 'align-wide' );

		/**
		 * Add image sizes
		 *
		 * Three sizes per aspect ratio so that WordPress
		 * will use srcset for responsive images.
		 *
		 * @since 1.0.0
		 */

		// 1:1 square.
		add_image_size( __( 'large-thumbnail', 'bs-theme' ), 240, 240, true );
		add_image_size( __( 'xlarge-thumbnail', 'bs-theme' ), 320, 320, true );

		// 16:9 HD Video.
		add_image_size( __( 'large-video', 'bs-theme' ), 1280, 720, true );
		add_image_size( __( 'medium-video', 'bs-theme' ), 960, 540, true );
		add_image_size( __( 'small-video', 'bs-theme' ), 640, 360, true );

		// 21:9 Cinemascope.
		add_image_size( __( 'large-banner', 'bs-theme' ), 1280, 549, true );
		add_image_size( __( 'medium-banner', 'bs-theme' ), 960, 411, true );
		add_image_size( __( 'small-banner', 'bs-theme' ), 640, 274, true );

		/**
		 * Custom header
		 */
		$default_image = register_default_headers( [
			'default_image' => [
				'url'           => '%s/assets/images/default-header.jpg',
				'thumbnail_url' => '%s/assets/images/default-header.jpg',
				'description'   => __( 'Default Header Image', 'bs-theme' ),
			],
		] );

		add_theme_support( 'custom-header', apply_filters( 'bst_custom_header_args', [
			'width'              => 2048,
			'height'             => 878,
			'flex-height'        => true,
			'default-image'      => $default_image,
			'video'              => false,
			'wp-head-callback'   => [ $this, 'header_style' ]
		] ) );

		/**
		 * Custom logo
		 *
		 * @since 1.0.0
		 */

		// Logo arguments.
		$logo_args = [
			'width'       => 160,
			'height'      => 160,
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
		$bst_content_width = apply_filters( 'bst_content_width', 1280 );

		if ( ! isset( $content_width ) ) {
			$content_width = $bst_content_width;
		}

		// Embed sizes.
		update_option( 'embed_size_w', 1280 );
		update_option( 'embed_size_h', 720 );

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
	 * Body classes
	 *
	 * Adds custom classes to the array of body classes.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array $classes Classes for the body element.
	 * @return array Returns the array of body classes.
	 */
	public function body_classes( $classes ) {

		// Adds a class of hfeed to non-singular pages.
		if ( ! is_singular() ) {
			$classes[] = 'hfeed';
		}

		// Adds a class of no-sidebar when there is no default sidebar present.
		if (
			! is_active_sidebar( 'sidebar-default' ) ||
			is_page_template( [ 'page-templates/no-sidebar.php' ] )
		) {
			$classes[] = 'no-sidebar';
		}

		// Return the modified array of body classes.
		return $classes;
	}

	/**
	 * Style the header image and text
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Returns an HTML style block.
	 *
	 */
	public function header_style() {

		$header_text_color = get_header_textcolor();

		/*
		 * Stop if no custom options for text are set.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text.
		 * Default: add_theme_support( 'custom-header' ).
		 */
		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			return;
		}

		if ( ! display_header_text() ) {
			$style = sprintf(
				'<style type="text/css">%1s</style>',
				'.site-title,
				 .site-title a,
				 .site-description {
					position: absolute;
					clip: rect(1px, 1px, 1px, 1px);
				}'
			);

		} else {
			$style = sprintf(
				'<style type="text/css">%1s</style>',
				'.site-title,
				 .site-title a,
				 .site-description {
					color: #' . esc_attr( $header_text_color ) . ';
				}'
			);
		}

		// Print the style block.
		echo $style;
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
	 * Frontend scripts
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function frontend_scripts() {

		// Instantiate the Assets class.
		$assets = new Core\Assets;

		// Enqueue jQuery.
		wp_enqueue_script( 'jquery' );

		// Navigation toggle and dropdown.
		wp_enqueue_script( 'bst-navigation', get_theme_file_uri( '/assets/js/navigation' . $assets->suffix() . '.js' ), [], BST_VERSION, true );

		// Skip link focus, for accessibility.
		wp_enqueue_script( 'bst-skip-link-focus-fix', get_theme_file_uri( '/assets/js/skip-link-focus-fix' . $assets->suffix() . '.js' ), [], BST_VERSION, true );

		// FitVids for responsive video embeds.
		wp_enqueue_script( 'bst-fitvids', get_theme_file_uri( '/assets/js/jquery.fitvids' . $assets->suffix() . '.js' ), [ 'jquery' ], BST_VERSION, true );
		wp_add_inline_script( 'bst-fitvids', 'jQuery(document).ready(function($){ $( ".entry-content" ).fitVids(); });', true );

		// Comments scripts.
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}

	/**
	 * Frontend styles
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function frontend_styles() {

		// Instantiate the Assets class.
		$assets = new Core\Assets;

		// Google fonts.
		// wp_enqueue_style( 'bst-google-fonts', 'add-url-here', [], 'BST_VERSION, 'screen' );

		/**
		 * Theme stylesheet
		 *
		 * This enqueues the minified stylesheet compiled from SASS (.scss) files.
		 * The main stylesheet, in the root directory, only contains the theme header but
		 * it is necessary for theme activation. DO NOT delete the main stylesheet!
		 */
		wp_enqueue_style( 'bst-theme', get_theme_file_uri( '/assets/css/style' . $assets->suffix() . '.css' ), [], BST_VERSION, 'all' );

		// Right-to-left languages.
		if ( is_rtl() ) {
			wp_enqueue_style( 'bst-theme-rtl', get_theme_file_uri( 'assets/css/style-rtl' . $assets->suffix() . '.css' ), [ 'bst-theme' ], BST_VERSION, 'all' );
		}

		// Block styles.
		if ( function_exists( 'has_blocks' ) ) {
			if ( has_blocks() ) {
				wp_enqueue_style( 'bst-blocks', get_theme_file_uri( '/assets/css/blocks' . $assets->suffix() . '.css' ), [ 'bst-theme' ], BST_VERSION, 'all' );
			}
		}

		// Print styles.
		wp_enqueue_style( 'bst-print', get_theme_file_uri( '/assets/css/print' . $assets->suffix() . '.css' ), [], BST_VERSION, 'print' );
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

		// Instantiate the Assets class.
		$assets = new Core\Assets;

		if ( is_user_logged_in() && is_admin_bar_showing() ) {
			wp_enqueue_style( 'bst-toolbar', get_theme_file_uri( '/assets/css/toolbar' . $assets->suffix() . '.css' ), [], BST_VERSION, 'screen' );
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

		// Instantiate the Assets class.
		$assets = new Core\Assets;

		wp_enqueue_style( 'bst-login', get_theme_file_uri( '/assets/css/login' . $assets->suffix() . '.css' ), [], BST_VERSION, 'screen' );
	}

	/**
     * User color scheme classes
	 *
	 * Add a class to the body element according to
	 * the user's admin color scheme preference.
     *
     * @since  1.0.0
	 * @access public
	 * @return array Returns a modified array of body classes.
     */
	public function color_scheme_classes( $classes ) {

		// Add a class if user is logged in and admin bar is showing.
		if ( is_user_logged_in() && is_admin_bar_showing() ) {

			// Get the user color scheme option.
			$scheme = get_user_option( 'admin_color' );

			// Return body classes with `user-color-$scheme`.
			return array_merge( $classes, array( 'user-color-' . $scheme ) );
		}

		// Return the unfiltered classes if user is not logged in.
		return $classes;
	}
}
