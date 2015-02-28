<?php
/**
 * Setup My Child Theme's textdomain.
 *
 * Declare textdomain for this child theme.
 * Translations can be filed in the /languages/ directory.
 */
function child_theme_setup() {
	load_child_theme_textdomain( 'framework', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'child_theme_setup' );
?>