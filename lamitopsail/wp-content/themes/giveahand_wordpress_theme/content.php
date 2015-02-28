<?php
/***********************************************************************************************/
/* Template for the default post format */
/***********************************************************************************************/
?>

<article <?php post_class('clearfix'); ?> id="post-<?php the_ID(); ?>">

	<figure class="article-preview-image">
<?php 
	$post_meta_data = get_post_custom($post->ID);
	$custom_select = isset($post_meta_data['post_select'][0]) ? $post_meta_data['post_select'][0]:'';  
	if (isset($post_meta_data['lightbox'][0])) {
						$custom_image = $post_meta_data['lightbox'][0];  
						$large_image = wp_get_attachment_image_src($custom_image, 'full'); 
						}
	$custom_textarea = isset($post_meta_data['post_textarea'][0]) ? $post_meta_data['post_textarea'][0]:'';  
	$external_link = isset($post_meta_data['post_link'][0]) ? $post_meta_data['post_link'][0]:'';
?>
		<?php if (has_post_thumbnail() or !empty($custom_textarea) or !empty($custom_image)) { ?>
		
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
						<a href="<?php if( $external_link != '' ){ 
									
									echo $external_link;
									
									} else {
									
									the_permalink($post->ID);
									
									} ?>">
									
							<?php the_post_thumbnail( 'post' ); ?>
						</a>
					<?php	
					}
			?>	
			
					<div class="meta"><span><?php the_time('j'); ?></span><br><?php the_time('M'); ?></div>
			
			<?php } ?>
	
	</figure>
	
	<div class="article-meta clearfix">
	
		<?php if (!has_post_thumbnail() and empty($custom_textarea) and empty($custom_image)) : ?>
		
			<p class="meta-date"><a href="<?php if( $external_link != '' ){ 
									
									echo $external_link;
									
									} else {
									
									the_permalink();
									
									} ?>"><?php the_time('M, j'); ?></a></p>
			
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
			
			<h3><a href="<?php if( $external_link != '' ){ 
									
									echo $external_link;
									
									} else {
									
									the_permalink();
									
									} ?>"><?php the_title(); ?></a></h3>
			
		</header>

		<?php the_content('Details'); ?>
		
	</div>							
								
</article> <!-- end article -->