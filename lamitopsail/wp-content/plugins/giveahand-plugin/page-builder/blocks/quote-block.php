<?php
/** Quote block **/

if(!class_exists('Quote_Block')) {
	class Quote_Block extends AQ_Block {
		
		//set and create block
		function __construct() {
			$block_options = array(
				'name' => 'Quote',
				'size' => 'span6',
			);
			
			//create the block
			parent::__construct('quote_block', $block_options);
		}
		
		function form($instance) {
			
			$defaults = array(
				'content' => '',
				'author' => ''
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
			
			?>
			

			<p class="description">
				<label for="<?php echo $this->get_field_id('content') ?>">
					Quote (required)<br/>
					<?php echo aq_field_textarea('content', $block_id, $content) ?>
				</label>
			</p>
			<p class="description">
				<label for="<?php echo $this->get_field_id('author') ?>">
					Author<br/>
					<?php echo aq_field_input('author', $block_id,  $author) ?>
				</label>
			</p>
			<?php
			
		}
		
		function block($instance) {
			extract($instance);
			
			echo do_shortcode('[blockquote author="'.$author.'" quote="' . do_shortcode(htmlspecialchars_decode($content)) . '"]');
			
		}
		
	}
}