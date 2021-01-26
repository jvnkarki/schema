<?php 

function schema_banner(){
    $banner_layout = get_theme_mod('schema_banner_content_align_pos','center');
    $image = get_theme_mod('schema_banner_image');
    $title = get_theme_mod('schema_banner_title', __( 'Content Marketing & SEO Done Right.', 'schema' ) );
    $description = get_theme_mod('schema_banner_description', __( 'Learn how B2B and SaaS companies improve their marketing ROI through the evidence-based approach to SEO and content marketing.', 'schema' ) );
    $shortcode = get_theme_mod('schema_banner_shortcode' );

    ?>
    <div class="site-banner">
            <div class="banner-item">
                 <?php if($image){ ?>
                    <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr__('Author image','schema'); ?>" title="<?php echo esc_attr__('Author image','schema'); ?>" />
                <?php } ?>
                <div class="banner-caption <?php echo esc_attr($banner_layout) ?>">
                    <div class="container">
                        <?php if($title){ ?>
                        <h1 class="title">
                            <a href="#"><?php echo esc_html($title); ?></a>
                        </h1>
                        <?php } ?>
                        <div class="item-desc">
                            <?php if($title){ ?>
                            <?php echo esc_html($description); ?>
                            <?php } ?>
                            <?php if($shortcode){
                                echo do_shortcode($shortcode);
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- .site-banner -->
    <?php 
}
if( ! function_exists('schema_banner_fn')){
    function schema_banner_fn(){
    $banner_enable =  get_theme_mod('schema_banner_enable','hide');
    if($banner_enable == 'show'){ 
        schema_banner();
     }
    
  }
} add_action( 'schema_banner_main_fn', 'schema_banner_fn');


function schema_about(){
    $about_post = get_theme_mod('schema_about_page');

    $schema_about_post = new WP_Query(array('post_type' => 'post', 'post__in' => array($about_post)));

    if($schema_about_post->have_posts()) :
            while($schema_about_post->have_posts()) : $schema_about_post->the_post();
            $img_src = wp_get_attachment_image_src(get_post_thumbnail_id(),'full');?>
            <section class="about-section">
                <div class="container">
                    <section class="widget widget_raratheme_featured_page_widget">                
                        <div class="widget-featured-holder right">
                            <p class="section-subtitle">                        
                                <span>About Us</span>
                            </p>                    
                            <div class="text-holder">
                                <h2 class="widget-title"><?php the_title(); ?></h2>
                                <div class="featured_page_content">
                                   <?php the_excerpt(); ?>
                                    <a href="<?php the_permalink() ?>" target="_blank" class="btn-readmore"><?php echo __( 'Know more about me', 'schema' ) ?></a>
                                </div>
                            </div>
                            <div class="img-holder">
                                <a target="_blank" href="#">
                                    <img src="<?php echo esc_url($img_src['0']); ?>" alt="">                        
                                </a>
                            </div>
                        </div>        
                    </section>
                </div>
            </section> <!-- .about-section -->
        <?php 
        endwhile;
        wp_reset_postdata();
    endif;
}
if( ! function_exists('schema_about_fn')){
    function schema_about_fn(){
    $about_enable =  get_theme_mod('schema_about_enable','hide');
    if($about_enable == 'show'){ 
        schema_about();
     }
    
  }
} add_action( 'schema_about_main_fn', 'schema_about_fn');

function schema_client(){
    $client_title = get_theme_mod('schema_client_title', __( 'Raushan has been featured on:.', 'schema' ) );
    $schema_clients_rep = get_theme_mod('schema_client_logo_rep');
    $schema_clients = json_decode($schema_clients_rep);

   ?>
   <section class="client-section">
    <div class="container">
        <section class="widget widget_raratheme_client_logo_widget">            
            <div class="raratheme-client-logo-holder">
                <div class="raratheme-client-logo-inner-holder">
                    <?php if($client_title){ ?>
                    <h2 class="widget-title" itemprop="name">Raushan has been featured on:</h2>
                    <?php } ?>
                    <div class="image-holder-wrap"> <!-- yo wrap plugin ko filter bata rakhnu parxa -->  
                    <?php if($schema_clients) { 
                        foreach( $schema_clients as $schema_client ){ 
                            $logo = $schema_client->cl_logo;
                            $link  = $schema_client->cl_url;

                            $link_open = '';
                            $link_close = '';
                            if( $link ){
                              $link_open = '<a href="'.esc_url($link).'" target="_blank">';
                              $link_close = '</a>';
                            } ?>
                            <?php if($logo){?>                           
                            <div class="image-holder black-white">
                                <a href="#" target="_blank">
                                    <img src="<?php echo esc_url($logo); ?>" alt="">
                                </a> 
                            </div>
                            <?php } ?>
                                    
                    <?php } } ?>
                	</div>
                </div>
            </div>
        </section>
    </div>
</section> <!-- .client-section -->
<?php 
}
if( ! function_exists('schema_client_fn')){
    function schema_client_fn(){
    $client_enable =  get_theme_mod('schema_client_enable','hide');
    if($client_enable == 'show'){ 
        schema_client();
     }
    
  }
} add_action( 'schema_client_main_fn', 'schema_client_fn');


function schema_features(){
    $feat_title = get_theme_mod('schema_feature_title', __( 'What do you need help with now?', 'schema' ) );
    $feat_desc = get_theme_mod('schema_feature_description', __( 'Get evidence-based collection of articles on a topic sent directly to you in one email.', 'schema' ) );

    $schema_feat_rep = get_theme_mod('schema_feature_list_tab');
    $schema_features = json_decode($schema_feat_rep);

   ?>
   <section class="service-section">
    <div class="container">
        <section class="widget widget_text">
            <?php if($feat_title){ ?>
                <h2 class="widget-title"><?php echo esc_html($feat_title); ?></h2>
            <?php } ?>
            <?php if($feat_desc){ ?>
            <div class="textwidget">
                <p><?php echo esc_html($feat_desc); ?></p>
            </div>      
            <?php } ?>    
        </section>
        <?php if($schema_features) { 
            foreach( $schema_features as $schema_feature ){ 
                $feature_logo   = $schema_feature->feat_icon;
                $feature_page   = $schema_feature->feat_page;
                if($feature_page){
                    $schema_args = array(
                        'post_type' => 'post',
                        'post__in' =>array($feature_page),
                    );
                    $sche_query = new WP_Query($schema_args);
                    if($sche_query->have_posts()){
                        while($sche_query->have_posts()){
                            $sche_query->the_post();
                            $feat_src = wp_get_attachment_image_src(get_post_thumbnail_id(),'full');

                 ?>
               <section class="widget widget_rrtc_icon_text_widget">        
                    <div class="rtc-itw-holder">
                        <div class="rtc-itw-inner-holder">
                            <div class="text-holder">
                                <h2 class="widget-title" itemprop="name"><?php the_title(); ?></h2>
                                <div class="content">
                                    <p><?php echo esc_attr(wp_trim_words(get_the_content(),'20','...')); ?></p>
                                </div>
                                <a class="btn-readmore" href="<?php the_permalink() ?>" target="_blank"><?php echo esc_html_e( 'Learn More', 'schema' ) ?></a>                              
                            </div>
                            <div class="icon-holder">
                                <img src="<?php echo esc_url($feat_src['0']); ?>" alt="Generate Better Plans">
                            </div>
                        </div>
                    </div>
                </section>
                <?php }
                wp_reset_postdata();
                }
                 ?>
        <?php } } }?>        
    </div>
</section> <!-- .service-section -->

<?php 
}

if( ! function_exists('schema_features_fn')){
    function schema_features_fn(){
    $features_enable =  get_theme_mod('schema_features_enable','hide');
    if($features_enable == 'show'){ 
        schema_features();
     }
    
  }
} add_action( 'schema_features_main_fn', 'schema_features_fn');

function schema_blog(){
    $blog_title = get_theme_mod('schema_blog_title', __( 'Read our blog to sharpen your business and SEO skills.', 'schema' ) );
    $blog_desc = get_theme_mod('schema_blog_description', __( 'Get evidence-based collection of articles on a topic sent directly to you in one email.', 'schema' ) );

   ?>
        <div id="content" class="site-content">
	        <header class="page-header">
	            <div class="container">
	                <h1 class="page-title"><?php echo esc_html($blog_title); ?></h1>
	                <div class="page-desc">
	                    <?php echo esc_html($blog_desc); ?>
	                </div>
	            </div>
	        </header>
	        <div class="container">
	            <div id="primary" class="content-area">
	                
	                <main id="main" class="site-main">
	                    <?php
                        if ( get_query_var('paged') ) {
                            $paged = get_query_var('paged');
                        } elseif ( get_query_var('page') ) { // 'page' is used instead of 'paged' on Static Front Page
                            $paged = get_query_var('page');
                        } else {
                            $paged = 1;
                        } 
	                    $args = array(
	                            'post_type'           => 'post',
	                            'posts_status'        => 'publish',
                                'paged' => $paged

                        );
	                        
	                    $query = new WP_Query( $args );
	                    if( $query->have_posts() ) :
	                        while( $query->have_posts() ) : $query->the_post();
	                        $blog_ig = wp_get_attachment_image_src(get_post_thumbnail_id(),'full');
	                    ?>
	                    <article class="post">
	                        <figure class="post-thumbnail">
	                            <a href="#<?php the_permalink() ?>"><img src="<?php echo esc_url($blog_ig[0]) ?>" alt=""></a>
	                        </figure>
	                        <div class="post-content-wrap">
	                            <header class="entry-header">
	                                <div class="entry-meta">
	                                    <span class="posted-on" itemprop="datePublished">
	                                        <?php echo esc_html(get_the_date()); ?>
	                                    </span>
	                                    <span class="category">
	                                        <?php schema_post_cat_lists(); ?>
	                                    </span>
	                                </div>
	                                <h2 class="entry-title" itemprop="headline">
	                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	                                </h2>
	                            </header>
	                            <?php echo schema_excerpt_content('200'); ?>
	                        </div>
	                    </article>
	                <?php endwhile;
                    echo the_post_navigation();
	                endif; ?>
	                </main> <!-- .site-main -->

	                <nav class="navigation pagination">
	                    <div class="nav-links">
	                    <?php //schema_navigation(); ?>
	                    <?php //echo get_the_post_navigation(); ?>
	                    <?php //paginate_links(); 
                        //previous_posts_link( '&laquo; Newer posts' );
                        //next_posts_link( 'Older posts &raquo;', $query->max_num_pages );?>
	                    </div>
                        <?php //echo get_next_posts_link(); ?>
                        <?php //echo get_previous_posts_link(); ?>

	                </nav>
	            </div> <!-- #primary -->
	            <aside id="secondary" class="widget-area">
	            <?php dynamic_sidebar( 'sidebar-1' ); ?>
	            </aside> <!-- #secondary -->
	        </div> <!-- .container -->
    </div> <!-- .site-content -->

    <?php 
   }

function schema_support(){
    $title = get_theme_mod('schema_support_title', __( 'join my mailing list to have text emails sent about new posts. sometimes you get something special.', 'schema' ) );
    $shortcode = get_theme_mod('schema_support_shortcode' );

    ?>
    <div class="newsletter-section">
            <div class="newsletter-item">
                <div class="newsletter-caption center">
                    <div class="container">
                        <?php if($title){ ?>
                        <h1 class="title">
                            <a href="#"><?php echo esc_html($title); ?></a>
                        </h1>
                        <?php } ?>
                        <div class="item-desc">
                            <?php if($shortcode){
                                echo do_shortcode($shortcode);
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- .site-newsletter -->
    <?php 
}
if( ! function_exists('schema_support_fn')){
    function schema_support_fn(){
    $support_enable =  get_theme_mod('schema_support_enable','hide');
    if($support_enable == 'show'){ 
        schema_support();
     }
    
  }
} add_action( 'schema_support_main_fn', 'schema_support_fn');