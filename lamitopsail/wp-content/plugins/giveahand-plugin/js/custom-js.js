jQuery(function(jQuery) {

	jQuery('#media-items').bind('DOMNodeInserted',function(){
		jQuery('input[value="Insert into Post"]').each(function(){
				jQuery(this).attr('value','Use This Image');
		});
	});
	
	jQuery('.custom_upload_image_button').click(function() {
		formfield = jQuery(this).siblings('.custom_upload_image');
		preview = jQuery(this).siblings('.custom_preview_image');
		tb_show('', 'media-upload.php?type=image&TB_iframe=true');
		window.send_to_editor = function(html) {
			imgurl = jQuery('img',html).attr('src');
			classes = jQuery('img', html).attr('class');
			id = classes.replace(/(.*?)wp-image-/, '');
			formfield.val(id);
			preview.attr('src', imgurl);
			tb_remove();
		}
		return false;
	});
	
	jQuery('.custom_clear_image_button').click(function() {
		var defaultImage = jQuery(this).parent().siblings('.custom_default_image').text();
		jQuery(this).parent().siblings('.custom_upload_image').val('');
		jQuery(this).parent().siblings('.custom_preview_image').attr('src', defaultImage);
		return false;
	});
	
	jQuery('.repeatable-add').click(function() {
		field = jQuery(this).closest('td').find('.custom_repeatable li:last').clone(true);
		fieldLocation = jQuery(this).closest('td').find('.custom_repeatable li:last');
		jQuery('input', field).val('').attr('name', function(index, name) {
			return name.replace(/(\d+)/, function(fullMatch, n) {
				return Number(n) + 1;
			});
		})	
		field.insertAfter(fieldLocation, jQuery(this).closest('td'))
		jQuery(".custom_upload_file_button").attr('value','Browse');
		return false;
	});
	
	jQuery('.repeatable-remove').click(function(){
		jQuery(this).parent().remove();
		return false;
	});
		
	
	
	
	
	
	
	jQuery('.custom_upload_file_button').click(function() {
		formfield = jQuery(this).siblings('.custom_upload_file');
		preview = jQuery(this).siblings('.custom_preview_file');
		tb_show('', 'media-upload.php?type=audio&TB_iframe=true');
		window.send_to_editor = function(html) {
			imgurl = jQuery(html).attr('href'); 
			classes = jQuery(html).attr('href'); 
			id = classes;
			formfield.val(id);
			preview.attr('href', imgurl);
			tb_remove();
		}
		return false;
	});
	
	jQuery('.custom_clear_file_button').click(function() {
		var defaultImage = jQuery(this).parent().siblings('.custom_default_file').text();
		jQuery(this).parent().siblings('.custom_upload_file').val('');
		jQuery(this).parent().siblings('.custom_preview_file').attr('src', defaultImage);
		return false;
	});
	
	
	
	
	
	
	
	

});