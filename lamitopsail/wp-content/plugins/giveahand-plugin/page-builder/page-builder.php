<?php
if(class_exists('AQ_Page_Builder')) {

	define('AQPB_CUSTOM_DIR', dirname(__FILE__) . '/');
	define('AQPB_CUSTOM_URI', dirname(__FILE__) . '/');

	//include the block files
	require_once(AQPB_CUSTOM_DIR . 'blocks/featured-block.php');
	require_once(AQPB_CUSTOM_DIR . 'blocks/our-staff-block.php');	
	require_once(AQPB_CUSTOM_DIR . 'blocks/contact-form-block.php');
	require_once(AQPB_CUSTOM_DIR . 'blocks/address-block.php');
	require_once(AQPB_CUSTOM_DIR . 'blocks/social-block.php');
	require_once(AQPB_CUSTOM_DIR . 'blocks/tabs-block.php');
	require_once(AQPB_CUSTOM_DIR . 'blocks/price-block.php');
	require_once(AQPB_CUSTOM_DIR . 'blocks/alert-block.php');
	require_once(AQPB_CUSTOM_DIR . 'blocks/quote-block.php');
	require_once(AQPB_CUSTOM_DIR . 'blocks/recent-block.php');
	//require_once(AQPB_CUSTOM_DIR . 'blocks/clients-block.php');
	require_once(AQPB_CUSTOM_DIR . 'blocks/text-block.php');
	require_once(AQPB_CUSTOM_DIR . 'blocks/skills-block.php');
	require_once(AQPB_CUSTOM_DIR . 'blocks/lists-block.php');
	//require_once(AQPB_CUSTOM_DIR . 'blocks/services-block.php');
	//require_once(AQPB_CUSTOM_DIR . 'blocks/testimonials-block.php');
	require_once(AQPB_CUSTOM_DIR . 'blocks/map-block.php');
	require_once(AQPB_CUSTOM_DIR . 'blocks/slider-block.php');
	require_once(AQPB_CUSTOM_DIR . 'blocks/contentslider-block.php');
	require_once(AQPB_CUSTOM_DIR . 'blocks/activity-block.php');
	require_once(AQPB_CUSTOM_DIR . 'blocks/carousel-block.php');
	require_once(AQPB_CUSTOM_DIR . 'blocks/process-block.php');

	//deregister the blocks
	aq_unregister_block('AQ_Text_Block');
	aq_unregister_block('AQ_Alert_Block');
	aq_unregister_block('AQ_Tabs_Block');
	aq_unregister_block('AQ_Richtext_Block');
	
	//register the blocks
	
	aq_register_block('Text_Block');
	aq_register_block('Our_Staff');
	aq_register_block('Featured_Block');
	aq_register_block('Contact_Form_Block');
	aq_register_block('Address_Block');
	aq_register_block('Social_Block');
	aq_register_block('Tabs_Block');
	aq_register_block('Price_Block');
	aq_register_block('Alert_Block');
	aq_register_block('Quote_Block');
	aq_register_block('Recent_Block');
	aq_register_block('Activity_Block');
	aq_register_block('Process_Block');
	//aq_register_block('Clients_Block');
	aq_register_block('Skills_Block');
	aq_register_block('Lists_Block');
	//aq_register_block('Services_Block');
	//aq_register_block('Testimonials_Block');
	aq_register_block('Map_Block');
	aq_register_block('Slider_Block');
	aq_register_block('ContentSlider_Block');
	aq_register_block('Carousel_Block');

	
	function main_styles() {
	if(is_admin()) {
		wp_enqueue_style('main_styles', plugin_dir_url( __FILE__ ).'/css/main-styles.css');
	}	
	}
	add_action('init', 'main_styles');
	

}
?>