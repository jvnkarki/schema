<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Schema
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<figure class="post-thumbnail">
	<?php the_post_thumbnail(); ?>
	</figure>
	<div class="post-content-wrap">
		<header class="entry-header">
			<div class="entry-meta">
				<span class="posted-on" itemprop="datePublished">
					<a href="#">
						<time datetime="2017-12-21"><?php echo esc_html(get_the_date()); ?></time>
					</a>
				</span>
				<span class="category">
					<?php schema_post_cat_lists(); ?>
				</span>
			</div>
			<h2 class="entry-title" itemprop="headline">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h2>
		</header>
		<?php echo schema_excerpt_content('100'); ?>
	</div>
</article>

