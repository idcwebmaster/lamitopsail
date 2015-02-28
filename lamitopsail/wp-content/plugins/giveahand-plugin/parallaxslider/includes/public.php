<?php
/**
 * Public. 
 */

/** 
 * Settings for slideshow query.
 */
global $post;
global $wp_query;

$args = array( 
	'post_type' => 'fx_slider', 
	'orderby'   => 'menu_order',
    'order'     => 'ASC',
    'slideshow'	=> $slideshow,
);


/* Backup the original $wp_query */
$original_query = $wp_query;
$wp_query = NULL;

$wp_query = new WP_Query( $args ); ?>
<section class="parallaxslider">
	<div class="container">
		<div class="slider">

			<?php /* Begin Loop. */
	            if ( $wp_query->have_posts() ) {

	                while ( $wp_query->have_posts() ) : $wp_query->the_post();  

						/* Grab background image. */
						$arr_sliderbg = (get_post_meta($post->ID, '_fx_background_id_bg_image', TRUE));

						/* Grab and apply the background color. */
						$arr_sliderbg_color = (get_post_meta($post->ID, '_fx_background_id_bg_color', TRUE)); 
						
						/* Grab and apply the background video. */
						$arr_sliderbg_video = (get_post_meta($post->ID, '_fx_background_id_bg_video', TRUE)); 	
											
						/* Random ID */
						
						$randId = rand(0,100);
						
						?>
						
						<div id="slide-<?php echo $randId; ?>" data-bg="" class="slide" <?php echo (!empty($arr_sliderbg_color)) ? "style='background-color:$arr_sliderbg_color'" : FALSE; ?>>
							
							<?php 
							
								/* Apply the background image */
								if (! empty($arr_sliderbg)) {

									$src = wp_get_attachment_image_src( $arr_sliderbg, 'fullwidth');
									$bg_image_url =  $src[0]; ?>
								<div class="imgWrapp" data-fixed>
									<img  src="<?php echo $bg_image_url; ?>">
								</div>
								<?php 
								
								};
								
								/* Apply the background image */
								if (! empty($arr_sliderbg_video)) {
									
									echo '<a id="slbgvideo-'.$randId.'" class="bgvdplayer" data-property="{videoURL:\''.$arr_sliderbg_video.'\', containment:\'#slide-'.$randId.'>.imgWrapp\', startAt:0, quality:\'highres\', mute:false, autoPlay:true, showYTLogo:false, showControls:false, loop:true, opacity:1}"></a>';				
																						
								}

								/* Start looping the elements */
								$arr_slider = (get_post_meta($post->ID, '_fx_elements_id', TRUE));
								
								
								$count = sizeof($arr_slider);
								$count_arr = 0;

								while ($count_arr < $count and !empty($arr_slider)) {
								
									/* Get element options. */
									$element_type = $arr_slider[$count_arr]['_layer_type'];
									$element_caption = $arr_slider[$count_arr]['_element_caption'];
									$element_caption_font = $arr_slider[$count_arr]['_element_caption_font'];
									$element_caption_color = $arr_slider[$count_arr]['_element_caption_color'];
									$element_caption_styles = $arr_slider[$count_arr]['_element_caption_styles'];
									$element_position = (empty($arr_slider[$count_arr]['_element_option_position'])) ? "0,0" : $arr_slider[$count_arr]['_element_option_position'];
									$element_delay = $arr_slider[$count_arr]['_element_option_delay'];
									$element_time = $arr_slider[$count_arr]['_element_option_time'];
									$element_in = $arr_slider[$count_arr]['_element_option_in'];
									$element_out = $arr_slider[$count_arr]['_element_option_out'];
									$element_step = $arr_slider[$count_arr]['_element_option_step'];
									$element_ease_in = $arr_slider[$count_arr]['_element_option_ease_in'];
									$element_ease_out = $arr_slider[$count_arr]['_element_option_ease_out'];

									/* Display element image */
									$element_image = $arr_slider[$count_arr]['_element_image'];
									if (!empty($element_type) && $element_type=='type_image') { 

										$src = wp_get_attachment_image_src( $element_image, 'column-full');
										$element_image_url = $src[0]; ?>  

											<img src="<?php echo $element_image_url; ?>" <?php
												echo (!empty($element_position)) ? "data-position='$element_position' " : FALSE; 
								            	echo (!empty($element_delay)) ? "data-delay='$element_delay' " : FALSE; 
								            	echo (!empty($element_time)) ? "data-time='$element_time' " : FALSE; 
							            		echo ($element_in != 'none') ? "data-in='$element_in' " : FALSE; 
							            		echo ($element_out != 'none') ? "data-out='$element_out' " : FALSE; 
							            		echo ($element_step != 'none') ? "data-step='$element_step' " : FALSE; 
								            	echo ($element_ease_in != 'none') ? "data-ease-in='$element_ease_in' " : FALSE ; 
								            	echo ($element_ease_out != 'none') ? "data-ease-out='$element_ease_out' " : FALSE ; 
											?>> <?php 
									} 



								    /* Display Video */
									elseif (!empty($element_type) && $element_type=='type_video') {
											
											$element_video = isset($arr_slider[$count_arr]['_element_video']) ? $arr_slider[$count_arr]['_element_video'] : FALSE;
											$element_video_dimension = isset($arr_slider[$count_arr]['_element_video_dimension']) ? $arr_slider[$count_arr]['_element_video_dimension'] : FALSE;

											/* Getting width and height into their own variables */
											$pieces = explode(',', $element_video_dimension); ?>
										
									<div class="fs-item" <?php
											echo (!empty($element_position)) ? "data-position='$element_position' " : FALSE; 
											echo (!empty($element_delay)) ? "data-delay='$element_delay' " : FALSE; 
											echo (!empty($element_time)) ? "data-time='$element_time' " : FALSE; 
											echo ($element_in != 'none') ? "data-in='$element_in' " : FALSE; 
											echo ($element_out != 'none') ? "data-out='$element_out' " : FALSE; 
											echo ($element_step != 'none') ? "data-step='$element_step' " : FALSE; 
											echo ($element_ease_in != 'none') ? "data-ease-in='$element_ease_in' " : FALSE ; 
											echo ($element_ease_out != 'none') ? "data-ease-out='$element_ease_out' " : FALSE ; 
										?>>	
										
									<?php echo fx_video_url($element_video, "embed", "$pieces[0]", "$pieces[1]", "$element_position", "$element_step" ); ?>
									</div> 
									<?php
									}

									/* Display captions */
									elseif (!empty($element_type) && $element_type=='type_capt') { 
									$element_caption_type = $arr_slider[$count_arr]['_element_caption_type'];
									
									
									if (!empty($element_caption_type) && $element_caption_type == 'heading') {
									echo "<h1"; } else { echo "<p";}?>
									style="<?php 
										echo (!empty($element_caption_font)) ? "font-size: $element_caption_font" : FALSE; 
										echo (!empty($element_caption_font)) ? "px;" : FALSE;
										echo (!empty($element_caption_color)) ? "color:$element_caption_color; " : FALSE; 
										echo (!empty($element_caption_styles)) ? "$element_caption_styles " : FALSE; 										
											?>"
									<?php 
										echo (!empty($element_position)) ? "data-position='$element_position' " : FALSE; 
										echo (!empty($element_delay)) ? "data-delay='$element_delay' " : FALSE; 
										echo (!empty($element_time)) ? "data-time='$element_time' " : FALSE; 
										echo ($element_in != 'none') ? "data-in='$element_in' " : FALSE; 
										echo ($element_out != 'none') ? "data-out='$element_out' " : FALSE; 
										echo ($element_step != 'none') ? "data-step='$element_step' " : FALSE; 
										echo ($element_ease_in != 'none') ? "data-ease-in='$element_ease_in' " : FALSE ; 
										echo ($element_ease_out != 'none') ? "data-ease-out='$element_ease_out' " : FALSE ; 
									?>><?php echo $element_caption;
									if (!empty($element_caption_type) && $element_caption_type == 'heading') {
									echo "</h1>"; } else { echo "</p>";}?>
						            <?php }
																		
									/* Display button */
									elseif (!empty($element_type) && $element_type=='type_button') { 
									$button_text = $arr_slider[$count_arr]['_element_button_text'];
									$button_link = $arr_slider[$count_arr]['_element_button_link'];
									$button_color = $arr_slider[$count_arr]['_element_button_color'];
									$donate_func = $arr_slider[$count_arr]['_element_button_donate'];
									?>
									
									<a href="<?php echo (!empty($button_link)) ? $button_link : FALSE; ?>" style="<?php echo (!empty($button_color)) ? "background-color:$button_color; " : FALSE; ?>" 
									class="button-custom <?php if (isset($donate_func) && $donate_func=='on') {echo 'donate';} ?>"
									<?php 
										echo (!empty($element_position)) ? "data-position='$element_position' " : FALSE; 
										echo (!empty($element_delay)) ? "data-delay='$element_delay' " : FALSE; 
										echo (!empty($element_time)) ? "data-time='$element_time' " : FALSE; 
										echo ($element_in != 'none') ? "data-in='$element_in' " : FALSE; 
										echo ($element_out != 'none') ? "data-out='$element_out' " : FALSE; 
										echo ($element_step != 'none') ? "data-step='$element_step' " : FALSE; 
										echo ($element_ease_in != 'none') ? "data-ease-in='$element_ease_in' " : FALSE ; 
										echo ($element_ease_out != 'none') ? "data-ease-out='$element_ease_out' " : FALSE ; 
									?>><?php echo $element_caption ?><?php echo (!empty($button_text)) ? $button_text : FALSE; ?></a>
						            <?php }
									
									
									$count_arr++; 
								}; 
								
								?>
						</div> <!-- .slide -->
				<?php endwhile; }; 

				/* Restore the original query */	
				$wp_query = NULL;
				$wp_query = $original_query;
				wp_reset_postdata(); ?>

		</div> <!-- .slider -->
	</div> <!-- .container -->
</section>
