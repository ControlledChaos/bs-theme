<?php
/**
 * BS Theme functions
 *
 * A basic starter theme for WordPress and ClassicPress.
 *
 * @package    BS_Theme
 * @subpackage Functions
 * @since      1.0.0
 *
 * @link       https://github.com/ControlledChaos/bs-theme
 * @license    http://www.gnu.org/licenses/gpl-3.0.html
 */

/**
 * License & Warranty
 *
 * BS Theme is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * BS Theme is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with BS Theme. If not, see {URI to Plugin License}.
 */

/**
 * Renaming, rebranding, and defaults
 *
 * Following is a list of strings to find and replace in all theme files.
 *
 * 1. Plugin name
 *    Find `BS_Theme` and replace with your theme name, include
 *    underscores between words. This will change the namespace and the package
 *    name in file headers.
 *
 * 2. Text domain
 *    Find `bs-theme` and replace with the text domain of your theme.
 *
 * 3. Theme prefix
 *    Find `bst` and replace with the unique, lowercase theme prefix.
 *    This prefix is used for applied filters, stylesheet IDs, and
 *    admin page URIs, so the prefix may be followed by an underscore
 *    or a dash. Search for `bst_` and `bst-` to find the difference.
 *
 * 4. Constant prefix
 *    Find `BST` and replace with the unique, uppercase prefix of your theme.
 *
 * 5. Header image
 *    Replace the default image file `default-header.jpg`.
 *    @see assets/images/
 *
 * 6. Activation and deactivation
 *    Check the activation and deactivation classes for sample methods.
 *    Remove or modify the samples as needed.
 *    @see includes/class-activate
 *    @see includes/class-deactivate
 *
 * 7. README file
 *    Whether or not your theme will be kept in a version control repository,
 *    edit the content of the README file in the theme's root directory or
 *    delete it if it is not necessary.
 */

namespace BS_Theme;

// Alias namespaces.
use
BS_Theme\Classes as General,
BS_Theme\Classes\Activate as Activate,
BS_Theme\Classes\Core as Core,
BS_Theme\Classes\Front as Front,
BS_Theme\Classes\Widgets as Widgets,
BS_Theme\Classes\Media as Media,
BS_Theme\Classes\Admin as Admin,
BS_Theme\Classes\Customize as Customize,
BS_Theme\Classes\Vendor as Vendor;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get the PHP version class.
require_once get_parent_theme_file_path( '/includes/classes/core/class-php-version.php' );

/**
 * PHP version check
 *
 * Disables theme front end if the minimum PHP version is not met.
 * Prevents breaking sites running older PHP versions.
 *
 * @since  1.0.0
 * @return void
 */
if ( ! Core\php()->version() && ! is_admin() ) {

	// Get the conditional message.
	$die = Core\php()->frontend_message();

	// Print the die message.
	die( $die );
}

/**
 * Get plugins path
 *
 * Used to check for active plugins with the `is_plugin_active` function.
 * Namespace escaped in example ( \ ) as it sometimes causes an error.
 *
 * @link https://developer.wordpress.org/reference/functions/is_plugin_active/
 *
 * @example The following would check for the Advanced Custom Fields plugin:
 *          ```
 *          if ( \is_plugin_active( 'advanced-custom-fields/acf.php' ) ) {
 *          	// Execute code.
 *           }
 *          ```
 */
$get_plugin = ABSPATH . 'wp-admin/includes/plugin.php';
if ( file_exists( $get_plugin ) ) {
	include_once( $get_plugin );
}

// Get plugin configuration file.
require get_parent_theme_file_path( '/includes/config.php' );

// Autoload class files.
require_once BST_PATH . 'includes/autoloader.php';

/**
 * Instantiate theme classes
 *
 * @since 1.0.0
 * @see   `includes/autoloader.php`
 */

// Activation classes.
$bst_activate   = new Classes\Activate\Activate;
$bst_deactivate = new Classes\Activate\Deactivate;

// Theme setup.
$bst_core    = new Core\Setup;
$bst_widgets = new Widgets\Register;
$bst_media   = new Media\Images;

// Vendor (plugin) classes.
$bst_acf = new Vendor\Theme_ACF;

// Frontend classes.
if ( ! is_admin() ) {
	$bst_head   = new Front\Head;
	$bst_tags   = new Front\Template_Tags;
	$bst_assets = new Front\Assets;
	$bst_layout = new Front\Layout;
}

// Backend classes.
if ( is_admin() ) {
	$bst_admin_pages  = new Admin\Admin_Pages;
	$bst_admin_assets = new Admin\Assets;
	if ( bst_has_blocks() ) {
		$bst_blocks = new Admin\Block_Editor;
	}
}

// Customizer classes.
if ( is_customize_preview() ) {
	$bst_customize = new Customize\Customizer;
}
