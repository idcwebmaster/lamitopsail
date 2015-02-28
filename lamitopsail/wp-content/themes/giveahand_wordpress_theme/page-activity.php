<?php 
/*
 Template Name: Activity page
*/
?>
<?php get_header(); ?>

	<!-- MAIN CONTENT -->
	<div id="main">
		
		<section> 
		
		<div class="container">
		
		<!-- Posts -->
			
			<div class="row">
					<?php echo do_shortcode('[activity view="wide"]'); ?>
			
			</div>

		</div>
		
		</section>
		
	</div> <!-- end main -->
	
	

<?php get_footer(); ?>