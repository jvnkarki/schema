<?php 

/**
* Repeater Sanitize
*/
// site layout
function schema_banner_layout( $input ) {
    $valid_keys = array(
            'left'     => esc_html__('Left ', 'schema'),
      		'center'     => esc_html__('Center', 'schema')
        );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}

function schema_webs_layout( $input ) {
    $valid_keys = array(
        'list'     => esc_html__('List ', 'schema'),
      	'normal'     => esc_html__('Normal', 'schema')
    );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}

function schema_post_layout( $input ) {
    $valid_keys = array(
        'center'     => esc_html__('Center ', 'schema'),
      'left'     => esc_html__('Left', 'schema')
    );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}

function schema_sanitize_enable( $input ) {
    $valid_keys = array(
        'show'        => esc_html__( 'Show', 'schema' ),
        'hide'       => esc_html__( 'Hide', 'schema' )
    );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}