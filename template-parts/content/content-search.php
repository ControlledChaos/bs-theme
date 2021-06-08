<?php
/**
 * Content template for search results
 *
 * @package    BS_Theme
 * @subpackage Templates
 * @category   Content
 * @since      1.0.0
 */

namespace BS_Theme;

// Alias namespaces.
use BS_Theme\Classes\Front as Front;

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">

	<header class="entry-header">
		<?php

		the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

		<?php

		if ( is_single() ) :

		?>
		<div class="entry-meta">
			<?php
			Front\tags()->posted_on();
			Front\tags()->posted_by();
			?>
		</div>

		<?php endif; ?>

	</header>

	<?php  Front\tags()->post_thumbnail(); ?>

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>

	<footer class="entry-footer">
		<?php  Front\tags()->entry_footer(); ?>
	</footer>

</article>
