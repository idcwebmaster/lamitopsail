<?php
/* Aqua Tabs Block */
if(!class_exists('Tabs_Block')) {
	class Tabs_Block extends AQ_Block {
	
		function __construct() {
			$block_options = array(
				'name' => 'Tabs &amp; Toggles',
				'size' => 'span6',
			);
			
			//create the widget
			parent::__construct('Tabs_Block', $block_options);
			
			//add ajax functions
			add_action('wp_ajax_aq_block_tab_add_new', array($this, 'add_tab'));
			
		}
		
		function form($instance) {
		
			$defaults = array(
				'type'	=> 'tab',
				'tabs' => array(
					1 => array(
						'title' => 'My New Tab',
						'icon' => '',
						'content' => 'My tab contents'
					)
				)
			);
			
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
			$tab_types = array(
				'tab_hor' => 'Horizontal Tabs',
				'tab_ver' => 'Vertical Tabs',
				'toggle' => 'Toggles',
				'accordion' => 'Accordion'
			);
			
			
			?>
			<div class="description cf">
				<ul id="aq-sortable-list-<?php echo $block_id ?>" class="aq-sortable-list" rel="<?php echo $block_id ?>">
					<?php
					$count = 0;
					foreach($tabs as $tab) {	
						$this->tab($tab, $count);
						$count++;
					}
					?>
				</ul>
				<p></p>
				<a href="#" rel="tab" class="aq-sortable-add-new button">Add New</a>
				<p></p>
			</div>
			<p class="description">
				<label for="<?php echo $this->get_field_id('type') ?>">
					Tabs style<br/>
					<?php echo aq_field_select('type', $block_id, $tab_types, $type) ?>
				</label>
			</p>
			<?php
		}
		
		function tab($tab = array(), $count = 0) {
				
			?>
			<li id="<?php echo $this->get_field_id('tabs') ?>-sortable-item-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">
				
				<div class="sortable-head cf">
					<div class="sortable-title">
						<strong><?php echo $tab['title'] ?></strong>
					</div>
					<div class="sortable-handle">
						<a href="#">Open / Close</a>
					</div>
				</div>
				
				<div class="sortable-body">
					<p class="tab-desc description">
						<label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-title">
							Tab Title<br/>
							<input type="text" id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-title" class="input-full" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][title]" value="<?php echo $tab['title'] ?>" />
						</label>
					</p>
					<p class="tab-desc description">
						<label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-content">
							<a href="#" class="editing button-primary">Edit Text</a>
							<textarea id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-content" class="textarea-full" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][content]" rows="5"><?php echo $tab['content'] ?></textarea>
						</label>
					</p>
					<p class="description">
						<label for="<?php echo $this->get_field_id('icon') ?>">
							Choose an Icon<br/>
							<?php 
					$icons = array (  	  
'note' =>								'note' ,
'logo-db'  =>                           'logo-db'  ,
'music'  =>                             'music'  ,
'search'  =>                            'search'  ,
'flashlight'  =>                        'flashlight'  ,
'mail'  =>                              'mail'  ,
'heart'  =>                             'heart'  ,
'heart-empty'  =>                       'heart-empty' ,
'star'  =>                              'star'  ,
'star-empty'  =>                        'star-empty' ,
'user'  =>                              'user'  ,
'users'  =>                             'users'  ,
'user-add'  =>                          'user-add'  ,
'video'  =>                             'video'  ,
'picture'  =>                           'picture'  ,
'camera'  =>                            'camera' ,
'layout'  =>                            'layout' ,
'menu'  =>                              'menu'  ,
'check'  =>                             'check' ,
'cancel'  =>                            'cancel'  ,
'cancel-circled'  =>                    'cancel-circled'  ,
'cancel-squared'  =>                    'cancel-squared'  ,
'plus'  =>                              'plus' ,
'plus-circled'  =>                      'plus-circled'  ,
'plus-squared'  =>                      'plus-squared'  ,
'minus'  =>                             'minus'  ,
'minus-circled'  =>                     'minus-circled'  ,
'minus-squared'  =>                     'minus-squared'  ,
'help'  =>                              'help'  ,
'help-circled'  =>                      'help-circled' ,
'info'  =>                              'info'  ,
'info-circled'  =>                      'info-circled' ,
'back'  =>                              'back' ,
'home'  =>                              'home'  ,
'link'  =>                              'link' ,
'attach'  =>                            'attach'  ,
'lock'  =>                              'lock'  ,
'lock-open'  =>                         'lock-open'  ,
'eye'  =>                               'eye'  ,
'tag'  =>                               'tag'  ,
'bookmark'  =>                          'bookmark'  ,
'bookmarks'  =>                         'bookmarks' ,
'flag'  =>                              'flag'  ,
'thumbs-up'  =>                         'thumbs-up' ,
'thumbs-down'  =>                       'thumbs-down'  ,
'download'  =>                          'download' ,
'upload'  =>                            'upload' ,
'upload-cloud'  =>                      'upload-cloud' ,
'reply'  =>                             'reply'  ,
'reply-all'  =>                         'reply-all'  ,
'forward'  =>                           'forward'  ,
'quote'  =>                             'quote' ,
'export'  =>                            'export'  ,
'pencil'  =>                            'pencil' ,
'feather'  =>                           'feather'  ,
'print'  =>                             'print' ,
'retweet'  =>                           'retweet'  ,
'keyboard'  =>                          'keyboard' ,
'comment'  =>                           'comment' ,
'chat'  =>                              'chat'  ,
'bell'  =>                              'bell'  ,
'attention'  =>                         'attention' ,
'alert'  =>                             'alert'  ,
'vcard' =>                              'vcard' ,
'address'  =>                           'address'  ,
'location'  =>                          'location'  ,
'map'  =>                               'map'  ,
'direction'  =>                         'direction'  ,
'compass'  =>                           'compass' ,
'cup'  =>                               'cup' ,
'trash'  =>                             'trash'  ,
'newspaper'  =>                         'newspaper'  ,
'book-open'  =>                         'book-open'  ,
'book'  =>                              'book'  ,
'folder'  =>                            'folder'  ,
'archive'  =>                           'archive'  ,
'box'  =>                               'box'  ,
'rss'  =>                               'rss'  ,
'phone'  =>                             'phone'  ,
'cog'  =>                               'cog'  ,
'tools'  =>                             'tools'  ,
'share'  =>                             'share' ,
'shareable'  =>                         'shareable'  ,
'basket'  =>                            'basket'  ,
'bag'  =>                               'bag'  ,
'calendar'  =>                          'calendar' ,
'login'  =>                             'login'  ,
'logout'  =>                            'logout'  ,
'mic'  =>                               'mic'  ,
'mute'  =>                              'mute'  ,
'sound'  =>                             'sound' ,
'clock'  =>                             'clock'  ,
'hourglass'  =>                         'hourglass'  ,
'lamp'  =>                              'lamp'  ,
'light-down'  =>                        'light-down' ,
'light-up'  =>                          'light-up'  ,
'adjust'  =>                            'adjust'  ,
'block'  =>                             'block'  ,
'popup'  =>                             'popup'  ,
'publish'  =>                           'publish'  ,
'window'  =>                            'window'  ,
'arrow-combo'  =>                       'arrow-combo'  ,
'down-circled'  =>                      'down-circled'  ,
'left-circled'  =>                      'left-circled'  ,
'right-circled'  =>                     'right-circled'  ,
'up-circled'  =>                        'up-circled'  ,
'down-open'  =>                         'down-open'  ,
'left-open'  =>                         'left-open'  ,
'right-open'  =>                        'right-open'  ,
'up-open'  =>                           'up-open'  ,
'down-open-mini'  =>                    'down-open-mini'  ,
'left-open-mini'  =>                    'left-open-mini'  ,
'right-open-mini'  =>                   'right-open-mini'  ,
'up-open-mini'  =>                      'up-open-mini' ,
'down-open-big'  =>                     'down-open-big'  ,
'left-open-big'  =>                     'left-open-big'  ,
'right-open-big' =>                     'right-open-big' ,
'up-open-big'  =>                       'up-open-big' ,
'down'  =>                              'down'  ,
'left'  =>                              'left'  ,
'right'  =>                             'right'  ,
'up'  =>                                'up' ,
'down-dir'  =>                          'down-dir'  ,
'left-dir'  =>                          'left-dir'  ,
'right-dir'  =>                         'right-dir'  ,
'up-dir'  =>                            'up-dir'  ,
'down-bold'  =>                         'down-bold'  ,
'left-bold'  =>                         'left-bold'  ,
'right-bold'  =>                        'right-bold'  ,
'note-beamed'  =>                       'note-beamed'  ,
'down-thin'  =>                         'down-thin'  ,
'left-thin'  =>                         'left-thin'  ,
'right-thin'  =>                        'right-thin'  ,
'up-thin'  =>                           'up-thin'  ,
'ccw'  =>                               'ccw' ,
'cw'  =>                                'cw' ,
'arrows-ccw'  =>                        'arrows-ccw'  ,
'level-down'  =>                        'level-down'  ,
'shuffle'  =>                           'shuffle'  ,
'switch'  =>                            'switch' ,
'play'  =>                              'play'  ,
'stop'  =>                              'stop'  ,
'pause'  =>                             'pause'  ,
'record'  =>                            'record'  ,
'to-end'  =>                            'to-end'  ,
'to-start'  =>                          'to-start'  ,
'fast-forward'  =>                      'fast-forward'  ,
'fast-backward'  =>                     'fast-backward'  ,
'palette'  =>                           'palette'  ,
'signal'  =>                            'signal'  ,
'trophy'  =>                            'trophy'  ,
'battery'  =>                           'battery'  ,
'back-in-time'  =>                      'back-in-time'  ,
'monitor'  =>                           'monitor'  ,
'mobile'  =>                            'mobile' ,
'network'  =>                           'network'  ,
'cd'  =>                                'cd'  ,
'inbox'  =>                             'inbox'  ,
'install'  =>                           'install'  ,
'globe'  =>                             'globe'  ,
'cloud'  =>                             'cloud'  ,
'cloud-thunder'  =>                     'cloud-thunder'  ,
'flash'  =>                             'flash' ,
'moon'  =>                              'moon'  ,
'flight'  =>                            'flight'  ,
'paper-plane'  =>                       'paper-plane'  ,
'leaf'  =>                              'leaf'  ,
'lifebuoy'  =>                          'lifebuoy'  ,
'mouse'  =>                             'mouse' ,
'briefcase'  =>                         'briefcase' ,
'suitcase'  =>                          'suitcase'  ,
'brush'  =>                             'brush' ,
'magnet'  =>                            'magnet'  ,
'infinity'  =>                          'infinity' ,
'erase'  =>                             'erase'  ,
'chart-pie'  =>                         'chart-pie' ,
'chart-line'  =>                        'chart-line'  ,
'chart-bar'  =>                         'chart-bar'  ,
'chart-area'  =>                        'chart-area'  ,
'tape'  =>                              'tape'  ,
'graduation-cap'  =>                    'graduation-cap'  ,
'language'  =>                          'language'  ,
'ticket'  =>                            'ticket'  ,
'water'  =>                             'water'  ,
'droplet'  =>                           'droplet' ,
'air'  =>                               'air'  ,
'credit-card'  =>                       'credit-card'  ,
'floppy'  =>                            'floppy'  ,
'clipboard'  =>                         'clipboard'  ,
'megaphone'  =>                         'megaphone' ,
'database'  =>                          'database' ,
'drive'  =>                             'drive'  ,
'bucket'  =>                            'bucket' ,
'thermometer'  =>                       'thermometer' ,
'key'  =>                               'key'  ,
'flow-parallel'  =>                     'flow-parallel'  ,
'rocket'  =>                            'rocket'  ,
'gauge'  =>                             'gauge' ,
'traffic-cone'  =>                      'traffic-cone'  ,
'cc'  =>                                'cc'  ,
'cc-by'  =>                             'cc-by'  ,
'cc-nc'  =>                             'cc-nc'  ,
'cc-nc-eu'  =>                          'cc-nc-eu'  ,
'cc-nc-jp'  =>                          'cc-nc-jp'  ,
'cc-sa'  =>                             'cc-sa'  ,
'cc-nd'  =>                             'cc-nd'  ,
'cc-pd'  =>                             'cc-pd'  ,
'cc-zero'  =>                           'cc-zero'  ,
'cc-share'  =>                          'cc-share'  ,
'cc-remix'  =>                          'cc-remix'  ,
'github'  =>                            'github' ,
'github-circled'  =>                    'github-circled'  ,
'flickr'  =>                            'flickr'  ,
'flickr-circled'  =>                    'flickr-circled'  ,
'vimeo'  =>                             'vimeo'  ,
'vimeo-circled'  =>                     'vimeo-circled'  ,
'twitter'  =>                           'twitter'  ,
'twitter-circled'  =>                   'twitter-circled'  ,
'facebook'  =>                          'facebook'  ,
'facebook-circled'  =>                  'facebook-circled'  ,
'facebook-squared'  =>                  'facebook-squared' ,
'gplus'  =>                             'gplus'  ,
'gplus-circled'  =>                     'gplus-circled'  ,
'pinterest'  =>                         'pinterest' ,
'pinterest-circled'  =>                 'pinterest-circled'  ,
'tumblr'  =>                            'tumblr' ,
'tumblr-circled'  =>                    'tumblr-circled' ,
'linkedin'  =>                          'linkedin'  ,
'linkedin-circled'  =>                  'linkedin-circled' ,
'dribbble'  =>                          'dribbble' ,
'dribbble-circled'  =>                  'dribbble-circled'  ,
'stumbleupon'  =>                       'stumbleupon' ,
'stumbleupon-circled'  =>               'stumbleupon-circled' ,
'lastfm'  =>                            'lastfm'  ,
'lastfm-circled'  =>                    'lastfm-circled'  ,
'rdio'  =>                              'rdio' ,
'rdio-circled'  =>                      'rdio-circled'  ,
'spotify'  =>                           'spotify'  ,
'spotify-circled'  =>                   'spotify-circled' ,
'qq'  =>                                'qq'  ,
'instagram'  =>                         'instagram'  ,
'dropbox'  =>                           'dropbox'  ,
'evernote'  =>                          'evernote'  ,
'flattr'  =>                            'flattr'  ,
'skype'  =>                             'skype'  ,
'skype-circled'  =>                     'skype-circled' ,
'renren'  =>                            'renren'  ,
'sina-weibo'  =>                        'sina-weibo'  ,
'paypal'  =>                            'paypal'  ,
'picasa'  =>                            'picasa'  ,
'soundcloud'  =>                        'soundcloud'  ,
'mixi'  =>                              'mixi'  ,
'behance'  =>                           'behance'  ,
'google-circles'  =>                    'google-circles'  ,
'vkontakte'  =>                         'vkontakte' ,
'smashing'  =>                          'smashing',
'sweden'  =>                            'sweden'  ,
'db-shape'  =>                          'db-shape'  ,
'up-bold'  =>                           'up-bold'  

			);
			
						if(isset($tab['icon'])) {
						?>
							<select id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-icon" class="icon-select" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][icon]">
						
							<?php 
							$count=0;
							foreach($icons as $key=>$value) {  ?>
								
							<option value="<?php echo $key; ?>" <?php echo selected( $tab['icon'], $key, false ) ?> class="icon-<?php echo htmlspecialchars($value); ?>"><?php echo htmlspecialchars($value); ?></option>		

							<? 
							 $count++; 
							
							} ?>
		
							</select>
							
							<?php } else { ?>
						
							<select id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-icon" class="icon-select" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][icon]">
						
							<?php
							 
							$count=0;
							
							foreach($icons as $icon) {  ?>
								
							<option value="<?php echo $icon; ?>" class="icon-<?php echo $icon; ?>"><?php echo $icon; ?></option>

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
			
			wp_enqueue_script('jquery-ui-tabs');
			
			$output = '';
			
			if($type == 'tab_hor') {
			
				$output .= '<div id="block_tabs_'. rand(1, 100) .'" class="block_tabs"><div class="tab-inner tabs_horizontal">';
					$output .= '<ul class="aq-nav cf">';
					
					$i = 1;
					foreach( $tabs as $tab ){
						$tab_selected = $i == 1 ? 'ui-tabs-active' : '';
						$output .= '<li class="'.$tab_selected.'"><a href="#tab-'. sanitize_title( $tab['title'] ) . $i .'">' . $tab['title'] . '</a></li>';
						$i++;
					}
					
					$output .= '</ul>';
					
					$i = 1;
					foreach($tabs as $tab) {
						
						$output .= '<div id="tab-'. sanitize_title( $tab['title'] ) . $i .'" class="tab">'. wpautop(do_shortcode(htmlspecialchars_decode($tab['content']))) .'</div>';
						
						$i++;
					}
				
				$output .= '</div></div>';
				
			} elseif($type == 'tab_ver') {
			
				$output .= '<div id="block_tabs_'. rand(1, 100) .'" class="block_tabs"><div class="tab-inner tabs_vertical clearfix">';
					$output .= '<ul class="aq-nav cf">';
					
					$i = 1;
					foreach( $tabs as $tab ){
						$tab_selected = $i == 1 ? 'ui-tabs-active' : '';
						$output .= '<li class="'.$tab_selected.'"><a href="#tab-'. sanitize_title( $tab['title'] ) . $i .'"><i class="icon-'.$tab['icon'].'"></i>' . $tab['title'] . '</a></li>';
						$i++;
					}
					
					$output .= '</ul>';
					
					$i = 1;
					foreach($tabs as $tab) {
						
						$output .= '<div id="tab-'. sanitize_title( $tab['title'] ) . $i .'" class="tab">'. wpautop(do_shortcode(htmlspecialchars_decode($tab['content']))) .'</div>';
						
						$i++;
					}
				
				$output .= '</div></div>';
				
			} elseif ($type == 'toggle') {
			
				$count = count($tabs);
				$i = 1;
				
				$output .= '<div id="block_toggles_wrapper_'.rand(1,100).'" class="block_toggles_wrapper">';
				
				foreach( $tabs as $tab ){
				
					$open = $i == 1 ? 'open' : 'close';
					
					$child = '';
					if($i == 1) $child = 'first-child';
					if($i == $count) $child = 'last-child';
					$i++;
					
					$output  .= '<div class="block_toggle '.$child.'">';
						$output .= '<div class="tab-head"><p>'. $tab['title'] .'</p></div>';
						$output .= '<div class="arrow"></div>';
						$output .= '<div class="tab-body close cf">';
							$output .= wpautop(do_shortcode(htmlspecialchars_decode($tab['content'])));
						$output .= '</div>';
					$output .= '</div>';
				}
				
				$output .= '</div>';
				
			} elseif ($type == 'accordion') {
				
				$count = count($tabs);
				$i = 1;
				
				$output .= '<div id="block_accordion_wrapper_'.rand(1,100).'" class="block_accordion_wrapper">';
				
				foreach( $tabs as $tab ){
					
					$open = $i == 1 ? 'open' : 'close';
					
					$child = '';
					if($i == 1) $child = 'first-child';
					if($i == $count) $child = 'last-child';
					$i++;
					
					$output  .= '<div class="block_accordion '.$child.'">';
						$output .= '<div class="tab-head"><p>'. $tab['title'] .'</p></div>';
						$output .= '<div class="tab-body '.$open.' cf">';
							$output .= wpautop(do_shortcode(htmlspecialchars_decode($tab['content'])));
						$output .= '</div>';
					$output .= '</div>';
				}
				
				$output .= '</div>';
				
			}
			
			echo $output;
			
		}
		/* AJAX add tab */
		function add_tab() {
			$nonce = $_POST['security'];
			if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
			
			$count = isset($_POST['count']) ? absint($_POST['count']) : false;
			$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
			
			//default key/value for the tab
			$tab = array(
				'title' => 'New Tab',
				'content' => 'New Content',
				'icon' => ''
			);
			
			if($count) {
				$this->tab($tab, $count);
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
