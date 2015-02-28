<?php
/**
 * Fired when the plugin is uninstalled.
 */


/* If uninstall, not called from WordPress, then exit */
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) exit;


/* Delete settings page options from wp_options table. */
delete_option( 'fx_settings' );


/* Delete meta_key data. */
delete_post_meta_by_key( '_fx_background_id_bg_image' );
delete_post_meta_by_key( '_fx_background_id_bg_color' );
delete_post_meta_by_key( 'fx_elements_id' );
