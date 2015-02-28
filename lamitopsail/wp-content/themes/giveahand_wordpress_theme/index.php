<?php get_header(); global $smof_data; ?>

	<!-- MAIN CONTENT -->
	<div id="main">
		
		<section> 
		
			<div class="container">				
				
			<!-- Posts -->
				
				<div class="row">
			
					<div class="main-articles <?php 
						if(isset($smof_data['layout']) && $smof_data['layout'] == 'fullwidth') { echo 'span12';
						} elseif (isset($smof_data['layout']) && $smof_data['layout'] == 'left-sidebar') { echo 'span9 right';
						} else { echo 'span9';}
					?>"> 
							
							<?php if (have_posts()) : while(have_posts()) : the_post(); ?>
							
								<?php get_template_part('content', get_post_format()); ?>
																	
							<?php  endwhile; else : ?>
							
								<h3><?php _e('No posts were found.', 'framework'); ?></h3>

							<?php endif; ?>
						
						<div class="articles-nav clearfix">
						
							<?php next_posts_link('&laquo;'); ?>

							<?php previous_posts_link('&raquo;'); ?>
							
						</div> <!-- end articles-nav -->
						
					</div>
					
				<?php if(isset($smof_data['layout']) && $smof_data['layout'] != 'fullwidth' || ! isset($smof_data['layout'])) { ?>
				
					<aside class="span3 main-sidebar">
						
						<?php get_sidebar(); ?>

					</aside>
					
				<?php } ?>
				
				</div>

			</div>
		
		</section>

	</div> <!-- end main -->

<?php get_footer(); ?>
