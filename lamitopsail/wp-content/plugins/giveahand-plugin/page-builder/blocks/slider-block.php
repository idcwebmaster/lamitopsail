<?php
class Slider_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Slider',
			'size' => 'span12',
		);
		
		//create the block
		parent::__construct('slider_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'slideshow' => '',
			'width' => '1200',
			'height' => '400',
			'controls' => '',
			'autochange' => '',
			'pauseonhover' => ''
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		
			$types = array(
				'true' => 'True',
				'' => 'False'
			);
		?>
		<p class="description">
			<label for="<?php echo $this->get_field_id('slideshow') ?>">
				Slideshow
				<?php echo aq_field_input('slideshow', $block_id, $slideshow, $size = 'full') ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('width') ?>">
				Slideshow Width
				<?php echo aq_field_input('width', $block_id, $width, $size = 'full') ?>
			</label>
		</p>

		<p class="description">
			<label for="<?php echo $this->get_field_id('height') ?>">
				Slideshow Height
				<?php echo aq_field_input('height', $block_id, $height, $size = 'full') ?>
			</label>
		</p>

		<p class="description">
			<label for="<?php echo $this->get_field_id('controls') ?>">
				Controls<br/>
				<?php echo aq_field_select('controls', $block_id, $types, $controls) ?>
			</label>
		</p>	
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('autochange') ?>">
				Autochange<br/>
				<?php echo aq_field_select('autochange', $block_id, $types, $autochange) ?>
			</label>
		</p>
			
		<p class="description">
			<label for="<?php echo $this->get_field_id('pauseonhover') ?>">
				Pause on hover<br/>
				<?php echo aq_field_select('pauseonhover', $block_id, $types, $pauseonhover) ?>
			</label>
		</p>
		
		<?php
	}
	
	function block($instance) {
		extract($instance);

	echo do_shortcode('[slider slideshow="'.$slideshow.'" dimensions="'.$width.','.$height.'" controls="'.$controls.'" autochange="'.$autochange.'" pauseonhover="'.$pauseonhover.'" fullwidth=""]');

		
	}
	
}
