<?php

add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{
		//Access the WordPress Categories via an Array
		$of_categories 		= array();  
		$of_categories_obj 	= get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
		    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
		$categories_tmp 	= array_unshift($of_categories, "Select a category:");    
	       
		//Access the WordPress Pages via an Array
		$of_pages 			= array();
		$of_pages_obj 		= get_pages('sort_column=post_parent,menu_order');    
		foreach ($of_pages_obj as $of_page) {
		    $of_pages[$of_page->ID] = $of_page->post_name; }
		$of_pages_tmp 		= array_unshift($of_pages, "Select a page:");       
	
		//Testing 
		$of_options_select 	= array("one","two","three","four","five"); 
		$of_options_radio 	= array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
		
		//Sample Homepage blocks for the layout manager (sorter)
		$of_options_homepage_blocks = array
		( 
			"disabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_one"		=> "Block One",
				"block_two"		=> "Block Two",
				"block_three"	=> "Block Three",
			), 
			"enabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_four"	=> "Block Four",
			),
		);


		//Stylesheets Reader
		$alt_stylesheet_path = LAYOUT_PATH;
		$alt_stylesheets = array();
		
		if ( is_dir($alt_stylesheet_path) ) 
		{
		    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) 
		    { 
		        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) 
		        {
		            if(stristr($alt_stylesheet_file, ".css") !== false)
		            {
		                $alt_stylesheets[] = $alt_stylesheet_file;
		            }
		        }    
		    }
		}


		//Background Images Reader
		$bg_images_path = get_stylesheet_directory(). '/images/bg/'; // change this to where you store your bg images
		$bg_images_url = get_template_directory_uri().'/images/bg/'; // change this to where you store your bg images
		$bg_images = array();
		
		if ( is_dir($bg_images_path) ) {
		    if ($bg_images_dir = opendir($bg_images_path) ) { 
		        while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
		            if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
		            	natsort($bg_images); //Sorts the array into a natural order
		                $bg_images[] = $bg_images_url . $bg_images_file;
		            }
		        }    
		    }
		}
		

		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/
		
		//More Options
		$uploads_arr 		= wp_upload_dir();
		$all_uploads_path 	= $uploads_arr['path'];
		$all_uploads 		= get_option('of_uploads');
		$other_entries 		= array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
		$body_repeat 		= array("no-repeat","repeat-x","repeat-y","repeat");
		$body_pos 			= array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
		
		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 
		
		// Image Links to Options
		$of_options_image_link_to = array("image" => "The Image","post" => "The Post"); 

		$alt_footer_area = array("empty" => "Empty","widgets" => "Widgets","google_map" => "Google Map"); 
/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options;
$of_options = array();

$of_options[] = array( 	"name" 		=> "Home Settings",
						"type" 		=> "heading"
				);
					
				$of_options[] = array( 	"name" 		=> "The Kind of Logo",
										"desc" 		=> "Select whether you want your main logo to be an image or text. If you select 'image' you can put in the image url in the next option, and if you select 'text' your Site Title will show instead.",
										"id" 		=> "logo_type",
										"std" 		=> "text_logo",
										"type" 		=> "select",
										"options" 	=> array("text_logo" => "Text","image_logo" => "Image")
								);
								
				$of_options[] = array( 	"name" 		=> "Logo URL",
										"desc" 		=> "Enter the direct path to your logo image. For example http://your_website_url_here/wp-content/uploads/logo.png",
										"id" 		=> "logo_url",						
										"std" 		=> "",
										"type" 		=> "upload"
				);
				
				$of_options[] = array( 	"name" 		=> "Margin",
										"desc" 		=> "Logo margin in pixels",
										"id" 		=> "top_margin",
										"std" 		=> "25",
										"type" 		=> "text"
				);	

				$of_options[] = array( 	"name" 		=> "Favicon",
										"desc" 		=> "Enter the direct path to your favicon",
										"id" 		=> "favicon",						
										"std" 		=> "",
										"type" 		=> "upload"
				);
				
				$of_options[] = array( 	"name" 		=> "Apple Touch Icon 57x57",
										"desc" 		=> "Enter the direct path to your Apple Touch Icon 57x57 pixels",
										"id" 		=> "favicon_one",						
										"std" 		=> "",
										"type" 		=> "upload"
				);

				$of_options[] = array( 	"name" 		=> "Apple Touch Icon 72x72",
										"desc" 		=> "Enter the direct path to your Apple Touch Icon 72x72 pixels",
										"id" 		=> "favicon_two",						
										"std" 		=> "",
										"type" 		=> "upload"
				);
				
				$of_options[] = array( 	"name" 		=> "Apple Touch Icon 114x114",
										"desc" 		=> "Enter the direct path to your Apple Touch Icon 114x114 pixels",
										"id" 		=> "favicon_three",						
										"std" 		=> "",
										"type" 		=> "upload"
				);
								
				$of_options[] = array( 	"name" 		=> "Top Header - Phone",
										"desc" 		=> "Input Phone number",
										"id" 		=> "top_phone",
										"std" 		=> "",
										"type" 		=> "text"
				);	

				$of_options[] = array( 	"name" 		=> "Top Header - Email",
										"desc" 		=> "Input Email",
										"id" 		=> "top_email",
										"std" 		=> "",
										"type" 		=> "text"
				);					

				$of_options[] = array( 	"name" 		=> "Top Header Social",
										"desc" 		=> "Show or Hide top header social",
										"id" 		=> "top_social",
										"std" 		=> "show",
										"type" 		=> "select",
										"options" 	=> array("show" => "Show","hide" => "Hide")
								);	
								
				$of_options[] = array( 	"name" 		=> "Privacy Policy Link",
										"desc" 		=> "Enter the direct path to your Privacy Policy page.",
										"id" 		=> "privacy_link",
										"std" 		=> "",
										"type" 		=> "text"
				);
				
				$of_options[] = array( 	"name" 		=> "Footer copyright text",
										"desc" 		=> "Enter text used in the left side of the footer.",
										"id" 		=> "copy_text",
										"std" 		=> "&copy; 2013",
										"type" 		=> "text"
				);					
								
				$of_options[] = array( 	"name" 		=> "Footer Menu",
										"desc" 		=> "Show or Hide footer menu",
										"id" 		=> "footer_menu",
										"std" 		=> "show",
										"type" 		=> "select",
										"options" 	=> array("show" => "Show","hide" => "Hide")
								);		


