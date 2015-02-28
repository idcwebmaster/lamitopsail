<?php 
/*
 Template Name: News page
*/
?>
<?php get_header(); ?>

	<!-- MAIN CONTENT -->
	<div id="main">
		
		<section> 
		
		<div class="container">
		
		<!-- Posts -->
			
			<div class="row">
						
					<?php echo do_shortcode('[recent_posts type="news" exclude="12" meta="true" thumb="true" excerpt_count="45"]'); ?>
			
			</div>

		</div>
		
		</section>
		
	</div> <!-- end main -->
	
	

<?php get_footer(); ?>