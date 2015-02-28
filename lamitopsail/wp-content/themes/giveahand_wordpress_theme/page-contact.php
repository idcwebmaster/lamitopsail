<?php 
/*
 Template Name: Contact page
*/
?>
<?php get_header(); ?>

	<!-- MAIN CONTENT -->
	<div id="main">		
		
		<?php global $smof_data; ?>
		
			<section style="">
				<div class="container">
					<div class="row">
						<div class="one_half">
							<h3 style="text-align: center;margin-bottom: 22px;"><?php if (isset($smof_data['form_title'])) { echo $smof_data['form_title']; }?></h3>
							<?php 
							if (isset($smof_data['form_id'])) { echo do_shortcode('[contact-form-7 id="'.$smof_data['form_id'].'" title="Contact form 1"]'); } ?>
						</div>
						<div class="one_half">
						
							<h3 style="text-align: center; margin-bottom: 16px;"><?php if (isset($smof_data['address_title'])) { echo $smof_data['address_title']; } ?></h3>
							
							<p style="text-align: center;">
								<span style="color: #777777; font-size: 18px;"><?php if (isset($smof_data['address'])) { echo $smof_data['address']; } ?></span>
							</p>
							<?php if (isset($smof_data['phone']) && $smof_data['phone'] !='') { ?>
							<div class="phone-number">
							
								<span style="color: #777777;"><?php echo $smof_data['phone']; ?></span>
							
							</div>
							<?php } ?>
							<div class="clear"></div>
							
							<h3 style="text-align: center; margin-bottom: 16px;"><?php if (isset($smof_data['social_title'])) { echo $smof_data['social_title']; } ?></h3>
						
							<div class="big-social-icons">
							<?php if (isset($smof_data['facebook_link']) && $smof_data['facebook_link'] !='') { ?>
								<a class="facebook-icon" href="<?php echo $smof_data['facebook_link']; ?>"></a>
							<?php } ?>	
							<?php if (isset($smof_data['twitter_link']) && $smof_data['twitter_link'] !='') { ?>
								<a class="twitter-icon" href="<?php echo $smof_data['twitter_link']; ?>"></a>
							<?php } ?>	
							<?php if (isset($smof_data['google_plus_link']) && $smof_data['google_plus_link'] !='') { ?>	
								<a class="google-icon" href="<?php echo $smof_data['google_plus_link']; ?>"></a>
							<?php } ?>	
							<?php if (isset($smof_data['skype_link']) && $smof_data['skype_link'] !='') { ?>	
								<a class="skype-icon" href="<?php echo $smof_data['skype_link']; ?>"></a>
							<?php } ?>	
							
							</div>
							
						</div>
					</div>
				</div>
			</section>
			<?php if (isset($smof_data['map_link']) && $smof_data['map_link'] !='') { ?>
			<section style="margin-bottom:-6px;">
				<?php echo do_shortcode('[map src="'.$smof_data['map_link'].'" height="'.$smof_data['map_height'].'"]'); ?>
			</section>
			<?php } ?>
	</div> <!-- end main -->
	
	

<?php get_footer(); ?>