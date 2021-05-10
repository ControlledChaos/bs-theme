<?php
/**
 * The template for displaying the footer
 *
 * @package    BS_Theme
 * @subpackage Templates
 * @category   Footers
 * @since      1.0.0
 */

namespace BS_Theme;

// Alias namespaces.
use BS_Theme\Classes\Front as Front;

?>
	<?php Front\tags()->before_footer(); ?>
	<?php Front\tags()->footer(); ?>
	<?php Front\tags()->after_footer(); ?>

</div><!-- #page -->

<?php Front\tags()->after_page(); ?>
<?php wp_footer(); ?>

</body>
</html>
