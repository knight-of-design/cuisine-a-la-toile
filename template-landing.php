<?php
/**
 * Template Name: Landing Page Template
 * The template file for the landing page
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Cuisine_a_la_Toile
 */

/* Places a video in the background of the landing page. It is set on autoplay loop muted.
The video can be accessed at: https://www.flickr.com/photos/manikrathee/8296685740/in/photolist-dD9FBS-dD4ePk-dD9E4E-dD4huv-dD4gFH-dD9Acq-dD4fMZ-dD9BKJ-dD9D5f-dD9Gp1-dD4jdn-7JtWwb-pzPt2Y-7uiTeW-76Ya9t-773iTW-AXECvb-zdvkyZ-nhGar3-5c6yWA-6FnBv1-56r1K7-56qVEy-56mUrX-nfUUDY-nfUW6q-nhZxHA-nfUWYh-nhEUG4-y3PB5T-56mP6K-4E2c76-rQ1mPn-DeJ8iA-AdvTuJ-6GhQgF-aq867o-5jPMoy-9fBSt4-BnTrDh-ASv54W-BQ2dk6-4Wwk4Z-4WACKq-7cfZMB-7ci4zj-4WABHU-aHbS7Z-6MhXZc-6MhUanand
This video falls under the creative commons.
  */
get_header(); ?>
<div class="video-wrapper">
	<video id="landing-background" autoplay loop muted>
		<source src="<?php echo get_template_directory_uri() ?>/assets/paris.mp4" type="video/mp4">
	</video>
</div>

	<div id="primary" class="content-area">

		<main id="main" class="site-main" role="main">
<?php
$options = get_option('cuisine_options_settings');

if (isset($options['cuisine_textarea_field']) and $options['cuisine_textarea_field']!="") {
	$promo = $options['cuisine_textarea_field'];
	?>
	<div class="promo"><?php echo $promo; ?></div>
	<?php
}
 ?>

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>

			<?php
			endif;

			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
