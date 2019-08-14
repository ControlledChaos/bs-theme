<?php
/**
 * Template part for displaying results in search pages
 *
 * @package    WordPress/ClassicPress
 * @subpackage BS_Theme
 * @since      1.0.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php
			BS_Theme\Tags\posted_on();
			BS_Theme\Tags\posted_by();
			?>
		</div>
		<?php endif; ?>
	</header>

	<?php BS_Theme\Tags\post_thumbnail(); ?>

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>

	<footer class="entry-footer">
		<?php BS_Theme\Tags\entry_footer(); ?>
	</footer><
</article>
