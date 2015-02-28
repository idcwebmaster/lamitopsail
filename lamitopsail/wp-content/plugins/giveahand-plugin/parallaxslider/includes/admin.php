<?php
/**
 * Administration.
 */

/**
 * Register the custom post type.
 */
$fx  = new Cuztom_Post_Type( 'fx_slider', 
	array(
		'menu_position' => 80,
	    'supports' 		=> array( 'title' ),
	),
	array(
	    'name'              => _x( 'Slider', 'framework' ),
	    'singular_name'     => _x( 'Slider', 'framework' ),
	    'search_items'      => __( 'Search Slides', 'framework' ),
	    'all_items'         => __( 'All Slides', 'framework' ),
	    'parent_item'       => __( 'Parent Slide', 'framework' ),
	    'parent_item_colon' => __( 'Parent Slides:', 'framework' ),
	    'edit_item'         => __( 'Edit Slide', 'framework' ),
	    'update_item'       => __( 'Update Slide', 'framework' ),
	    'add_new_item'      => __( 'Add New Slide', 'framework' ),
	    'new_item_name'     => __( 'New Slide Name', 'framework' ),
	    'menu_name'         => __( 'Slider', 'framework' ),
	) 
);


/**
 * Register taxonomy.
 */
$slideshow = register_cuztom_taxonomy( 'Slideshow', 'fx_slider', 
        array(
            'show_admin_column'     => TRUE,
            'admin_column_sortable' => TRUE,
            'admin_column_filter'   => TRUE,
            'hierarchical' 			=> TRUE
        ));
		
/**
 * Register the meta-boxes.
 */


/* Background options */
$fx->add_meta_box( 
	'fx_background_id',
	'Background Slide Options', 
	array(
	        array(
	            'name'          => 'bg_image',
	            'label'         => __( 'Image', 'framework' ),
	            'description'   => __( 'Select the background image for the slide.', 'framework' ),
	            'type'          => 'image'
	        ),
	        array(
	            'name'          => 'bg_color',
	            'label'         => __( 'Color', 'framework' ),
	            'description'   => __( 'Select the background color.', 'framework' ),
	            'type'          => 'color'
	        ),
	        array(
	            'name'          => 'bg_video',
	            'label'         => __( 'Youtube video', 'framework' ),
	            'description'   => __( 'Set the Youtube link.', 'framework' ),
	            'type'          => 'text'
	        ),
	    ),
	'normal', // context
	'high' // priority
);

