<?php
/* Price Block */
if(!class_exists('Price_Block')) {
	class Price_Block extends AQ_Block {
	
		function __construct() {
			$block_options = array(
				'name' => 'Price Block',
				'size' => 'span6',
			);
			
			//create the widget
			parent::__construct('price_block', $block_options);
			
			//add ajax functions
			add_action('wp_ajax_aq_block_price_add_new', array($this, 'add_price'));
			
		}
		
		function form($instance) {
		
			$defaults = array(
				'title' => '',
				'curr' => '',
				'price' => '',
				'per' => '',
				'link' => '',
				'link_text' => '',
				'style' => 'none',
				'prices' => array(
					1 => array(
						'text' => 'Text'
					)
				)
			);
			
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
			$block_types = array(
				'active' => 'Active',
				'non-active' => 'None'
			);			

			
			?>
		<p class="description">
			<label for="<?php echo $this->get_field_id('title') ?>">
				Title
				<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
			</label>
		</p>
		<p class="description">
			<label for="<?php echo $this->get_field_id('curr') ?>">
				Currency
				<?php echo aq_field_input('curr', $block_id, $curr, $size = 'full') ?>
			</label>
		</p>		
		<p class="description">
			<label for="<?php echo $this->get_field_id('price') ?>">
				Price
				<?php echo aq_field_input('price', $block_id, $price, $size = 'full') ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('per') ?>">
				Period
				<?php echo aq_field_input('per', $block_id, $per, $size = 'full') ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('link') ?>">
				Link
				<?php echo aq_field_input('link', $block_id, $link, $size = 'full') ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('link_text') ?>">
				Link text
				<?php echo aq_field_input('link_text', $block_id, $link_text, $size = 'full') ?>
			</label>
		</p>	

			
			<div class="description cf">
				<ul id="aq-sortable-list-<?php echo $block_id ?>" class="aq-sortable-list" rel="<?php echo $block_id ?>">
					<?php
					$count = 0;
					foreach($prices as $price) {
						$this->price($price, $count);
						$count++;
					}
					?>
				</ul>
				<p></p>
				<a href="#" rel="price" class="aq-sortable-add-new button">Add New</a>
				<p></p>
			</div>

		<p class="description">
			<label for="<?php echo $this->get_field_id('style') ?>">
				Block style<br/>
				<?php echo aq_field_select('style', $block_id, $block_types, $style) ?>
			</label>
		</p>
			
			<?php
		}
		
		function price($price = array(), $count = 0) {
				
			?>
			<li id="<?php echo $this->get_field_id('prices') ?>-sortable-item-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">
				
				<div class="sortable-head cf">
					<div class="sortable-title">
						<strong><?php echo $price['text'] ?></strong>
					</div>
					<div class="sortable-handle">
						<a href="#">Open / Close</a>
					</div>
				</div>
				
				<div class="sortable-body">
					<p class="tab-desc description">
						<label for="<?php echo $this->get_field_id('prices') ?>-<?php echo $count ?>-text">
							Text<br/>
							<input type="text" id="<?php echo $this->get_field_id('prices') ?>-<?php echo $count ?>-text" class="input-full" name="<?php echo $this->get_field_name('prices') ?>[<?php echo $count ?>][text]" value="<?php echo $price['text'] ?>" />
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
					$output .= '<div class="pricing-table '.$style.'">					
						<header>						
							<div class="pricing-title">								
								<h3>'.$title.'</h3>								
							</div>							
							<div class="price-section">							
								<h2>'.$curr.''.$price.'';
	if($per !=""){
		$output .= '/<span>'.$per.'</span>';
	}
		$output .= '</h2>							
					</div>						
					</header>						
					<article>';	
						foreach( $prices as $price ){
							$output .= "<p>{$price['text']}</p>";
						}
		$output .= '</article>						
						<footer>						
							<a href="'.$link.'" class="button little">'.$link_text.'</a>						
						</footer>										
					</div>';
				
	echo $output;
	
		}
		
		/* AJAX add tab */
		function add_price() {
			$nonce = $_POST['security'];
			if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
			
			$count = isset($_POST['count']) ? absint($_POST['count']) : false;
			$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-99999';
			
			//default key/value for the tab
			$price = array(
				'text' => 'New text'
			);
			
			if($count) {
				$this->price($price, $count);
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
