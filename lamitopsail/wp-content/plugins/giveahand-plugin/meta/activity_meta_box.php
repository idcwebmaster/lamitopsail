<?php

// Add the Meta Box
function add_activity_meta_box() {
    add_meta_box(
		'activity_meta_box', // $id
		'Options', // $title 
		'show_activity_meta_box', // $callback
		'activity', // $page
		'normal', // $context
		'high'); // $priority
}
add_action('add_meta_boxes', 'add_activity_meta_box');

// Field Array
$prefix = 'activity_';
$activity_meta_fields = array(
	array(
		'label'	=> 'Subtitle',
		'desc'	=> 'Set the subtitle',
		'id'	=> $prefix.'subtitle',
		'type'	=> 'text'
	),
	array(
		'label'	=> 'External Link',
		'desc'	=> 'Set an "activity" external link.',
		'id'	=> $prefix.'link',
		'type'	=> 'text'
	)
);

// The Callback
function show_activity_meta_box() {
	global $activity_meta_fields, $post;
	// Use nonce for verification
	echo '<input type="hidden" name="pager_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';	
	// Begin the field table and loop
	echo '<table class="form-table">';
	foreach ($activity_meta_fields as $field) {
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
function save_activity_meta($post_id) {
    global $activity_meta_fields;
	
	// verify nonce
	if (isset ($_POST['activity_meta_box_nonce']) and !wp_verify_nonce($_POST['activity_meta_box_nonce'], basename(__FILE__))) 
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
	foreach ($activity_meta_fields as $field) {
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
add_action('save_post', 'save_activity_meta');

?>