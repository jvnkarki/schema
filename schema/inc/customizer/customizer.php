<?php
/**
 * Schema Theme Customizer
 *
 * @package Schema
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function schema_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'schema_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'schema_customize_partial_blogdescription',
			)
		);
	}
	require get_template_directory() . '/inc/customizer/schema-customizer.php';

	// Register JS control types
	$wp_customize->register_control_type( 'Schema_Customizer_Buttonset_Control' );

	
}
add_action( 'customize_register', 'schema_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function schema_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function schema_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function schema_customize_preview_js() {
	wp_enqueue_script( 'schema-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'schema_customize_preview_js' );

/**
 * Enqueue scripts and style for customizer
*/
function schema_customize_backend_scripts() {
    
	wp_enqueue_style( 'schema-fontawesome-styles', get_template_directory_uri(). '/assets/externals/font-awesome/css/font-awesome.min.css');
   
}
add_action( 'customize_controls_enqueue_scripts', 'schema_customize_backend_scripts' );