<?php 
/***********************************************************************************************/
/* 	Define Constants */
/***********************************************************************************************/
define('THEMEROOT', get_stylesheet_directory_uri());
define('IMAGES', THEMEROOT.'/images');

/***********************************************************************************************/
/* Load JS&Stylesheet Files */
/***********************************************************************************************/
function theme_scripts() {
	if (!is_admin()) {
		wp_enqueue_script('jquery');
		wp_enqueue_script( 'comment-reply');
		wp_enqueue_script('easing', get_template_directory_uri().'/js/jquery.easing.js', array('jquery'), '1.0', true);
		wp_enqueue_script('fitvids', get_template_directory_uri().'/js/jquery.fitvids.js', array('jquery'), '1.0', true);
		wp_enqueue_script('main', get_template_directory_uri().'/js/scripts.js', array('jquery'), '1.0', true);

		
		wp_enqueue_style( 'bootstrap', get_template_directory_uri().'/css/bootstrap.css', array(), 'all');
		wp_enqueue_style( 'style', get_stylesheet_directory_uri().'/style.css', array(), 'all');		
		if (class_exists('Woocommerce')) {
		
			wp_enqueue_style( 'woo', get_template_directory_uri().'/css/woocommerce.css', array(), 'all');
		
		}
	}	
}
add_action('init', 'theme_scripts');

/**
 * Google fonts.
 */
function mytheme_fonts() {
    $protocol = is_ssl() ? 'https' : 'http';
    wp_enqueue_style( 'mytheme-gothic-one', "$protocol://fonts.googleapis.com/css?family=Pathway+Gothic+One" );
	wp_enqueue_style( 'mytheme-opensans', "$protocol://fonts.googleapis.com/css?family=Open+Sans" );
	
}
add_action( 'wp_enqueue_scripts', 'mytheme_fonts' );

/***********************************************************************************************/
/* Add Theme Support for Post Formats, Post Thumbnails and Automatic Feed Links */
/***********************************************************************************************/
if (function_exists('add_theme_support')) {
	add_theme_support('post-formats', array('link', 'quote', 'gallery', 'video'));
	
	add_theme_support('post-thumbnails', array('post', 'portfolio', 'activity', 'news', 'slider'));
	set_post_thumbnail_size(1000, 600, true);
	add_image_size('custom-blog-image', 784, 350);
	add_theme_support('automatic-feed-links');
}

if ( ! isset( $content_width ) ) $content_width = 1170;

add_action('admin_init','customize_meta_boxes');

function customize_meta_boxes() {
     remove_meta_box('postcustom','post','normal');
}

/***********************************************************************************************/
/* Localization */
/***********************************************************************************************/
function custom_theme_localization() {
	$lang_dir = THEMEROOT . '/languages';
	
	load_theme_textdomain('framework', $lang_dir);
}

add_action('after_theme_setup', 'custom_theme_localization');
/***********************************************************************************************/
/* Add Menus */
/***********************************************************************************************/
function register_menus(){
	register_nav_menus(
		array(
			'main-menu' => __('Main Menu', 'framework'),
			'footer-menu' => __('Footer Menu', 'framework')
		)
	);
}
add_action('init', 'register_menus');

/***********************************************************************************************/
/* Posts Links Classes */
/***********************************************************************************************/
add_filter('next_posts_link_attributes', 'posts_link_attributes_1');
add_filter('previous_posts_link_attributes', 'posts_link_attributes_2');

function posts_link_attributes_1() {
    return 'class="previouspostslink"';
}
function posts_link_attributes_2() {
    return 'class="nextpostslink"';
}


/***********************************************************************************************/
/* Sidebars */
/***********************************************************************************************/
if (function_exists('register_sidebar')) {
	register_sidebar(
		array(
			'name' => __('Main Sidebar', 'framework'),
			'id' => 'main-sidebar',
			'description' => __('The main sidebar area', 'framework'),
			'before_widget' => '<div class="widget">',
			'after_widget' => '</div> <!-- end sidebar-widget -->',
			'before_title' => '<h3>',
			'after_title' => '</h3>'
		)
	);
	register_sidebar(
		array(
			'name' => __('Footer Sidebar', 'framework'),
			'id' => 'footer',
			'description' => __('The footer area', 'framework'),
			'before_widget' => '<div class="footer-widget span3">',
			'after_widget' => '</div> <!-- end footer-widget -->',
			'before_title' => '<h3>',
			'after_title' => '</h3>'
		)
	);
	register_sidebar(
		array(
			'name' => __('WooCommerce Sidebar', 'framework'),
			'id' => 'woocommerce',
			'description' => __('The WooCommerce area', 'framework'),
			'before_widget' => '<div id="%1$s" class="commerce-widget %2$s">',
			'after_widget' => '</div> <!-- end commerce-widget -->',
			'before_title' => '<h3>',
			'after_title' => '</h3>'
		)
	);
}


