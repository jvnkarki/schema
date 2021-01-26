<?php 

/**
* Change comment form textarea to use placeholder
*
* @param  array $args
* @return array
*/
function schema_comment_textarea_placeholder( $args ) {
$args['comment_field']  = str_replace( 'textarea', 'textarea placeholder="'.esc_attr__('Your Comment','schema').'"', $args['comment_field'] );
return $args;
}
add_filter( 'comment_form_defaults', 'schema_comment_textarea_placeholder' );


/**
* Comment Form Fields Placeholder
*
*/
function schema_comment_form_fields( $fields ) {
 
foreach( $fields as &$field ) {
$field = str_replace( 'id="author"', 'id="author" placeholder="'.esc_attr__('Name*','schema').'"', $field );
$field = str_replace( 'id="email"', 'id="email" placeholder="'.esc_attr__('Email Address*','schema').'"', $field );
$field = str_replace( 'id="url"', 'id="url" placeholder="'.esc_attr__('Website','schema').'"', $field );
}
return $fields;
}
add_filter( 'comment_form_default_fields', 'schema_comment_form_fields' );

if( ! function_exists( 'schema_theme_comment' ) ) :

function schema_theme_comment( $comment, $args, $depth ){
	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
	<<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
	
    <?php if ( 'div' != $args['style'] ) : ?>
    <div id="div-comment-<?php comment_ID() ?>" class="comment-body" itemscope itemtype="https://schema.org/UserComments">
	<?php endif; ?>
    	
        <footer class="comment-meta">
            <div class="comment-author vcard">
               <?php echo '<b class="fn" itemprop="creator" itemscope itemtype="https://schema.org/Person">'.get_comment_author_link().'</b>'; ?>
        	</div><!-- .comment-author vcard -->
            
            <div class="comment-metadata commentmetadata">
                <a href="<?php echo esc_url( htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ); ?>">
                    <time itemprop="commentTime" datetime="<?php echo esc_attr( get_gmt_from_date( get_comment_date() . get_comment_time(), 'Y-m-d H:i:s' ) ); ?>"><?php printf( esc_html__( '%1$s at %2$s', 'schema' ), get_comment_date(),  get_comment_time() ); ?></time>
                </a>
            </div>
            <?php if ( $comment->comment_approved == '0' ) : ?>
                <p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'schema' ); ?></p>
                <br />
            <?php endif; ?>
            <div class="reply">
                <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
            </div>
        </footer>
        
        <div class="comment-content">           
            <p class="comment-content" itemprop="commentText"><?php comment_text(); ?></p>        
        </div><!-- .text-holder -->
        
	   <?php if ( 'div' != $args['style'] ) : ?>
    </div><!-- .comment-body -->
	<?php endif; ?>
    
<?php
}
endif;

function schema_social_array(){

	$schema_user_social_array = array(
	    'behance'			=> esc_html__( 'Behance', 'schema' ),
	    'delicious'			=> esc_html__( 'Delicious', 'schema' ),
	    'deviantart'		=> esc_html__( 'Deviantart', 'schema' ),
	    'digg'				=> esc_html__( 'Digg', 'schema' ),
	    'dribbble'			=> esc_html__( 'Dribbble', 'schema' ),
	    'facebook'			=> esc_html__( 'Facebook', 'schema' ),
	    'flickr'			=> esc_html__( 'Flickr', 'schema' ),
	    'github'			=> esc_html__( 'Github', 'schema' ),
	    'google-plus'		=> esc_html__( 'Google+', 'schema' ),
	    'html5'				=> esc_html__( 'Html5', 'schema' ),
	    'instagram'			=> esc_html__( 'Instagram', 'schema' ),    
	    'linkedin'			=> esc_html__( 'Linkedin', 'schema' ),
	    'paypal'			=> esc_html__( 'Paypal', 'schema' ),
	    'pinterest'			=> esc_html__( 'Pinterest', 'schema' ),
	    'reddit'			=> esc_html__( 'Reddit', 'schema' ),
	    'rss'				=> esc_html__( 'RSS', 'schema' ),
	    'share'				=> esc_html__( 'Share', 'schema' ),
	    'skype'				=> esc_html__( 'Skype', 'schema' ),
	    'soundcloud'		=> esc_html__( 'Soundcloud', 'schema' ),
	    'spotify'			=> esc_html__( 'Spotify', 'schema' ),
	    'stack-exchange'	=> esc_html__( 'Stackexchange', 'schema' ),
	    'stack-overflow'	=> esc_html__( 'Stackoverflow', 'schema' ),
	    'steam'				=> esc_html__( 	'Steam', 'schema' ),
	    'stumbleupon'		=> esc_html__( 'StumbleUpon', 'schema' ),
	    'tumblr'			=> esc_html__( 'Tumblr', 'schema' ),
	    'twitter'			=> esc_html__( 'Twitter', 'schema' ),
	    'vimeo'				=> esc_html__( 'Vimeo', 'schema' ),
	    'vk'				=> esc_html__( 'VKontakte', 'schema' ),
	    'windows'			=> esc_html__( 'Windows', 'schema' ),
	    'wordpress'			=> esc_html__( 'Woordpress', 'schema' ),
	    'yahoo'				=> esc_html__( 'Yahoo', 'schema' ),
	    'youtube'			=> esc_html__( 'Youtube', 'schema' )
	);
	return $schema_user_social_array;
}

