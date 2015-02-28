<?php
class Map_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Google Map',
			'size' => 'span12',
		);
		
		//create the block
		parent::__construct('map_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'title'=>'',
			'src' => '',
			'width' => '',
			'height' => ''
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
			<label for="<?php echo $this->get_field_id('src') ?>">
				Embed code
				<?php echo aq_field_textarea('src', $block_id, $src, $size = 'full') ?>
			</label>
		</p>

		<p class="description">
			<label for="<?php echo $this->get_field_id('width') ?>">
				Width
				<?php echo aq_field_input('width', $block_id, $width, $size = 'full') ?>
			</label>
		</p>

		<p class="description">
			<label for="<?php echo $this->get_field_id('height') ?>">
				Height
				<?php echo aq_field_input('height', $block_id, $height, $size = 'full') ?>
			</label>
		</p>
	
		
		<?php
	}
	
	function block($instance) {
		extract($instance);
		
	if($title) echo '<h3 class="text-block-title">'.strip_tags($title).'</h3>';
	echo do_shortcode('[map src="'.$src.'" width="'.$width.'" height="'.$height.'"]');

		
	}
	
}
