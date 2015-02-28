<?php
/** A simple text block **/
class AQ_Column_Block extends AQ_Block {
	
	/* PHP5 constructor */
	function __construct() {
		
		$block_options = array(
			'name' => 'Section',
			'size' => 'span12',
			'color' => '',
			'bgimage' => '',
			'bgrepeat' => '',
			'bgparallax' => '',
			'bgspeed' => '',
			'bgstyles' => ''

		);
		
		//create the widget
		parent::__construct('aq_column_block', $block_options);
		
	}



	//form header
	function before_form($instance) {
		extract($instance);
		
		$title = $title ? '<span class="in-block-title"> : '.$title.'</span>' : '';
		$resizable = $resizable ? '' : 'not-resizable';
		
		echo '<li id="template-block-'.$number.'" class="block block-container block-'.$id_base.' '. $size .' '.$resizable.'">',
				'<dl class="block-bar">',
					'<dt class="block-handle">',
						'<div class="block-title">',
							$name , $title, 
						'</div>',
						'<span class="block-controls">',
							'<a class="block-edit" id="edit-'.$number.'" title="Edit Block" href="#block-settings-'.$number.'">Edit Block</a>',
						'</span>',
					'</dt>',
				'</dl>',
				'<div class="block-settings cf" id="block-settings-'.$number.'">';
	}

	function form($instance) {
		$rend = rand(0,100);
		echo	'<ul><li id="template-block-'.$rend.'">';
		echo    '<dl class="block-bar">';
		echo	'<dt class="block-handle">';
		echo	'<div class="block-title">Section styles</div>';
		echo	'<span class="block-controls">';
		echo	'<a id="edit-'.$rend.'" class="block-edit" href="#block-settings-'.$rend.'" title="Edit Block">Edit Block</a>';
		echo	'</span>';
		echo	'</dt>';
		echo	'</dl>';
		echo    '<div id="block-settings-'.$rend.'" class="block-settings clearfix first-time" style="display: none;">';
			
			//////////////////// new features add here!!! ////////////////////////////
			$color = '';	
			$bgimage = '';
			$bgrepeat = '';
			$bgparallax = '';
			$bgspeed = '30';
			$bgstyles = '';
			$bgvideo = '';
			
			//Background-color
			echo '<label for="'.$this->get_field_name('color').'">Background color&nbsp;</label>';
			echo '<div class="aqpb-color-picker">';
			echo '<input type="text" class="input-color-picker" value="'. $color .'" name="'.$this->get_field_name('color').'" data-default-color="#FFFFFF"/>';
			echo '</div>';
			
			//Background-image
			echo '<label for="'.$this->get_field_name('bgimage').'">Background image&nbsp;</label>';
			echo '<input type="text" data-id="repeat'.rand(0,100).'" class="input-full input-upload" value="'.$bgimage.'" name="'.$this->get_field_name('bgimage').'">';
			echo '<a href="#" class="custom_upload_button button" rel="image">Upload</a><p></p>';
			
			//Background-repeat
			echo '<label for="'.$this->get_field_name('bgrepeat').'">Background repeat&nbsp;</label>';
			echo '<input type="hidden" name="'.$this->get_field_name('bgrepeat').'" value="0" />';
			echo '<input type="checkbox" id="repeat'.rand(0,100).'" class="input-checkbox" name="'.$this->get_field_name('bgrepeat').'" '. checked( 1, $bgrepeat, false ) .' value="1"/>';
			
			//Parallax
			echo '<label for="'.$this->get_field_name('bgparallax').'">&nbsp;Parallax effect&nbsp;</label>';
			echo '<input type="hidden" name="'.$this->get_field_name('bgparallax').'" value="0" />';
			echo '<input type="checkbox" id="parallax'.rand(0,100).'" class="input-checkbox" name="'.$this->get_field_name('bgparallax').'" '. checked( 1, $bgparallax, false ) .' value="1"/>';	
			
			//Parallax speed
			echo '<label for="'.$this->get_field_name('bgspeed').'">Parallax effect Speed&nbsp;(0-100)&nbsp;</label>';
			echo '<input type="text" id="repeat'.rand(0,100).'" class="input-full" style="width:50px;" value="'.$bgspeed.'" name="'.$this->get_field_name('bgspeed').'">';
							
			//Background-video
			echo '<p></p><label for="'.$this->get_field_name('bgvideo').'">Background YouTube Video&nbsp;</label>';
			echo '<input type="text" id="repeat'.rand(0,100).'" class="input-full" value="'.$bgvideo.'" name="'.$this->get_field_name('bgvideo').'">';	
					
			//Background styles
			echo '<br /><label for="'.$this->get_field_name('bgstyles').'">Background Custom Css&nbsp;</label>';
			echo '<textarea class="" name="'.$this->get_field_name('bgstyles').'" rows="6" style="width:100%;" />'.$bgstyles.'</textarea>';
						
			
////////////////////////////////////////////////////////////////////////
		
		echo '</div></li></ul>';			
						
		echo '<p class="empty-column">',
		__('Drag block items into this section box', 'framework'),
		'</p>';
		
		echo '<ul class="blocks column-blocks cf"></ul>';
	}
	
