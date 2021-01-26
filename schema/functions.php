<?php
/**
 * Schema functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Schema
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'schema_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function schema_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Schema, use a find and replace
		 * to change 'schema' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'schema', get_template_directory() . '/languages' );

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
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'schema' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'schema_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'schema_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function schema_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'schema_content_width', 640 );
}
add_action( 'after_setup_theme', 'schema_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function schema_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'schema' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'schema' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	$footer_widget_regions = apply_filters( 'schema_footer_widget_regions', 3 );
	
	for ( $i = 1; $i <= intval( $footer_widget_regions ); $i++ ) {
		
		register_sidebar( array(
			/* translators: %d: Value*/
			'name' 				=> sprintf( __( 'Footer Widget Area %d', 'schema' ), $i ),
			'id' 				=> sprintf( 'footer-%d', $i ),
			/* translators: %d: Value*/
			'description' 		=> sprintf( __( ' Add Widgetized Footer Region %d.', 'schema' ), $i ),
			'before_widget' 	=> '<div id="%1$s" class="widget %2$s">',
			'after_widget' 		=> '</div>',
			'before_title' 		=> '<h2 class="widget-title">',
			'after_title' 		=> '</h2>',
		));
	}
}
add_action( 'widgets_init', 'schema_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function schema_scripts() {

	$query_args = array('family' => 'Abhaya+Libre:400,500,600,700,800|Nunito+Sans:400,400i,600,600i,700,700i');

  	wp_enqueue_style('schema-google-fonts', add_query_arg($query_args, "//fonts.googleapis.com/css"));
  	wp_enqueue_style( 'aschema-style', get_stylesheet_uri());

	wp_enqueue_script( 'schema-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_style( 'schema-font-awesome', get_template_directory_uri() . '/assets/externals/font-awesome/css/font-awesome.min.css' );
	wp_enqueue_script( 'sticky-sidebar', get_template_directory_uri() . '/js/sticky-sidebar.js', array( 'jquery' ), _S_VERSION, true );
	wp_enqueue_style( 'rara-companion', get_template_directory_uri() . '/assets/css/raratheme-companion-public.css' );



	wp_register_script( 'schema-custom', get_template_directory_uri() . '/assets/js/custom.js', array(), '1.0.1', true );
	
	$localize_options =  array(
    	'ajaxurl'		=> admin_url( 'admin-ajax.php'),
    
    );
    wp_localize_script( 'schema-custom', 'schema_ajax_script', $localize_options  );
    wp_enqueue_script( 'schema-custom' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'schema_scripts' );



/**
 * Init
 */
require get_template_directory() . '/inc/init.php';

// add_action( 'wp_ajax_nopriv_ajax_pagination', 'my_ajax_pagination' );
// add_action( 'wp_ajax_ajax_pagination', 'my_ajax_pagination' );

// function my_ajax_pagination() {
// 	if(isset($_POST['page'])){
//     $paged = $_POST['page'];

// 	}else{

//     $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
// 	}
//     $args = array(
//         'post_type' => 'post',
//         'paged' => $paged,
//         'post_status' =>'publish',
//     );
//     // echo '<pre>';
//     // print_r($args);
//     // echo '</pre>';

//     $loop = new WP_Query( $args );

//     if( $loop->have_posts() ) {
//         while( $loop->have_posts() ) {
//             $loop->the_post();
//             get_template_part( 'template-parts/content', 'archive' );
//         }
//         //the_posts_navigation();
//         the_posts_pagination( array(
//             'prev_text'          => __( 'Previous page', 'schema' ),
//             'next_text'          => __( 'Next page', 'schema' ),
//             'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'schema' ) . ' </span>',
//         ) );
//     }
//     die();

// }