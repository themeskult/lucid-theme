<?php
/**
 * @package Lucid
 */
?>

<article id="post-<?php the_ID(); ?>" class="post-small">


	<header class="entry-header">

		<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php lucid_posted_on(); ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'lucid' ) );
				if ( $categories_list && lucid_categorized_blog() ) :
			?>
			<span class="cat-links">
				<?php printf( __( 'in %1$s', 'lucid' ), $categories_list ); ?>
			</span>
			<?php endif; // End if categories ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="content-post">
		<a href="<?php echo the_permalink() ?>">
			<p>
				<?php echo am_get_content(160) ?>
			</p>
		</a>
	</div>

</article><!-- #post-## -->