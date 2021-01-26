<?php 

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/etc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/etc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

require get_template_directory() . '/inc/customizer/repeater-controller/customizer.php';

/**
 * buttonset
 */
require get_template_directory () .'/inc/customizer/buttonset/init.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';
require get_template_directory() . '/inc/customizer/schema-sanitize.php';



/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}



/**
 * Footer
 */
require get_template_directory() . '/inc/hook/footer.php';

/**
 * Schema Functions
 */
require get_template_directory() . '/inc/schema-functions.php';


/**
 * Schema Home
 */
require get_template_directory() . '/inc/customizer/home-functions.php';
