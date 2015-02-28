<?php
	/**
	 * Template Name: Portfolio
	 */
?>
<?php get_header(); ?>

	<!-- MAIN CONTENT -->
	<div id="main">
		
		<section> 
		
		<div class="container">	
			<div class="row">
				
<ul class="filter span12">
					<li class="active"><a href="javascript:void(0)" class="all">All</a></li>
					<?php
						// Get the taxonomy
						$terms =''; $count=''; $term_list=''; $args=''; $term='';
						$values = get_post_custom_values("category-include"); $cat=$values[0];  
	
$catId = get_term_by('name', $cat, 'portfolio_category'); 
$taxonomyName = "portfolio_category"; 
if ($catId!='' && $taxonomyName!='') { 
$termchildren = get_term_children( $catId->term_id, $taxonomyName );  
$count = count($terms); 						
						// set a count value to 0
						$i=0;						
						// test if the count has any categories
						if ($count > 0) {							
							// break each of the categories into individual elements								
								// increase the count by 1
					foreach ($termchildren as $child) 	
						{
							$i++;
							$term = get_term_by( 'id', $child, $taxonomyName );  
							$slug = strtolower($term->name);
							$term_list .= '<li><a href="javascript:void(0)" class="'. $slug .'">' . $term->name . '</a></li>';
							// if count is equal to i then output blank
								if ($count != $i)
								{
									$term_list .= '';
								}
								else 
								{
									$term_list .= '';
								}						
						}  
							// print out each of the categories in our new format
							echo $term_list;
						}
}
					?>
				</ul>
				<div class="gallery-container"><div class="gallery-page"><div class="filterable-grid clearfix">		
					<?php $paged=''; $wpbp='';
						// Set the page to be pagination
						$paged = get_query_var('paged') ? get_query_var('paged') : 1;						
						// Query Out Database
						$wpbp = new WP_Query(array( 'post_type' => 'portfolio', 'portfolio_category' => $cat,  'posts_per_page' =>'-1', 'paged' => $paged ) ); 
					?>					
					<?php
						// Begin The Loop
						if ($wpbp->have_posts()) : while ($wpbp->have_posts()) : $wpbp->the_post(); 
					?>					
					<?php 
						// Get The Taxonomy 'Filter' Categories
						$terms = get_the_terms( get_the_ID(), 'portfolio_category' ); 
					?>	
					<?php 
					$post_meta_data = get_post_custom($post->ID); 	

$custom_link = isset($post_meta_data['custom_link'][0]) ? $post_meta_data['custom_link'][0]:'';
$lightbox = isset($post_meta_data['lightbox'][0]) ? $post_meta_data['lightbox'][0]:'';
$big_image = isset($post_meta_data['big_image'][0]) ? $post_meta_data['big_image'][0]:'';
$select = isset($post_meta_data['select'][0]) ? $post_meta_data['select'][0]:'';
$large_image = wp_get_attachment_image_src($big_image, 'fullsize');
					?>
							<div data-id="id-<?php echo $count; ?>" data-type="<?php foreach ($terms as $term) { echo strtolower(preg_replace('/\s+/', '-', $term->name)). ' '; } ?>">								
									<?php 
										// Check if wordpress supports featured images, and if so output the thumbnail
										if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) : 
									?>
										
																		<?php 
																		
	$img_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );	
	$img = aq_resize($img_url,270,247,true);		
	if ($img!=false){
	$img_url = $img;
	}																
															
	if ( $select == 'four') {  ?>
	<a rel="prettyPhoto[Gallery]" href="<?php echo $lightbox; ?>"><span></span><strong></strong><i class="video"></i>
	<img src="<?php echo $img_url; ?>" alt=""/>
	</a>
	<?php } else if ( $select == 'three') {  ?>
	<a rel="prettyPhoto[Gallery]" href="<?php echo $large_image[0]; ?>"><span></span><strong></strong><i class="image"></i>
	<img src="<?php echo $img_url; ?>" alt=""/>
	</a>	
	<?php } else if ( $select == 'two') { ?>
	<a href="<?php echo $custom_link; ?>"><span></span><strong></strong><i class="link"></i>
	<img src="<?php echo $img_url; ?>" alt=""/>
	</a>
	<?php 
	} else {
	?>
	<a class="folio_link" href="<?php the_permalink($post->ID); ?>"><span></span><strong></strong><i class="link"></i>
	<img src="<?php echo $img_url; ?>" alt=""/>
	</a>
	<?php	
	}
	
	endif; ?>				
					<span class="ver_decor"></span><span class="hor_decor"></span>
	
							</div>					
					<?php $count++; // Increase the count by 1 ?>		
					<?php endwhile; endif; // END the Wordpress Loop ?>
					<?php wp_reset_query(); // Reset the Query Loop?>				
				</div></div></div>
<div class="clear"></div>
</div>
		</div>
		
		</section>
		
</div> <!-- end main -->
	
	

<?php get_footer(); ?>