<?php
$schema_post_lists = schema_post_lists();

/**
* Home page common sections
* 
*/
$sections = array('banner','about','client','features','blog','support');
foreach( $sections as $section ){
    
    $wp_customize->add_setting( 'schema_'.$section.'_enable', array(
        'default'             => 'hide',
        'sanitize_callback'   => 'schema_sanitize_enable',
      ) );

      $wp_customize->add_control( new Schema_Customizer_Buttonset_Control( $wp_customize, 'schema_'.$section.'_enable', array(
        'label'         => esc_html__( 'Enable Section', 'schema' ),
        'section'       => 'schema_'.$section.'_section',
        'priority'        => 1,
        'choices'         => array(
          'show'        => esc_html__( 'Show', 'schema' ),
          'hide'       => esc_html__( 'Hide', 'schema' ),
        )
      ) ) );

}

$wp_customize->add_panel('schema_extra_settings', array(
 'priority'         =>      10,
 'title'            =>      esc_html__( 'Extra Setting', 'schema' ),
));

$wp_customize->get_section('title_tagline')->panel = 'schema_extra_settings';

$wp_customize->get_section('colors')->panel = 'schema_extra_settings';

$wp_customize->get_section('background_image')->panel = 'schema_extra_settings';

$wp_customize->get_section('static_front_page')->panel = 'schema_extra_settings';

$wp_customize->get_section('colors')->title = esc_html__( 'Colors', 'schema' );

//adding homepage setting panel
$wp_customize->add_panel( 'schema_home_page_setting',array(
	'title'			=> esc_html__('Home Section','schema'),
	'description'	=> esc_html__('it shows Home Section','schema'),
	'priority'		=> 30,
));

$wp_customize->add_section('schema_banner_section',array(
	'panel'			=> 'schema_home_page_setting',
	'title'			=> esc_html__('Banner Section','schema'),
));

$wp_customize->add_setting( 'schema_banner_image', array(
    'default'           => false,
	'sanitize_callback' => 'esc_url_raw',
));

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize,'schema_banner_image',array(
	'label'      	=> esc_html__( 'Upload Image', 'schema' ),
	'section'    	=> 'schema_banner_section'
)));

$wp_customize->add_setting('schema_banner_title',array(
    'default'           =>  __( 'Content Marketing & SEO Done Right.', 'schema' ),
	'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_control( 'schema_banner_title', array(
	'label'			=> esc_html__('Banner Title','schema'),
	'type'			=> 'text',
	'section'		=> 'schema_banner_section'
));

$wp_customize->add_setting('schema_banner_description',array(
    'default'           =>  __( 'Learn how B2B and SaaS companies improve their marketing ROI through the evidence-based approach to SEO and content marketing.', 'schema' ),
	'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_control( 'schema_banner_description', array(
	'label'			=> esc_html__('Banner Description','schema'),
	'type'			=> 'text',
	'section'		=> 'schema_banner_section'
));

$wp_customize->add_setting( 'schema_banner_shortcode', array( 
	'default'           => '',
    'sanitize_callback' => 'wp_kses_post',
));
        
$wp_customize->add_control( 'schema_banner_shortcode', array(
    'type'        => 'text',
    'label'       => __( 'Enter Shortcode', 'schema' ),
    'description' => __( 'Enter the Contact Form Shortcode to display form.', 'schema' ),
    'section'     => 'schema_banner_section',
));

$wp_customize->add_setting( 'schema_banner_content_align_pos',array(
    'sanitize_callback' => 'schema_banner_layout',
    'default'           => 'center',
  ));
$wp_customize->add_control( 'schema_banner_content_align_pos', array(
    'label'           => esc_html__('Content Align', 'schema'),
    'section'         => 'schema_banner_section',
    'type'            => 'radio',
    'choices'         => array(
      'left'     => esc_html__('Left ', 'schema'),
      'center'     => esc_html__('Center', 'schema')
    )
  ));

