<?php
/**
 * The template for displaying the footer
 *
 * @package    BS_Theme
 * @subpackage Templates
 * @category   Footers
 * @since      1.0.0
 */

// Copyright HTML.
$copyright = sprintf(
	'<p class="copyright-text" itemscope="itemscope" itemtype="http://schema.org/CreativeWork">&copy; <span class="screen-reader-text">%1s</span><span itemprop="copyrightYear">%2s</span> <span itemprop="copyrightHolder">%3s.</span> %4s.</p>',
	esc_html__( 'Copyright ', 'bs-theme' ),
	get_the_time( 'Y' ),
	esc_attr( get_bloginfo( 'name' ) ),
	esc_html__( 'All rights reserved', 'bs-theme' )
);

?>
	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="footer-content global-wrapper footer-wrapper">
				<?php echo apply_filters( 'bst_footer_copyright', $copyright ); ?>
		</div>
	</footer>

</div><!-- #page -->

<?php BS_Theme\Tags\after_page(); ?>
<?php wp_footer(); ?>

</body>
</html>
