<?php 
/*
 Template Name: Full width page
*/
?>
<?php get_header(); ?>

	<!-- MAIN CONTENT -->
	<div id="main">
		
		<section> 
		
		<div class="container">
		
		<!-- Posts -->
			
			<div class="row">
			
					<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

								<?php the_content(); ?>
					
					<?php endwhile; else : ?>
					
						<article class="no-posts">
						
						<div class="article-main">

							<h3><?php _e('No posts were found.', 'framework'); ?></h3>
							
						</div>
							
						</article>
						
					<?php endif; ?>
			
			</div>

		</div>
		
		</section>
		
	</div> <!-- end main -->
	
	

<?php get_footer(); ?>