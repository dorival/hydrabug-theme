<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package HydraBug
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
	<style>
	<?php
		if ( has_custom_logo() ) :
			$custom_logo = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );
	?>
		.site-title a{
			background-image: url(<?php echo esc_url( $custom_logo[0] ); ?>);
			background-size: <?php echo absint( $custom_logo[1] ) ?>px;
			display: block;
			height: <?php echo absint( $custom_logo[2] ) ?>px;
			width: <?php echo absint( $custom_logo[1] ) ?>px;
		}
	<?php endif; ?>

	<?php
		if ( has_header_image() ) :
			$custom_header = get_header_image();
	?>
		.site-mascot{
			background-image: url(<?php echo $custom_header ?>);
		}
	<?php endif; ?>
	</style>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'hydrabug' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="site-branding">
			<div class="sb-inner">

				<?php if ( has_header_image() ) : ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="site-mascot"></a>
				<?php	endif; ?>

				<div class="site-logo">
				<?php
				if ( is_front_page() && is_home() ) :
					?>
					<h1 class="site-title">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<?php has_custom_logo() ? '' : bloginfo( 'name' ); ?>
						</a>
					</h1>
					<?php
				else :
					?>
					<p class="site-title">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<?php has_custom_logo() ? '' : bloginfo( 'name' ); ?>
						</a>
					</p>
					<?php
				endif;
				$hydrabug_description = get_bloginfo( 'description', 'display' );
				if ( $hydrabug_description || is_customize_preview() ) :
					?>
				<?php endif; ?>
					<p class="site-description"><?php echo $hydrabug_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
				</div>
				
			</div>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation <?php echo has_header_image() ? 'has-header-image' : '' ?>">
			<button class="menu-toggle" aria-controls="primary-menu"
				aria-expanded="false" aria-label="<?php esc_html_e( 'Primary Menu', 'hydrabug' ); ?>">
			</button>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu'
				)
			);
			?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
