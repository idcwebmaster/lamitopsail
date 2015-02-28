<?php


/**
 * If this file is called directly, abort it.
 */
if ( ! defined( 'ABSPATH' ) ) exit;


/**
 * Load the helper library.
 */
require_once( plugin_dir_path( __FILE__ ) . 'includes/cuztom/cuztom.php');


/**
 * Administration.
 */
require_once( plugin_dir_path( __FILE__ ) . 'includes/admin.php' );


/**
 * Adds function to load slideshow within theme.
 */
function fx_slider( $slideshow = '' ) {
	require_once( plugin_dir_path( __FILE__ ) . 'includes/public.php' );
}


/**
 * Plugin class.
 */
if ( !class_exists('Fx_Slider') ) {

	class Fx_Slider {

		/**
		 * Plugin version, used for cache-busting of style and script file references.
		 */
		const VERSION = '1.0.0';


		/**
		 * Used as the text domain when internationalizing strings of text. It should
		 * match the Text Domain file header in the main plugin file.
		 */
		protected $plugin_slug = 'fx';


		/**
		 * Initialize the plugin by setting localization, filters, and shortcode functions.
		 */
		public function __construct() {

			/* Load plugin text domain. */
			add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

			/* Load admin style sheet. */
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );

			/* Load public style sheet and javacripts. */
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

			/* Shortcode */
			add_shortcode( 'slider', array( $this, 'fx_shortcode' ) );
		}


		/**
		 * Load plugin text domain for translation.
		 */
		public function load_plugin_textdomain() {

			$domain = $this->plugin_slug;
			$locale = apply_filters( 'plugin_locale', get_locale(), $domain );

			load_textdomain( $domain, WP_LANG_DIR . '/' . $domain . '/' . $domain . '-' . $locale . '.mo' );
			load_plugin_textdomain( $domain, FALSE, basename( dirname( __FILE__ ) ) . '/assets/languages/' );
		}


		/**
		 * Enqueue admin-specific style sheet.
		 */
		public function enqueue_admin_styles($hook) {

			/* Only load the css on the necessary pages */
			if( $hook != 'edit.php' && $hook != 'edit-tags.php' && $hook != 'post-new.php' ) {
				return;
			}

			wp_enqueue_style( $this->plugin_slug .'-admin-styles', plugins_url( 'assets/css/admin.css', __FILE__ ), array(), self::VERSION );
		}
		

		/**
		 * Enqueue public style sheet.
		 */
		public function enqueue_styles() {
			wp_enqueue_style( $this->plugin_slug . '-plugin-styles', plugins_url( 'assets/css/public.css', __FILE__ ), array(), self::VERSION );
		}


		/**
		 * Enqueue and register public JavaScript files.
		 */
		public function enqueue_scripts() {
			wp_enqueue_script( $this->plugin_slug . '-slider-script', plugins_url( 'assets/js/jquery.fractionslider.min.js', __FILE__ ), array( 'jquery' ), '0.9.9.9', TRUE);
			wp_register_script ( $this->plugin_slug . '-public-script', plugins_url( 'assets/js/public.js', __FILE__ ), array( 'fx-slider-script' ), self::VERSION, TRUE);
		}
		

		/**
		 * Define the shortcode and its respective default values.
		 */
		public function fx_shortcode($atts) {

			$data = shortcode_atts ( 
				array(
					'slideshow' 			=> '',
					'controls' 				=> FALSE,
					'pager'					=> FALSE,
					'autochange'			=> TRUE,					
					'pauseonhover'			=> FALSE,
					'fullwidth' 			=> TRUE,
					'responsive' 			=> TRUE,
					'dimensions' 			=> '1200,85',
					'increase'				=> FALSE,
					'timeout'				=> '2000'
				), 
				$atts 
			);
			
			$slideshow_att = $data['slideshow'];
			ob_start();
			fx_slider( $slideshow = $slideshow_att );	
			$fx_slider_content = ob_get_clean();
			
			wp_enqueue_script ( $this->plugin_slug . '-public-script');
			wp_localize_script( $this->plugin_slug . '-public-script', 'fxparams', $data );

			return $fx_slider_content;
		}

	} // End of Fx_Slider class.


	/**
	 * Initialise the plugin.
	 */
	new Fx_Slider();

} // End if class_exists check.


