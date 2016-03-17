<?php
/**
 * Cuisine a la Toile functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Cuisine_a_la_Toile
 */

if ( ! function_exists( 'cuisine_a_la_toile_setup' ) ) :

function cuisine_a_la_toile_init(){
	register_taxonomy(
		'cusine_recipe_meal_course',
		'cusine_recipe',
		array(
			'labels' => array(
					'name' =>	__( 'Meal Courses', 'cuisine_a_la_toile'),
          'singular_name' => __( 'Meal Course', 'cuisine_a_la_toile'),
					'all_items' => __( 'All Meal Courses' , 'cuisine_a_la_toile'),
					'edit_item'  => __( 'Edit Meal Course', 'cuisine_a_la_toile' ),
					'view_item' => __( 'View Meal Course' , 'cuisine_a_la_toile'),
					'update_item'  => __( 'Update Meal Course', 'cuisine_a_la_toile' ),
					'add_new_item'  => __( 'Add New Meal Course', 'cuisine_a_la_toile' ),
					'new_item_name'  => __( 'New Meal Course Name', 'cuisine_a_la_toile' ),
					'search_items' =>  __( 'Search Meal Courses', 'cuisine_a_la_toile' ),
					'not_found' => __( 'No Meal Courses found.', 'cuisine_a_la_toile' )

				),
			'rewrite' => array( 'slug' => 'course'),
			'public' => true,
			'show_ui' => true,
			'hierarchical' => true,
		));

	register_post_type('cuisine_recipe', array(
      'labels' => array(
        'name' => __( 'Recipes', 'cuisine_a_la_toile' ),
        'singular_name' => __( 'Recipe', 'cuisine_a_la_toile')
      ),
			'taxonomies' => array('cusine_recipe_meal_course'),
			'hierarchical'        => false,
      'public' => true,
      'has_archive' => true,
			'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
			'menu_position'       => 3,
			    'publicly_queryable' => true,
					 'query_var' => true,
					 'capability_type' => 'post',
			'rewrite' => array('slug' => 'recipe'),
    ));

}

add_action('init',cuisine_a_la_toile_init);
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function cuisine_a_la_toile_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Cuisine a la Toile, use a find and replace
	 * to change 'cuisine-a-la-toile' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'cuisine-a-la-toile', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'cuisine-a-la-toile' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'cuisine_a_la_toile_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'cuisine_a_la_toile_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function cuisine_a_la_toile_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'cuisine_a_la_toile_content_width', 640 );
}
add_action( 'after_setup_theme', 'cuisine_a_la_toile_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function cuisine_a_la_toile_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'cuisine-a-la-toile' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'cuisine_a_la_toile_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function cuisine_a_la_toile_scripts() {
	wp_enqueue_style( 'cuisine-a-la-toile-style', get_stylesheet_uri() );

	wp_enqueue_script( 'cuisine-a-la-toile-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'cuisine-a-la-toile-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'cuisine_a_la_toile_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

// Adds a custom Google font.
function wpb_add_google_fonts() {
wp_enqueue_style( 'wpb-google-fonts', 'https://fonts.googleapis.com/css?family=Parisienne|Muli', false );
}
add_action( 'wp_enqueue_scripts', 'wpb_add_google_fonts' );

//Theme Options: It calls the file (options.php) that controls the theme options.
require get_stylesheet_directory() . '/inc/options.php';

//Adds a custom gravatar
add_filter( 'avatar_defaults', 'cuisine_a_la_toile' );
function cuisine_a_la_toile ($avatar_defaults) {
   $myavatar = get_stylesheet_directory_uri() . 'assets/images/gravatar.png';
    $avatar_defaults[$myavatar] = __( 'Custom Gravatar', 'cuisine' );
    return $avatar_defaults;
}

//Adds a signature after each post
add_filter('the_content','add_signature', 1);
function add_signature($text) {
 global $post;
 if(($post->post_type == 'post'))
    $text .= '<div class="signature">~Bon Appetite!</div>';
    return $text;
}

//Adds a menu in the footer
register_nav_menus( array('secondary' => __( 'Footer Menu' ),));

//Pagination within the category
function cd_posts_navigation() {
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	$args = array(
    'mid_size' => 2,
    'prev_text' => __( 'Backward', 'cuisine' ),
    'next_text' => __( 'Forward', 'cuisine' )
);
	?>
	<nav class="navigation posts-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Posts navigation', 'cuisine' ); ?></h2>
		<div class="nav-links">
			<?php the_posts_pagination( $args ); ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
