<?php
/** Editor block **/
class Editor_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Editor',
			'size' => 'span12',
		);
		
		//create the block
		parent::__construct('editor_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'text' => ''
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		
		?>
	
		<p class="description">
			<label for="<?php echo $this->get_field_id('text') ?>">
				Content
				<?php 
				$args = array (
				    'tinymce' => true,
				    'quicktags' => true,
				);
				wp_editor( htmlspecialchars_decode($text), 'aq_blocks['.$block_id.'][text]', $args );
				?>
			</label>
		</p>
		
		<?php
	}
	
	function block($instance) {
		extract($instance);
		echo wpautop(do_shortcode(htmlspecialchars_decode($text)));
	}
	
}