<?php
class Featured_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Features',
			'size' => 'span6',
		);
		
		//create the block
		parent::__construct('featured_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'title' => '',
			'desc' => '',
			'icon' => '',
			'link_text' => 'Details',
			'link' => '#'
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
			<label for="<?php echo $this->get_field_id('desc') ?>">
				Description
				<?php echo aq_field_textarea('desc', $block_id, $desc, $size = 'full') ?>
			</label>
		</p>

		<p class="description">
			<label for="<?php echo $this->get_field_id('icon') ?>">
				Choose an Image<br/>
				<?php echo aq_field_upload('icon', $block_id, $icon, $media_type = 'image') ?>
			</label>
		</p>

		<p class="description">
			<label for="<?php echo $this->get_field_id('link_text') ?>">
				Link text
				<?php echo aq_field_input('link_text', $block_id, $link_text, $size = 'full') ?>
			</label>
		</p>

		<p class="description">
			<label for="<?php echo $this->get_field_id('link') ?>">
				Link URL
				<?php echo aq_field_input('link', $block_id, $link, $size = 'full') ?>
			</label>
		</p>		
		
		<?php
	}
	
	function block($instance) {
		extract($instance);

	echo do_shortcode('[icon title="'.$title.'" desc="'.$desc.'" image="'.$icon.'" link="'.$link.'" link_text="'.$link_text.'"]');
		
	}
	
}
	/* Select field */
	function aq_field_select_icon($field_id, $block_id, $options, $selected) {
		$options = is_array($options) ? $options : array();
		$output = '<select id="'. $block_id .'_'.$field_id.'" name="aq_blocks['.$block_id.']['.$field_id.']">';
		foreach($options as $key=>$value) {
			$output .= '<option value="'.$key.'" '.selected( $selected, $key, false ).' class="icon-'.htmlspecialchars($value).'">&nbsp;'.htmlspecialchars($value).'</option>';
		}
		$output .= '</select>';
		
		return $output;
	}