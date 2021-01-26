<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package schema
 */

get_header(); 
    do_action('schema_banner_main_fn');
    do_action('schema_about_main_fn');
    do_action('schema_client_main_fn');
    do_action('schema_features_main_fn');
    $blog_enable = get_theme_mod('schema_blog_enable','hide');
    $blog_title = get_theme_mod('schema_blog_title', __( 'Read our blog to sharpen your business and SEO skills.', 'schema' ) );
    $blog_desc = get_theme_mod('schema_blog_description', __( 'Get evidence-based collection of articles on a topic sent directly to you in one email.', 'schema' ) );
    if($blog_enable == 'show'){
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
        		<?php if ( have_posts() ) : 
                ?>
        			<?php /* Start the Loop */ ?>
        			<?php while ( have_posts() ) : the_post(); ?>
        				<?php
        					/*
        					 * Include the Post-Format-specific template for the content.
        					 * If you want to override this in a child theme, then include a file
        					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
        					 */
        					get_template_part( 'template-parts/content-archive', );
        				?>
        			<?php endwhile; ?>
        			<?php the_posts_pagination(); ?>
        		<?php else : ?>
        			<?php get_template_part( 'template-parts/content', 'none' );
                    wp_reset_postdata(); ?>
        		<?php endif; ?>

		    </main><!-- #main -->
	   </div><!-- #primary -->
        <aside id="secondary" class="widget-area">
        <?php dynamic_sidebar( 'sidebar-1' ); ?>
        </aside> <!-- #secondary -->
</div>

<?php
?>
</div>
<?php } ?>
<?php do_action('schema_support_main_fn'); ?>
<?php get_footer();


