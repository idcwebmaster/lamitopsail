<?php
/** Notifications block **/

if(!class_exists('Alert_Block')) {
	class Alert_Block extends AQ_Block {
		
		//set and create block
		function __construct() {
			$block_options = array(
				'name' => 'Alerts',
				'size' => 'span6',
			);
			
			//create the block
			parent::__construct('alert_block', $block_options);
		}
		
		function form($instance) {
			
			$defaults = array(
				'content' => '',
				'type' => 'note',
				'style' => ''
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
			$type_options = array(
				'standart' => 'Standard',
				'succesful' => 'Succesful',
				'notice' => 'Notification',
				'warning' => 'Warning',
				'error' => 'Error'
			);
			
			?>
			

			<p class="description">
				<label for="<?php echo $this->get_field_id('content') ?>">
					Alert Text (required)<br/>
					<?php echo aq_field_textarea('content', $block_id, $content) ?>
				</label>
			</p>
			<p class="description half">
				<label for="<?php echo $this->get_field_id('type') ?>">
					Alert Type<br/>
					<?php echo aq_field_select('type', $block_id, $type_options, $type) ?>
				</label>
			</p>
			<?php
			
		}
		
		function block($instance) {
			extract($instance);
			
			echo do_shortcode('[notice type="'.$type.'" text="' . do_shortcode(htmlspecialchars_decode($content)) . '"]');
			
		}
		
	}
}