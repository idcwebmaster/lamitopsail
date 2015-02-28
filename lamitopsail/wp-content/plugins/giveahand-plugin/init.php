<?php
/**
 * Plugin Name: GiveAHand - Must Have Plugin
 * Plugin URI: http://themeforest.net/user/FXoffice
 * Description: Shortcodes and Widgets for GivaAHand Charity Responsive Wordpress Theme
 * Version: 2.0.0
 * Author: FXoffice
 * Author URI: http://themeforest.net/user/FXoffice
 * License: GPL2
 */

	$plugin_dir_path = dirname(__FILE__);

	require_once ('lib/shortcodes.php');
	require_once ('meta/portfolio_meta_box.php');
	require_once ('meta/page_meta_box.php');
	require_once ('meta/post_meta_box.php');
	require_once ('meta/activity_meta_box.php');
	require_once ('meta/news_meta_box.php');
	require_once ('parallaxslider/init.php');
	require_once('page-builder/aqua-page-builder/aq-page-builder.php');
	require_once('page-builder/page-builder.php');
	require_once('lib/aq_resizer.php');
	require_once('post-types-order/post-types-order.php');
	
	//tinyMCE includes
	include_once($plugin_dir_path . '/tinymce/tinymce_shortcodes.php');


function plugin_scripts() {	
	if (!is_admin()) {
	wp_enqueue_style( 'give-styles', plugin_dir_url( __FILE__ ).'css/styles.css' ,array(), "1.0", 'all' );	
	wp_enqueue_style( 'pretty', plugin_dir_url( __FILE__ ).'css/prettyPhoto.css', array(), 'all');
	
	wp_enqueue_script( 'give-masonry',plugin_dir_url( __FILE__ ).'/js/jquery.masonry.min.js' ,array( 'jquery' ), "2.1.08", true );
	wp_enqueue_script( 'give-appear',plugin_dir_url( __FILE__ ).'/js/jquery.appear.js' ,array( 'jquery' ), "1.0", true );
	wp_enqueue_script( 'quicksand',plugin_dir_url( __FILE__ ).'/js/jquery.quicksand.js' ,array( 'jquery' ), "1.3", true );
	wp_enqueue_script( 'pretty', plugin_dir_url( __FILE__ ).'/js/jquery.prettyPhoto.js', array('jquery'), '3.1.5', true);
	wp_enqueue_script( 'bxslider', plugin_dir_url( __FILE__ ).'/js/jquery.bxslider.min.js', array('jquery'), '4.1.1', true);
	wp_enqueue_script( 'parallax', plugin_dir_url( __FILE__ ).'/js/jquery.parallax-1.1.3.js', array('jquery'), '1.1.3', true);
	wp_enqueue_script( 'bgvideo', plugin_dir_url( __FILE__ ).'/js/jquery.mb.YTPlayer.js', array('jquery'), '1.3', true);
	wp_enqueue_script( 'give-scripts',plugin_dir_url( __FILE__ ).'/js/scripts.js' ,array( 'jquery' ), "1.0", true );
	}
	// enqueue scripts and styles, but only if is_admin
	if(is_admin()) {
		wp_enqueue_script('custom-js', plugin_dir_url( __FILE__ ).'/js/custom-js.js');
		wp_enqueue_style('jquery-ui-custom', plugin_dir_url( __FILE__ ).'/css/jquery-ui-custom.css');
	}
}
add_action('init', 'plugin_scripts');	

/**************************************************************************************************/
/* Add thumbnail
/**************************************************************************************************/
	//if ( function_exists( 'add_theme_support' ) ) { 
	//	add_image_size( 'staff_foto', 151, 154, true ); // Staff Thumbnail 
	//	add_image_size('portfolio_thumb', 270, 247, true); // Portfolio Thumbnail
	//	add_image_size('activity_thumb', 271, 159, true); // Activity Thumbnail
	//	add_image_size('activity_full', 574, 305, true); // Activity Full size
	//	add_image_size('news_thumb', 680, 540, true); // News Thumbnail
	//	add_image_size('news_thumb', 273, 273, true); // Recent Posts Slider Thumbnail
	//}
	
/***********************************************************************************************/		
/* Load custom widgets */
/***********************************************************************************************/
require_once('widgets/ad-125.php');
require_once('widgets/get_in_touch.php');
require_once('widgets/recent_posts.php');
require_once('widgets/flickr.php');
require_once('widgets/tweets-widget.php');

/***********************************************************************************************/
/* Excerpt limit words
/***********************************************************************************************/

function my_string_limit_words($string, $word_limit)
{
  $words = explode(' ', $string, ($word_limit + 1));
  if(count($words) > $word_limit)
  array_pop($words);
  $rez = implode(' ', $words);
  return trim($rez,"\&nbsp;");
}