function schema_author_meta_contact() {

    $schema_social_array = schema_social_array();
    foreach( $schema_social_array as $icon_id => $icon_name ) {
        $contactmethods[$icon_id] = $icon_name;
    }
    return $contactmethods;
}

add_filter( 'user_contactmethods', 'schema_author_meta_contact' );

/**
 * Get media attachment id from url
 */ 
if ( ! function_exists( 'schema_get_attachment_id_from_url' ) ):
    function schema_get_attachment_id_from_url( $attachment_url ) {  
        return attachment_url_to_postid( $attachment_url);
    }
endif;

$schema_user_social_array = array(
    'behance'			=> esc_html__( 'Behance', 'schema' ),
    'delicious'			=> esc_html__( 'Delicious', 'schema' ),
    'deviantart'		=> esc_html__( 'Deviantart', 'schema' ),
    'digg'				=> esc_html__( 'Digg', 'schema' ),
    'dribbble'			=> esc_html__( 'Dribbble', 'schema' ),
    'facebook'			=> esc_html__( 'Facebook', 'schema' ),
    'flickr'			=> esc_html__( 'Flickr', 'schema' ),
    'github'			=> esc_html__( 'Github', 'schema' ),
    'google-plus'		=> esc_html__( 'Google+', 'schema' ),
    'html5'				=> esc_html__( 'Html5', 'schema' ),
    'instagram'			=> esc_html__( 'Instagram', 'schema' ),    
    'linkedin'			=> esc_html__( 'Linkedin', 'schema' ),
    'paypal'			=> esc_html__( 'Paypal', 'schema' ),
    'pinterest'			=> esc_html__( 'Pinterest', 'schema' ),
    'reddit'			=> esc_html__( 'Reddit', 'schema' ),
    'rss'				=> esc_html__( 'RSS', 'schema' ),
    'share'				=> esc_html__( 'Share', 'schema' ),
    'skype'				=> esc_html__( 'Skype', 'schema' ),
    'soundcloud'		=> esc_html__( 'Soundcloud', 'schema' ),
    'spotify'			=> esc_html__( 'Spotify', 'schema' ),
    'stack-exchange'	=> esc_html__( 'Stackexchange', 'schema' ),
    'stack-overflow'	=> esc_html__( 'Stackoverflow', 'schema' ),
    'steam'				=> esc_html__( 	'Steam', 'schema' ),
    'stumbleupon'		=> esc_html__( 'StumbleUpon', 'schema' ),
    'tumblr'			=> esc_html__( 'Tumblr', 'schema' ),
    'twitter'			=> esc_html__( 'Twitter', 'schema' ),
    'vimeo'				=> esc_html__( 'Vimeo', 'schema' ),
    'vk'				=> esc_html__( 'VKontakte', 'schema' ),
    'windows'			=> esc_html__( 'Windows', 'schema' ),
    'wordpress'			=> esc_html__( 'Woordpress', 'schema' ),
    'yahoo'				=> esc_html__( 'Yahoo', 'schema' ),
    'youtube'			=> esc_html__( 'Youtube', 'schema' )
);

