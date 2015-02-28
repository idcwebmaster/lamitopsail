<?php

// Add the Meta Box
function add_portfolio_meta_box() {
    add_meta_box(
		'portfolio_meta_box', // $id
		'Options', // $title 
		'show_portfolio_meta_box', // $callback
		'portfolio', // $page
		'normal', // $context
		'high'); // $priority
}
add_action('add_meta_boxes', 'add_portfolio_meta_box');

// Field Array
$prefix = '';
$portfolio_meta_fields = array(
	
	array(
		'label'	=> 'Select Format',
		'desc'	=> 'Select format: standard, image lightbox,<br>video lightbox( Youtube etc. ) or custom link',
		'id'	=> 'select',
		'type'	=> 'select',
		'options' => array (
			'one' => array (
				'label' => 'Standard',
				'value'	=> 'one'
			),
			'two' => array (
				'label' => 'Custom Link',
				'value'	=> 'two'
			),
			'three' => array (
				'label' => 'Image lightbox',
				'value'	=> 'three'
			),
			'four' => array (
				'label' => 'Video lightbox',
				'value'	=> 'four'
			)
			//'five' => array (
			//	'label' => 'Multiple Lightbox',
			//	'value'	=> 'six'
			//)
		)
	),
	array(
		'label'	=> 'Set fullsized image',
		'desc'	=> 'For image lightbox only',
		'id'	=> 'big_image',
		'type'	=> 'image'
	),
	//array(
	//	'label'	=> 'Multiple Gallery',
	//	'desc'	=> '',
	//	'id'	=> 'repeatable',
	//	'type'	=> 'repeatable'
	//),
	array(
		'label'	=> 'Video',
		'desc'	=> 'Add link to the "Youtube" or "Vimeo" video<br> for video lightbox format',
		'id'	=> 'lightbox',
		'type'	=> 'embed'
	),
	//array(
	//	'label'	=> 'Image description',
	//	'desc'	=> 'Add image description',
	//	'id'	=> 'slider_content',
	//	'type'	=> 'textarea'
	//),
	array(
		'label'	=> 'Custom Link',
		'desc'	=> 'Set the cutom link for "Custom link" format',
		'id'	=> 'custom_link',
		'type'	=> 'text'
	)
);



// The Callback
function show_portfolio_meta_box() {
	global $portfolio_meta_fields, $post;
	// Use nonce for verification
	echo '<input type="hidden" name="portfolio_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';
	
	// Begin the field table and loop
	echo '<table class="form-table">';
	foreach ($portfolio_meta_fields as $field) {
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
					// repeatable
					case 'repeatable':
						
						echo '<a class="repeatable-add button" href="#">Add image</a><br /><br />
						
								
								<ul id="'.$field['id'].'-repeatable" class="custom_repeatable">';
						$i = 0;
						if ($meta)
						{					
							foreach($meta as $row) {							
								echo '<li>
								<input name="'.$field['id'].'['.$i.'][0]" type="text" class="custom_upload_file" value="'.$row[0].'" size="40" />
										<input name="'.$field['id'].'" class="custom_upload_file_button button" type="button" value="Browse" />							
										<a class="repeatable-remove button" href="#">Remove</a></li>';
								$i++;
							}
						} else {
							echo '<li>
							<input name="'.$field['id'].'['.$i.'][0]" type="text" class="custom_upload_file" value="" size="40" />
										<input name="'.$field['id'].'" class="custom_upload_file_button button" type="button" value="Browse" />								
										<a class="repeatable-remove button" href="#">Remove</a></li>';
						}
						echo '</ul>';
							
					break;
					// textarea
					case 'textarea':
						echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="60" rows="4">'.$meta.'</textarea>
								<br /><span class="description">'.$field['desc'].'</span>';
					break;
					// textarea
					case 'textarea':
						echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="60" rows="4">'.$meta.'</textarea>
								<br /><span class="description">'.$field['desc'].'</span>';
					break;
					// textarea
					case 'embed':
						echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="60" rows="4">'.$meta.'</textarea>
								<br /><span class="description">'.$field['desc'].'</span>';
					break;
					// text
					case 'text':
						echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="60" />
								<br /><span class="description">'.$field['desc'].'</span>';
					break;
					
					
				} //end switch
		echo '</td></tr>';
	} // end foreach
	echo '</table>'; // end table
}



// Save the Data
function save_portfolio_meta($post_id) {
    global $portfolio_meta_fields;
	
	// verify nonce
	if (isset($_POST['portfolio_meta_box_nonce']) and !wp_verify_nonce($_POST['portfolio_meta_box_nonce'], basename(__FILE__))) 
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
	foreach ($portfolio_meta_fields as $field) {
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
add_action('save_post', 'save_portfolio_meta');

?>