<?php
/** Our_Staff block **/
if(!class_exists('Our_Staff')) {
	class Our_Staff extends AQ_Block {
	
		//set and create block
		function __construct() {
			$block_options = array(
				'name' => 'Our Staff',
				'size' => 'span6',
			);
			
			//create the block
			parent::__construct('our_staff', $block_options);
			
			//add ajax functions
			add_action('wp_ajax_aq_block_staffsocial_add_new', array($this, 'add_staffsocial'));
		}
	
		function form($instance) {
			
			$defaults = array(
				'staff_name' => '',
				'desc' => '',
				'photo' => '#',
				'photo_back' => '#',
				'bg' => 'cover',
				'link' => '#',
				'link_text' => 'Follow',
				'staffsocials' => array(
						1 => array(
							'sociallink' => '',
							'socialicon' => ''
						)
					)
			);
			
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
				$bg_type = array (
					'cover' => 'cover',
					'repeat' => 'repeat'
				);
			
			?>
			<p class="description">
				<label for="<?php echo $this->get_field_id('staff_name') ?>">
					Name
					<?php echo aq_field_input('staff_name', $block_id, $staff_name, $size = 'full') ?>
				</label>
			</p>
			
			<p class="description">
				<label for="<?php echo $this->get_field_id('desc') ?>">
					Description
					<?php echo aq_field_input('desc', $block_id, $desc, $size = 'full') ?>
				</label>
			</p>
			<p class="description">
				<label for="<?php echo $this->get_field_id('photo') ?>">
					Photo
					<?php echo aq_field_upload('photo', $block_id, $photo, 'image') ?>
				</label>
			</p>
			<p class="description">
				<label for="<?php echo $this->get_field_id('photo_back') ?>">
					Photo Background
					<?php echo aq_field_upload('photo_back', $block_id, $photo_back, 'image') ?>
				</label>
			</p>
			<p class="description">
				<label for="<?php echo $this->get_field_id('bg') ?>">
					Background Type 
					<?php echo aq_field_select('bg', $block_id, $bg_type, $bg) ?>
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
					Link Text
					<?php echo aq_field_input('link_text', $block_id, $link_text, $size = 'full') ?>
				</label>
			</p>
			<div class="description cf">
				<ul id="aq-sortable-list-<?php echo $block_id ?>" class="aq-sortable-list" rel="<?php echo $block_id ?>">
					<?php
					$count = 0;
					foreach($staffsocials as $staffsocial) {
						$this->staffsocial($staffsocial, $count);
						$count++;
					}
					?>
				</ul>
				<p></p>
				<a href="#" rel="staffsocial" class="aq-sortable-add-new button">Add New</a>
				<p></p>
			</div>
			
			<?php
		}
		
		function staffsocial($staffsocial = array(), $count = 0) {
				
			?>
			<li id="<?php echo $this->get_field_id('staffsocials') ?>-sortable-item-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">
				
				<div class="sortable-head cf">
					<div class="sortable-title">
						<strong>Add Social</strong>
					</div>
					<div class="sortable-handle">
						<a href="#">Open / Close</a>
					</div>
				</div>
				
				<div class="sortable-body">
					<p class="tab-desc description">
						<label for="<?php echo $this->get_field_id('staffsocials') ?>-<?php echo $count ?>-link">
							Social Link<br/>
							<input type="text" id="<?php echo $this->get_field_id('staffsocials') ?>-<?php echo $count ?>-link" class="input-full" name="<?php echo $this->get_field_name('staffsocials') ?>[<?php echo $count ?>][sociallink]" value="<?php echo $staffsocial['sociallink'] ?>" />
						</label>
					</p>
					<p class="description">
						<label for="<?php echo $this->get_field_id('staffsocials') ?>">
							Social Icon<br/>
							<?php 
					$icons = array (  	  
						'github'=>'github',
						'github-circled'=>'github-circled',
						'flickr'=>'flickr',
						'flickr-circled'=>'flickr-circled',
						'vimeo'=>'vimeo',
						'vimeo-circled'=>'vimeo-circled',
						'twitter'=>'twitter',
						'twitter-circled'=>'twitter-circled',
						'facebook'=>'facebook',
						'facebook-circled'=>'facebook-circled',
						'facebook-squared'=>'facebook-squared',
						'gplus'=>'gplus',
						'gplus-circled'=>'gplus-circled',
						'pinterest'=>'pinterest',
						'pinterest-circled'=>'pinterest-circled',
						'tumblr'=>'tumblr',
						'tumblr-circled'=>'tumblr-circled',
						'linkedin'=>'linkedin',
						'linkedin-circled'=>'linkedin-circled',
						'dribbble'=>'dribbble',
						'dribbble-circled'=>'dribbble-circled',
						'stumbleupon'=>'stumbleupon',
						'stumbleupon-circled'=>'stumbleupon-circled',
						'lastfm'=>'lastfm',
						'lastfm-circled'=>'lastfm-circled',
						'rdio'=>'rdio',
						'rdio-circled'=>'rdio-circled',
						'spotify'=>'spotify',
						'spotify-circled'=>'spotify-circled',
						'qq'=>'qq',
						'instagram'=>'instagram',
						'dropbox'=>'dropbox',
						'evernote'=>'evernote',
						'flattr'=>'flattr',
						'skype'=>'skype',
						'skype-circled'=>'skype-circled',
						'renren'=>'renren',
						'sina-weibo'=>'sina-weibo',
						'paypal'=>'paypal',
						'picasa'=>'picasa',
						'soundcloud'=>'soundcloud',
						'mixi'=>'mixi',
						'behance'=>'behance',
						'google-circles'=>'google-circles',
						'vkontakte'=>'vkontakte',
						'smashing'=>'smashing'
			);
			
						if(isset($staffsocial['socialicon'])) {
						?>
							<select id="<?php echo $this->get_field_id('staffsocials') ?>-<?php echo $count ?>-socialicon" class="icon-select" name="<?php echo $this->get_field_name('staffsocials') ?>[<?php echo $count ?>][socialicon]">
						
							<?php 
							$count=0;
							foreach($icons as $key=>$value) {  ?>
								
							<option value="<?php echo $key; ?>" <?php echo selected( $staffsocial['socialicon'], $key, false ) ?> class="icon-<?php echo htmlspecialchars($value); ?>"><?php echo htmlspecialchars($value); ?></option>
							

							<? 
							 $count++; 
							
							} ?>
		
		
							</select>
							
						<?php } else { ?>
						
							<select id="<?php echo $this->get_field_id('staffsocials') ?>-<?php echo $count ?>-socialicon" class="icon-select" name="<?php echo $this->get_field_name('staffsocials') ?>[<?php echo $count ?>][socialicon]">
						
							<?php 
							$count=0;
							foreach($icons as $icon) {  ?>
								
							<option value="<?php echo $icon; ?>" class="icon-<?php echo $icon; ?>"><?php echo htmlspecialchars($icon); ?></option>
							

							<? 
							 $count++; 
							
							} ?>
		
		
							</select>						
						
						
						
						<?php } ?>


						</label>
					</p>
	
					<p class="tab-desc description"><a href="#" class="sortable-delete">Delete</a></p>
				</div>
				
			</li>
			<?php
		}
		
		
	
		function block($instance) {
			extract($instance);
	
			$output = '<div class="page-content clearfix">
						<div class="team-box">';
						
			if ($photo != '') {	
				$photo = aq_resize($photo,151,151,true);
				
				$output .= '<div class="photo_bg" style="background-image:url('.$photo_back.');';
				
					if ($bg == "repeat") { 
						$output .= 'background-repeat:repeat;';
					}
				
					if ($bg == "cover") { 
						$output .= 'background-size:cover;';
					}
				
				$output .= '"><div class="circle-wrap">
								
								<img src="'.$photo.'" alt=""/>
								
							</div></div>';
				}
							
				$output .= '<h4>'.$staff_name.'</h4>
							
							<span>'.$desc.'</span>';
							
				if ($link != '' or $link_text != '') {
							
					$output .= '<a href="'.$link.'" class="button staff">'.$link_text.'</a>';
							
				}
						
				$output .= '</div>
				
						<div class="social-block">
							<ul class="team-social">';
							
							foreach( $staffsocials as $staffsocial ){
								$output .= '<li><a href="'.$staffsocial['sociallink'].'" class="icon-'.$staffsocial['socialicon'].'"></a></li>';
							}
	
							$output .= '</ul>
						</div>
						
					</div>';
					
				echo $output;
	
			
		}
	
	
		/* AJAX add tab */
		function add_staffsocial() {
			$nonce = $_POST['security'];
			if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
			
			$count = isset($_POST['count']) ? absint($_POST['count']) : false;
			$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-999999';
			
			//default key/value for the tab
			$staffsocial = array(
				'text' => 'New Social', 
				'sociallink' => '',
				'socialicon' => ''
			);
			
			if($count) {
				$this->staffsocial($staffsocial, $count);
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
