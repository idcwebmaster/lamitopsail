<!DOCTYPE html>
<!--[if IE 8]> <html <?php language_attributes(); ?> class="ie8"> <![endif]-->
<!--[if !IE]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<?php global $smof_data; ?>
	<meta charset="<?php bloginfo('charset'); ?>">
	<title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
	<meta name="description" content="<?php bloginfo('description'); ?>">
	<meta name="author" content="">

	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Pingbacks -->
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Favicon and Apple Icons -->
	<link rel="shortcut icon" href="<?php if (isset($smof_data['favicon'])) { echo $smof_data['favicon']; } ?>">
	<link rel="apple-touch-icon" href="<?php if (isset($smof_data['favicon_one'])) { echo $smof_data['favicon_one']; } ?>">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php if (isset($smof_data['favicon_two'])) { echo $smof_data['favicon_two']; } ?>">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php if (isset($smof_data['favicon_three'])) { echo $smof_data['favicon_three']; } ?>">
<!-- Load Custome Theme Fonts for LAMI -->
<script type="text/javascript">
  WebFontConfig = {
    google: { families: [ 'Open+Sans:300italic,400italic,600italic,700italic,400,700,600,300:latin' ] }
  };
  (function() {
    var wf = document.createElement('script');
    wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
      '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
    wf.type = 'text/javascript';
    wf.async = 'true';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(wf, s);
  })(); 
</script>
	<script type='text/javascript'>
		google_map_code = '';
	</script>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<!-- HEADER -->
	<header class="main-header" id="top">

	<?php if (isset($smof_data['paypal_account']) && $smof_data['paypal_account'] !="" &&
				isset($smof_data['currency']) && isset($smof_data['donation_title']) &&
				isset($smof_data['donation_descr']) && isset($smof_data['donation_mode']) && isset($smof_data['paypal_amount'])  ) {?>
<div class="donation-overlay">				
	<div class="donation-container">
		<h3 class="donation-header"><?php echo $smof_data['donation_title'] ?></h3>
		<p class="donation-descr"><?php echo $smof_data['donation_descr'] ?></p>
			<div class="donation-form">
				<form method="post" action= "<?php if ($smof_data['donation_mode'] == "pro") {
					echo 'https://www.paypal.com/cgi-bin/webscr';
				} else { 
					echo 'https://www.sandbox.paypal.com/cgi-bin/webscr'; 
				} ?>">
					<div class="form-amount">
						<input type="hidden" name="cmd" value="_xclick">
						<input type="hidden" name="business" value="<?php echo $smof_data['paypal_account'] ?>">
						<input type="hidden" name="item_name" value="Donate">
						<input type="hidden" name="item_number" value="">
						<input type="input" name="amount" value="<?php echo $smof_data['paypal_amount'] ?>">
						<input type="hidden" name="currency_code" value="<?php echo $smof_data['currency'] ?>">
						<input type="hidden" name="no_shipping" value="1">		
							<?php
								$currency = $smof_data['currency'];
								if ($currency == "usd") { $currency = '$'; }
								elseif ($currency == "eur") { $currency = '€'; }
								elseif ($currency == "gbp") { $currency = '£'; }
								elseif ($currency == "yen") { $currency = 'Ұ'; }
								else { $currency = '$'; };
							?>						
						<span class="curr-code"><?php echo $currency; ?></span>
						<span class="curr-name"><?php echo $smof_data['currency']; ?></span>
					</div>
					<div class="donation-form-submit">
						<input type="submit" value="Donate">
					</div>
				</form>	
				<span class="form-close"></span>
			</div>
	</div>
