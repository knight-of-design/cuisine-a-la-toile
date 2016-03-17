<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Cuisine_a_la_Toile
 */

get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();

		/**
		 * Template part for displaying recipes.
		 *
		 */

		?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<?php
						the_title( '<h1 class="entry-title">', '</h1>' );

				if ( 'post' === get_post_type() ) : ?>
				<div class="entry-meta">
					<?php cuisine_a_la_toile_posted_on(); ?>
				</div><!-- .entry-meta -->
				<?php
				endif; ?>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php
					the_content( sprintf(
						/* translators: %s: Name of current post. */
						wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'cuisine-a-la-toile' ), array( 'span' => array( 'class' => array() ) ) ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					) );

		if ( has_post_thumbnail() ){ ?>
			<div class="entry-thumbnail">
				  <?php the_post_thumbnail(array(500,500)); ?>
			</div>
		<?php }

					$ingredients = get_post_meta(get_the_ID(),'Ingredients',true);
					$directions = get_post_meta(get_the_ID(),'Directions',true);

					if ($ingredients and $ingredients != ""){?>
					<section id="ingredients">
					<h2>Ingredients</h2>

						<ul>
							<?php
								foreach (explode("\n",$ingredients) as $item) {
									echo "<li>".$item."</li>";
								}
							?>
						</ul>
					</section>
					<?php
				 }

				 if ($directions and $directions != ""){?>
					<section id="directions">
					<h2>Directions</h2>
					<ol>
						<?php
							foreach (explode("\n",$directions) as $step) {
								echo "<li>".$step."</li>";
							}
						?>
					</ol>
					</section>
					<?php
				}

					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'cuisine-a-la-toile' ),
						'after'  => '</div>',
					) );
				?>
			</div><!-- .entry-content -->

			<footer class="entry-footer">
				<?php cuisine_a_la_toile_entry_footer(); ?>
			</footer><!-- .entry-footer -->
		</article><!-- #post-## -->
		<?php

			the_post_navigation();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
