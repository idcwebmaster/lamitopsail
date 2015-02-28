<?php
class Contact_Form_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Contact Form',
			'size' => 'span6',
		);
		
		//create the block
		parent::__construct('contact_form_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'title' => '',
			'id' => ''
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
			<label for="<?php echo $this->get_field_id('id') ?>">
				Contact Form ID
				<?php echo aq_field_input('id', $block_id, $id, $size = 'full') ?>
			</label>
		</p>
				
		
		<?php
	}
	
	function block($instance) {
		extract($instance);
	if($title != '') {
	echo '<h3 class="text-block-title contact-page">'.$title.'</h3>';
	}
	echo do_shortcode('[contact-form-7 id="'.$id.'" title="Contact form"]');

		
	}
	
}
