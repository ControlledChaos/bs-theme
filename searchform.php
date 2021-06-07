<?php
/**
 * Default search form template
 *
 * @package    BS_Theme
 * @subpackage Templates
 * @category   Forms
 * @since      1.0.0
 */

namespace BS_Theme;

// Alias namespaces.
use BS_Theme\Classes\Front as Front;

?>
<?php Front\tags()->before_searchform(); ?>
<?php Front\tags()->searchform(); ?>
<?php Front\tags()->after_searchform(); ?>