$wp_customize->add_section('schema_about_section',array(
	'panel'			=> 'schema_home_page_setting',
	'title'			=> esc_html__('About Section','schema'),
));

$wp_customize->add_setting( 'schema_about_page', array(
	'sanitize_callback' => 'absint',
	'default'           => 0,
));

$wp_customize->add_control('schema_about_page', array(
	'label'			=> esc_html__('Select Post  ','schema'),
	'description'	=>	esc_html__('Choose post to show in About us Section ','schema'),
	'type'			=> 'select',
	'choices'		=> $schema_post_lists,
	'section'		=> 'schema_about_section',
));

$wp_customize->add_section('schema_client_section',array(
	'panel'			=> 'schema_home_page_setting',
	'title'			=> esc_html__('Client Section','schema'),
));

$wp_customize->add_setting('schema_client_title',array(
    'default'           =>  __( 'Raushan has been featured on:.', 'schema' ),
	'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_control( 'schema_client_title', array(
	'label'			=> esc_html__('Client Title','schema'),
	'type'			=> 'text',
	'section'		=> 'schema_client_section'
));

$wp_customize->add_setting( 'schema_client_logo_rep', array(
	'sanitize_callback' => 'schema_sanitize_repeater',
	'default' => json_encode(
		array(
			array(
				'cl_logo' => '',
				'cl_url'  => '',
			)
		)
	)
));

$wp_customize->add_control(  new Schema_Repeater_Controler( $wp_customize, 'schema_client_logo_rep', 
	array(
		'label'                        => esc_html__('Client Logo Options','schema'),
		'section'                      => 'schema_client_section',
		'schema_box_label'         => esc_html__('Logo','schema'),
		'schema_box_add_control'   => esc_html__('Add Client Logo','schema'),
	),
	array(
		'cl_logo' => array(
			'type'        => 'upload',
			'label'       => esc_html__( 'Client Logo', 'schema' ),
			'default'     => '',
			'class'       => 'un-bottom-block-cat1'
		),

		'cl_url' => array(
			'type'        => 'text',
			'label'       => esc_html__( 'Client URL', 'schema' ),
			'default'     => '',
			'class'       => 'un-bottom-block-cat1'
		) 
	)
));

$wp_customize->add_section('schema_features_section',array(
	'panel'			=> 'schema_home_page_setting',
	'title'			=> esc_html__('Feature Section','schema'),
));

$wp_customize->add_setting('schema_feature_title',array(
    'default'           =>  __( 'What do you need help with now?', 'schema' ),
	'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_control( 'schema_feature_title', array(
	'label'			=> esc_html__('Feature Title','schema'),
	'type'			=> 'text',
	'section'		=> 'schema_features_section'
));

$wp_customize->add_setting('schema_feature_description',array(
    'default'           =>  __( 'Get evidence-based collection of articles on a topic sent directly to you in one email.', 'schema' ),
	'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_control( 'schema_feature_description', array(
	'label'			=> esc_html__('Feature Description','schema'),
	'type'			=> 'text',
	'section'		=> 'schema_features_section'
));

$wp_customize->add_setting( 'schema_feature_list_tab', array(
	'sanitize_callback' => 'schema_sanitize_repeater',
	'default' => json_encode(
		array(
			array(
				'feat_page'  	=> ''
			)
		)
	)
));

$wp_customize->add_control(  new Schema_Repeater_Controler( $wp_customize, 'schema_feature_list_tab', 
	array(
		'label'                        => esc_html__('Add Feature Options','schema'),
		'section'                      => 'schema_features_section',
		'schema_box_label'         => esc_html__('Feature','schema'),
		'schema_box_add_control'   => esc_html__('Add Feature','schema'),
	),
	array(
        'feat_page'   => array(
        'type'        => 'select',
        'label'       => esc_html__( 'Choose Posts', 'schema' ),
	    'options'     => $schema_post_lists,
        'class'       => 'un-bottom-block-cat1'
    )
    )
));