</div>
	<?php } ?>
		<div class="top-contact-container">
		
			<div class="container">
				<div class="row">
				<div class="contacts span6">
				<?php 
				if (isset($smof_data['top_phone']) && $smof_data['top_phone'] != '') { ?>
					<div class="phone"><?php echo $smof_data['top_phone']; ?></div>
				<?php };
				if (isset($smof_data['top_email']) && $smof_data['top_email'] != '') { ?>
					<div class="mail"><a href="mailto:<?php echo $smof_data['top_email']; ?>" class="mailto"><?php echo $smof_data['top_email']; ?></a></div>
				<?php } ?>
				</div>
				<?php if (isset($smof_data['top_social']) &&  $smof_data['top_social'] == 'show') { ?>
				<div class="social-icons span6">

							<?php if (isset($smof_data['linkedin_link']) && $smof_data['linkedin_link'] !='') { ?>	
								<a class="icon-6" href="<?php echo $smof_data['linkedin_link']; ?>"></a>
							<?php } ?>	
							<?php if (isset($smof_data['youtube_link']) && $smof_data['youtube_link'] !='') { ?>	
								<a class="icon-5" href="<?php echo $smof_data['youtube_link']; ?>"></a>
							<?php } ?>	
							<?php if (isset($smof_data['skype_link']) && $smof_data['skype_link'] !='') { ?>	
								<a class="icon-4" href="<?php echo $smof_data['skype_link']; ?>"></a>
							<?php } ?>
							<?php if (isset($smof_data['google_plus_link']) && $smof_data['google_plus_link'] !='') { ?>	
								<a class="icon-3" href="<?php echo $smof_data['google_plus_link']; ?>"></a>
							<?php } ?>	
							<?php if (isset($smof_data['twitter_link']) && $smof_data['twitter_link'] !='') { ?>
								<a class="icon-2" href="<?php echo $smof_data['twitter_link']; ?>"></a>
							<?php } ?>
							<?php if (isset($smof_data['facebook_link']) && $smof_data['facebook_link'] !='') { ?>
								<a class="icon-1" href="<?php echo $smof_data['facebook_link']; ?>"></a>
							<?php } ?>
					</div>
				<?php } ?>
 				<div class="buttons-head">	
					<a class="head-button-1" href="http://visitor.r20.constantcontact.com/manage/optin?v=001D5M72sEPb7rfwH_C20otjGGpza5vo5Umj_1Fweg3a9T_tS0lPbhk1xtN23bEtyy3wOZexAs-BbiYb2QdSVPXHwRMascTGRSgsGH2SVEidmk%3D" target="_blank">JOIN MAILING LIST</a>
					<a class="head-button-2" href="/donate">DONATE</a>

				</div>
				</div>
			</div> <!-- end container -->
			
		</div> <!-- end top-menu-container -->
		
		<div class="container">
		
			<div class="row">
			
				<div class="span3 logo-container">

					<h1 class="logo" <?php if (isset($smof_data['top_margin']) ){ ?> style="margin-top:<?php echo $smof_data['top_margin'] ?>px; <?php } ?>">
					
						<?php 
							if(isset($smof_data['logo_type']) && $smof_data['logo_type'] == 'text_logo'){ ?>
							<a href="<?php echo home_url(); ?>/" title="<?php bloginfo('description'); ?>" class="text-logo"><?php bloginfo( 'name', 'display' ); ?></a>
						<?php } else { ?>
							<?php if(isset($smof_data['logo_url']) && $smof_data['logo_url'] != ''){ ?>
								<a href="<?php echo home_url(); ?>/" class="image-logo"><img src="<?php echo $smof_data['logo_url']; ?>" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('description'); ?>"></a>
							<?php } else { ?>
								<a href="<?php echo home_url(); ?>/" class="image-logo"><img src="<?php print IMAGES; ?>/logo.png" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('description'); ?>"></a>
							<?php } ?>
						<?php }?>
						
					</h1>
				
				</div> <!-- end span3 -->
				
				<div class="span9 clearfix">
				
								<?php 

				if (class_exists('Woocommerce')) {

				if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

				global $woocommerce; 

				?>

				<div class="header-cart">

				<div class="cart-menu"><span class="icon-basket"></span></div>

					<div class="amount-cart">

					<ul class="header_cart_list">

						<?php if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) : ?>

							<?php foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $cart_item ) :

								$_product = $cart_item['data'];

								// Only display if allowed
								if ( ! apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) || ! $_product->exists() || $cart_item['quantity'] == 0 )
									continue;

								// Get price
								$product_price = get_option( 'woocommerce_tax_display_cart' ) == 'excl' ? $_product->get_price_excluding_tax() : $_product->get_price_including_tax();

								$product_price = apply_filters( 'woocommerce_cart_item_price_html', woocommerce_price( $product_price ), $cart_item, $cart_item_key );
								?>

								<li>
									<a href="<?php echo get_permalink( $cart_item['product_id'] ); ?>">

										<?php echo $_product->get_image(); ?>

										<?php echo apply_filters('woocommerce_widget_cart_product_title', $_product->get_title(), $_product ); ?>

									</a>

									<?php echo $woocommerce->cart->get_item_data( $cart_item ); ?>

									<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?>
								</li>

							<?php endforeach; ?>

						<?php else : ?>

							<li class="empty"><?php _e( 'No products in the cart.', 'woocommerce' ); ?></li>

						<?php endif; ?>

					</ul><!-- end product list -->

					<?php if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) : ?>

						<p class="total"><strong><?php _e( 'Subtotal', 'woocommerce' ); ?>:</strong> <?php echo $woocommerce->cart->get_cart_subtotal(); ?></p>

						<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>
					
						<p class="buttons">
							<a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" class="button small"><?php _e( 'View Cart', 'woocommerce' ); ?></a>
							<a href="<?php echo $woocommerce->cart->get_checkout_url(); ?>" class="button small checkout"><?php _e( 'Checkout', 'woocommerce' ); ?></a>
						</p>

					<?php endif; ?>

					</div> <!-- end amount cart -->

				</div> <!-- end header cart -->

				<?php } ?>
					
					<nav class="main-navigation clearfix">
						<?php 
							wp_nav_menu(array(
							   'theme_location' => 'main-menu'
							));
						?>
					</nav>
					
				</div> <!-- end span9 -->
				
				<a href="#" class="mobile-menu-trigger"></a>
				
			</div> <!-- end row -->
			
		<div class="mobile-menu"></div> <!-- end mobile-menu -->
			
		</div> <!-- end container -->
		
	</header> <!-- end main-header -->
		
		<?php if(is_front_page() && isset($smof_data['home_slider']) && $smof_data['home_slider'] == 'show'){ ?>
			<div class="main-page-slider"> 
				<?php 
				if (isset($smof_data['slideshow']) && isset($smof_data['width']) && isset($smof_data['height']) && isset($smof_data['controls']) && isset($smof_data['autochange']) && isset($smof_data['pauseonhover']) && isset($smof_data['timeout']) ) {
					echo do_shortcode('[slider slideshow="'.$smof_data['slideshow'].'" dimensions="'.$smof_data['width'].','.$smof_data['height'].'" controls="'.$smof_data['controls'].'" autochange="'.$smof_data['autochange'].'" pauseonhover="'.$smof_data['pauseonhover'].'" timeout="'.$smof_data['timeout'].'"]');
				} ?>
			</div> <!-- end main-page-slider -->
		<?php } else { ?>  
			<div class="title-section">
				<div class="container">
					<div class="title-block"><!-- page title -->
						<div class="page-divider"></div>					
						<div class="page-title"><strong></strong><?php 
						$title = wp_title('',false);
						if ( 'product' == get_post_type() ) { woocommerce_page_title(); }
						elseif ($title != '') { echo $title; } 
						elseif (is_front_page()) {  _e('Home','framework'); } ?><span>
							<div class="page-divider-top"></div>
							<div class="page-divider-bottom"></div>
						</span>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
		