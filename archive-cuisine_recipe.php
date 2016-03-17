<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Cuisine_a_la_Toile
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					echo '<h1 class="page-title"> Recipes </h1>';
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				 ?>

 				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
 					<header class="entry-header">
 						<?php
 							if ( is_single() ) {
 								the_title( '<h1 class="entry-title">', '</h1>' );
 							} else {
 								the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
 							}

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
										<a href="<?php echo esc_url( get_permalink() );?>">
											<?php the_post_thumbnail(array(500,500)); ?></a>
								</div>
							<?php }



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
