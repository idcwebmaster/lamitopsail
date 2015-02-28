<?php
/* Aqua Carousel Block */
if(!class_exists('Carousel_Block')) {
	class Carousel_Block extends AQ_Block {
	
		function __construct() {
			$block_options = array(
				'name' => 'Carousel',
				'size' => 'span12',
			);
			
			//create the widget
			parent::__construct('carousel_block', $block_options);
			
			//add ajax functions
			add_action('wp_ajax_aq_block_carousel_add_new', array($this, 'add_carousel'));
			
		}
		
		function form($instance) {
		
			$defaults = array(
				'carousels' => array(
					1 => array(
						'content' => ''
					)
				)
			);
			
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);

			
			
			?>
			<div class="description cf">
				<ul id="aq-sortable-list-<?php echo $block_id ?>" class="aq-sortable-list" rel="<?php echo $block_id ?>">
					<?php
					$count = 0;
					foreach($carousels as $carousel) {	
						$this->carousel($carousel, $count);
						$count++;
					}
					?>
				</ul>
				<p></p>
				<a href="#" rel="carousel" class="aq-sortable-add-new button">Add New</a>
				<p></p>
			</div>
			<?php
		}
		
		function carousel($carousel = array(), $count = 0) {
				
			?>
			<li id="<?php echo $this->get_field_id('carousels') ?>-sortable-item-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">
				
				<div class="sortable-head cf">
					<div class="sortable-title">
						<strong>New Item</strong>
					</div>
					<div class="sortable-handle">
						<a href="#">Open / Close</a>
					</div>
				</div>
				
				<div class="sortable-body">
					<p class="tab-desc description">
						<label for="<?php echo $this->get_field_id('carousels') ?>-<?php echo $count ?>-content">
							<a href="#" class="editing button-primary">Edit Text</a>
							<textarea id="<?php echo $this->get_field_id('carousels') ?>-<?php echo $count ?>-content" class="textarea-full" name="<?php echo $this->get_field_name('carousels') ?>[<?php echo $count ?>][content]" rows="5"><?php echo $carousel['content'] ?></textarea>
						</label>
					</p>
					

					<p class="tab-desc description"><a href="#" class="sortable-delete">Delete</a></p>
				</div>
				
			</li>
			<?php
		}
		
		function block($instance) {
			extract($instance);
			
			$output = '';
			
			$output .= '<div class="slider-carousel"><ul class="carousel">';
			
				foreach($carousels as $carousel) {
				
					$output .= '<li>';
					
					$output .= htmlspecialchars_decode($carousel['content']);
					
					$output .= '</li>';	
					
				}
			
			$output .= '</ul></div>';
			
			echo $output;
			
		}
		
		/* AJAX add slidecontent */
		function add_carousel() {
			$nonce = $_POST['security'];
			if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
			
			$count = isset($_POST['count']) ? absint($_POST['count']) : false;
			$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-999999';
			
			//default key/value for the slide
			$carousel = array(
				'content' => ''
			);
			
			if($count) {
				$this->carousel($carousel, $count);
			} else {
				die(-1);
			}
			
			die();
		}
		
		function update($new_instance, $old_instance) {
			$new_instance = aq_recursive_sanitize($new_instance);
			return $new_instance;
		}
	}
}