<?php 
// Prevent the direct loading of this file
if (!empty($_SERVER['SCRIPT-FILENAME']) && basename($_SERVER['SCRIPT-FILENAME']) == 'comments.php') {
	die(__('You cannot access this file directly', 'framework'));
}

// Check if post is pwd protected
if (post_password_required()) : ?>
	<p>
		<?php _e('This post is password protected. Enter the password to view the comments', 'framework'); ?>
		<?php return; ?>
	</p>

<?php endif;

if (have_comments()) : ?>
<div id="comments" class="comments-area">
	<div class="title-block">
		<div class="page-divider"></div>
		<div class="page-title"><strong></strong><?php _e('Comments','framework'); ?><span>
			<div class="page-divider-top"></div>
			<div class="page-divider-bottom"></div>
		</span></div>
	</div>

	<ol class="commentslist">
		<?php wp_list_comments('callback=custom_comments'); ?>
	</ol>

</div>	
	<?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
	
	<div class="comments-nav-section clearfix">

		<span class="fl"><?php previous_comments_link('&laquo;'); ?></span>
		<span class="fr"><?php next_comments_link('&raquo;'); ?></span>

	</div> <!-- end comments-nav-section -->
	
	<?php endif; ?>
					
<?php elseif (!comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')) : ?>
	<p><?php _e('Comments are closed.', 'framework'); ?></p>
<?php endif;

// Display comment form

comment_form();

?>
