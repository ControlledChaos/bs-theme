<?php
/**
 * Template part for displaying page content in front-page.php
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
		if ( is_front_page() ) {

			// Front page uses h1 in the page header so h2 here.
			the_title( '<h2 class="entry-title">', '</h2>' );
		} else {
			the_title( '<h1 class="entry-title">', '</h1>' );
		} ?>
	</header>

	<?php Front\tags()->post_thumbnail(); ?>

	<div class="entry-content" itemprop="articleBody">
		<?php
		the_content();

		wp_link_pages( [
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'bs-theme' ),
			'after'  => '</div>',
		] );
		?>
	</div>

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						__( 'Edit <span class="screen-reader-text">%s</span>', 'bs-theme' ),
						[
							'span' => [
								'class' => [],
							],
						]
					),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer>
	<?php endif; ?>

</article>