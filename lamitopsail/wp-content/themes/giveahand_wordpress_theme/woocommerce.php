<?php get_header(); ?>

	<!-- MAIN CONTENT -->
	<div id="main">
		
		<section> 
		
		<div class="container">			

			<div class="row">
			
				<div class="main-articles span9"> 
						
					<?php woocommerce_content(); ?>
					
				</div>
					
				<aside class="span3 main-sidebar">
		
					<?php get_sidebar('woocommerce'); ?>

				</aside>
				
				</div>

			</div>

		</div>
		
		</section>
		
	</div> <!-- end main -->
	
<?php get_footer(); ?>