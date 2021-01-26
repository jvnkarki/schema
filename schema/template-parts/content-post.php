<?php
/**
 * Template part for displaying single post 
 *
 */
$single_image = wp_get_attachment_image_src(get_post_thumbnail_id(),'full');
?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="page-header" style="background-image: url(<?php echo esc_url($single_image[0]); ?>);">
		<div class="container">
			<h1 class="page-title"><?php the_title(); ?></h1>
		</div>
	</header>
	<div class="container">
		<div id="primary" class="content-area sticky-meta">
			<main id="main" class="site-main">
				<div class="entry-meta">
					<div class="sticky-inner">
						<div class="sidebar__inner">
							<span class="byline" itemprop="author">
								<span class="meta-title"><?php echo esc_html_e('Written By','schema'); ?></span>

								<span class="author">
									<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );?>" class="url fn" itemprop="name"><?php echo get_the_author(); ?></a>
								</span>
							</span>
							<span class="posted-on" itemprop="datePublished">
								<span class="meta-title"><?php echo esc_html_e('Published on','schema'); ?></span>
								<a href="#">
									<time datetime="2017-12-21"><?php echo esc_html(get_the_date()); ?></time>
								</a>
							</span>
							<span class="category">
								<span class="meta-title"><?php echo esc_html_e('Category','schema') ?></span>
								 <?php schema_post_cat_lists(); ?>
							</span>
							<div class="sticky-social">
								<div class="post-favourite">
									<?php echo schema_post_views(); ?>
								</div>
								<?php 
								echo schema_social_share(); ?>
							</div>
						</div>
					</div>
				</div>
				<div class="entry-content">
					<?php the_content(); ?>
					
				</div>
				<footer class="entry-footer">
					<div class="tags">
						<?php echo esc_html_e('Tags:','schema') ?>
						<?php schema_single_post_tags_list();?>
					</div>
				</footer>
			</main> <!-- .site-main -->
			<?php do_action( 'schema_author_info' ); ?>
			<nav class="navigation posts-navigation">
				<div class="nav-links">
					<?php schema_navigation(); ?>
				</div>
			</nav>
			<div class="additional-posts">
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
						</div>
					
						<?php 
						endwhile;
						wp_reset_postdata();
					endif; ?>
				</div><!-- .block-wrap -->
			</div>
			
		</div> <!-- #primary -->
		<?php 
		$single_post = get_theme_mod('schema_post_layout','normal');
    	if($single_post == 'left'){ ?>
		<aside id="secondary" class="widget-area">
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</aside> <!-- #secondary -->
		<?php } ?>
	</div> <!-- .container -->
</div> <!-- .site-content -->
	
	

</article>

<?php		
