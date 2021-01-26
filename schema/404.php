<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Schema
 */

get_header();
?>

	<div id="content" class="site-content">			
			<div class="container">
				<div id="primary" class="content-area">
					<main id="main" class="site-main">
						<section class="error-404 not-found">
							<header class="page-header">
								<h1 class="page-title"><?php echo esc_html_e('Uh-Oh...','schema'); ?></h1>
								<div class="page-desc">
									<?php echo esc_html_e('The page you are looking for may have been moved, deleted, or possibly never existed.','schema'); ?>
								</div>
							</header>
							<div class="page-content">
								<div class="error-num">404</div>
								<a class="bttn" href="<?php echo esc_url( home_url('/') );?>"><?php echo esc_html_e('Take me to the home page','schema'); ?></a>
								<?php get_search_form(); ?>			
							</div><!-- .page-content -->
						</section>
					</main> <!-- .site-main -->
				</div> <!-- #primary -->
			</div> <!-- .container -->
			<div class="additional-posts">
				<div class="container">
					<h3 class="title">
					<?php echo esc_html_e('Recommended Articles','schema'); ?>
					</h3>
                    <div class="block-wrap">
					<?php
					$args = array(
                        'post_type'           => 'post',
                        'posts_status'        => 'publish',
                        'posts_per_page'	  => 3
                    );
                            
                    $query = new WP_Query( $args );
                    if( $query->have_posts() ) :
                        while( $query->have_posts() ) : $query->the_post();
                        $blog_ig = wp_get_attachment_image_src(get_post_thumbnail_id(),'full'); ?>
						<div class="block clearfix">
							<div class="entry-meta">
								<span class="posted-on" itemprop="datePublished">
									<a href="#">
										<time datetime="2017-12-21"><?php echo esc_html(get_the_date()); ?></time>
									</a>
								</span>
							</div>
							<header class="entry-header">
								<h3 class="entry-title">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h3>                        
							</header><!-- .entry-header -->
							<figure class="post-thumbnail">
								<a href="#">
									<img src="<?php echo esc_url($blog_ig[0]) ?>" alt="">
								</a>
							</figure><!-- .post-thumbnail -->
						</div>
					
						<?php 
						endwhile;
						wp_reset_postdata();
					endif; ?>
					</div><!-- .block-wrap -->			
					
				</div>
			</div>
		</div> <!-- .site-content -->

<?php
get_footer();
