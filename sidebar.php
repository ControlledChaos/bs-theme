<?php
/**
 * Default sidebar template
 *
 * @package    BS_Theme
 * @subpackage Templates
 * @category   Asides
 * @since      1.0.0
 */

namespace BS_Theme;

// Alias namespaces.
use BS_Theme\Classes\Front as Front;

?>
<?php Front\tags()->before_sidebar(); ?>
<?php Front\tags()->sidebar(); ?>
<?php Front\tags()->after_sidebar(); ?>
