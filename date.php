<?php
/**
 * The template for displaying date archive pages
 *
 * @package    BS_Theme
 * @subpackage Templates
 * @category   Archives
 * @since      1.0.0
 */

namespace BS_Theme;

// Alias namespaces.
use BS_Theme\Classes\Front as Front;

// Get the default header file.
get_header();

?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" itemscope itemprop="mainContentOfPage">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header>

			<?php while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content/content', get_post_type() );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content/content', 'none' );

		endif;
		?>

		</main>
	</div>
<?php

// Get the default sidebar file.
get_sidebar();

// Get the default footer file.
get_footer();