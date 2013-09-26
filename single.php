<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Lucid
 */

get_header(); 
global $post;
?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>

					
			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() )
					comments_template();
			?>

		<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->


		<div class="also-read">

			<div class="site-content">
				
				<h4 id='also-read-title'>Also read...</h4>
				<ul id='also-read-items'>
				<?php $recent_posts = wp_get_recent_posts(array('numberposts'=> 5, 'exclude' => $post->ID, 'post_status' => 'publish')); ?>
				<?php foreach ($recent_posts as $key => $recent): ?>
					<li>
						<a href="<?php echo get_permalink($recent["ID"]) ?>" title="Look <?php echo esc_attr($recent["post_title"]) ?>" >
							<span class="date"><?php echo date('F j, Y' ,strtotime($recent["post_date"])) ?></span>
							<span class="title"><?php echo $recent["post_title"] ?></span>
						</a> 
					</li>
				<?php endforeach; ?>
				</ul>
			</div>
		</div>

	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>