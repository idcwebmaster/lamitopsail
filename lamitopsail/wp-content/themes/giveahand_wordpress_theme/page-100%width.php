<?php 
/*
 Template Name: 100% width page
*/
?>
<?php get_header(); ?>

	<!-- MAIN CONTENT -->
	<div id="main">		
		
		<!-- Posts -->

				<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

								<?php the_content(); ?>

						<div>
							
							<?php 
								$args = array (
									'before' => '<p class="post-navigation">',
									'after' => '</p>',
									'pagelink' => 'Page %'
							); ?>
							
							<?php wp_link_pages($args); ?>
							
						</div> <!-- end post-navigation -->
					
					<?php endwhile; else : ?>
					
						<article class="no-posts">
						
							<div class="article-main">

								<h3><?php _e('No posts were found.', 'framework'); ?></h3>
								
							</div>
							
						</article>
						
					<?php endif; ?>
		
	</div> <!-- end main -->

<?php get_footer(); ?>