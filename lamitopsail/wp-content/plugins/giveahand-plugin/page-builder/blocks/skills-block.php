<?php
/* Skills Block */
if(!class_exists('Skills_Block')) {
	class Skills_Block extends AQ_Block {
	
		function __construct() {
			$block_options = array(
				'name' => 'Skills',
				'size' => 'span6',
			);
			
			//create the widget
			parent::__construct('Skills_Block', $block_options);
			
			//add ajax functions
			add_action('wp_ajax_aq_block_skill_add_new', array($this, 'add_skill'));
			
		}
		
		function form($instance) {
		
			$defaults = array(
				'block_title' => '',
				'skills' => array(
					1 => array(
						'title' => 'New Skill',
						'content' => '50',
						'color' => '',
					)
				)
			);
			
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
			
			?>
			<p class="description">
			
				<label for="<?php echo $this->get_field_id('block_title') ?>">
					Block Title
					<?php echo aq_field_input('block_title', $block_id, $block_title, $size = 'full') ?>
				</label>
				
			</p>
			
			<div class="description cf">
				<ul id="aq-sortable-list-<?php echo $block_id ?>" class="aq-sortable-list" rel="<?php echo $block_id ?>">
					<?php
					$count = 0;
					foreach($skills as $skill) {
						$this->skill($skill, $count);
						$count++;
					}
					?>
				</ul>
				<p></p>
				<a href="#" rel="skill" class="aq-sortable-add-new button">Add New</a>
				<p></p>
			</div>

			<?php
		}
		
		function skill($skill = array(), $count = 0) {
				
			?>
			<li id="<?php echo $this->get_field_id('skills') ?>-sortable-item-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">
				
				<div class="sortable-head cf">
					<div class="sortable-title">
						<strong><?php echo $skill['title'] ?></strong>
					</div>
					<div class="sortable-handle">
						<a href="#">Open / Close</a>
					</div>
				</div>
				
				<div class="sortable-body">
					<p class="tab-desc description">
						<label for="<?php echo $this->get_field_id('skills') ?>-<?php echo $count ?>-title">
							Skill Title<br/>
							<input type="text" id="<?php echo $this->get_field_id('skills') ?>-<?php echo $count ?>-title" class="input-full" name="<?php echo $this->get_field_name('skills') ?>[<?php echo $count ?>][title]" value="<?php echo $skill['title'] ?>" />
						</label>
					</p>
					<p class="tab-desc description">
						<label for="<?php echo $this->get_field_id('skills') ?>-<?php echo $count ?>-content">
							Skill %<br/>
							<input type="text" id="<?php echo $this->get_field_id('skills') ?>-<?php echo $count ?>-content" class="input-full" name="<?php echo $this->get_field_name('skills') ?>[<?php echo $count ?>][content]" value="<?php echo $skill['content'] ?>" />
						</label>
					</p>
					<p class="tab-desc description">
					<label for="<?php echo $this->get_field_id('skills') ?>-<?php echo $count ?>-color">
							Skill Color<br/>
						<input type="text" id="<?php echo $this->get_field_id('skills') ?>-<?php echo $count ?>-color" name="<?php echo $this->get_field_name('skills') ?>[<?php echo $count ?>][color]" class="input-color-picker" value="<?php echo $skill['color'] ?>" />
						
						<p class="tab-desc description"><a href="#" class="sortable-delete">Delete</a></p>
					</label>	
					</p>
				</div>
			</li>
			<?php
		}
		
		function block($instance) {
			extract($instance);
			
			
			$output = '';
			
			$output .= '<h3 class="text-block-title">'.strip_tags($block_title).'</h3>';

			$output .= '<div class="animated-skills"><div class="animated-progressBar">';
			
			foreach( $skills as $skill ){
			
			$output .= "<div class=\"skill_bar\">
							<div data-position=\"{$skill['content']}\" class=\"skill_active\" style=\"background-color:{$skill['color']};\">
								<span style=\"background-color:{$skill['color']};\"></span>
								<i style=\"border-top:6px solid {$skill['color']};\"></i>
							</div>
						</div>";
			
			}
			
			$output .= "<div class=\"skills_wrap clearfix\">";
			
			foreach( $skills as $skill ){
			
			$output .= "<div class=\"skill_idwrap\"><div class=\"skill_id\" style=\"background-color:{$skill['color']};\"></div></div><div class=\"skill_name\">{$skill['title']}</div>";

			}
			
			$output .= '</div></div></div>';	

			
			echo $output;
			
		}
		
		/* AJAX add tab */
		function add_skill() {
			$nonce = $_POST['security'];
			if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
			
			$count = isset($_POST['count']) ? absint($_POST['count']) : false;
			$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-99999';
			
			//default key/value for the tab
			$skill = array(
				'title' => 'New Skill',
				'content' => '50',
				'color' => ''
			);
			
			if($count) {
				$this->skill($skill, $count);
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
