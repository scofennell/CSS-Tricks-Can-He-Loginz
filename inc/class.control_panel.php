<?php

/**
 * A class for drawing the CSS-Tricks Can He Loginz settings page.
 *
 * @package WordPress
 * @subpackage CSS_Tricks_Can_He_Loginz
 * @since CSS_Tricks_Can_He_Loginz 1.0
 */

function css_tricks_can_he_loginz_control_panel_init() {

	// Are we in the admin area?
	if( ! is_network_admin() ) { return FALSE; }

	if( ! isset( $_GET['page'] ) ) { return FALSE; }

	if( $_GET['page'] != CSS_TRICKS_CAN_HE_LOGINZ ) { return FALSE; }

	// If so, add our control panel.
	return new CSS_Tricks_Can_He_Loginz_Control_Panel();

}
add_action( 'plugins_loaded', 'css_tricks_can_he_loginz_control_panel_init', 100 );

class CSS_Tricks_Can_He_Loginz_Control_Panel extends CSS_Tricks_WP_API_Client_Control_Panel {

	function __construct() {

		// The meta_key for our plugin options in the database.
		$settings_slug = CSS_TRICKS_CAN_HE_LOGINZ;

		// The class for defnining our array of settings.
		$settings = new CSS_Tricks_Can_He_Loginz_Settings();
		
		// The array of settings for this plugin.
		$settings_array = $settings -> settings_array;

		// The admin UI text for the settings page.
		$plugin_label = esc_html__( 'CSS-Tricks Can He Loginz Settings', 'css-tricks-can-he-loginz' );

		// Pass this stuff to the client plugin, which will automatically draw a settings page.
		parent::__construct( $settings_slug, $settings_array, $plugin_label );

	}

}