$wp_customize->add_section('schema_blog_section',array(
	'panel'			=> 'schema_home_page_setting',
	'title'			=> esc_html__('Blog Section','schema'),
));

$wp_customize->add_setting('schema_blog_title',array(
    'default'           =>  __( 'Read our blog to sharpen your business and SEO skills.
', 'schema' ),
	'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_control( 'schema_blog_title', array(
	'label'			=> esc_html__('Blog Title','schema'),
	'type'			=> 'text',
	'section'		=> 'schema_blog_section'
));

$wp_customize->add_setting('schema_blog_description',array(
    'default'           =>  __( 'Get evidence-based collection of articles on a topic sent directly to you in one email.', 'schema' ),
	'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_control( 'schema_blog_description', array(
	'label'			=> esc_html__('Blog Description','schema'),
	'type'			=> 'text',
	'section'		=> 'schema_blog_section'
));

$wp_customize->add_section('schema_support_section',array(
	'panel'			=> 'schema_home_page_setting',
	'title'			=> esc_html__('Support Section','schema'),
));

$wp_customize->add_setting('schema_support_title',array(
    'default'           =>  __( 'join my mailing list to have text emails sent about new posts. sometimes you get something special.', 'schema' ),
	'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_control( 'schema_support_title', array(
	'label'			=> esc_html__('Support Title','schema'),
	'type'			=> 'text',
	'section'		=> 'schema_support_section'
));

$wp_customize->add_setting( 'schema_support_shortcode', array( 
	'default'           => '',
    'sanitize_callback' => 'wp_kses_post',
));
        
$wp_customize->add_control( 'schema_support_shortcode', array(
    'type'        => 'text',
    'label'       => __( 'Enter Shortcode', 'schema' ),
    'description' => __( 'Enter the Contact Form Shortcode to display form.', 'schema' ),
    'section'     => 'schema_support_section',
));

$wp_customize->add_section('schema_footer_section',array(
	'title'			=> esc_html__('Footer Section','schema'),
	'priority'		=> 30
));

$wp_customize->add_setting( 'schema_footer_copyright', array(
	'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control( 'schema_footer_copyright', array(
	'label'			=> esc_html__('Footer Copyright','schema'),
	'type'			=> 'textarea',
	'section'		=> 'schema_footer_section'
));

$social_icons = array('facebook','twitter','googlePlus','dribbble','youtube','linkedin');
foreach( $social_icons as $social_icon){

	$wp_customize->add_setting( 'schema_'.$social_icon.'_url', array(
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control( 'schema_'.$social_icon.'_url', array(
		'section'       => 'schema_footer_section',
		'label'         => $social_icon.esc_html__(' Social Icon : ','schema'),
		'type'          => 'text'
	));
}


//General Settings
$wp_customize->add_section('schema_general_section',array(
	'title'			=> esc_html__('General Settings','schema'),
	'priority'		=> 30
));

$wp_customize->add_setting( 'schema_web_layout',array(
    'sanitize_callback' => 'schema_webs_layout',
    'default'           => 'normal',
  ));
$wp_customize->add_control( 'schema_web_layout', array(
    'label'           => esc_html__('Web Layout', 'schema'),
    'description'	 => esc_html__('It will changes the blog layout in homepage', 'schema'),
    'section'         => 'schema_general_section',
    'type'            => 'radio',
    'choices'         => array(
      'list'     => esc_html__('List ', 'schema'),
      'normal'     => esc_html__('Normal', 'schema')
    )
  ));

$wp_customize->add_setting( 'schema_post_layout',array(
    'sanitize_callback' => 'schema_post_layout',
    'default'           => 'left',
  ));
$wp_customize->add_control( 'schema_post_layout', array(
    'label'           => esc_html__('Post Layout', 'schema'),
    'description'	 => esc_html__('It will changes the single post layout', 'schema'),
    'section'         => 'schema_general_section',
    'type'            => 'radio',
    'choices'         => array(
      'center'     => esc_html__('Center ', 'schema'),
      'left'     => esc_html__('Left', 'schema')
    )
  ));