/********************************/
/* Function to display comments */
/********************************/ 

function custom_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	
	if (get_comment_type() == 'pingback' || get_comment_type() == 'trackback') : ?>
	
	<li class="pingback" id="comment-<?php comment_ID(); ?>">
	
		<article <?php comment_class(); ?>>
			<header>
				<h4><?php _e('Pingback:', 'framework'); ?></h4>
			</header>
			
			<p><?php comment_author_link(); ?></p>
		</article>	
		
	<?php endif; ?>
	
	<?php if (get_comment_type() == 'comment') : ?>
	
	<li id="comment-<?php comment_ID(); ?>">
		<article <?php comment_class('clearfix'); ?>>
		
			<header>
				<h4><?php comment_author_link(); ?></h4>
				<p><?php comment_date(); ?> - <?php comment_time(); ?></p>
			</header>
			
			<div class="reply-button">
					<?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
			</div>

			<figure class="circle-wrap">
				<?php
					$avatar_size = 155;
					echo get_avatar($comment, $avatar_size);
				?>
			</figure>
			
			<div class="clear"></div>
			
			<?php if ($comment->comment_approved == '0') : ?> 
			
				<p class="awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'framework'); ?></p>
				
			<?php endif; ?>
			
			<?php comment_text(); ?>
		</article>		
			
	<?php endif; 	
		
}

/**********************************************/
/* Custom comment form */
/***********************************************/
function custom_comment_form ($defaults) {
	$defaults['comment_notes_before'] = '';
	$defaults['title_reply'] = '<div class="title-block"><div class="page-divider"></div><div class="page-title"><strong></strong>'.__("Post a Comment","framework").'<span><div class="page-divider-top"></div><div class="page-divider-bottom"></div></span></div></div>';
	$defaults['id_form'] = 'comment-form';
	$defaults['label_submit'] = 'Send';
	$defaults['comment_notes_after'] = '';
	$defaults['comment_field'] = '<div><span class="bg"><textarea  name="comment" id="comment" rows="1" cols="1">Your Message</textarea></span></div>';
	return $defaults;
}
add_filter('comment_form_defaults','custom_comment_form');

function custom_comment_fields () {
		$commenter = wp_get_current_commenter();
		$req = get_option('require_name_email');
		$aria_req = ($req ? " aria-required='true'" : ' ');
		$fields = array(
			'author' => '<div class="wrapper left">' .
						'<span class="bg"><input class="input" type="text" id="author" placeholder="' . __('Your Name', 'framework') . ' ' . ($req ? '*' : '') . '" name="author" value="' . esc_attr($commenter['comment_author']) . '" '.$aria_req.' ></span>'.
						'</div>',	
			
			'email' => '<div class="wrapper left">' .
						'<span class="bg"><input type="text" name="email" id="email" placeholder="' . __('Your Email:', 'framework') . ' ' . ($req ? '*' : '') . '" value="' . esc_attr($commenter['comment_author_email']) . '"  class="input" '.$aria_req.' ></span>'.
						'</div>',		
						
			'url' => '<div class="wrapper right">' .
						'<span class="bg"><input type="text" name="url" id="url" placeholder="' . __('Your Website', 'framework') . '" value="' . esc_attr($commenter['comment_author_url']) . '" class="input" ></span>'.
						'</div>'
						
		);
		return $fields;
}
add_filter('comment_form_default_fields', 'custom_comment_fields');

/***********************************************************************************************/
/* Plugin Activation
/***********************************************************************************************/
require_once ('lib/activation_file.php');

/***********************************************************************************************/
/* Slightly Modified Options Framework
/***********************************************************************************************/
require_once ('admin/index.php');

/***********************************************************************************************/
/* Meta Boxes
/***********************************************************************************************/
	$includes_path = get_template_directory() . '/includes/';

/***********************************************************************************************/
/* Menu Item Parent
/***********************************************************************************************/
add_filter( 'wp_nav_menu_objects', 'add_menu_parent_class' );
function add_menu_parent_class( $items ) {

    $parents = array();
    foreach ( $items as $item ) {
        if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
            $parents[] = $item->menu_item_parent;
        }
    }

    foreach ( $items as $item ) {
        if ( in_array( $item->ID, $parents ) ) {
            $item->classes[] = 'menu-item-parent';
        }
    }

    return $items;
}


