<?php get_header(); ?>

	<!-- MAIN CONTENT -->
	<div id="main">
		
		<section>
		
		<div class="container">			

		<!-- Posts -->
			
			<div class="row">
		
				<div class="main-articles  single-post <?php 
						if(isset($smof_data['layout']) && $smof_data['layout'] == 'fullwidth') { echo 'span12';
						} elseif (isset($smof_data['layout']) && $smof_data['layout'] == 'left-sidebar') { echo 'span9 right';
						} else { echo 'span9';}
					?>"> 
				
					<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
					<?php 
	$post_meta_data = get_post_custom($post->ID);
	if (isset($post_meta_data['custom_select'][0])) $custom_select = $post_meta_data['custom_select'][0];  
	if (isset($post_meta_data['lightbox'][0])) {
						$custom_image = $post_meta_data['lightbox'][0];  
						$large_image = wp_get_attachment_image_src($custom_image, 'fullsize'); 
						}
	if (isset($post_meta_data['custom_textarea'][0])) $custom_textarea = $post_meta_data['custom_textarea'][0];  
?>
						<article>

							<figure class="article-preview-image">
							
							<?php if (has_post_thumbnail() or isset($custom_select)) { ?>
							
								<?php		
									if (isset($custom_select) and $custom_select == 'two' ) {  ?>
											<a rel="prettyPhoto[Preview]" href="<?php if (isset($large_image[0])) echo $large_image[0]; ?>">
												<?php the_post_thumbnail( 'post' ); ?><span class="zoomSp"></span>
											</a>
										<?php 
									} else if (isset($custom_select) and $custom_select == 'three' ) { 
												echo $custom_textarea;
									} else {
										?>
											<a href="<?php the_permalink($post->ID); ?>">
												<?php the_post_thumbnail( 'post' ); ?>
											</a>
										<?php	
										}
								?>	
								
										<div class="meta"><span><?php the_time('j'); ?></span><br><?php the_time('M'); ?></div>
								
								<?php } ?>

							</figure>
							
							<div class="article-meta clearfix">
								
								<p class="userPost"><?php the_author_posts_link(); ?></p>
		
								<?php
									if (comments_open() && !post_password_required()) { 
										comments_popup_link('0', '1', '%', 'comments');
									}
								?>
		
								<p class="categories-container"><?php the_category(',&nbsp;'); ?></p>
								
								<?php if (has_tag()) : ?>

								<p class="tags-container"><?php the_tags('',',&nbsp;',''); ?></p>
								
								<?php endif; ?>
								
							</div>
							
							<hr>
								
							<div class="article-main">
							
								<header>
									
									<h3><?php the_title(); ?></a></h3>
									
								</header>

								<?php the_content(); ?>
							<div>
								
								<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'framework' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
								
							</div> <!-- end post-navigation -->								
							</div>
								
						</article> <!-- end article -->
						
						<div class="share-block clearfix">
						
							<span>Share:</span>

								<a class="small-facebook-icon" href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>" target="blank"></a>

								<a class="small-twitter-icon" href="https://twitter.com/share?url=https%3A%2F%2Fdev.twitter.com%2Fpages%2Ftweet-button" target="_blank"></a>
								
								<a class="small-google-icon" href="https://plus.google.com/share?url={URL}" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"></a>
								
						</div>
						
						<?php theme_post_nav(); ?>
						
						<?php endwhile; else : ?>
						
							<article class="no-posts">

								<div class="article-main">

									<h3><?php _e('No posts were found.', 'framework'); ?></h3>
									
								</div>
								
							</article>
							
						<?php endif; ?>
							
						<?php comments_template('', true); ?>
						
				</div> <!-- end main articles - single post -->

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