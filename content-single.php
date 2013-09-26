<?php
/**
 * @package Lucid
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>

		<div class="entry-meta">
			<?php lucid_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'lucid' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer>
		<a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo the_permalink() ?>" class='symbol social-button facebook'></a>
		<a target="_blank" href="https://twitter.com/intent/tweet?url=<?php echo the_permalink() ?>" class='symbol social-button twitter '></a>
	</footer>
</article><!-- #post-## -->
