<?php
/**
 * Class autoloader
 *
 * @package    WordPress/ClassicPress
 * @subpackage BS_Theme
 * @since      1.0.0
 */

namespace BS_Theme;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class files
 *
 * Defines the class directories and file prefixes.
 *
 * @since 1.0.0
 * @var   array Defines an array of class file paths.
 */
define( 'BST_CLASS', [
	'core'     => BST_PATH . '/includes/classes/core/class-',
	'settings' => BST_PATH . '/includes/classes/settings/class-',
	'tools'    => BST_PATH . '/includes/classes/tools/class-',
	'media'    => BST_PATH . '/includes/classes/media/class-',
	'users'    => BST_PATH . '/includes/classes/users/class-',
	'vendor'   => BST_PATH . '/includes/classes/vendor/class-',
	'admin'    => BST_PATH . '/includes/classes/backend/class-',
	'front'    => BST_PATH . '/includes/classes/frontend/class-',
	'general'  => BST_PATH . '/includes/classes/class-',
] );

/**
 * Classes namespace
 *
 * @since 1.0.0
 * @var   string Defines the namespace of class files.
 */
define( 'BST_CLASS_NS', __NAMESPACE__ . '\Classes' );

/**
 * Array of classes to register
 *
 * When you add new classes to your version of this plugin you may
 * add them to the following array rather than requiring the file
 * elsewhere. Be sure to include the precise namespace.
 *
 * SAMPLES: Uncomment sample classes to load them.
 *
 * @since 1.0.0
 * @var   array Defines an array of class files to register.
 */
define( 'BST_CLASSES', [

	// Base class.
	// BST_CLASS_NS . '\Base' => BST_CLASS['general'] . 'base.php',

	// Core classes.
	BST_CLASS_NS . '\Setup' => BST_CLASS['general'] . 'setup.php',

	// Settings classes.
	// Tools classes.
	// Media classes.
	// Users classes.
	// Vendor classes.
	// Backend/admin classes,
	// Frontend classes.
	// General/miscellaneous classes.

] );

/**
 * Autoload class files
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
spl_autoload_register(
	function ( string $class ) {
		if ( isset( BST_CLASSES[ $class ] ) ) {
			require BST_CLASSES[ $class ];
		}
	}
);
