<?php
class Activity_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Activity',
			'size' => 'span6',
		);
		
		//create the block
		parent::__construct('activity_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'title' => 'Events',
			'custom_category' => '',
			'numb' => '5'
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

		<p class="description">
			<label for="<?php echo $this->get_field_id('custom_category') ?>">
				From Category (optional)
				<?php echo aq_field_input('custom_category', $block_id, $custom_category, $size = 'full') ?>
			</label>
		</p>

		<p class="description">
			<label for="<?php echo $this->get_field_id('numb') ?>">
				Number of posts
				<?php echo aq_field_input('numb', $block_id, $numb, $size = 'full') ?>
			</label>
		</p>
				
		<?php
	}
	
	function block($instance) {
		extract($instance);

	echo do_shortcode('[activity title="'.$title.'" numb="'.$numb.'" custom_category="'.$custom_category.'" view="slider"]');

	}
	
}
