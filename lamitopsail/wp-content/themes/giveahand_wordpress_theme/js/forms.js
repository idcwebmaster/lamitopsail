(function(jQuery){
	jQuery.fn.ajaxForms=function(o){
		/*---------------------*/
		
		jQuery("input[type='text'], input[type='email'], textarea").live("focus", formInputFocus);
		jQuery("input[type='text'], input[type='email'], textarea").live("blur", formInputBlur);
		
		/*----------Focus----------*/		
		function formInputFocus(){
			var item=jQuery(this);
			item.removeClass("errorInput");	
			if(item.data("val")==undefined){
				item.data("val", item.val())
			}
			if(item.val()==item.data("val")){
				item.val("");
			}
		}
		/*----------Blur----------*/
		function formInputBlur(){
			var item=jQuery(this);
			if(item.val()==""){
				item.val(item.data("val"));	
			}
		}

		/*--------------------*/
		


	}
})(jQuery)