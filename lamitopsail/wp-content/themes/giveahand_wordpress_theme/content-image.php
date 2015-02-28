<?php
/***********************************************************************************************/
/* Template for the image post format */
/***********************************************************************************************/
?>

<article <?php post_class('clearfix'); ?> id="post-<?php the_ID(); ?>">

	<figure class="article-preview-image">
<?php 
	$post_meta_data = get_post_custom($post->ID);
	if (isset($post_meta_data['custom_select'][0])) $custom_select = $post_meta_data['custom_select'][0];  
	if (isset($post_meta_data['lightbox'][0])) {
						$custom_image = $post_meta_data['lightbox'][0];  
						$large_image = wp_get_attachment_image_src($custom_image, 'fullsize'); 
						}
	if (isset($post_meta_data['custom_textarea'][0])) $custom_textarea = $post_meta_data['custom_textarea'][0];  
?>

	
	</figure>
	
	<div class="article-meta clearfix">
	
		<?php if (!has_post_thumbnail()) : ?>
		
			<p class="meta-date"><a href="<?php the_permalink(); ?>"><?php the_time('M, j'); ?></a></p>
			
		<?php endif; ?>
		
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
			
			<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			
		</header>

		<?php the_content('Details'); ?>
		
	</div>							
								
</article> <!-- end article -->