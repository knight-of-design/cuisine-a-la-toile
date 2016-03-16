<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Cuisine_a_la_Toile
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'cuisine-a-la-toile' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'cuisine-a-la-toile' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php
			$copyright = get_option('cuisine_options_settings')['cuisine_text_field'];

			printf( esc_html__( 'Theme: %1$s by %2$s.', 'cuisine-a-la-toile' ), 'cuisine-a-la-toile', $copyright ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