add_action( 'schema_author_info', 'schema_author_info_hook' );
if( ! function_exists( 'schema_author_info_hook' ) ):
    function schema_author_info_hook() {
        global $post;
        $author_id = $post->post_author;
        $author_avatar = get_avatar( $author_id, '132' );
        $author_nickname = get_the_author_meta( 'display_name' );
        $author_extra_img_url = get_the_author_meta( 'user_meta_image', $post->post_author );
        ?>
        <div class="author-profile">
			<div class="author-img">
            <?php 
                if( !empty( $author_extra_img_url ) ) {
                    $author_img_id = schema_get_attachment_id_from_url( $author_extra_img_url );
                    $author_thumb_img = wp_get_attachment_image_src( $author_img_id, 'thumbnail', true ); ?>
                    <img src="<?php echo esc_url( $author_thumb_img[0] )?>" alt="<?php the_title_attribute()?>"/>
                <?php 
                } else {
                    echo wp_kses_post($author_avatar);
                }
            ?>
			</div>
			<div class="author-content-wrap">
				<h1 class="page-title">
					<a class="author-title" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );?>"><?php echo esc_html( $author_nickname ); ?></a>
				</h1>
				<div class="author-desc">
					<?php echo get_the_author_meta( 'description' ); ?>
				</div>
				<ul class="social-list">
					<?php 
                        global $schema_user_social_array;
                        foreach( $schema_user_social_array as $icon_id => $icon_name ) {
                            $author_social_link = get_the_author_meta( $icon_id );
                            if( !empty( $author_social_link ) ) {
                    ?>
                                <li class="social-icon-wrap"><a href="<?php echo esc_url( $author_social_link )?>" target="_blank" title="<?php echo esc_attr( $icon_name )?>"><i class="fa fa-<?php echo esc_attr( $icon_id ); ?>"></i></a></li>
                    <?php            
                            }
                        }
                    ?>
				</ul>
			</div>
		</div>
	<?php 
    }
endif;

