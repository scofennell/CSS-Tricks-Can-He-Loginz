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

	// If so, add our control panel.
	return new CSS_Tricks_Can_He_Loginz();

}
add_action( 'plugins_loaded', 'css_tricks_can_he_loginz_control_panel_init', 100 );

class CSS_Tricks_Can_He_Loginz {

	function __construct() {

		// Grab the array of settings.
		$settings       = new CSS_Tricks_Can_He_Loginz_Settings();
		$settings_array = $settings -> settings_array;
		$plugin_label   = esc_html__( 'CSS-Tricks Can He Loginz Settings' );

		// Use the NSFW plugin to add a network settings page.
		new CSS_Tricks_WP_API_Client_Control_Panel( CSS_TRICKS_CAN_HE_LOGINZ, $settings_array, $plugin_label );

	}

}