//Slider			
$of_options[] = array( 	"name" 		=> "Slider Settings",
						"type" 		=> "heading"
				);
				
				$of_options[] = array( 	"name" 		=> "Home Page Slider",
										"desc" 		=> "Show or Hide home page slider",
										"id" 		=> "home_slider",
										"std" 		=> "show",
										"type" 		=> "select",
										"options" 	=> array("show" => "Show","hide" => "Hide")
								);

				$of_options[] = array( 	"name" 		=> "Slideshow",
										"desc" 		=> "Enter the slideshow slug",
										"id" 		=> "slideshow",
										"std" 		=> "home",
										"type" 		=> "text"
				);	

				$of_options[] = array( 	"name" 		=> "Slideshow Width",
										"desc" 		=> "Enter the slideshow width",
										"id" 		=> "width",
										"std" 		=> "1200",
										"type" 		=> "text"
				);

				$of_options[] = array( 	"name" 		=> "Slideshow Height",
										"desc" 		=> "Enter the slideshow height",
										"id" 		=> "height",
										"std" 		=> "750",
										"type" 		=> "text"
				);
				
				$of_options[] = array( 	"name" 		=> "Show Controls",
										"desc" 		=> "Show or Hide slider controls",
										"id" 		=> "controls",
										"std" 		=> "",
										"type" 		=> "select",
										"options" 	=> array("true" => "On","" => "Off")
				);

				$of_options[] = array( 	"name" 		=> "Auto change",
										"desc" 		=> "Auto change on/off",
										"id" 		=> "autochange",
										"std" 		=> "true",
										"type" 		=> "select",
										"options" 	=> array("true" => "On","" => "Off")
				);

				$of_options[] = array( 	"name" 		=> "Timeout",
										"desc" 		=> "Timeout between slides",
										"id" 		=> "timeout",
										"std" 		=> "2000",
										"type" 		=> "text"
				);
								
				$of_options[] = array( 	"name" 		=> "Pause on hover",
										"desc" 		=> "Pause on hover on/off",
										"id" 		=> "pauseonhover",
										"std" 		=> "",
										"type" 		=> "select",
										"options" 	=> array("true" => "On","" => "Off")
				);
			
//Analitics				
$of_options[] = array( 	"name" 		=> "General Settings",
						"type" 		=> "heading"
				);
				
				$url =  ADMIN_DIR . 'assets/images/';
				$of_options[] = array( 	"name" 		=> "Main Layout",
										"desc" 		=> "Select sidebar alignment.",
										"id" 		=> "layout",
										"std" 		=> "right-sidebar",
										"type" 		=> "images",
										"options" 	=> array(										
											'right-sidebar' 	=> $url . '2cr.png',
											'fullwidth' 	=> $url . '1col.png',
											'left-sidebar' 	=> $url . '2cl.png'
										)
								);
								
								
				$of_options[] = array( 	"name" 		=> "Tracking Code",
										"desc" 		=> "Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.",
										"id" 		=> "google_analytics",
										"std" 		=> "",
										"type" 		=> "textarea"
								);		

