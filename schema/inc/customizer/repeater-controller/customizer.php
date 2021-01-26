<?php
/**
* Schema repeater customizer
*
* @package Schema
*/



/**
* Load scripts for repeater 
*/
  function schema_enqueue_repeater_scripts() {
    wp_enqueue_script( 'schema-repeater-script', get_template_directory_uri() . '/inc/customizer/repeater-controller/repeater-script.js',array( 'jquery','jquery-ui-sortable'));
    wp_enqueue_style('schema-repeater-style',get_template_directory_uri() . '/inc/customizer/repeater-controller/repeater-style.css');
} add_action( 'admin_enqueue_scripts', 'schema_enqueue_repeater_scripts');

/**
* Repeater customizer
*/
add_action( 'customize_register', 'schema_repeaters_customize_register' );
function schema_repeaters_customize_register( $wp_customize ) {
    
    require get_template_directory().'/inc/customizer/repeater-controller/repeater-class.php';
    

    /**
    * Repeater Sanitize
    */
    function schema_sanitize_repeater($input){      
        $input_decoded = json_decode( $input, true );
        
        if(!empty($input_decoded)) {
            foreach ($input_decoded as $boxes => $box ){
                foreach ($box as $key => $value){

                    $input_decoded[$boxes][$key] = sanitize_text_field( $value );
                }
            }
            return json_encode($input_decoded);
        }    
        return $input;
    }
    /**
    * Repeater Sanitize for html filter
    */
    function schema_html_sanitize_repeater($input){      
        $input_decoded = json_decode( $input, true );
        if(!empty($input_decoded)) {
            foreach ($input_decoded as $boxes => $box ){
                foreach ($box as $key => $value){

                    $input_decoded[$boxes][$key] = wp_kses_post( $value );
                }
            }
            return json_encode($input_decoded);
        }    
        return $input;
    }
    
}