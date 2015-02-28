<?php
class Address_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Address',
			'size' => 'span6',
		);
		
		//create the block
		parent::__construct('address_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'title' => '',
			'text' => '',
			'address' => '',
			'phone' => '',
			'site' => ''
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
			<label for="<?php echo $this->get_field_id('address') ?>">
				Address
				<?php echo aq_field_input('address', $block_id, $address, $size = 'full') ?>
			</label>
		</p>
						
		<p class="description">
			<label for="<?php echo $this->get_field_id('phone') ?>">
				Phone Number
				<?php echo aq_field_input('phone', $block_id, $phone, $size = 'full') ?>
			</label>
		</p>
		
				
		
		<?php
	}
	
	function block($instance) {
		extract($instance);
	if($title != '') {
	echo '<h3 class="text-block-title contact-page">'.$title.'</h3>';
	}
	if($address != '') {
	echo '<p style="text-align: center;">
<span style="color: #777777; font-size: 18px;">'.$address.'</span></p>';
	}
	if($phone != '') {
	echo '<div class="phone-number">
<span style="color: #777777;">'.$phone.'</span></div>';
	}

		
	}
	
}
