<?php
class Testimonials_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Testimonials',
			'size' => 'span6',
		);
		
		//create the block
		parent::__construct('testimonials_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'title' => '',
			'num' => '5',
			'excerpt' =>'30',
			'thumb' => array(
				'true' => 'Show',
				'false' => 'Hide'
			)
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
			<label for="<?php echo $this->get_field_id('num') ?>">
				Number of posts
				<?php echo aq_field_input('num', $block_id, $num, $size = 'full') ?>
			</label>
		</p>
		<p class="description">
			<label for="<?php echo $this->get_field_id('excerpt') ?>">
				Excerpt count
				<?php echo aq_field_input('excerpt', $block_id, $excerpt, $size = 'full') ?>
			</label>
		</p>


	
		
		<?php
	}
	
	function block($instance) {
		extract($instance);
		
	if($title) echo '<h3 class="text-block-title">'.strip_tags($title).'</h3>';
	echo do_shortcode('[recenttesti excerpt_count="'.$excerpt.'" num="'.$num.'"]');

		
	}
	
}
