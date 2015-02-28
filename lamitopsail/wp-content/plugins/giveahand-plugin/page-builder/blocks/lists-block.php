<?php
/* lists Block */
if(!class_exists('Lists_Block')) {
	class lists_Block extends AQ_Block {
	
		function __construct() {
			$block_options = array(
				'name' => 'Lists',
				'size' => 'span6',
			);
			
			//create the widget
			parent::__construct('Lists_Block', $block_options);
			
			//add ajax functions
			add_action('wp_ajax_aq_block_list_add_new', array($this, 'add_list'));
			
		}
		
		function form($instance) {
		
			$defaults = array(
				'block_title' => '',
				'lists' => array(
					1 => array(
						'content' => '',
					)
				),
				'type'	=> '1',
				'color' => ''
			);
			
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			$list_types = array(
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
					foreach($lists as $list) {
						$this->lists($list, $count);
						$count++;
					}
					?>
				</ul>
				<p></p>
				<a href="#" rel="list" class="aq-sortable-add-new button">Add New</a>
				<p></p>
			</div>
			<p class="description">
				<label for="<?php echo $this->get_field_id('type') ?>">
					Lists style<br/>
					
						<select id="<?php echo $block_id; ?>_type ?>" name="aq_blocks[<?php echo $block_id; ?>][type]" class="icon-select">
						
						<?php foreach($list_types as $key=>$value) { ?>
						
							<option class="icon-<?php echo $value; ?>" value="<?php echo $key; ?>" <?php echo selected( $type, $key, false ) ?>><?php echo htmlspecialchars($value); ?></option>
			
						<?php } ?>
						
						</select>					
						
				</label>
			</p>
			<p class="description">
				<label for="<?php echo $this->get_field_id('color') ?>">
					Lists color<br/>			
					<?php echo aq_field_color_picker('color', $block_id, $color, $default='#2A3C52'); ?>
				</label>
			</p> 
			<?php
		}
		
		function lists($list = array(), $count = 0) {
				
			?>
			<li id="<?php echo $this->get_field_id('lists') ?>-sortable-item-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">
				
				<div class="sortable-head cf">
					<div class="sortable-title">
						<strong><?php echo 'List';?> - <?php echo $count+1;?></strong>
					</div>
					<div class="sortable-handle">
						<a href="#">Open / Close</a>
					</div>
				</div>
				
				<div class="sortable-body">
					<p class="tab-desc description">
						<label for="<?php echo $this->get_field_id('lists') ?>-<?php echo $count ?>-content">
							<a href="#" class="editing button-primary">Edit Text</a>
							<textarea id="<?php echo $this->get_field_id('lists') ?>-<?php echo $count ?>-content" class="textarea-full" name="<?php echo $this->get_field_name('lists') ?>[<?php echo $count ?>][content]" rows="5"><?php echo $list['content'] ?></textarea>
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
			
			$output .= '<h3 class="text-block-title">'.strip_tags($block_title).'</h3>';

			$output .= '<ul class="custom-lists">';
			
				foreach( $lists as $list ){
				
					$output .= "<li><i class=\"icon-{$type}\" style=\"color:{$color};\"></i>";
					$output .= do_shortcode(htmlspecialchars_decode($list['content']));
					$output .= "</li>";
				
				}

			$output .= '</ul>';	

			
			echo $output;
			
		}
		
		/* AJAX add tab */
		function add_list() {
			$nonce = $_POST['security'];
			if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
			
			$count = isset($_POST['count']) ? absint($_POST['count']) : false;
			$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-99999';
			
			//default key/value for the tab
			$list = array(
				'content' => ''
			);
			
			if($count) {
				$this->lists($list, $count);
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
