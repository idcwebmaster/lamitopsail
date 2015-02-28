<?php
/** A simple title block **/
class Title_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Title',
			'size' => 'span12',
			'heading' => 'h3'
		);
		
		//create the block
		parent::__construct('title_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'text' => ''
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
				$heading_type = array (
					'h1' => 'h1',
					'h2' => 'h2',
					'h3' => 'h3',
					'h4' => 'h4',
					'h5' => 'h5',
					'h6' => 'h6',
				);
		?>
		<p class="description">
			<label for="<?php echo $this->get_field_id('title') ?>">
				Title
				<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
			</label>
		</p>
		<p class="description">
			<label for="<?php echo $this->get_field_id('heading') ?>">
				Select Heading 
				<?php echo aq_field_select('heading', $block_id, $heading_type, $heading) ?>
			</label>
		</p>
		
		<?php
	}
	
	function block($instance) {
		extract($instance);

		$wp_autop = ( isset($wp_autop) ) ? $wp_autop : 0;
		
		if($title) echo '<'.$heading.' class="title-block">'.strip_tags($title).'</'.$heading.'>';
		
	}
	
}
