<?php
/** A social block **/
class Social_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Socials',
			'size' => 'span6',
		);
		
		//create the block
		parent::__construct('social_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'title' => 'Follow Us:'
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);

		?>
		<p class="description">
			<label for="<?php echo $this->get_field_id('title') ?>">
				Title
				<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
			</label>
		</p>
		
		<?php
	}
	
	function block($instance) {
		extract($instance);
		
		global $smof_data;
		
		if($title) echo '<h3 style="text-align: center; margin-bottom: 16px;">'.$title.'</h3>';
						
							echo '<div class="big-social-icons">';
							
							if (isset($smof_data["facebook_link"]) && $smof_data["facebook_link"] !="") { 
								echo '<a class="facebook-icon" href="';
								echo $smof_data['facebook_link']; 
								echo '"></a>';
							}; 
							if (isset($smof_data['twitter_link']) && $smof_data['twitter_link'] !='') { 
								echo '<a class="twitter-icon" href="';
								echo $smof_data['twitter_link'];
								echo '"></a>';
							}; 
							if (isset($smof_data['google_plus_link']) && $smof_data['google_plus_link'] !='') {	
								echo '<a class="google-icon" href="';
								echo $smof_data['google_plus_link'];
								echo '"></a>';
							};	
							if (isset($smof_data['skype_link']) && $smof_data['skype_link'] !='') {
								echo '<a class="skype-icon" href="';
								echo $smof_data['skype_link'];
								echo '"></a>';
							} ;	
							
							echo '</div>';

		
	}
	
}
