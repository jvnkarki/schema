<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Schema
 */

get_header();
?>
<div id="content" class="site-content">
	<div class="container">
		<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'archive' );

			endwhile;

			//the_posts_navigation();
			the_posts_pagination( array(
				'mid_size'  => 2,
				'prev_text' => __( 'Prev', 'schema' ),
				'next_text' => __( 'Next', 'schema' ),
			) ); 

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
		</main>
	</div>
		<?php get_sidebar(); ?>
</div>
		</div><!-- #main -->

<?php
get_footer();
