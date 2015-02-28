jQuery(document).ready(function(){

	/*===============================================*/

		jQuery('section.parallax').each(function(){
			var sectionParallax = "#"+jQuery(this).attr('id'); 
			var effectSpeed = jQuery(this).attr('data-speed') / 100;
			jQuery(sectionParallax).parallax("50%", effectSpeed );
		});
		
		jQuery(".bgvdplayer").each(function(){
			jQuery(this).mb_YTPlayer();
		});
		
	
	/*=========================Custom Slider=========================*/	
	
	jQuery('.custom_slider').each(function(){ 
		jQuery(this).bxSlider({
			auto:true,
			minSlides: 1,
			maxSlides: 1,
			pager:false,
			easing:'ease',
			moveSlides:1,
			prevText:'',
			nextText:''
		});
	});		    

	/*===============Articles Hover==================*/
	
		jQuery(".articles.wide>.news-element").hover(
			function(){ 
					bg_color = "#0A4863"; 
					jQuery(this).stop(true,false).css({"marginLeft":23+"px","marginTop":-7+"px","box-shadow":"7px 7px" +bg_color});					
			},
			function(){
				jQuery(this).stop(true,false).css({"marginLeft":30+"px","marginTop":0, "box-shadow":"0px 0px" +bg_color});
			}
		);
	/*===========================Articles Slider=========================*/	
	
	jQuery('.recent-posts-slider').each(function(){ 
		jQuery(this).bxSlider({
			  minSlides: 1,
			  maxSlides: 1,
			  slideWidth:570,
			  pager:false,
			  infiniteLoop:false,
			  easing:'ease',
			  moveSlides:1,
			  prevText:'<<',
			  nextText:'>>'
		});
	});
	
	/*======================Gallery Hover=================================*/
	
	function folio_hover() {

			jQuery("body").on("mouseover", ".filterable-grid div>a",
		 		function(){
					jQuery(">span", this).stop(true).animate({"opacity":1},200, "easeInOutSine" );
					jQuery(">strong", this).stop(true).delay(150).animate({"opacity":1},200, "easeInOutSine" );
					jQuery(">i", this).stop(true).delay(200).animate({"opacity":1},350, "easeInOutSine" );
				}
			)
			jQuery("body").on("mouseout", ".filterable-grid div>a",
				function(){
					jQuery(">i", this).stop(true).animate({"opacity":0},200, "easeInOutSine" );
					jQuery(">strong", this).stop(true).delay(150).animate({"opacity":0},200, "easeInOutSine" );
					jQuery(">span", this).stop(true).delay(200).animate({"opacity":0},200, "easeInOutSine" );
				}
			)
	};
	folio_hover();

	function lightbox(){
	jQuery("a[rel^='pretty']").prettyPhoto({
			animationSpeed:'fast',
			theme:'pp_default',
			show_title:false,
			allow_resize: true,
			horizontal_padding: 0,
			overlay_gallery: false,
			social_tools: false,
			deeplinking: false
	});		
	};
	lightbox();


	
	function portfolio_quicksand() {	
	
		// Setting Up Our Variables
		var jQueryfilter;
		var jQuerycontainer;
		var jQuerycontainerClone;
		var jQueryfilterLink;
		var jQueryfilteredItems
		
		// Set Our Filter
		jQueryfilter = jQuery('.filter li.active a').attr('class');
		
		// Set Our Filter Link
		jQueryfilterLink = jQuery('.filter li a');
		
		// Set Our Container
		jQuerycontainer = jQuery('div.filterable-grid');
		
		// Clone Our Container
		jQuerycontainerClone = jQuerycontainer.clone();
		
		// Apply our Quicksand to work on a click function
		// for each for the filter li link elements
		jQueryfilterLink.click(function(e) 
		{
			// Remove the active class
			jQuery('.filter li').removeClass('active');
			
			// Split each of the filter elements and override our filter
			jQueryfilter = jQuery(this).attr('class').split(' ');
			
			// Apply the 'active' class to the clicked link
			jQuery(this).parent().addClass('active');

			// If 'all' is selected, display all elements
			// else output all items referenced to the data-type
			if (jQueryfilter == 'all') {
				jQueryfilteredItems = jQuerycontainerClone.find('div'); 
			}
			else {
				jQueryfilteredItems = jQuerycontainerClone.find('div[data-type~=' + jQueryfilter + ']'); 
			}
			
			// Finally call the Quicksand function
			jQuerycontainer.quicksand(jQueryfilteredItems, 
			{
			});
			
			//Initalize our PrettyPhoto Script When Filtered
			jQuerycontainer.quicksand(jQueryfilteredItems, 
				function () { lightbox(); folio_hover(); }
			);			
		});
	}
		
	if(jQuery().quicksand) {
		portfolio_quicksand();	
	}
		

	if(jQuery().prettyPhoto) {
		lightbox();
		folio_hover();
	}
		
	/*====================Teambox Hover=============================*/
	
	jQuery(".page-content").css({"opacity":0});
	jQuery('.page-content').parent().each(function() { 
			jQuery(this).appear(function() {
				jQuery(this).find('> div').each(function(i){	
					jQuery(this).delay(i*300).animate({"opacity":1},450);
				});
			});
	});		
		
		
	/*===================Activity Page Effects=====================*/
	
	jQuery(".activity>.element").first().addClass("active");
	jQuery(".activity>.element").first().find(">div").removeClass("span3").addClass("span6");
	
	jQuery(".activity>.element").live("click",
		function(){
			jQuery(".element.active>div").removeClass("span6").addClass("span3");
			jQuery(".element.active").removeClass("active");

			jQuery(this).addClass("active")
			jQuery(">div", this).removeClass("span3").addClass("span6");
			
			jQuery('.activity').masonry('reload');
			return false;
		}
	);
	jQuery(".activity>.element a.button").live("click",
		function(){
			hrefL = jQuery(this).attr("href");
			window.location = hrefL;
		}
	);
	jQuery(".activity .preview").css({"opacity":0});
	
	jQuery('.activity').each(function() {
		jQuery(this).appear(function() {
			jQuery(this).find('> div').each(function(i){ 
					jQuery(this).delay(i*200).animate({"marginTop":0+"px"},450);
					jQuery(".preview", this).stop(true).delay(i*200).animate({"opacity":1},450);
				
			});
		});
	});		
		
	/*===========================Activity Slider=========================*/	
	
	jQuery('.element-events').each(function(){ 
		jQuery(this).bxSlider({
			  minSlides: 1,
			  maxSlides: 2,
			  slideWidth: 270,
			  slideMargin: 30,
			  pager:false,
			  infiniteLoop:false,
			  easing:'ease',
			  moveSlides:1,
			  prevText:'<<',
			  nextText:'>>'
		});
	});
	
	/*==================Carousel========================*/
	
	jQuery('.carousel').each(function(){ 
		jQuery(this).bxSlider({
			minSlides: 1,
			maxSlides: 5,
			slideWidth: 180,
			slideMargin: 30,
			pager:false,
			infiniteLoop:false,
			easing:'ease',
			moveSlides:1,
			prevText:'<<',
			nextText:'>>',
			adaptiveHeight:true				
		});	
	});
	/*=======================Notification box=====================================*/
	
	jQuery(".alert>i").live("click", function(){
		jQuery(this).parent().fadeOut(450);
	});	
		
	/*============Animated Progress Bar=============*/
	
	jQuery(function(){ 
	jQuery('.animated-progressBar').each(function(){ 
		jQuery(this).appear(function() {
				jQuery(this).find('> div').each(function(iu){ 
				ret = jQuery(this).find('> div').attr("data-position");
				wWidth = jQuery(this).width() * ret / 100;
					jQuery(this).find('> div').delay(iu*600).animate({width: wWidth},{duration: 1200,step: function( currentWidth ){
					jQuery("span", this).css({"display":"block"}); jQuery("i", this).css({"display":"block"});
					log = Math.round(currentWidth / jQuery(this).parent().width() * 100);
						jQuery("span", this).html( log + "%");
					}
					}
					);
					if(ret == '100'){
						jQuery(this).find('> div').addClass('full');
					}
				});
		});
	});
	});
	
	/*============Progress Bar=============*/
	
	jQuery(function(){ 
	jQuery('.progressBar').each(function(){ 
		jQuery(this).appear(function() {
			jQuery(this).find('> div').each(function(){ 
				rety = jQuery(this).attr("data-position");
				fluidW = jQuery(this).parent().width() * (rety-1)/ 100
				jQuery(this).css({"width":fluidW});
				jQuery("strong", this).animate({width: fluidW},{duration: 1200,step: function( cW ){
					logy = Math.round(cW / jQuery(this).parent().parent().width() * 100) + 1;
						jQuery(this).parent().find("span").html(logy +"%");
					}
					});
			});
		});
	});	
	});
	
	
		/** Tabs & Toggles
	-------------------------------*/
	// Tabs
	if(jQuery().tabs) {
		jQuery(".block_tabs").tabs({ 
			show: true 
		});
	}
	
	// Toggles
	jQuery('.block_toggle .tab-head, .block_toggle .arrow').each( function() {
		var toggle = jQuery(this).parent();
		
		jQuery(this).click(function() {
			toggle.find('.tab-body').slideToggle();
			toggle.find('.tab-head').toggleClass("clicked");
			return false;
		});
		
	});
	// Accordion
	jQuery('.block_accordion_wrapper>div:first-child .tab-head').addClass('clicked');
	jQuery(document).on('click', '.block_accordion_wrapper .tab-head', function() {
		var $clicked = jQuery(this);
		jQuery('.block_accordion_wrapper .tab-head').removeClass('clicked');
		$clicked.addClass('clicked');
		
		$clicked.parents('.block_accordion_wrapper').find('.tab-body').each(function(i, el) {
			if(jQuery(el).is(':visible') && ( jQuery(el).prev().hasClass('clicked') || jQuery(el).prev().prev().hasClass('clicked') ) == false ) {
				jQuery(el).slideUp();
			}
		});
		
		$clicked.parent().children('.tab-body').slideToggle('slow', function(){
			if ($clicked.parent().children('.tab-body').is(':hidden')) { $clicked.removeClass('clicked'); };
			
		});

		return false;
	});			
		
});

jQuery(window).load(function(){	

/*============================Masonry==================================*/

		
		jQuery('.articles.wide').masonry({
			itemSelector: 'article'
		});
	
		jQuery('.activity').masonry({
			itemSelector: '.element',
			columnWidth: 1
		});
	
		jQuery(window).resize(function () {
			jQuery('.articles.wide').masonry('reload');
			jQuery('.activity').masonry('reload');
		});
		
	

		
});

