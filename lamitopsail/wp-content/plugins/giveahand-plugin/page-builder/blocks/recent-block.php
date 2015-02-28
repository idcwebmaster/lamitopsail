<?php
class Recent_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Recent News',
			'size' => 'span6',
		);
		
		//create the block
		parent::__construct('recent_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'title' => 'Recent News',
			'custom_category' => '',
			'numb' => '5',
			'excerpt_count' => '10'
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
	
		<p class="description">
			<label for="<?php echo $this->get_field_id('excerpt_count') ?>">
				Excerpt count (optional)
				<?php echo aq_field_input('excerpt_count', $block_id, $excerpt_count, $size = 'full') ?>
			</label>
		</p>
				
		<?php
	}
	
	function block($instance) {
		extract($instance);

	echo do_shortcode('[recent_posts title="'.$title.'" type="news" excerpt_count="'.$excerpt_count.'" custom_category="'.$custom_category.'" numb="'.$numb.'" meta="false" thumb="true" excerpt_count="22" view="slider"]');

	}
	
}