/* Bundle metabox */
$fx->add_meta_box( 
	'fx_elements_id',
	'Slide Element Options', 
	array(
	        'bundle', 
	    array(

			array(
				'name'          => 'layer_type',
				'label'         => 'Type',
				'description'   => 'Select Layer Type',
				'type'          => 'select',
				'options'       => array(
					'type_image'    => 'Image',
					'type_video'    => 'Video',
					'type_capt'    => 'Caption',
					'type_button'    => 'Button'
				),
				'default_value' => ''
			),
	        array(
	            'name'          => 'element_image',
	            'label'         => __( 'Image', 'framework' ),
	            'description'   => __( 'Select an image', 'framework' ),
	            'type'          => 'image'
	        ),
	        array(
	            'name'          => 'element_caption',
	            'label'         => __( 'Caption', 'framework' ),
	            'description'   => __( 'Enter the text', 'framework' ),
	            'type'          => 'textarea'
	        ),
			array(
	            'name'          => 'element_caption_font',
	            'label'         => __( 'Font Size', 'framework' ),
	            'description'   => __( 'Enter font size in pixels', 'framework' ),
	            'type'          => 'text'
	        ),
			array(
	            'name'          => 'element_caption_type',
	            'label'         => __( 'Caption type', 'framework' ),
	            'description'   => __( 'Select type', 'framework' ),
	            'type'          => 'select',
				'options'       => array(
					'heading' => 'Heading',
					'paragraph' => 'Paragraph'
 				),
				'default_value' => 'paragraph'
	        ),
			array(
	            'name'          => 'element_caption_color',
	            'label'         => __( 'Font Color', 'framework' ),
	            'description'   => __( 'Enter caption color', 'framework' ),
	            'type'          => 'color'
	        ),
			array(
	            'name'          => 'element_caption_styles',
	            'label'         => __( 'Caption Styles', 'framework' ),
	            'description'   => __( 'Enter caption custom styles.<br />Example: text-align:center;', 'framework' ),
	            'type'          => 'textarea'
	        ),
			array(
				'name'          => 'element_video',
				'label'         => __( 'Video Link', 'framework' ),
				'description'   => __( 'Enter your video link', 'framework' ),
				'type'          => 'text'
			),
			array(
				'name'          => 'element_video_dimension',
				'label'         => __( 'Video Dimensions', 'framework' ),
				'description'   => __( 'Enter element dimension as width,height.<br />Example: 500,300', 'framework' ),
				'type'          => 'text'
			),
			array(
				'name'          => 'element_button_text',
				'label'         => __( 'Button Text', 'framework' ),
				'description'   => __( 'Enter button text', 'framework' ),
				'type'          => 'text'
			),
			array(
				'name'          => 'element_button_link',
				'label'         => __( 'Button Link', 'framework' ),
				'description'   => __( 'Enter button link', 'framework' ),
				'type'          => 'text'
			),
			array(
				'name'          => 'element_button_color',
				'label'         => __( 'Button color', 'framework' ),
				'description'   => __( 'Select button color', 'framework' ),
				'type'          => 'color'
			),
			array(
				'name'          => 'element_button_donate',
				'label'         => __( 'Donate', 'framework' ),
				'description'   => __( 'Enable donation function', 'framework' ),
				'type'          => 'select',
				'options'       => array (
					'on' => 'On',
					'off' => 'Off'
				),
				'default_value' => 'off'
			),
	        array(
	            'name'          => 'element_option_position',
	            'label'         => __( 'Postion', 'framework'),
	            'description'   => __( 'Enter element position as Y,X.<br>Example: 100,10', 'framework'),
	            'type'          => 'text'
	        ),
	        array(
	            'name'          => 'element_option_delay',
	            'label'         => __( 'Delay', 'framework'),
	            'description'   => __( 'Time in ms before the <b>in</b> transition starts.', 'framework'),
	            'type'          => 'text'
	        ),
	        array(
	            'name'          => 'element_option_time',
	            'label'         => __( 'Time', 'framework'),
	            'description'   => __( 'Time after which the elements animation is complete in ms.', 'framework'),
	            'type'          => 'text'
	        ),
	        array(
		        'name'          => 'element_option_in',
		        'label'         => __( 'Data In', 'framework'),
		        'description'   => __( 'Type of the in-animation.', 'framework'),
		        'type'          => 'select',
		        'options'       => array(
		        	'none'			=>  __( 'None', 'framework'),        	
	            	'fade'			=>	__( 'fade', 'framework'),
	            	'left'			=>	__( 'left', 'framework'),
	            	'topLeft'		=>	__( 'topLeft', 'framework'),
	            	'bottomLeft'	=>	__( 'bottomLeft', 'framework'),
	            	'right'			=>  __( 'right', 'framework'),
	            	'topRight'		=>	__( 'topRight', 'framework'),
	            	'bottomRight'	=>	__( 'bottomRight', 'framework'),
	            	'top'			=>	__( 'top', 'framework'),
	            	'bottom'		=>	__( 'bottom', 'framework'),
		        ),
		        'default_value' => 'left',
		    ),
	        array(
		        'name'          => 'element_option_out',
		        'label'         => __( 'Data Out', 'framework'),
		        'description'   => __( 'Type of the out-animation.', 'framework'),
		        'type'          => 'select',
		        'options'       => array(
		        	'none'			=>  __( 'None', 'framework'),		        	
	            	'fade'			=>	__( 'fade', 'framework'),
	            	'left'			=>	__( 'left', 'framework'),
	            	'topLeft'		=>	__( 'topLeft', 'framework'),
	            	'bottomLeft'	=>	__( 'bottomLeft', 'framework'),
	            	'right'			=>  __( 'right', 'framework'),
	            	'topRight'		=>	__( 'topRight', 'framework'),
	            	'bottomRight'	=>	__( 'bottomRight', 'framework'),
	            	'top'			=>	__( 'top', 'framework'),
	            	'bottom'		=>	__( 'bottom', 'framework'),
		        ),
		        'default_value' => 'left',
		    ),
	        array(
		        'name'          => 'element_option_step',
		        'label'         => __( 'Step', 'framework'),
		        'description'   => __( 'Group elements in different steps. Elements of the next step will not start before the previous step is finished.', 'framework'),
		        'type'          => 'select',
		        'options'       => array(
		        	'none' 	=> __( 'none', 'framework'),
	            	'1'		=>	'1',
	            	'2'		=>	'2',
	            	'3'		=>	'3',
	            	'4'		=>	'4',
	            	'5'		=>  '5',
	            	'6'		=>	'6',
	            	'7'		=>	'7',
	            	'8'		=>	'8',
	            	'9'		=>	'9',
	            	'10'	=>	'10',
	            	'11'	=>	'11',
	            	'12'	=>	'12',
	            	'13'	=>	'13',
	            	'14'	=>  '14',
	            	'15'	=>	'15',
	            	'16'	=>	'16',
	            	'17'	=>	'17',
	            	'18'	=>	'18',
	            	'19'	=>	'19',
	            	'20'	=>	'20',
		        ),
		        'default_value' => 'none',
		    ),
	        array(
		        'name'          => 'element_option_ease_in',
		        'label'         => __( 'Ease In', 'framework'),
		        'description'   => __( 'Easing for the in-animations.', 'framework'),
		        'type'          => 'select',
		        'options'       =>  array(
		        	'none' 				=> __( 'none', 'framework'),
	        		'easeInQuad' 		=> __( 'easeInQuad', 'framework'),
					'easeOutQuad' 		=> __( 'easeOutQuad', 'framework'),
					'easeInOutQuad' 	=> __( 'easeInOutQuad', 'framework'),
					'easeInCubic' 		=> __( 'easeInCubic', 'framework'),
					'easeOutCubic' 		=> __( 'easeOutCubic', 'framework'),
					'easeInOutCubic' 	=> __( 'easeInOutCubic', 'framework'),
					'easeInQuart' 		=> __( 'easeInQuart', 'framework'),
					'easeOutQuart' 		=> __( 'easeOutQuart', 'framework'),
					'easeInOutQuart' 	=> __( 'easeInOutQuart', 'framework'),
					'easeInQuint' 		=> __( 'easeInQuint', 'framework'),
					'easeOutQuint' 		=> __( 'easeOutQuint', 'framework'),
					'easeInOutQuint' 	=> __( 'easeInOutQuint', 'framework'),
					'easeInSine' 		=> __( 'easeInSine', 'framework'),
					'easeOutSine' 		=> __( 'easeOutSine', 'framework'),
					'easeInOutSine' 	=> __( 'easeInOutSine', 'framework'),
					'easeInExpo' 		=> __( 'easeInExpo', 'framework'),
					'easeOutExpo' 		=> __( 'easeOutExpo', 'framework'),
					'easeInOutExpo' 	=> __( 'easeInOutExpo', 'framework'),
					'easeInCirc' 		=> __( 'easeInCirc', 'framework'),
					'easeOutCirc' 		=> __( 'easeOutCirc', 'framework'),
					'easeInOutCirc' 	=> __( 'easeInOutCirc', 'framework'),
					'easeInElastic' 	=> __( 'easeInElastic', 'framework'),
					'easeOutElastic' 	=> __( 'easeOutElastic', 'framework'),
					'easeInOutElastic' 	=> __( 'easeInOutElastic', 'framework'),
					'easeInBack' 		=> __( 'easeInBack', 'framework'),
					'easeOutBack' 		=> __( 'easeOutBack', 'framework'),
					'easeInOutBack' 	=> __( 'easeInOutBack', 'framework'),
					'easeInBounce' 		=> __( 'easeInBounce', 'framework'),
					'easeOutBounce' 	=> __( 'easeOutBounce', 'framework'),
					'easeInOutBounce' 	=> __( 'easeInOutBounce', 'framework'),
					),
		        'default_value' => 'easeInQuad',
		    ),

	        array(
		        'name'          => 'element_option_ease_out',
		        'label'         => __( 'Ease Out', 'framework'),
		        'description'   => __( 'Easing for the out-animations.', 'framework'),
		        'type'          => 'select',
			 'options'       =>  array(
		        	'none' 				=> __( 'none', 'framework'),
	        		'easeInQuad' 		=> __( 'easeInQuad', 'framework'),
					'easeOutQuad' 		=> __( 'easeOutQuad', 'framework'),
					'easeInOutQuad' 	=> __( 'easeInOutQuad', 'framework'),
					'easeInCubic' 		=> __( 'easeInCubic', 'framework'),
					'easeOutCubic' 		=> __( 'easeOutCubic', 'framework'),
					'easeInOutCubic' 	=> __( 'easeInOutCubic', 'framework'),
					'easeInQuart' 		=> __( 'easeInQuart', 'framework'),
					'easeOutQuart' 		=> __( 'easeOutQuart', 'framework'),
					'easeInOutQuart' 	=> __( 'easeInOutQuart', 'framework'),
					'easeInQuint' 		=> __( 'easeInQuint', 'framework'),
					'easeOutQuint' 		=> __( 'easeOutQuint', 'framework'),
					'easeInOutQuint' 	=> __( 'easeInOutQuint', 'framework'),
					'easeInSine' 		=> __( 'easeInSine', 'framework'),
					'easeOutSine' 		=> __( 'easeOutSine', 'framework'),
					'easeInOutSine' 	=> __( 'easeInOutSine', 'framework'),
					'easeInExpo' 		=> __( 'easeInExpo', 'framework'),
					'easeOutExpo' 		=> __( 'easeOutExpo', 'framework'),
					'easeInOutExpo' 	=> __( 'easeInOutExpo', 'framework'),
					'easeInCirc' 		=> __( 'easeInCirc', 'framework'),
					'easeOutCirc' 		=> __( 'easeOutCirc', 'framework'),
					'easeInOutCirc' 	=> __( 'easeInOutCirc', 'framework'),
					'easeInElastic' 	=> __( 'easeInElastic', 'framework'),
					'easeOutElastic' 	=> __( 'easeOutElastic', 'framework'),
					'easeInOutElastic' 	=> __( 'easeInOutElastic', 'framework'),
					'easeInBack' 		=> __( 'easeInBack', 'framework'),
					'easeOutBack' 		=> __( 'easeOutBack', 'framework'),
					'easeInOutBack' 	=> __( 'easeInOutBack', 'framework'),
					'easeInBounce' 		=> __( 'easeInBounce', 'framework'),
					'easeOutBounce' 	=> __( 'easeOutBounce', 'framework'),
					'easeInOutBounce' 	=> __( 'easeInOutBounce', 'framework'),
					),
		        'default_value' => 'easeOutQuad',
		    ),

	    )
	)
);


