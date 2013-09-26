<?php
get_header(); 
?>
<div class="main-post">
	<h5 class="column-title">Featured</h5>

	<div class="slides">
	<?php if ( have_posts() ) : ?>

		<?php 
		$sticky = get_option( 'sticky_posts' );
		$catquery = new WP_Query( 'p=' . $sticky[0] );
		?>

		<?php /* Start the Loop */ ?>
		<?php while ( $catquery->have_posts() ) : $catquery->the_post(); ?>
			<?php global $post ?>
			<article id="post-<?php the_ID(); ?>" >

				<header class="entry-header">
					<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

					<?php if ( 'post' == get_post_type() ) : ?>
					<div class="entry-meta">
						<?php lucid_posted_on(); ?>
					</div><!-- .entry-meta -->
					<?php endif; ?>
				</header><!-- .entry-header -->

				<?php if ( has_post_thumbnail() ):?>
					
					<a href="<?php echo the_permalink() ?>" class="thumbnail-permalink"><?php the_post_thumbnail('featured-post'); ?></a>
				 
				<?php endif; ?>

				<div class="entry-content">
					<a href="<?php echo the_permalink() ?>">
						<?php echo am_get_content(140) ?>
					</a>
				</div>

			</article><!-- #post-## -->

		<?php endwhile; ?>

	<?php endif; ?>
	</div>
	<!-- .slides -->
</div>

<div id="primary" class="post-list" role="main">
	<h5 class="column-title">FROM BLOG</h5>
	<?php if ( have_posts() ) : ?>

		<?php wp_reset_query(); ?>

		<?php 
		$sticky = get_option( 'sticky_posts' );

		$args = array(
			'ignore_sticky_posts' => 1,
			'post__not_in' => $sticky,
			'paged' => $paged
		);
		$cq = new WP_Query($args);
		?>
		<?php while ( $cq->have_posts() ) : $cq->the_post(); ?>

			<?php get_template_part( 'content', 'small'); ?>

		<?php endwhile; ?>

		<?php lucid_content_nav( 'nav-below' ); ?>

	<?php else : ?>

		<?php get_template_part( 'no-results', 'index' ); ?>

	<?php endif; ?>
</div><!-- .post-list -->

<?php get_footer(); ?>