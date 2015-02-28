<?php
/** A simple button block **/
class Button_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Button',
			'size' => 'span6',
		);
		
		//create the block
		parent::__construct('button_block', $block_options);
		
		add_action('wp_ajax_insert_tinymce', 'insert_tinymce');
		function insert_tinymce(){
		    wp_editor('','editor-id');
		    exit;
		}

	}
	
	function form($instance) {
		
		$defaults = array(
			'link' => '',
			'linktext' => '',
			'button_color' => ''
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		$default_color = '#4873a6';
		?>
		<p class="description">
			<label for="<?php echo $this->get_field_id('link') ?>">
				Link
				<?php echo aq_field_input('link', $block_id, $link, $size = 'full') ?>
			</label>
		</p>
		<p class="description">
			<label for="<?php echo $this->get_field_id('linktext') ?>">
				Link Text <a href="#" class="editing">Edit Text</a>
				<?php echo aq_field_textarea('linktext', $block_id, $linktext, $size = 'full') ?>
			</label>
			
		</p>
		<p class="description">
			<label for="<?php echo $this->get_field_id('button_color') ?>">
				Button color
				<?php echo aq_field_color_picker('button_color', $block_id, $button_color, $default_color) ?>
			</label>
		</p>			
		
		<?php
	}
	
	function block($instance) {
		extract($instance);
		
		echo '<a href="'.$link.'" class="button" style="background-color:'.$button_color.'!important;">'.wpautop(do_shortcode(htmlspecialchars_decode($linktext))).'</a>';

	}
	
}
