<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @package    BS_Theme
 * @subpackage Templates
 * @category   Headers
 * @since      1.0.0
 *
 * @todo Add hooks for nav above or below header.
 */

namespace BS_Theme;

// Alias namespaces.
use BS_Theme\Classes\Front as Front;

// Conditional canonical link.
if ( is_home() && ! is_front_page() ) {
    $canonical = get_permalink( get_option( 'page_for_posts' ) );
} elseif ( is_archive() ) {
    $canonical = get_permalink( get_option( 'page_for_posts' ) );
} else {
    $canonical = get_permalink();
}

?>
<!doctype html>
<?php

// Hook for ACF forms & similar.
do_action( 'before_html' ); ?>

<html <?php language_attributes(); ?> class="no-js">

<head id="<?php echo esc_attr( get_bloginfo( 'url' ) ); ?>" data-template-set="<?php echo esc_attr( get_template() ); ?>">

	<meta charset="<?php esc_attr( bloginfo( 'charset' ) ); ?>">
	<!--[if IE ]>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<![endif]-->
	<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">

	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php if ( is_singular() && pings_open() ) {
		echo sprintf( '<link rel="pingback" href="%s" />', esc_attr( get_bloginfo( 'pingback_url' ) ) );
	} ?>

	<link href="<?php echo esc_attr( $canonical ); ?>" rel="canonical" />

	<?php if ( is_search() ) { echo esc_attr( '<meta name="robots" content="noindex,nofollow" />' ); } ?>

	<!-- Prefetch font URLs -->
	<link rel='dns-prefetch' href='//fonts.adobe.com'/>
	<link rel='dns-prefetch' href='//fonts.google.com'/>

	<?php
	// Hook into the head.
	do_action( 'before_wp_head' );
	wp_head();
	do_action( 'after_wp_head' );
	?>

</head>

<body <?php body_class(); ?>>

<?php
Front\tags()->body_open();
Front\tags()->before_page();
?>

<div id="page" class="site" itemscope="itemscope" itemtype="<?php esc_attr( Front\tags()->site_schema() ); ?>">

	<a class="skip-link screen-reader-text" href="#content"><?php esc_attr( esc_html_e( 'Skip to content', 'bs-theme' ) ); ?></a>

	<nav id="site-navigation" class="main-navigation" role="directory" itemscope itemtype="http://schema.org/SiteNavigationElement">
		<button class="menu-toggle" aria-controls="main-menu" aria-expanded="false">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="theme-icon menu-icon"><path d="M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z"/></svg>
			<?php esc_html_e( 'Menu', 'bs-theme' ); ?>
		</button>
		<?php
		wp_nav_menu( [
			'theme_location' => 'main',
			'menu_id'        => 'main-menu',
		] );
		?>
	</nav>

	<header id="masthead" class="site-header" role="banner" itemscope="itemscope" itemtype="http://schema.org/Organization">

		<div class="site-branding">

			<?php echo Front\tags()->site_logo(); ?>

			<div class="site-title-description">

				<?php if ( is_front_page() ) : ?>
					<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
					<?php else : ?>
					<p class="site-title"><a href="<?php echo esc_attr( esc_url( get_bloginfo( 'url' ) ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php endif;

				$site_description = get_bloginfo( 'description', 'display' );
				if ( $site_description || is_customize_preview() ) :
					?>
					<p class="site-description"><?php echo $site_description; ?></p>
				<?php endif; ?>

			</div>
		</div>

		<div class="site-header-image" role="presentation">
			<figure>
				<?php
				if ( has_header_image() ) {
					$attributes = [
						'alt'  => ''
					];
					the_header_image_tag( $attributes );
				} else {
					echo sprintf(
						'<img src="%1s" alt="" width="2048" height="878" />',
						esc_attr( get_theme_file_uri( '/assets/images/default-header.jpg' ) )
					);
				} ?>
			</figure>
		</div>
	</header>

	<div id="content" class="site-content">