	function form_callback($instance = array()) {
		$instance = is_array($instance) ? wp_parse_args($instance, $this->block_options) : $this->block_options;
		
		//insert the dynamic block_id & block_saving_id into the array
		$this->block_id = 'aq_block_' . $instance['number'];
		$instance['block_saving_id'] = 'aq_blocks[aq_block_'. $instance['number'] .']';

		extract($instance);
		
		$col_order = $order;
		
		//column block header
		if(isset($template_id)) {
			echo '<li class="block block-container block-aq_column_block '.$size.'">',
					'<div class="block-settings-column cf" id="block-settings-'.$number.'">';		

			echo '<ul><li id="template-block-'.$number.'"><dl class="block-bar">',
			'<dt class="block-handle">',
			'<div class="block-title">Section styles</div>',
			'<span class="block-controls">',
			'<a id="edit-'.$number.'" class="block-edit" href="#block-settings-'.$number.'" title="Edit Block">Edit Block</a>',
			'</span>',
			'</dt>',
			'</dl>',
			'<div id="block-settings-'.$number.'" class="block-settings clearfix" style="display: none;">';
			
//////////// And new features add here //////////////////////////
			
			//Background-color
			echo '<label for="'.$this->get_field_name('color').'">Background color&nbsp;</label>';
			echo '<div class="aqpb-color-picker">';
			echo '<input type="text" class="input-color-picker" value="'. $color .'" name="'.$this->get_field_name('color').'" data-default-color="#FFFFFF"/>';
			echo '</div>';
			
			//Background-image
			echo '<label for="'.$this->get_field_name('bgimage').'">Background image&nbsp;</label>';
			echo '<input type="text" id="bg'.rand(0,100).'" class="input-full input-upload" value="'.$bgimage.'" name="'.$this->get_field_name('bgimage').'">';
			echo '<a href="#" class="aq_upload_button button" rel="image">Upload</a><p></p>';
			
			//Background-repeat
			echo '<label for="'.$this->get_field_name('bgrepeat').'">Background repeat&nbsp;</label>';
			echo '<input type="hidden" name="'.$this->get_field_name('bgrepeat').'" value="0" />';
			echo '<input type="checkbox" id="repeat'.rand(0,100).'" class="input-checkbox" name="'.$this->get_field_name('bgrepeat').'" '. checked( 1, $bgrepeat, false ) .' value="1"/>';
			
			//Parallax
			echo '<label for="'.$this->get_field_name('bgparallax').'">&nbsp;Parallax effect&nbsp;</label>';
			echo '<input type="hidden" name="'.$this->get_field_name('bgparallax').'" value="0" />';
			echo '<input type="checkbox" id="parallax'.rand(0,100).'" class="input-checkbox" name="'.$this->get_field_name('bgparallax').'" '. checked( 1, $bgparallax, false ) .' value="1"/>';			
			
			//Parallax speed
			echo '<label for="'.$this->get_field_name('bgspeed').'">Parallax effect Speed&nbsp;(0-100)&nbsp;</label>';
			echo '<input type="text" id="repeat'.rand(0,100).'" class="input-full" style="width:50px;" value="'.$bgspeed.'" name="'.$this->get_field_name('bgspeed').'">';
						
			//Background-video
			echo '<p></p><label for="'.$this->get_field_name('bgvideo').'">Background YouTube Video&nbsp;</label>';
			echo '<input type="text" id="repeat'.rand(0,100).'" class="input-full" value="'.$bgvideo.'" name="'.$this->get_field_name('bgvideo').'">';	
					
			//Bckground styles
			echo '<br /><label for="'.$this->get_field_name('bgstyles').'">Background Custom Css&nbsp;</label>';
			echo '<textarea class="" name="'.$this->get_field_name('bgstyles').'" rows="6" style="width:100%;" />'.$bgstyles.'</textarea>';
			
			
/////////////////////////////////////////////////////////////////

			echo '</div></li></ul>';			
			
			echo '<p class="empty-column">',
							__('Drag block items into this section box', 'framework'),
						'</p>',
						'<ul class="blocks column-blocks cf">';
					
			//check if column has blocks inside it
			$blocks = aq_get_blocks($template_id);
			
			//outputs the blocks
			if($blocks) {
				foreach($blocks as $key => $child) {
					global $aq_registered_blocks;
					extract($child);
					
					//get the block object
					$block = $aq_registered_blocks[$id_base];
					
					if($parent == $col_order) {
						$block->form_callback($child);
					}
				}
			} 
			echo 		'</ul>';
			
		} else {
			$this->before_form($instance);
			$this->form($instance);
		}
				
		//form footer
		$this->after_form($instance);
	}
	
