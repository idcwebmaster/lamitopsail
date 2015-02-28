<?php get_header(); ?>

	<!-- MAIN CONTENT -->
	<div id="main">
		
		<section> 
		
		<div class="container">		

			<div class="row">		
		
		<!-- Posts -->

			<div class="main-articles <?php 
						if (isset($smof_data['layout']) && $smof_data['layout'] == 'left-sidebar') { echo 'span9 right';
						} else { echo 'span9';}
					?>"> 
		
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
					
				</div>
				
				<aside class="span3 main-sidebar">
		
					<?php get_sidebar('main-sidebar'); ?>

				</aside>
				
			</div>
					
		</div>
		
		</section>
		
	</div> <!-- end main -->
	
	

<?php get_footer(); ?>