jQuery(document).ready(function(){

		jQuery("input[type='reset']").live("click", function(){
			jQuery(".wpcf7-response-output, .wpcf7-not-valid-tip").text("");
		});
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

		
	jQuery(".menu>li>a").live("click",function(){ 
		jQuery(".menu>li").removeClass("current-page-item");
		jQuery(this).parent().addClass("current-page-item");
	})	
		
	jQuery('.main-navigation ul:first-child').clone().appendTo('.mobile-menu');

	jQuery('.mobile-menu-trigger').click(function(event){
			event.preventDefault();
		jQuery('.mobile-menu').slideToggle();
	});
	
	jQuery('#main').fitVids();


		
	/*===================LightenDarkenColor======================*/
	function LightenDarkenColor(col, amt) { 
	col = col.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
	col = "#" +
		("0" + parseInt(col[1],10).toString(16)).slice(-2) +
		("0" + parseInt(col[2],10).toString(16)).slice(-2) +
		("0" + parseInt(col[3],10).toString(16)).slice(-2);
    var usePound = false; 
    if (col[0] == "#") {
        col = col.slice(1);
        usePound = true;
    }
    var num = parseInt(col,16);
    var r = (num >> 16) + amt;
    if (r > 255) r = 255;
    else if  (r < 0) r = 0;
    var b = ((num >> 8) & 0x00FF) + amt;
    if (b > 255) b = 255;
    else if  (b < 0) b = 0; 
    var g = (num & 0x0000FF) + amt;
    if (g > 255) g = 255;
    else if (g < 0) g = 0;
    return (usePound?"#":"") + (g | (b << 8) | (r << 16)).toString(16); 
}




	

	/*================Button hover effect===========================*/
	
			jQuery(".button, .page-numbers>li>a, .button-custom, .page-links>a>span, .post-navigation>a, .fl>a, .fr>a, input[type='submit'], .more-link,.bx-next, .bx-prev, .filter > li > a, .tagcloud > a, .reply-button>a, .articles-nav .previouspostslink, .articles-nav .nextpostslink, .articles-nav .page, .ad-navigation .ad-next, .ad-navigation .ad-prev ").hover(
		 		function(){ 
				bgcol = jQuery(this).css('backgroundColor'); console.log(bgcol);
					// Lighten
					NewColor = bgcol;
					if (bgcol!='transparent') {
						NewColor = LightenDarkenColor(bgcol, 10);
					}
					jQuery(this).css('backgroundColor', NewColor);
				},
				function(){
					jQuery(this).css('backgroundColor', bgcol);
				}
			);

	/*==================WooCommerce=================*/
	
	jQuery(".cart-menu").live("click",function(){

		jQuery(this).parent().find(".amount-cart").toggleClass("visible");
	
	});
	
}); //end document ready!


jQuery(window).load(function(){	

		/*===============Donate func================*/


		function donate_center() {
			var overlayHeight = jQuery('.donation-container').outerHeight();
			var windowHeight = jQuery(window).height();
			var centerOffset = windowHeight / 2 - overlayHeight / 2;
			jQuery('.donation-container').css({ marginTop : centerOffset });
		} 

		jQuery(".donate").on("click", function(){ 
			jQuery(".donation-overlay").fadeIn(200);
			donate_center();
		});
		jQuery(".form-close").on("click", function(){ 
			jQuery(".donation-overlay").fadeOut(200);
		});
		jQuery(window).resize(function(){
			donate_center();
		});		
		
		//jQuery("body").on("click", "a[href='#']", function(){return false});	
		

});

	
	
