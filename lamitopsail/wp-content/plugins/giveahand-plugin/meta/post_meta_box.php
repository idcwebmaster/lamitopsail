<?php

// Add the Meta Box
function add_custom_meta_box() {
    add_meta_box(
		'custom_meta_box', // $id
		'Set post preview', // $title 
		'show_custom_meta_box', // $callback
		'post', // $page
		'normal', // $context
		'high'); // $priority
}
add_action('add_meta_boxes', 'add_custom_meta_box');

// Field Array
$prefix = 'post_';
$custom_meta_fields = array(
	
	array(
		'label'	=> 'Select Post Preview',
		'desc'	=> 'Select post preview: thumbnail, thumbnail with lightbox,<br> embed video( Youtube etc. ) or audio( Soundcloud etc. )',
		'id'	=> $prefix.'select',
		'type'	=> 'select',
		'options' => array (
			'one' => array (
				'label' => 'Thumbnail',
				'value'	=> 'one'
			),
			'two' => array (
				'label' => 'Lightbox',
				'value'	=> 'two'
			),
			'three' => array (
				'label' => 'Embed',
				'value'	=> 'three'
			)
		)
	),
	array(
		'label'	=> 'Lightbox',
		'desc'	=> 'Set fullsized image.',
		'id'	=> 'lightbox',
		'type'	=> 'image'
	),
	array(
		'label'	=> 'Embed Code',
		'desc'	=> 'Paste embed video or audio code.',
		'id'	=> $prefix.'textarea',
		'type'	=> 'textarea'
	),
	array(
		'label'	=> 'External Link',
		'desc'	=> 'Set the external link.',
		'id'	=> $prefix.'link',
		'type'	=> 'text'
	)
);



// The Callback
function show_custom_meta_box() {
	global $custom_meta_fields, $post;
	// Use nonce for verification
	echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';
	
	// Begin the field table and loop
	echo '<table class="form-table">';
	foreach ($custom_meta_fields as $field) {
		// get value of this field if it exists for this post
		$meta = get_post_meta($post->ID, $field['id'], true);
		// begin a table row with
		echo '<tr>
				<th><label for="'.$field['id'].'">'.$field['label'].'</label></th>
				<td>';
				switch($field['type']) {
					// select
					case 'select':
						echo '<select name="'.$field['id'].'" id="'.$field['id'].'">';
						foreach ($field['options'] as $option) {
							echo '<option', $meta == $option['value'] ? ' selected="selected"' : '', ' value="'.$option['value'].'">'.$option['label'].'</option>';
						}
						echo '</select><br /><span class="description">'.$field['desc'].'</span>';
					break;
					// image
					case 'image':
						$image = get_template_directory_uri().'/images/image.png';	
						echo '<span class="custom_default_image" style="display:none">'.$image.'</span>';
						if ($meta) { $image = wp_get_attachment_image_src($meta, 'medium');	$image = $image[0]; }				
						echo	'<input name="'.$field['id'].'" type="hidden" class="custom_upload_image" value="'.$meta.'" />
									<img src="'.$image.'" class="custom_preview_image" alt="" /><br />
										<input class="custom_upload_image_button button" type="button" value="Choose Image" />
										<small>&nbsp;<a href="#" class="custom_clear_image_button">Remove Image</a></small>
										<br clear="all" /><span class="description">'.$field['desc'].'</span>';
					break;
					// textarea
					case 'textarea':
						echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="60" rows="4">'.$meta.'</textarea>
								<br /><span class="description">'.$field['desc'].'</span>';
					break;
					// text
					case 'text':
						echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" />
								<br /><span class="description">'.$field['desc'].'</span>';
					break;
					
					
				} //end switch
		echo '</td></tr>';
	} // end foreach
	echo '</table>'; // end table
}



// Save the Data
function save_custom_meta($post_id) {
    global $custom_meta_fields;
	
	// verify nonce
	if (isset($_POST['custom_meta_box_nonce']) and !wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__))) 
		return $post_id;
	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
		return $post_id;
	// check permissions
	if (isset($_POST['post_type']) and 'page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id))
			return $post_id;
		} elseif (!current_user_can('edit_post', $post_id)) {
			return $post_id;
	}
	
	// loop through fields and save the data
	foreach ($custom_meta_fields as $field) {
		if($field['type'] == 'tax_select') continue;
		$old = get_post_meta($post_id, $field['id'], true);
		if (isset ($_POST[$field['id']])) {
		$new = $_POST[$field['id']];
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
		}
	} // enf foreach
	

}
add_action('save_post', 'save_custom_meta');

?>