if( ! function_exists( 'schema_single_post_tags_list' ) ) :
	function schema_single_post_tags_list() {

		// Hide tag text for pages.
		if ( 'post' === get_post_type() ) {

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html__( '', 'schema' ) );
			if ( $tags_list ) {
				printf( '<span class="tags-links clearfix">' . esc_html__( '%1$s', 'schema' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}
	}
endif;

function schema_navigation(){

    $previous = get_previous_post_link(
        '<div class="nav-previous nav-holder">%link</div>',
        '<i class="fas fa-long-arrow-alt-left"></i>' . esc_html__( 'Previous Article', 'schema' ) . '',
        false,
        '',
        'category'
    );

    $next = get_next_post_link(
        '<div class="nav-next nav-holder">%link</div>',esc_html__( 'Next Article', 'schema' ) . '<i class="fas fa-long-arrow-alt-right"></i>',
        false,
        '',
        'category'
    ); 
    
    if( $previous || $next ){?>            
        <nav class="navigation posts-navigation" role="navigation">
            <h2 class="screen-reader-text"><?php esc_html_e( 'Post Navigation', 'schema' ); ?></h2>
            <div class="nav-links">
                <?php
                    if( $previous ) echo $previous;
                    if( $next ) echo $next;
                ?>
            </div>
        </nav>        
        <?php
    }
}

if( ! function_exists('schema_social_icons')){
	function schema_social_icons(){
		
		$social_icons = array('facebook','twitter','googlePlus','dribbble','youtube','linkedin');
        foreach( $social_icons as $social_icon){
            $schema_social_icons = get_theme_mod ('schema_'.$social_icon.'_url');
            if( $schema_social_icons ){
                echo '<li><a href="'. esc_url($schema_social_icons).'" target="_blank">';
                if( $social_icon == 'googlePlus' ){
                    echo '<i class ="fa fa-google-plus"></i>'; 
                }else{
                    echo '<i class ="fa fa-'. esc_attr($social_icon).'"></i>';    
                }
                echo '</a></li>';
            }
        }
    }
}

if( ! function_exists('schema_excerpt_content')):
    function schema_excerpt_content($count){
    if( empty($count)){
        return;
    }
    $permalink = get_permalink( get_the_ID() );
    $excerpt   = get_the_content();
    $excerpt   = strip_tags($excerpt);   
    $excerpt   = substr($excerpt, 0, $count);

    if($count){
        $excerpt   = '<div class="entry-footer"><p>'.$excerpt.'</p></div>'.'<a href="'.esc_url($permalink).'" class="btn-readmore">'.esc_html__("Continue Reading","schema").'</a>';
    }
    return $excerpt;
    }
endif;

if( ! function_exists( 'schema_post_cat_lists' ) ) :
	function schema_post_cat_lists() {

		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			global $post;
			$categories = get_the_category();
			$separator = ' ';
			$output = '';
			if( $categories ) {
				$output .= '<span class="cat-links">';
				foreach( $categories as $category ) {
					$output .= '<a href="'.esc_url(get_category_link( $category->term_id )).'" class="cat-' . esc_attr($category->term_id) . '" rel="category tag">'.esc_html($category->cat_name).'</a>';					
				}
				$output .='</span>';
				echo trim( $output, $separator );// WPCS: XSS OK.
			}
		}
	}
endif;

function schema_post_lists(){
    wp_reset_postdata();
    $posts = get_posts(array('posts_per_page'   => -1));
    $post_lists = array();
    $post_lists[] = __('Select post', 'schema'); 
    foreach($posts as $post) :
        $post_lists[$post->ID] = $post->post_title;
    endforeach;
    return $post_lists;
}

function sakala_font_icons_array(){
   $jk_icon_list_raw = 'fa-glass, fa-music, fa-search, fa-envelope-o, fa-heart, fa-star, fa-star-o, fa-user, fa-film, fa-th-large, fa-th, fa-th-list, fa-check, fa-times, fa-search-plus, fa-search-minus, fa-power-off, fa-signal, fa-cog, fa-trash-o, fa-home, fa-file-o, fa-clock-o, fa-road, fa-download, fa-arrow-circle-o-down, fa-arrow-circle-o-up, fa-inbox, fa-play-circle-o, fa-repeat, fa-refresh, fa-list-alt, fa-lock, fa-flag, fa-headphones, fa-volume-off, fa-volume-down, fa-volume-up, fa-qrcode, fa-barcode, fa-tag, fa-tags, fa-book, fa-bookmark, fa-print, fa-camera, fa-font, fa-bold, fa-italic, fa-text-height, fa-text-width, fa-align-left, fa-align-center, fa-align-right, fa-align-justify, fa-list, fa-outdent, fa-indent, fa-video-camera, fa-picture-o, fa-pencil, fa-map-marker, fa-adjust, fa-tint, fa-pencil-square-o, fa-share-square-o, fa-check-square-o, fa-arrows, fa-step-backward, fa-fast-backward, fa-backward, fa-play, fa-pause, fa-stop, fa-forward, fa-fast-forward, fa-step-forward, fa-eject, fa-chevron-left, fa-chevron-right, fa-plus-circle, fa-minus-circle, fa-times-circle, fa-check-circle, fa-question-circle, fa-info-circle, fa-crosshairs, fa-times-circle-o, fa-check-circle-o, fa-ban, fa-arrow-left, fa-arrow-right, fa-arrow-up, fa-arrow-down, fa-share, fa-expand, fa-compress, fa-plus, fa-minus, fa-asterisk, fa-exclamation-circle, fa-gift, fa-leaf, fa-fire, fa-eye, fa-eye-slash, fa-exclamation-triangle, fa-plane, fa-calendar, fa-random, fa-comment, fa-magnet, fa-chevron-up, fa-chevron-down, fa-retweet, fa-shopping-cart, fa-folder, fa-folder-open, fa-arrows-v, fa-arrows-h, fa-bar-chart, fa-twitter-square, fa-facebook-square, fa-camera-retro, fa-key, fa-cogs, fa-comments, fa-thumbs-o-up, fa-thumbs-o-down, fa-star-half, fa-heart-o, fa-sign-out, fa-linkedin-square, fa-thumb-tack, fa-external-link, fa-sign-in, fa-trophy, fa-github-square, fa-upload, fa-lemon-o, fa-phone, fa-square-o, fa-bookmark-o, fa-phone-square, fa-twitter, fa-facebook, fa-github, fa-unlock, fa-credit-card, fa-rss, fa-hdd-o, fa-bullhorn, fa-bell, fa-certificate, fa-hand-o-right, fa-hand-o-left, fa-hand-o-up, fa-hand-o-down, fa-arrow-circle-left, fa-arrow-circle-right, fa-arrow-circle-up, fa-arrow-circle-down, fa-globe, fa-wrench, fa-tasks, fa-filter, fa-briefcase, fa-arrows-alt, fa-users, fa-link, fa-cloud, fa-flask, fa-scissors, fa-files-o, fa-paperclip, fa-floppy-o, fa-square, fa-bars, fa-list-ul, fa-list-ol, fa-strikethrough, fa-underline, fa-table, fa-magic, fa-truck, fa-pinterest, fa-pinterest-square, fa-google-plus-square, fa-google-plus, fa-money, fa-caret-down, fa-caret-up, fa-caret-left, fa-caret-right, fa-columns, fa-sort, fa-sort-desc, fa-sort-asc, fa-envelope, fa-linkedin, fa-undo, fa-gavel, fa-tachometer, fa-comment-o, fa-comments-o, fa-bolt, fa-sitemap, fa-umbrella, fa-clipboard, fa-lightbulb-o, fa-exchange, fa-cloud-download, fa-cloud-upload, fa-user-md, fa-stethoscope, fa-suitcase, fa-bell-o, fa-coffee, fa-cutlery, fa-file-text-o, fa-building-o, fa-hospital-o, fa-ambulance, fa-medkit, fa-fighter-jet, fa-beer, fa-h-square, fa-plus-square, fa-angle-double-left, fa-angle-double-right, fa-angle-double-up, fa-angle-double-down, fa-angle-left, fa-angle-right, fa-angle-up, fa-angle-down, fa-desktop, fa-laptop, fa-tablet, fa-mobile, fa-circle-o, fa-quote-left, fa-quote-right, fa-spinner, fa-circle, fa-reply, fa-github-alt, fa-folder-o, fa-folder-open-o, fa-smile-o, fa-frown-o, fa-meh-o, fa-gamepad, fa-keyboard-o, fa-flag-o, fa-flag-checkered, fa-terminal, fa-code, fa-reply-all, fa-star-half-o, fa-location-arrow, fa-crop, fa-code-fork, fa-chain-broken, fa-question, fa-info, fa-exclamation, fa-superscript, fa-subscript, fa-eraser, fa-puzzle-piece, fa-microphone, fa-microphone-slash, fa-shield, fa-calendar-o, fa-fire-extinguisher, fa-rocket, fa-maxcdn, fa-chevron-circle-left, fa-chevron-circle-right, fa-chevron-circle-up, fa-chevron-circle-down, fa-html5, fa-css3, fa-anchor, fa-unlock-alt, fa-bullseye, fa-ellipsis-h, fa-ellipsis-v, fa-rss-square, fa-play-circle, fa-ticket, fa-minus-square, fa-minus-square-o, fa-level-up, fa-level-down, fa-check-square, fa-pencil-square, fa-external-link-square, fa-share-square, fa-compass, fa-caret-square-o-down, fa-caret-square-o-up, fa-caret-square-o-right, fa-eur, fa-gbp, fa-usd, fa-inr, fa-jpy, fa-rub, fa-krw, fa-btc, fa-file, fa-file-text, fa-sort-alpha-asc, fa-sort-alpha-desc, fa-sort-amount-asc, fa-sort-amount-desc, fa-sort-numeric-asc, fa-sort-numeric-desc, fa-thumbs-up, fa-thumbs-down, fa-youtube-square, fa-youtube, fa-xing, fa-xing-square, fa-youtube-play, fa-dropbox, fa-stack-overflow, fa-instagram, fa-flickr, fa-adn, fa-bitbucket, fa-bitbucket-square, fa-tumblr, fa-tumblr-square, fa-long-arrow-down, fa-long-arrow-up, fa-long-arrow-left, fa-long-arrow-right, fa-apple, fa-windows, fa-android, fa-linux, fa-dribbble, fa-skype, fa-foursquare, fa-trello, fa-female, fa-male, fa-gratipay, fa-sun-o, fa-moon-o, fa-archive, fa-bug, fa-vk, fa-weibo, fa-renren, fa-pagelines, fa-stack-exchange, fa-arrow-circle-o-right, fa-arrow-circle-o-left, fa-caret-square-o-left, fa-dot-circle-o, fa-wheelchair, fa-vimeo-square, fa-try, fa-plus-square-o, fa-space-shuttle, fa-slack, fa-envelope-square, fa-wordpress, fa-openid, fa-university, fa-graduation-cap, fa-yahoo, fa-google, fa-reddit, fa-reddit-square, fa-stumbleupon-circle, fa-stumbleupon, fa-delicious, fa-digg, fa-pied-piper-pp, fa-pied-piper-alt, fa-drupal, fa-joomla, fa-language, fa-fax, fa-building, fa-child, fa-paw, fa-spoon, fa-cube, fa-cubes, fa-behance, fa-behance-square, fa-steam, fa-steam-square, fa-recycle, fa-car, fa-taxi, fa-tree, fa-spotify, fa-deviantart, fa-soundcloud, fa-database, fa-file-pdf-o, fa-file-word-o, fa-file-excel-o, fa-file-powerpoint-o, fa-file-image-o, fa-file-archive-o, fa-file-audio-o, fa-file-video-o, fa-file-code-o, fa-vine, fa-codepen, fa-jsfiddle, fa-life-ring, fa-circle-o-notch, fa-rebel, fa-empire, fa-git-square, fa-git, fa-hacker-news, fa-tencent-weibo, fa-qq, fa-weixin, fa-paper-plane, fa-paper-plane-o, fa-history, fa-circle-thin, fa-header, fa-paragraph, fa-sliders, fa-share-alt, fa-share-alt-square, fa-bomb, fa-futbol-o, fa-tty, fa-binoculars, fa-plug, fa-slideshare, fa-twitch, fa-yelp, fa-newspaper-o, fa-wifi, fa-calculator, fa-paypal, fa-google-wallet, fa-cc-visa, fa-cc-mastercard, fa-cc-discover, fa-cc-amex, fa-cc-paypal, fa-cc-stripe, fa-bell-slash, fa-bell-slash-o, fa-trash, fa-copyright, fa-at, fa-eyedropper, fa-paint-brush, fa-birthday-cake, fa-area-chart, fa-pie-chart, fa-line-chart, fa-lastfm, fa-lastfm-square, fa-toggle-off, fa-toggle-on, fa-bicycle, fa-bus, fa-ioxhost, fa-angellist, fa-cc, fa-ils, fa-meanpath, fa-buysellads, fa-connectdevelop, fa-dashcube, fa-forumbee, fa-leanpub, fa-sellsy, fa-shirtsinbulk, fa-simplybuilt, fa-skyatlas, fa-cart-plus, fa-cart-arrow-down, fa-diamond, fa-ship, fa-user-secret, fa-motorcycle, fa-street-view, fa-heartbeat, fa-venus, fa-mars, fa-mercury, fa-transgender, fa-transgender-alt, fa-venus-double, fa-mars-double, fa-venus-mars, fa-mars-stroke, fa-mars-stroke-v, fa-mars-stroke-h, fa-neuter, fa-genderless, fa-facebook-official, fa-pinterest-p, fa-whatsapp, fa-server, fa-user-plus, fa-user-times, fa-bed, fa-viacoin, fa-train, fa-subway, fa-medium, fa-y-combinator, fa-optin-monster, fa-opencart, fa-expeditedssl, fa-battery-full, fa-battery-three-quarters, fa-battery-half, fa-battery-quarter, fa-battery-empty, fa-mouse-pointer, fa-i-cursor, fa-object-group, fa-object-ungroup, fa-sticky-note, fa-sticky-note-o, fa-cc-jcb, fa-cc-diners-club, fa-clone, fa-balance-scale, fa-hourglass-o, fa-hourglass-start, fa-hourglass-half, fa-hourglass-end, fa-hourglass, fa-hand-rock-o, fa-hand-paper-o, fa-hand-scissors-o, fa-hand-lizard-o, fa-hand-spock-o, fa-hand-pointer-o, fa-hand-peace-o, fa-trademark, fa-registered, fa-creative-commons, fa-gg, fa-gg-circle, fa-tripadvisor, fa-odnoklassniki, fa-odnoklassniki-square, fa-get-pocket, fa-wikipedia-w, fa-safari, fa-chrome, fa-firefox, fa-opera, fa-internet-explorer, fa-television, fa-contao, fa-500px, fa-amazon, fa-calendar-plus-o, fa-calendar-minus-o, fa-calendar-times-o, fa-calendar-check-o, fa-industry, fa-map-pin, fa-map-signs, fa-map-o, fa-map, fa-commenting, fa-commenting-o, fa-houzz, fa-vimeo, fa-black-tie, fa-fonticons, fa-reddit-alien, fa-edge, fa-credit-card-alt, fa-codiepie, fa-modx, fa-fort-awesome, fa-usb, fa-product-hunt, fa-mixcloud, fa-scribd, fa-pause-circle, fa-pause-circle-o, fa-stop-circle, fa-stop-circle-o, fa-shopping-bag, fa-shopping-basket, fa-hashtag, fa-bluetooth, fa-bluetooth-b, fa-percent, fa-gitlab, fa-wpbeginner, fa-wpforms, fa-envira, fa-universal-access, fa-wheelchair-alt, fa-question-circle-o, fa-blind, fa-audio-description, fa-volume-control-phone, fa-braille, fa-assistive-listening-systems, fa-american-sign-language-interpreting, fa-deaf, fa-glide, fa-glide-g, fa-sign-language, fa-low-vision, fa-viadeo, fa-viadeo-square, fa-snapchat, fa-snapchat-ghost, fa-snapchat-square, fa-pied-piper, fa-first-order, fa-yoast, fa-themeisle, fa-google-plus-official, fa-font-awesome' ;
   $jk_icon_list = explode( ", " , $jk_icon_list_raw);
   return $jk_icon_list;
}

if ( !function_exists( 'schema_social_share' ) ) {

    function schema_social_share() {
        global $post;
        
        $post_url = get_permalink();

        // Get current page title
        $post_title = str_replace( ' ', '%20', get_the_title() );

        // Get Post Thumbnail for pinterest
        $post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );

        // Construct sharing URL
        $twitterURL = 'https://twitter.com/intent/tweet?text=' . esc_html($post_title) . '&amp;url=' . esc_url($post_url);
        $facebookURL = 'https://www.facebook.com/sharer/sharer.php?u=' . esc_url($post_url);
        $googleURL = 'https://plus.google.com/share?url=' . esc_url($post_url);
        $pinterestURL = 'https://pinterest.com/pin/create/button/?url=' . esc_url($post_url) . '&amp;media=' . $post_thumbnail[ 0 ] . '&amp;description=' . esc_html($post_title);
        $linkedinURL = 'https://stumbleupon.com/shareArticle?mini=true&amp;url=' . esc_url($post_url) . '&amp;title=' . esc_html($post_title);

        $content = '<ul class="social-list">';
        $content .= '<li><a class="facebook-share" target="_blank" href="' . esc_url($facebookURL) . '"><i class="fa fa-facebook" aria-hidden="true"></i><span class="screen-reader-text">' . esc_html__( 'Facebook', 'schema' ) . '</span></a></li>';
        $content .= '<li><a class="twitter-share" target="_blank" href="' . esc_url($twitterURL) . '"><i class="fa fa-twitter" aria-hidden="true"></i><span class="screen-reader-text">' . esc_html__( 'Twitter', 'schema' ) . '</span></a></li>';
        $content .= '<li><a class="googleplus-share" target="_blank" href="' . esc_url($googleURL) . '"><i class="fa fa-google-plus" aria-hidden="true"></i><span class="screen-reader-text">' . esc_html__( 'Google +', 'schema' ) . '</span></a></li>';
        $content .= '<li><a class="linkedin-share" target="_blank" href="' . esc_url($linkedinURL) . '"><i class="fa fa-linkedin" aria-hidden="true"></i><span class="screen-reader-text">' . esc_html__( 'LinkedIn', 'schema' ) . '</span></a></li>';
        
        $content .= '<li><a class="pinterest-share" target="_blank" href="' . esc_url($pinterestURL) . '"><i class="fa fa-pinterest-p" aria-hidden="true"></i><span class="screen-reader-text">' . esc_html__( 'Pinterest', 'schema' ) . '</span></a></li>';
        
        $content .= '</ul>';

        echo $content; // WPCS: XSS OK.
    }

}

/**
 * Set Post view count
 *
 * @since 1.0.0
 */
function schema_setPostViews( $postID ) {
    $count_key = 'schema_post_views_count';
    $count = get_post_meta( $postID, $count_key, true );
    if( $count == '' ){
        $count = 0;
        delete_post_meta( $postID, $count_key );
        add_post_meta( $postID, $count_key, '0' );
    }else{
        $count++;
        update_post_meta( $postID, $count_key, $count );
    }
}

/**
 * Get Post view count
 *
 * @since 1.0.0
 */
function schema_getPostViews( $postID ){
    $count_key = 'schema_post_views_count';
    $count = get_post_meta( $postID, $count_key, true) ;
    if( $count == '' ){
        delete_post_meta( $postID, $count_key );
        add_post_meta( $postID, $count_key, '0' );
        return '0';
    }
    return $count;
}

function schema_post_views() {
	$post_view_count = schema_getPostViews( get_the_ID() );
	echo '<span class="fav-count">'. absint($post_view_count) .'</span>';
	echo '<a><i class="fa fa-heart"></i></a>';
}