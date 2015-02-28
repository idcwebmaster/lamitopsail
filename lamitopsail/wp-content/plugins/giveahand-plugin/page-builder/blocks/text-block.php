<?php
/** A simple text block **/
class Text_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Text',
			'size' => 'span6',
		);
		
		//create the block
		parent::__construct('text_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'contenttext' => 'Some text'
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		?>
		<p class="description">
			<label for="<?php echo $this->get_field_id('contenttext') ?>">
				<a href="#" class="editing button-primary">Edit Text</a>
				<?php echo aq_field_textarea('contenttext', $block_id, $contenttext, $size = 'full') ?>
			</label>
		</p>
	
		
		<?php
	}
	
	function block($instance) {
		extract($instance);
		
		echo do_shortcode(htmlspecialchars_decode($contenttext));
		
	}
	
}