$of_options[] = array( 	"name" 		=> "Styling Options",
						"type" 		=> "heading"
				);
								
				$of_options[] = array( 	"name" 		=> "Body Background Color",
										"desc" 		=> "Pick a background color for the theme (default: #ffffff).",
										"id" 		=> "body_background",
										"std" 		=> "#FFFFFF",
										"type" 		=> "color"
								);
								
				$of_options[] = array( 	"name" 		=> "Body Background Image",
										"desc" 		=> "Upload background image.",
										"id" 		=> "background_image",
										// Use the shortcodes [site_url] or [site_url_secure] for setting default URLs
										"std" 		=> "",
										"type" 		=> "upload"
								);
								
				$of_options[] = array( 	"name" 		=> "Repeat Background",
										"desc" 		=> "Repeat background.",
										"id" 		=> "repeat_background",
										"std" 		=> 0,
										"type" 		=> "checkbox"
								);
								
				$of_options[] = array( 	"name" 		=> "Header and Footer Background Color",
										"desc" 		=> "Pick a background color for the header and footer(default: #BE5555).",
										"id" 		=> "header_background",
										"std" 		=> "#BE5555",
										"type" 		=> "color"
								);
								
				$of_options[] = array( 	"name" 		=> "Footer Widget Area Background Color",
										"desc" 		=> "Pick a background color for the footer widget area(default: #fff).",
										"id" 		=> "footer_background",
										"std" 		=> "#182028",
										"type" 		=> "color"
								);
								
				$of_options[] = array( 	"name" 		=> "Body Font",
										"desc" 		=> "Specify the body font properties",
										"id" 		=> "body_font",
										"std" 		=> array('size' => '13px','face' => 'Open Sans','style' => 'normal','color' => '#3d4a5d'),
										"type" 		=> "typography"
								);  

				$of_options[] = array( 	"name" 		=> "Buttons Background Color",
										"desc" 		=> "Pick a background color for the buttons(default: #0F5D7F).",
										"id" 		=> "button_background",
										"std" 		=> "#0F5D7F",
										"type" 		=> "color"
								);
								
				$of_options[] = array( 	"name" 		=> "Title Overlay Background Image",
										"desc" 		=> "Upload title overlay background image.",
										"id" 		=> "overlay_image",
										// Use the shortcodes [site_url] or [site_url_secure] for setting default URLs
										"std" 		=> "",
										"type" 		=> "upload"
								);
								
				$of_options[] = array( 	"name" 		=> "Title Inner Background Image",
										"desc" 		=> "Upload title inner background image.",
										"id" 		=> "inner_image",
										// Use the shortcodes [site_url] or [site_url_secure] for setting default URLs
										"std" 		=> "",
										"type" 		=> "upload"
								);								
								
				$of_options[] = array( 	"name" 		=> "Custom CSS",
										"desc" 		=> "Quickly add some CSS to your theme by adding it to this block.",
										"id" 		=> "custom_css",
										"std" 		=> "",
										"type" 		=> "textarea"
								);									
								
//Donation		
$of_options[] = array( 	"name" 		=> "Donation Settings",
						"type" 		=> "heading"
				);
				
				$of_options[] = array( 	"name" 		=> "PayPal Account",
										"desc" 		=> "Enter account e-mail",
										"id" 		=> "paypal_account",
										"std" 		=> "",
										"type" 		=> "text"
				);
				
				$of_options[] = array( 	"name" 		=> "Currency",
										"desc" 		=> "Select currency",
										"id" 		=> "currency",
										"std" 		=> "usd",
										"type" 		=> "select",
										"options" 	=> array("usd" => "USD","eur"=>"EUR","gbp"=>"GBP","yen"=>"YEN","cad"=>"CAD")
				);
				
				$of_options[] = array( 	"name" 		=> "Donation Amount",
										"desc" 		=> "Enter min donation amount",
										"id" 		=> "paypal_amount",
										"std" 		=> "50",
										"type" 		=> "text"
				);	
				
				$of_options[] = array( 	"name" 		=> "Mode",
										"desc" 		=> "Select mode",
										"id" 		=> "donation_mode",
										"std" 		=> "test",
										"type" 		=> "radio",
										"options" 	=> array("pro" => "Production","test"=>"Test")
				);
				
				$of_options[] = array( 	"name" 		=> "Title",
										"desc" 		=> "Enter tile",
										"id" 		=> "donation_title",
										"std" 		=> "",
										"type" 		=> "text"
				);
				
				$of_options[] = array( 	"name" 		=> "Descripton",
										"desc" 		=> "Enter descripton",
										"id" 		=> "donation_descr",
										"std" 		=> "",
										"type" 		=> "textarea"
				);

