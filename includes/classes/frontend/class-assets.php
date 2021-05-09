<?php
/**
 * Frontend assets
 *
 * Methods for enqueueing and printing assets
 * such as JavaScript and CSS files.
 *
 * @package    BS_Theme
 * @subpackage Classes
 * @category   Frontend
 * @since      1.0.0
 */

namespace BS_Theme\Classes\Front;

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

		// Frontend scripts.
		add_action( 'wp_enqueue_scripts', [ $this, 'frontend_scripts' ] );

		// Frontend styles.
		add_action( 'wp_enqueue_scripts', [ $this, 'frontend_styles' ] );
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
}
