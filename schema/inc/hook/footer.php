<?php  
/**
* Footer
*
* 
*/
add_action( 'schema_footer', 'schema_footer_widgets', 0 );

if ( ! function_exists( 'schema_footer_widgets' ) ) {
    /**
     * Display the theme footer widgets
     * @since  1.0.0
     * @return void
     */
    function schema_footer_widgets() {
        if ( is_active_sidebar( 'footer-3' ) ) {
            $widget_columns = apply_filters( 'schema_footer_widget_regions', 3 );
        } elseif ( is_active_sidebar( 'footer-2' ) ) {
            $widget_columns = apply_filters( 'schema_footer_widget_regions', 2 );
        }elseif ( is_active_sidebar( 'footer-1' ) ) {
            $widget_columns = apply_filters( 'schema_footer_widget_regions', 1 );
        } else {
            $widget_columns = apply_filters( 'schema_footer_widget_regions', 0 );
        }

        if ( $widget_columns > 0 ) : ?>

        <div class="top-footer col-<?php echo intval( $widget_columns ); ?>">
                <div class="container">
                    <?php $i = 0; while ( $i < $widget_columns ) : $i++; ?>     
                    <?php if ( is_active_sidebar( 'footer-' . $i ) ) : ?>       
                         <div class="col">
                            <section class="widget widget_text">
                               <div class="block footer-widget-<?php echo intval( $i ); ?>">
                                    <?php dynamic_sidebar( 'footer-' . intval( $i ) ); ?>
                                </div>
                            </section>
                        </div>      
                    <?php endif; ?>     
                    <?php endwhile; ?>
                </div>
            </div> <!-- .top-footer -->
<?php endif;
}
}

function schema_footer_copyright_fn() {
    $schema_footer_copyright = get_theme_mod('schema_footer_copyright');
    ?>
    <div class="bottom-footer">
        <div class="container">
            <div class="copyright">            
                <?php 
                if($schema_footer_copyright) { ?>
                    <span class="footer_text"> <?php echo esc_html($schema_footer_copyright); ?> </span>
                <?php }
                else{
                    printf(wp_kses_post('&copy; %1$s %2$s'), esc_html(date("Y")), esc_html(get_bloginfo('name')));
                } ?>
                <?php esc_html_e(' | WordPress Theme :','schema');?>
                <?php 
                $theme = wp_get_theme();

                 ?>
                <a target="_blank" href="#"><?php echo esc_html($theme->Name); ?></a>          
            </div>
            <div class="footer-social">
                <ul class="social-list">
                    <?php echo schema_social_icons(); ?>
                </ul>
            </div>
        </div>
    </div>

<?php 

}
add_action('schema_footer_copyright_fn','schema_footer_copyright_fn');