$of_options[] = array( 	"name" 		=> "Contacts Page",
						"type" 		=> "heading",
						"icon"		=> ADMIN_IMAGES . "icon-edit.png"
				);

				$of_options[] = array( 	"name" 		=> "Contact Form Title",
										"desc" 		=> "Enter contact form title",
										"id" 		=> "form_title",
										"std" 		=> "Feedback",
										"type" 		=> "text"
				);
				
				$of_options[] = array( 	"name" 		=> "Contact Form ID",
										"desc" 		=> "Enter \"Contact Form 7\" Plugin ID.",
										"id" 		=> "form_id",
										"std" 		=> "",
										"type" 		=> "text"
				);

				$of_options[] = array( 	"name" 		=> "Address block Title",
										"desc" 		=> "Enter address block title",
										"id" 		=> "address_title",
										"std" 		=> "Where to Find Us:",
										"type" 		=> "text"
				);
				
				$of_options[] = array( 	"name" 		=> "Address",
										"desc" 		=> "Enter your address",
										"id" 		=> "address",
										"std" 		=> "",
										"type" 		=> "textarea"
								);	

				$of_options[] = array( 	"name" 		=> "Phone",
										"desc" 		=> "Enter your phone",
										"id" 		=> "phone",
										"std" 		=> "",
										"type" 		=> "text"
								);

				$of_options[] = array( 	"name" 		=> "Social block Title",
										"desc" 		=> "Enter social block title",
										"id" 		=> "social_title",
										"std" 		=> "Follow Us:",
										"type" 		=> "text"
				);		

				$of_options[] = array( 	"name" 		=> "Google map",
										"desc" 		=> "Enter Google map linkk",
										"id" 		=> "map_link",
										"std" 		=> "",
										"type" 		=> "textarea"
				);

				$of_options[] = array( 	"name" 		=> "Map Height",
										"desc" 		=> "Enter map height value",
										"id" 		=> "map_height",
										"std" 		=> "450",
										"type" 		=> "text"
				);					
	

$of_options[] = array( 	"name" 		=> "Social Media",
						"type" 		=> "heading"
				);

				$of_options[] = array( 	"name" 		=> "Facebook link",
										"desc" 		=> "Enter Facebook link",
										"id" 		=> "facebook_link",
										"std" 		=> "",
										"type" 		=> "text"
				);	

				$of_options[] = array( 	"name" 		=> "Twitter link",
										"desc" 		=> "Enter Twitter link",
										"id" 		=> "twitter_link",
										"std" 		=> "",
										"type" 		=> "text"
				);

				$of_options[] = array( 	"name" 		=> "Google+ link",
										"desc" 		=> "Enter Google+ link",
										"id" 		=> "google_plus_link",
										"std" 		=> "",
										"type" 		=> "text"
				);

				$of_options[] = array( 	"name" 		=> "Skype link",
										"desc" 		=> "Enter Skype link",
										"id" 		=> "skype_link",
										"std" 		=> "",
										"type" 		=> "text"
				);	

				$of_options[] = array( 	"name" 		=> "YouTube link",
										"desc" 		=> "Enter YouTube link",
										"id" 		=> "youtube_link",
										"std" 		=> "",
										"type" 		=> "text"
				);	
				
				$of_options[] = array( 	"name" 		=> "LinkedIn link",
										"desc" 		=> "Enter LinkedIn link",
										"id" 		=> "linkedin_link",
										"std" 		=> "",
										"type" 		=> "text"
				);	

	
// Backup Options
$of_options[] = array( 	"name" 		=> "Backup Options",
						"type" 		=> "heading",
						"icon"		=> ADMIN_IMAGES . "icon-slider.png"
				);
				
$of_options[] = array( 	"name" 		=> "Backup and Restore Options",
						"id" 		=> "of_backup",
						"std" 		=> "",
						"type" 		=> "backup",
						"desc" 		=> 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
				);
				
$of_options[] = array( 	"name" 		=> "Transfer Theme Options Data",
						"id" 		=> "of_transfer",
						"std" 		=> "",
						"type" 		=> "transfer",
						"desc" 		=> 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".',
				);
				
	}//End function: of_options()
}//End chack if function exists: of_options()
?>