function remove_invalid_tags($str, $tags) 
{
    foreach($tags as $tag)
    {
    	$str = preg_replace('#^<\/'.$tag.'>|<'.$tag.'>$#', '', trim($str));
    }

    return $str;
}

	
add_action( 'after_setup_theme', 'my_setup' );

if ( ! function_exists( 'my_setup' ) ):

function my_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	//add_editor_style();

}
endif;

/* Custom post type - Portfolio */
$folio  = new Cuztom_Post_Type( 'portfolio', 
	array(
				'supports' => array(
						'title',
						'editor',
						'thumbnail',				
						'custom-fields',
						'post-formats',
						'comments'
						) 
	),
	array(
	    'name'              => _x( 'Portfolio', 'framework' ),
	    'singular_name'     => _x( 'Portfolio', 'framework' ),
	    'search_items'      => __( 'Search Items', 'framework' ),
	    'all_items'         => __( 'All Portfolios', 'framework' ),
	    'parent_item'       => __( 'Parent Portfolio', 'framework' ),
	    'parent_item_colon' => __( 'Parent Portfolios:', 'framework' ),
	    'edit_item'         => __( 'Edit Portfolio', 'framework' ),
	    'update_item'       => __( 'Update Portfolio', 'framework' ),
	    'add_new_item'      => __( 'Add New Portfolio', 'framework' ),
	    'new_item_name'     => __( 'New Portfolios Name', 'framework' ),
	    'menu_name'         => __( 'Portfolio', 'framework' ),
	) 
);
/**
 * Register taxonomy.
 */
$foliocat = register_cuztom_taxonomy( __('Portfolio Category', 'framework'), 'portfolio', 
        array(
            'show_admin_column'     => TRUE,
            'admin_column_sortable' => TRUE,
            'admin_column_filter'   => TRUE,
            'hierarchical' 			=> TRUE
        ));

/* Custom post type - Activity */
$activ  = new Cuztom_Post_Type( 'activity', 
	array(
				'supports' => array(
						'title',
						'editor',
						'thumbnail',				
						'custom-fields',
						'comments'
						) 
	),
	array(
	    'name'              => _x( 'Activity', 'framework' ),
	    'singular_name'     => _x( 'Activity', 'framework' ),
	    'search_items'      => __( 'Search Items', 'framework' ),
	    'all_items'         => __( 'All Activities', 'framework' ),
	    'parent_item'       => __( 'Parent Activity', 'framework' ),
	    'parent_item_colon' => __( 'Parent Activities:', 'framework' ),
	    'edit_item'         => __( 'Edit Activity', 'framework' ),
	    'update_item'       => __( 'Update Activity', 'framework' ),
	    'add_new_item'      => __( 'Add New Activity', 'framework' ),
	    'new_item_name'     => __( 'New Activity Name', 'framework' ),
	    'menu_name'         => __( 'Activity', 'framework' ),
	) 
);
/**
 * Register taxonomy.
 */
$activcat = register_cuztom_taxonomy( __('Activity Category', 'framework'), 'activity', 
        array(
            'show_admin_column'     => TRUE,
            'admin_column_sortable' => TRUE,
            'admin_column_filter'   => TRUE,
            'hierarchical' 			=> TRUE
        ));	


/* Custom post type - News */
	
$newstype  = new Cuztom_Post_Type( 'news', 
	array(
				'supports' => array(
						'title',
						'editor',
						'thumbnail',				
						'custom-fields',
						'comments'
						) 
	),
	array(
	    'name'              => _x( 'News', 'framework' ),
	    'singular_name'     => _x( 'News', 'framework' ),
	    'search_items'      => __( 'Search Items', 'framework' ),
	    'all_items'         => __( 'All News', 'framework' ),
	    'parent_item'       => __( 'Parent News', 'framework' ),
	    'parent_item_colon' => __( 'Parent News:', 'framework' ),
	    'edit_item'         => __( 'Edit News', 'framework' ),
	    'update_item'       => __( 'Update News', 'framework' ),
	    'add_new_item'      => __( 'Add New News', 'framework' ),
	    'new_item_name'     => __( 'New News Name', 'framework' ),
	    'menu_name'         => __( 'News', 'framework' ),
	) 
);
/**
 * Register taxonomy.
 */
$newscat = register_cuztom_taxonomy( __('News Category', 'framework'), 'news', 
        array(
            'show_admin_column'     => TRUE,
            'admin_column_sortable' => TRUE,
            'admin_column_filter'   => TRUE,
            'hierarchical' 			=> TRUE
        ));



?>