/**
 * Display custom messages.
 */
function fx_updated_messages( $messages ) {

	global $post, $post_ID;
	$messages['fx_slider'] = array (
		0  => '',
		1  => sprintf( __( 'Slide updated. <a href="%s">View slide</a>', 'framework' ), esc_url( get_permalink($post_ID) ) ),
		2  => __( 'Custom field updated.', 'framework' ),
		3  => __( 'Custom field deleted.', 'framework' ),
		4  => __( 'Slide updated.', 'framework' ),
		5  => isset($_GET['revision']) ? sprintf( __( 'Slide restored to revision from %s', 'framework' ), wp_post_revision_title( (int) $_GET['revision'], FALSE ) ) : FALSE,
		6  => sprintf( __( 'Slide published. <a href="%s">View slide</a>', 'framework' ), esc_url( get_permalink($post_ID) ) ),
		7  => __( 'Slide saved.', 'framework' ),
		8  => sprintf( __( 'Slide submitted. <a target="_blank" href="%s">Preview slide</a>', 'framework' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9  => sprintf( __( 'Slide scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview slide</a>', 'framework' ), date_i18n( __( 'M j, Y @ G:i', 'framework' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __( 'Slide draft updated. <a target="_blank" href="%s">Preview slide</a>', 'framework' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ) );

	return $messages;
}
add_filter( 'post_updated_messages', 'fx_updated_messages' );

/**
 * Parse Video.
 *
 * @author  takien, slaffko
 * @since	1.0.0
 */
function fx_video_url($url,$return='embed',$width='',$height='', $element_position='', $element_step='',$rel=0){
    $urls = parse_url($url);

    //url is http://vimeo.com/xxxx
    if($urls['host'] == 'vimeo.com'){
        $vid = ltrim($urls['path'],'/');
    }
    //url is http://youtu.be/xxxx
    else if($urls['host'] == 'youtu.be'){
        $yid = ltrim($urls['path'],'/');
    }
    //url is http://www.youtube.com/embed/xxxx
    else if(strpos($urls['path'],'embed') == 1){
        $yid = end(explode('/',$urls['path']));
    }
     //url is xxxx only
    else if(strpos($url,'/')===false){
        $yid = $url;
    }
    //http://www.youtube.com/watch?feature=player_embedded&v=m-t4pcO99gI
    //url is http://www.youtube.com/watch?v=xxxx
    else{
        parse_str($urls['query']);
        $yid = $v;
        if(!empty($feature)){
            $yid = end(explode('v=',$urls['query']));
            $arr = explode('&',$yid);
            $yid = $arr[0];
        }
    }
    if(!empty($yid)) {
    
    //return embed iframe
    if($return == 'embed'){
        return '<iframe data-position="'.($element_position).'" data-step="'.($element_step).'" width="'.($width?$width:540).'" height="'.($height?$height:300).'" src="http://www.youtube.com/embed/'.$yid.'?wmode=transparent?rel='.$rel.'" frameborder="0" ebkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
    }
    //return normal thumb
    else if($return == 'thumb' || $return == 'thumbmed'){
        return 'http://i1.ytimg.com/vi/'.$yid.'/default.jpg';
    }
    //return hqthumb
    else if($return == 'hqthumb' ){
        return 'http://i1.ytimg.com/vi/'.$yid.'/hqdefault.jpg';
    }
    // else return id
    else{
        return $yid;
    }
  }
  else if($vid) {
  $vimeoObject = json_decode(file_get_contents("http://vimeo.com/api/v2/video/".$vid.".json"));
   if (!empty($vimeoObject)) {
      //return embed iframe
      if($return == 'embed'){
      return '<iframe data-position="'.($element_position).'" data-step="'.($element_step).'" width="'.($width?$width:$vimeoObject[0]->width).'" height="'.($height?$height:$vimeoObject[0]->height).'" src="http://player.vimeo.com/video/'.$vid.'?title=0&byline=0&portrait=0" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
    }
    //return normal thumb
    else if($return == 'thumb'){
      return $vimeoObject[0]->thumbnail_small;
    }
    //return medium thumb
    else if($return == 'thumbmed'){
      return $vimeoObject[0]->thumbnail_medium;
    }
    //return hqthumb
    else if($return == 'hqthumb'){
      return $vimeoObject[0]->thumbnail_large;
    }
    // else return id
    else{
      return $vid;
    }
   }
  }
}

/**
 * Remove permalink metabox (slug).
 */
function fx_remove_permalink_meta_box() {

    remove_meta_box( 'slugdiv', 'fx_slider', 'core' );
}
add_action( 'admin_menu', 'fx_remove_permalink_meta_box' );


/** 
 * Removing unused columns from the admin listing page.
 */
function remove_fx_columns($columns) {
    
    unset($columns['wps_post_thumbs']);
    return $columns;
}
add_filter('manage_theux_slider_posts_columns' , 'remove_fx_columns');
