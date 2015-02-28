<?php
/* Aqua Process Block */
if(!class_exists('Process_Block')) {
	class Process_Block extends AQ_Block {
	
		function __construct() {
			$block_options = array(
				'name' => 'Process',
				'size' => 'span12',
			);
			
			//create the widget
			parent::__construct('Process_Block', $block_options);
			
			//add ajax functions
			add_action('wp_ajax_aq_block_proc_add_new', array($this, 'add_proc'));
			
		}
		
		function form($instance) {
		
			$defaults = array(
				'procs' => array(
					1 => array(
						'title' => 'New Step',
						'image' => '',
						'descr' => ''
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
					foreach($procs as $proc) {	
						$this->proc($proc, $count);
						$count++;
					}
					?>
				</ul>
				<p></p>
				<a href="#" rel="proc" class="aq-sortable-add-new button">Add New</a>
				<p></p>
			</div>
			<?php
		}
		
		function proc($proc = array(), $count = 0) {
				
			?>
			<li id="<?php echo $this->get_field_id('procs') ?>-sortable-item-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">
				
				<div class="sortable-head cf">
					<div class="sortable-title">
						<strong><?php echo $proc['title'] ?></strong>
					</div>
					<div class="sortable-handle">
						<a href="#">Open / Close</a>
					</div>
				</div>
				
				<div class="sortable-body">
					<p class="tab-desc description">
						<label for="<?php echo $this->get_field_id('procs') ?>-<?php echo $count ?>-image">
							Choose an Image<br/>
		                    <input type="text" id="<?php echo $this->get_field_id('procs') ?>-<?php echo $count ?>-image" class="input-full input-upload"  name="<?php echo $this->get_field_name('procs') ?>[<?php echo $count ?>][image]" value="<?php echo $proc['image'] ?>" />
		                    <a href="#" class="aq_upload_button button" rel="image">Upload</a><p></p>
						</label>
					</p>
					<p class="tab-desc description">
						<label for="<?php echo $this->get_field_id('procs') ?>-<?php echo $count ?>-title">
							Title<br/>
							<input type="text" id="<?php echo $this->get_field_id('procs') ?>-<?php echo $count ?>-title" class="input-full" name="<?php echo $this->get_field_name('procs') ?>[<?php echo $count ?>][title]" value="<?php echo $proc['title'] ?>" />
						</label>
					</p>
					<p class="tab-desc description">
						<label for="<?php echo $this->get_field_id('procs') ?>-<?php echo $count ?>-descr">
						Description<br/>
							<textarea id="<?php echo $this->get_field_id('procs') ?>-<?php echo $count ?>-descr" class="textarea-full" name="<?php echo $this->get_field_name('procs') ?>[<?php echo $count ?>][descr]" rows="5"><?php echo $proc['descr'] ?></textarea>
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
			
			$output .= '<div class="row"><div class="process-divider"></div>';

					foreach($procs as $proc) {

						$output .= '<div class="one_third"><div class="process-part clearfix">';
					
							if ($proc['image'] != '') {
					
								$output .= '<div class=""><img src="'.$proc['image'].'" alt=""/></div>';
							}
						
						$output .= '<h5>'.$proc['title'].'</h5>';
			
						$output .= '<p>'.$proc['descr'].'</p>';
					
						$output .= '</div></div>';

					}
					
			$output .= '</div>';	
			
			echo $output;
			
		}
		/* AJAX add proc */
		function add_proc() {
			$nonce = $_POST['security'];
			if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
			
			$count = isset($_POST['count']) ? absint($_POST['count']) : false;
			$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
			
			//default key/value for the proc
			$proc = array(
				'title' => 'New Step',
				'descr' => '',
				'image' => ''
			);
			
			if($count) {
				$this->proc($proc, $count);
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
