<?php

/**
 * A class for altering the output of the wp-login screen.
 *
 * @package WordPress
 * @subpackage CSS_Tricks_Can_He_Loginz
 * @since CSS_Tricks_Can_He_Loginz 1.0
 */

function css_tricks_can_he_loginz_login_screen_init() {

	new CSS_Tricks_Can_He_Loginz_Login_Screen;

}
add_action( 'login_enqueue_scripts', 'css_tricks_can_he_loginz_login_screen_init', 1 );

class CSS_Tricks_Can_He_Loginz_Login_Screen  {

	public function __construct() {
		
		// Grab the class which manages our settings, both local and remote.
		$this -> settings = new CSS_Tricks_Can_He_Loginz_Settings;

		// Add the loggins to the login page.
		add_action( 'login_enqueue_scripts', array( $this, 'the_loggins' ) );

		// Add the message text to the login page.
		add_action( 'login_message', array( $this, 'the_message' ) );

	}

	/**
	 * Get some message text for the wp-login page.
	 * 
	 * @return string Some message text for the login page.
	 */
	function get_message() {

		// Will hold some message text for the login page.
		$out = '';

		//  Grab the part of the message that pertains to the current danger level in the zone.
		$danger_zone_message = $this -> get_danger_zone_message();

		// Grab the part of the message that pertains to the kicking off of shoes.
		$which_shoes_to_kick_off_message = $this -> get_kicking_off_shoes_message();
		
		// If they're both empty, bail.
		if( empty( $which_shoes_to_kick_off_message ) && empty( $danger_zone_message ) ) { return FALSE; }

		// The markup for our custom message.  Not going to over-engineer this!
		$out = "
			<div style='text-align:center;'>
				$danger_zone_message
				$which_shoes_to_kick_off_message
			</div>
		";

		return $out;

	}

	/**
	 * Print the login message.
	 */
	function the_message() {

		echo $this -> get_message();

	}

	/**
	 * Get the message text for the danger zone.
	 * 
	 * @return string The message text for the danger zone.
	 */
	function get_danger_zone_message() {

		// Grab the current value for the danger level in the zone.
		$danger_zone_setting = $this -> settings -> get_value( 'zone', 'danger' );
		if( empty( $danger_zone_setting ) ) { return FALSE; }

		// We made it!  The checkbox in the settings page was checked!

		// Grab a music note.
		$dashicon = $this -> get_icon();

		$out = "<p>$dashicon <em>" . esc_html__( 'Right into the danger zone!', 'css-tricks-can-he-loginz' ) . '</em></p>';
		
		return $out;

	}

	/**
	 * Get the message text for kicking shoes off.
	 * 
	 * @return string The message text for kicking shoes off.
	 */
	function get_kicking_off_shoes_message() {

		// Grab the current value for which shoes to kick off.
		$which_shoes_to_kick_off_message_setting = esc_html( $this -> settings -> get_value( 'kicking_off_shoes', 'which_pair' ) );
		if( empty( $which_shoes_to_kick_off_message_setting ) ) { return FALSE; }

		// We made it!  The setting is non-empty.  Build the message.
		$dashicon = $this -> get_icon();
		$out = '<p><em>' . sprintf( esc_html__( 'Kick off your %s shoes!', 'css-tricks-can-he-loginz' ), $which_shoes_to_kick_off_message_setting ) . "</em> $dashicon</p>";
		
		return $out;

	}

	/**
	 * Get a music note dashicon for our message.
	 * 
	 * @see    https://developer.wordpress.org/resource/dashicons/#plus-alt
	 * @return string The music note dashicon.
	 */
	function get_icon() {

		return '<span class="dashicons dashicons-format-audio"></span>';

	}

	/**
	 * Get the inline styles for replacing the WP logo.

	 * @return string The inline styles for replacing the WP logo.
	 */
	function get_loggins() {

		// Our image src, in the plugin folder.
		$src = CSS_TRICKS_CAN_HE_LOGINZ_URL . 'img/logo.jpg';

		// The wp login screen is 320px wide.
		$login_width = '320px';

		$out = "
			<style>
				body.login h1 a {
					background-image  : url( $src );
					display           : block;
					max-width         : 100%;
					width             : $login_width;
					height            : $login_width;
					background-size   : 100%;
				}
			</style>
		";	

		return $out;

	}

	/**
	 * Print the login styles.
	 */
	function the_loggins() {

		echo $this -> get_loggins();

	}

}