	//form footer
	function after_form($instance) {
		extract($instance);
		
		$block_saving_id = 'aq_blocks[aq_block_'.$number.']';
			
			echo '<div class="block-control-actions cf"><a href="#" class="delete">Delete</a></div>';
			echo '<input type="hidden" class="id_base" name="'.$this->get_field_name('id_base').'" value="'.$id_base.'" />';
			echo '<input type="hidden" class="name" name="'.$this->get_field_name('name').'" value="'.$name.'" />';
			echo '<input type="hidden" class="order" name="'.$this->get_field_name('order').'" value="'.$order.'" />';
			echo '<input type="hidden" class="size" name="'.$this->get_field_name('size').'" value="'.$size.'" />';
			echo '<input type="hidden" class="parent" name="'.$this->get_field_name('parent').'" value="'.$parent.'" />';
			echo '<input type="hidden" class="number" name="'.$this->get_field_name('number').'" value="'.$number.'" />';
			
		echo '</div>',
			'</li>';
	}
	
	function block_callback($instance) {
		$instance = is_array($instance) ? wp_parse_args($instance, $this->block_options) : $this->block_options;
		
		extract($instance);
		
		$col_order = $order;
		$col_size = absint(preg_replace("/[^0-9]/", '', $size));
		
		//column block header
		if(isset($template_id)) {
			echo '<section ';
			
			
			echo 'id="parallax-section-'.$number.'" ';
		
			
			echo 'style="';
					
				echo 'background-color:'.$color.';';
	
				echo 'background-image:url('.$bgimage.');';
				
				if ($bgrepeat==1) {
					
					echo 'background-repeat:repeat; background-size:inherit;';
					
				} else {
					
					echo 'background-repeat:no-repeat; background-size:cover;';
				}
				
			echo $bgstyles;
				
			echo '" ';
			
			if ($bgparallax==1){
			
				echo 'class="parallax"';
				
			}
			
			if ($bgparallax==1){
			
				echo 'data-speed="'.$bgspeed.'"';
				
			}
			
			echo '>';
						
			if ($bgvideo != '') {
			
			echo '<a id="bgvideo-'.$number.'" class="bgvdplayer" data-property="{videoURL:\''.$bgvideo.'\', containment:\'#parallax-section-'.$number.'\', startAt:0, quality:\'highres\', mute:false, autoPlay:true, showYTLogo:false, showControls:false, loop:true, opacity:1}"></a>';
			
			}
						
			echo '<div class="container"><div class="row">';
			
			//define vars
			$overgrid = 0; $span = 0; $first = false;
			
			//check if column has blocks inside it
			$blocks = aq_get_blocks($template_id);
			
			//outputs the blocks
			if($blocks) {
				foreach($blocks as $key => $child) {
					global $aq_registered_blocks;
					extract($child);
					
					if(class_exists($id_base)) {
						//get the block object
						$block = $aq_registered_blocks[$id_base];
						
						//insert template_id into $child
						$child['template_id'] = $template_id;
						
						//display the block
						if($parent == $col_order) {
							
							$child_col_size = absint(preg_replace("/[^0-9]/", '', $size));
							
							$overgrid = $span + $child_col_size;
							
							if($overgrid > $col_size || $span == $col_size || $span == 0) {
								$span = 0;
								$first = true;
							}
							
							if($first == true) {
								$child['first'] = true;
							}
							
							$block->block_callback($child);
							
							$span = 12;
							
							$overgrid = 0; //reset $overgrid
							$first = false; //reset $first
						}
					}
				}
			} 
			
			echo "</div></div></section>";
			
		} else {
			//show nothing
		}
	}
	
}