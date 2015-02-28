<?php
/* Aqua Tabs Block */
if(!class_exists('AQ_Tabs_Block')) {
	class AQ_Tabs_Block extends AQ_Block {
	
		function __construct() {
			$block_options = array(
				'name' => 'Tabs &amp; Toggles',
				'size' => 'span6',
			);
			
			//create the widget
			parent::__construct('AQ_Tabs_Block', $block_options);
			
			//add ajax functions
			add_action('wp_ajax_aq_block_tab_add_new', array($this, 'add_tab'));
			
		}
		
		function form($instance) {
		
			$defaults = array(
				'tabs' => array(
					1 => array(
						'title' => 'My New Tab',
						'content' => 'My tab contents',
					)
				),
				'type'	=> 'tab',
			);
			
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
			$tab_types = array(
				'tab' => 'Tabs',
				'toggle' => 'Toggles',
				'accordion' => 'Accordion'
			);
			
			?>
			<div class="description cf">
				<ul id="aq-sortable-list-<?php echo $block_id ?>" class="aq-sortable-list" rel="<?php echo $block_id ?>">
					<?php
					$tabs = is_array($tabs) ? $tabs : $defaults['tabs'];
					$count = 1;
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
			'asterisk'	  	  	  	  	 => 'asterisk'	  	   	  	  	 	  	  ,
			'plus'	                     => 'plus'	  		 					  ,
			'euro'	                     => 'euro'	  		 					  ,
			'minus'	                     => 'minus'	  		 					  ,
			'cloud'	                     => 'cloud'	  		 					  ,
			'envelope'                   => 'envelope'		 					  ,
			'pencil'                     => 'pencil'  		 					  ,
			'glass'	                     => 'glass'	  		 					  ,
			'music'	                     => 'music'	  		 					  ,
			'search'                     => 'search'  		 					  ,
			'heart'	                     => 'heart'	  		 					  ,
			'star'	                     => 'star'	  		 					  ,
			'star-empty'                 => 'star-empty'	 					  ,
			'user'	                     => 'user'	  		 					  ,
			'film'	                     => 'film'	  		 					  ,
			'th-large'                   => 'th-large'		 					  ,
			'th'	                     => 'th'	  		 					  ,
			'th-list'                    => 'th-list' 		 					  ,
			'ok'	                     => 'ok'	  		 					  ,
			'remove'                     => 'remove'  		 					  ,
			'zoom-in'                    => 'zoom-in' 		 					  ,
			'zoom-out'                   => 'zoom-out'		 					  ,
			'off'	                     => 'off'	  		 					  ,
			'signal'                     => 'signal'  		 					  ,
			'cog'	                     => 'cog'	  		 					  ,
			'trash'	                     => 'trash'	  		 					  ,
			'home'	                     => 'home'	  		 					  ,
			'file'	                     => 'file'	  		 					  ,
			'time'	                     => 'time'	  		 					  ,
			'road'	                     => 'road'	  		 					  ,
			'download-alt'               => 'download-alt'	 					  ,
			'download'                   => 'download'		 					  ,
			'upload'                     => 'upload'  		 					  ,
			'inbox'	                     => 'inbox'	  		 					  ,
			'play-circle'                => 'play-circle'	 					  ,
			'repeat'                     => 'repeat'  		 					  ,
			'refresh'                    => 'refresh' 		 					  ,
			'list-alt'                   => 'list-alt'		 					  ,
			'lock'	                     => 'lock'	  		 					  ,
			'flag'	                     => 'flag'	  		 					  ,
			'headphones'                 => 'headphones'	 					  ,
			'volume-off'                 => 'volume-off'	 					  ,
			'volume-down'                => 'volume-down'	 					  ,
			'volume-up'                  => 'volume-up'		 					  ,
			'qrcode'                     => 'qrcode'  		 					  ,
			'barcode'                    => 'barcode' 		 					  ,
			'tag'	                     => 'tag'	  		 					  ,
			'tags'	                     => 'tags'	  		 					  ,
			'book'	                     => 'book'	  		 					  ,
			'bookmark'                   => 'bookmark'		 					  ,
			'print'	                     => 'print'	  		 					  ,
			'camera'                     => 'camera'  		 					  ,
			'font'	                     => 'font'	  		 					  ,
			'bold'	                     => 'bold'	  		 					  ,
			'italic'                     => 'italic'  		 					  ,
			'text-height'                => 'text-height'	 					  ,
			'text-width'                 => 'text-width'	 					  ,
			'align-left'                 => 'align-left'	 					  ,
			'align-center'               => 'align-center'	 					  ,
			'align-right'                => 'align-right'	 					  ,
			'align-justify'              => 'align-justify'	 					  ,
			'list'	                     => 'list'	  		 					  ,
			'indent-left'                => 'indent-left'	 					  ,
			'indent-right'               => 'indent-right'	 					  ,
			'facetime-video'             => 'facetime-video' 					  ,
			'picture'                    => 'picture' 		 					  ,
			'map-marker'                 => 'map-marker'	 					  ,
			'adjust'                     => 'adjust'  		 					  ,
			'tint'	                     => 'tint'	  		 					  ,
			'edit'	                     => 'edit'	  		 					  ,
			'share'	                     => 'share'	  		 					  ,
			'check'	                     => 'check'	  		 					  ,
			'move'	                     => 'move'	  		 					  ,
			'step-backward'              => 'step-backward'	 					  ,
			'fast-backward'              => 'fast-backward'	 					  ,
			'backward'                   => 'backward'		 					  ,
			'play'	                     => 'play'	  		 					  ,
			'pause'	                     => 'pause'	  		 					  ,
			'stop'	                     => 'stop'	  		 					  ,
			'forward'                    => 'forward' 		 					  ,
			'fast-forward'               => 'fast-forward'	 					  ,
			'step-forward'               => 'step-forward'	 					  ,
			'eject'	                     => 'eject'	  		 					  ,
			'chevron-left'               => 'chevron-left'	 					  ,
			'chevron-right'              => 'chevron-right'	 					  ,
			'plus-sign'                  => 'plus-sign'		 					  ,
			'minus-sign'                 => 'minus-sign'	 					  ,
			'remove-sign'                => 'remove-sign'	 					  ,
			'ok-sign'                    => 'ok-sign' 		 					  ,
			'question-sign'              => 'question-sign'	 					  ,
			'info-sign'                  => 'info-sign'		 					  ,
			'screenshot'                 => 'screenshot'	 					  ,
			'remove-circle'              => 'remove-circle'	 					  ,
			'ok-circle'                  => 'ok-circle'		 					  ,
			'ban-circle'                 => 'ban-circle'	 					  ,
			'arrow-left'                 => 'arrow-left'	 					  ,
			'arrow-right'                => 'arrow-right'	 					  ,
			'arrow-up'                   => 'arrow-up'		 					  ,
			'arrow-down'                 => 'arrow-down'	 					  ,
			'share-alt'                  => 'share-alt'		 					  ,
			'resize-full'                => 'resize-full'	 					  ,
			'resize-small'               => 'resize-small'	 					  ,
			'exclamation-sign'           => 'exclamation-sign'					  ,
			'gift'	                     => 'gift'	  		 					  ,
			'leaf'	                     => 'leaf'	  		 					  ,
			'fire'	                     => 'fire'	  		 					  ,
			'eye-open'                   => 'eye-open'		 					  ,
			'eye-close'                  => 'eye-close'		 					  ,
			'warning-sign'               => 'warning-sign'	 					  ,
			'plane'	                     => 'plane'	  		 					  ,
			'calendar'                   => 'calendar'		 					  ,
			'random'                     => 'random'  		 					  ,
			'comment'                    => 'comment' 		 					  ,
			'magnet'                     => 'magnet'  		 					  ,
			'chevron-up'                 => 'chevron-up'	 					  ,
			'chevron-down'               => 'chevron-down'	 					  ,
			'retweet'                    => 'retweet' 		 					  ,
			'shopping-cart'              => 'shopping-cart'	 					  ,
			'folder-close'               => 'folder-close'	 					  ,
			'folder-open'                => 'folder-open'	 					  ,
			'resize-vertical'            => 'resize-vertical'					  ,
			'resize-horizontal'          => 'resize-horizontal'				  ,
			'hdd'	                     => 'hdd'	  		 					  ,
			'bullhorn'                   => 'bullhorn'		 					  ,
			'bell'	                     => 'bell'	  		 					  ,
			'certificate'                => 'certificate'	 					  ,
			'thumbs-up'                  => 'thumbs-up'		 					  ,
			'thumbs-down'                => 'thumbs-down'	 					  ,
			'hand-right'                 => 'hand-right'	 					  ,
			'hand-left'                  => 'hand-left'		 					  ,
			'hand-up'                    => 'hand-up' 		 					  ,
			'hand-down'                  => 'hand-down'		 					  ,
			'circle-arrow-right'         => 'circle-arrow-right'				  ,
			'circle-arrow-left'          => 'circle-arrow-left'				  ,
			'circle-arrow-up'            => 'circle-arrow-up'					  ,
			'circle-arrow-down'          => 'circle-arrow-down'				  ,
			'globe'	                     => 'globe'	  		 					  ,
			'wrench'                     => 'wrench'  		 					  ,
			'tasks'	                     => 'tasks'	  		 					  ,
			'filter'                     => 'filter'  		 					  ,
			'briefcase'                  => 'briefcase'		 					  ,
			'fullscreen'                 => 'fullscreen'	 					  ,
			'dashboard'                  => 'dashboard'		 					  ,
			'paperclip'                  => 'paperclip'		 					  ,
			'heart-empty'                => 'heart-empty'	 					  ,
			'link'	                     => 'link'	  		 					  ,
			'phone'	                     => 'phone'	  		 					  ,
			'pushpin'                    => 'pushpin' 		 					  ,
			'usd'	                     => 'usd'	  		 					  ,
			'gbp'	                     => 'gbp'	  		 					  ,
			'sort'	                     => 'sort'	  		 					  ,
			'sort-by-alphabet'           => 'sort-by-alphabet'					  ,
			'sort-by-alphabet-alt'       => 'sort-by-alphabet-alt'				  ,
			'sort-by-order'              => 'sort-by-order'	 					  ,
			'sort-by-order-alt'          => 'sort-by-order-alt'				  ,
			'sort-by-attributes'         => 'sort-by-attributes'				  ,
			'sort-by-attributes-alt'     => 'sort-by-attributes-alt'			  ,
			'unchecked'                  => 'unchecked'		 					  ,
			'expand'                     => 'expand'  		 					  ,
			'collapse-down'              => 'collapse-down'	 					  ,
			'collapse-up'                => 'collapse-up'	 					  ,
			'log-in'                     => 'log-in'  		 					  ,
			'flash'	                     => 'flash'	  		 					  ,
			'log-out'                    => 'log-out' 		 					  ,
			'new-window'                 => 'new-window'	 					  ,
			'record'                     => 'record'  		 					  ,
			'save'	                     => 'save'	  		 					  ,
			'open'	                     => 'open'	  		 					  ,
			'saved'	                     => 'saved'	  		 					  ,
			'import'                     => 'import'  		 					  ,
			'export'                     => 'export'  		 					  ,
			'send'	                     => 'send'	  		 					  ,
			'floppy-disk'                => 'floppy-disk'	 					  ,
			'floppy-saved'               => 'floppy-saved'	 					  ,
			'floppy-remove'              => 'floppy-remove'	 					  ,
			'floppy-save'                => 'floppy-save'	 					  ,
			'floppy-open'                => 'floppy-open'	 					  ,
			'credit-card'                => 'credit-card'	 					  ,
			'transfer'                   => 'transfer'		 					  ,
			'cutlery'                    => 'cutlery' 		 					  ,
			'header'                     => 'header'  		 					  ,
			'compressed'                 => 'compressed'	 					  ,
			'earphone'                   => 'earphone'		 					  ,
			'phone-alt'                  => 'phone-alt'		 					  ,
			'tower'	                     => 'tower'	  		 					  ,
			'stats'	                     => 'stats'	  		 					  ,
			'sd-video'                   => 'sd-video'		 					  ,
			'hd-video'                   => 'hd-video'		 					  ,
			'subtitles'                  => 'subtitles'		 					  ,
			'sound-stereo'               => 'sound-stereo'	 					  ,
			'sound-dolby'                => 'sound-dolby'	 					  ,
			'sound-5-1'                  => 'sound-5-1'		 					  ,
			'sound-6-1'                  => 'sound-6-1'		 					  ,
			'sound-7-1'                  => 'sound-7-1'		 					  ,
			'copyright-mark'             => 'copyright-mark' 					  ,
			'registration-mark'          => 'registration-mark'				  ,
			'cloud-download'             => 'cloud-download' 					  ,
			'cloud-upload'               => 'cloud-upload'	 					  ,
			'tree-conifer'               => 'tree-conifer'	 					  ,
			'tree-deciduous'             => 'tree-deciduous' 					  
			);
			
						if(isset($tab['icon'])) {
						?>
							<select id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-icon" class="icon-select" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][icon]">
						
							<?php 
							$count=0;
							foreach($icons as $key=>$value) {  ?>
								
							<option value="<?php echo $key; ?>" <?php echo selected( $tab['icon'], $key, false ) ?> class="glyphicon glyphicon-<?php echo htmlspecialchars($value); ?>"><?php echo htmlspecialchars($value); ?></option>
							

							<? 
							 $count++; 
							
							} ?>
		
		
							</select>
							
						<?php } else { ?>
						
							<select id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-icon" class="icon-select" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][icon]">
						
							<?php 
							$count=0;
							foreach($icons as $icon) {  ?>
								
							<option value="<?php echo $icon; ?>" class="glyphicon glyphicon-<?php echo $icon; ?>"><?php echo $icon; ?></option>
							

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
			
			if($type == 'tab') {
			
				$output .= '<div id="aq_block_tabs_'. rand(1, 100) .'" class="aq_block_tabs"><div class="aq-tab-inner">';
					$output .= '<ul class="aq-nav cf">';
					
					$i = 1;
					foreach( $tabs as $tab ){
						$tab_selected = $i == 1 ? 'ui-tabs-active' : '';
						$output .= '<li class="'.$tab_selected.'"><a href="#aq-tab-'. sanitize_title( $tab['title'] ) . $i .'">' . $tab['title'] . '</a></li>';
						$i++;
					}
					
					$output .= '</ul>';
					
					$i = 1;
					foreach($tabs as $tab) {
						
						$output .= '<div id="aq-tab-'. sanitize_title( $tab['title'] ) . $i .'" class="aq-tab">'. wpautop(do_shortcode(htmlspecialchars_decode($tab['content']))) .'</div>';
						
						$i++;
					}
				
				$output .= '</div></div>';
				
			} elseif ($type == 'toggle') {
				
				$output .= '<div id="aq_block_toggles_wrapper_'.rand(1,100).'" class="aq_block_toggles_wrapper">';
				
				foreach( $tabs as $tab ){
					$output  .= '<div class="aq_block_toggle">';
						$output .= '<h2 class="tab-head">'. $tab['title'] .'</h2>';
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
				
				$output .= '<div id="aq_block_accordion_wrapper_'.rand(1,100).'" class="aq_block_accordion_wrapper">';
				
				foreach( $tabs as $tab ){
					
					$open = $i == 1 ? 'open' : 'close';
					
					$child = '';
					if($i == 1) $child = 'first-child';
					if($i == $count) $child = 'last-child';
					$i++;
					
					$output  .= '<div class="aq_block_accordion '.$child.'">';
						$output .= '<h2 class="tab-head">'. $tab['title'] .'</h2>';
						$output .= '<div class="arrow"></div>';
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
				'content' => ''
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
