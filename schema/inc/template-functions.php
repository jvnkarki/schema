<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Schema
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function schema_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}
   

    if ( is_front_page() || is_home()   ) {
        $classes[] = 'rightsidebar';

         $layout = get_theme_mod('schema_web_layout','normal');
        if($layout == 'normal'){
            $classes[] = '';

        }else{
            $classes[] = 'list-view';

        }
    }

    if(is_single()){
        $single_post = get_theme_mod('schema_post_layout','normal');
        if($single_post == 'center'){
            $classes[] = 'fullwidth-centered';

        }else{
            $classes[] = 'rightsidebar';

        }
    }

    if(is_archive()){
        $classes[] = 'rightsidebar';
    }
    
    if(is_search()){
        $classes[] = 'rightsidebar';
         $classes[] = 'list-view';
    }
	return $classes;
}
add_filter( 'body_class', 'schema_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function schema_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'schema_pingback_header' );

