<?php
/**
 * BS Theme functions
 *
 * A basic starter theme for WordPress and ClassicPress.
 *
 * @package    WordPress/ClassicPress
 * @subpackage BS_Theme
 * @author     Controlled Chaos Design <greg@ccdzine.com>
 * @copyright  Copyright (c) Controlled Chaos Design
 * @link       https://github.com/ControlledChaos/bs-theme
 * @license    http://www.gnu.org/licenses/gpl-3.0.html
 * @since      1.0.0
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
 * 5. Author
 *    Find `Controlled Chaos Design <greg@ccdzine.com>` and replace with your name and
 *    email address or those of your organization.
 *
 * 6. Header image
 *    Replace the default image file `default-header.jpg`.
 *    @see assets/images/
 *
 * 7. Activation and deactivation
 *    Check the activation and deactivation classes for sample methods.
 *    Remove or modify the samples as needed.
 *    @see includes/class-activate
 *    @see includes/class-deactivate
 *
 * 8. README file
 *    Whether or not your theme will be kept in a version control repository,
 *    edit the content of the README file in the theme's root directory or
 *    delete it if it is not necessary.
 */

namespace BS_Theme;

// Alias namespaces.
use BS_Theme\Classes as Classes;

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
if ( ! Classes\php()->version() && ! is_admin() ) {

	// Get the conditional message.
	$die = Classes\php()->frontend_message();

	// Print the die message.
	die( $die );
}

// Get plugin configuration file.
require get_parent_theme_file_path( '/includes/config.php' );

// Autoload class files.
require BST_PATH . 'includes/autoloader.php';

/**
 * Get plugins path
 *
 * Used to check for active plugins with the `is_plugin_active` function.
 *
 * @link https://developer.wordpress.org/reference/functions/is_plugin_active/
 *
 * @example The following would check for the Advanced Custom Fields plugin:
 *          ```
 *          if ( is_plugin_active( 'advanced-custom-fields/acf.php' ) ) {
 *          	// Do stuff.
 *           }
 *          ```
 */
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

/**
 * Core theme function
 *
 * Runs initial setup classes.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function theme_setup() {

	// Activation classes.
	new Classes\Activate;
	new Classes\Deactivate;

	// Theme setup.
	new Classes\Setup;

	require get_theme_file_path( '/includes/template-functions.php' );
	require get_theme_file_path( '/includes/template-tags.php' );
	require get_theme_file_path( '/includes/customizer.php' );
}
theme_setup();