/***********************************************************************************/
/* Displays navigation to next/previous post
/***********************************************************************************/

if ( ! function_exists( 'theme_post_nav' ) ) :

function theme_post_nav() {
	global $post;

	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous )
		return;
	?>
	<p class="post-navigation">

			<?php previous_post_link( '%link', '&laquo' ); ?>
			<?php next_post_link( '%link', '&raquo;' ); ?>

	</p><!-- .navigation -->
	<div class="clear"></div>
	<?php
}
endif;	







		
/*-----------------Custom styles in wp_head-------------------------*/
 function custom_styles_function() {?>
	<?php global $smof_data; ?>
	<style type="text/css">
	<?php if (isset($smof_data['body_background']) && $smof_data['body_background']!='') { 
		echo 'body {background-color:'.$smof_data['body_background'].';}';
	} ?>
	<?php if (isset($smof_data['background_image']) && $smof_data['background_image']!='') { 
		echo 'body {background-image:url("'.$smof_data['background_image'].'");}';
	} ?>
	<?php if (isset($smof_data['repeat_background']) && $smof_data['repeat_background']=='0') { 
		echo 'body {background-repeat:no-repeat;}';
	} ?>
	<?php if (isset($smof_data['overlay_image']) && $smof_data['overlay_image']!='') { 
		echo '.ver_decor, .hor_decor, .page-divider-top, .articles.wide > .news-element .article-main, .page-divider-bottom, .main-articles .article-preview-image, body > footer, .main-page-slider {background-image:url("'.$smof_data['overlay_image'].'");}';
	} ?>
	<?php if (isset($smof_data['inner_image']) && $smof_data['inner_image']!='') { 
		echo '.page-divider {background-image:url("'.$smof_data['inner_image'].'");}';
	} ?>
	<?php if (isset($smof_data['body_font'])) { 
		if ($smof_data['body_font']['face'] == 'open_sans') { $face = '"Open Sans"';} else {
			$face = $smof_data['body_font']['face'];
		}
		echo 'body, p {font:'.$smof_data['body_font']['style'].' '.$smof_data['body_font']['size'].' '.$face.'; line-height:1.6923em; color:'.$smof_data['body_font']['color'].'}';	
	} ?>
	<?php if (isset($smof_data['button_background']) && $smof_data['button_background']!='') { 
		echo '.button,.tagcloud > a, .more-link, input[type="submit"], .filter > li > a, .reply-button > a, .comment-edit-link, .button-custom, .bx-controls-direction>a {background-color:'.$smof_data['button_background'].';}';
	} ?>
	<?php if (isset($smof_data['header_background']) && $smof_data['header_background']!='') { 
		echo '.top-contact-container {background-color:'.$smof_data['header_background'].';}';
		echo '.main-navigation > div > ul > li > a:hover, .main-navigation > div > ul > li.current_page_item > a, .sub-menu > li > a:hover, .sub-menu > li.current_page_item > a, .main-navigation .children > li > a:hover, .main-navigation .children > li.current_page_item > a,  {background-color:'.$smof_data['header_background'].';}';
		echo '.cart-menu .icon-basket {color:'.$smof_data['header_background'].';}';
		echo '.copyright-container {background-color:'.$smof_data['header_background'].';}';
	} ?>
	<?php if (isset($smof_data['footer_background']) && $smof_data['footer_background']!='') { 
		echo '.footer-widget-area {background-color:'.$smof_data['footer_background'].';}';
	} ?>	
	</style>
	
	
  <!-- Custom CSS -->
<?php if (isset($smof_data['custom_css']) && $smof_data['custom_css']!='') { ?>
  <style type="text/css">
  	  <?php echo $smof_data['custom_css']; ?>
  </style>
<?php };

}
add_action('wp_head', 'custom_styles_function');


/***********************************************************************************/
/* Woocommerce Support
/***********************************************************************************/
add_theme_support( 'woocommerce' );
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

// Update items in cart via AJAX
add_filter('add_to_cart_fragments', 'woo_add_to_cart_ajax');
function woo_add_to_cart_ajax( $fragments ) {
    global $woocommerce;
    ob_start();
    ?>
       <p class="total"><strong><?php _e( 'Subtotal', 'woocommerce' ); ?>:</strong> <?php echo $woocommerce->cart->get_cart_subtotal(); ?></p>
    <?php
    $fragments['p.total'] = ob_get_clean();
    return $fragments;
}

	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
	add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
	add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 10 );

?>