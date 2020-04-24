<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package HydraBug
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'hydrabug' ) ); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'hydrabug' ), 'WordPress' );
				?>
			</a>
			<div class="sep">&#10714;</div>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s', 'hydrabug' ), 'hydrabug', '<a href="https://github.com/dorival/hydrabug-theme">Dorival Neto</a>' );
				?>
			<div class="sep">&#10714;</div>
			<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( '&copy; %s Dorival Neto', 'hydrabug' ), date('Y') );
			?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
