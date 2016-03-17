<?php
/**
 * Template Name: Gallery Page Template
 * The template file for the gallery page
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

	<div id="primary" class="content-area">

		<main id="main" class="site-main" role="main">
<?php
//If statement
//If the user enters the promotion content they want displayed in the options page, it will appear on the landing page
//else nothing will appear as a default
$options = get_option('cuisine_options_settings');

if (isset($options['cuisine_textarea_field']) and $options['cuisine_textarea_field']!="") {
	$promo = $options['cuisine_textarea_field'];
	?>
	<div class="promo"><?php echo $promo; ?></div>
	<?php
}
	$count = 0;
	wp_reset_query();
	$page = get_query_var('page');
	$args = array(
	'category_name' => 'subscriber-gallery',
	'posts_per_page' => 10,
	'paged' => $page,
	'order' => 'DESC'
	);
	$wp_query = new WP_Query($args);

	if ( $wp_query->have_posts() ) :
 		// Start the Loop
 		while ($wp_query->have_posts() ) : $wp_query->the_post();
			$count++;

            if ($count == 1) $gridClass = 'grid-jumbo';
            elseif ($count == 4) $gridClass = 'grid-middle';
            else $gridClass = 'grid-item';
?>
			<article id="post-<?php the_ID(); ?>" <?php post_class($gridClass); ?>>

				<?php


				if ( has_post_thumbnail() ){ ?>
					<div class="preview">
                        <a href="<?php echo esc_url( get_permalink() );?>">
						<?php the_post_thumbnail(array(500,500));
						the_title( '<h1 class="entry-title">', '</h1>' );

						?>
                            </a>

					</div>
				<?php }

				?>

			</article><!-- #post-## -->
				<?php


		endwhile;
		the_posts_pagination( array( 'mid_size'  => 2 ) );

	else :

		get_template_part( 'template-parts/content', 'none' );

	endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
