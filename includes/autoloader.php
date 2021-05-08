<?php
/**
 * Class autoloader
 *
 * @package    BS_Theme
 * @subpackage Includes
 * @category   Core
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
	'core'      => BST_PATH . 'includes/classes/core/class-',
	'settings'  => BST_PATH . 'includes/classes/settings/class-',
	'tools'     => BST_PATH . 'includes/classes/tools/class-',
	'media'     => BST_PATH . 'includes/classes/media/class-',
	'users'     => BST_PATH . 'includes/classes/users/class-',
	'widgets'   => BST_PATH . 'includes/classes/widgets/class-',
	'vendor'    => BST_PATH . 'includes/classes/vendor/class-',
	'admin'     => BST_PATH . 'includes/classes/backend/class-',
	'front'     => BST_PATH . 'includes/classes/frontend/class-',
	'customize' => BST_PATH . 'includes/classes/customizer/class-',
	'general'   => BST_PATH . 'includes/classes/class-',
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

	// Core classes.
	BST_CLASS_NS . '\Core\Assets' => BST_CLASS['core'] . 'assets.php',
	BST_CLASS_NS . '\Core\Setup'  => BST_CLASS['core'] . 'setup.php',

	// Widgets classes.
	BST_CLASS_NS . '\Widgets\Register' => BST_CLASS['widgets'] . 'register.php',

	// Frontend classes.
	BST_CLASS_NS . '\Front\Head'          => BST_CLASS['front'] . 'head.php',
	BST_CLASS_NS . '\Front\Template_Tags' => BST_CLASS['front'] . 'template-tags.php',

	// Backend classes.
	BST_CLASS_NS . '\Admin\Admin'       => BST_CLASS['admin'] . 'admin.php',
	BST_CLASS_NS . '\Admin\Admin_Pages' => BST_CLASS['admin'] . 'admin-pages.php',

	// Customizer classes.
	BST_CLASS_NS . '\Customize\Customizer' => BST_CLASS['customize'] . 'customizer.php',

	// Vendor classes.
	BST_CLASS_NS . '\Vendor\Plugin' => BST_CLASS['vendor'] . 'plugin.php',
	BST_CLASS_NS . '\Vendor\ACF'    => BST_CLASS['vendor'] . 'acf.php',

	// General/miscellaneous classes.
	BST_CLASS_NS . '\Activate\Activate'   => BST_CLASS['general'] . 'activate.php',
	BST_CLASS_NS . '\Activate\Deactivate' => BST_CLASS['general'] . 'deactivate.php',

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
