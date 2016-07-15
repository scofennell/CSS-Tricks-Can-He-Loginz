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
add_action( 'plugins_loaded', 'css_tricks_can_he_loginz_login_screen_init', 100 );

class CSS_Tricks_Can_He_Loginz_Login_Screen  {

	public function __construct() {

		$this -> settings = new CSS_Tricks_Can_He_Loginz_Settings;

		add_action( 'login_enqueue_scripts', array( $this, 'the_logo' ) );

		add_action( 'login_message', array( $this, 'the_message' ) );


		
	}

	function get_message() {

		$out = '';

		$danger_zone_message = $this -> get_danger_zone_message();
		
		$which_shoes_to_kick_off_message = $this -> get_kicking_off_shoes_message();
		
		if( ! empty( $which_shoes_to_kick_off_message ) || ! empty( $danger_zone_message ) ) {

			$out = "
				<div>
					<center>
						$danger_zone_message
						$which_shoes_to_kick_off_message
						<br>
					</center>
				</div>
			";

		}
		
		return $out;

	}

	function the_message() {

		echo $this -> get_message();

	}

	function get_danger_zone_message() {

		$out = '';

		$dashicon = $this -> get_icon();

		$danger_zone_setting = $this -> settings -> get_value( 'zone', 'danger' );
		if( ! empty( $danger_zone_setting ) ) {
			$out = "<p>$dashicon <em>" . esc_html__( 'Right into the danger zone!', 'css-tricks-can-he-loginz' ) . '</em></p>';
		}

		return $out;

	}

	function get_kicking_off_shoes_message() {

		$out = '';

		$dashicon = $this -> get_icon();

		$which_shoes_to_kick_off_message_setting = esc_html( $this -> settings -> get_value( 'kicking_off_shoes', 'which_pair' ) );
		if( ! empty( $which_shoes_to_kick_off_message_setting ) ) {
			$out = '<p><em>' . sprintf( esc_html__( 'Kick off your %s shoes!', 'css-tricks-can-he-loginz' ), $which_shoes_to_kick_off_message_setting ) . "</em> $dashicon</p>";
		}


		return $out;

	}

	function get_icon() {

		return '<span class="dashicons dashicons-format-audio"></span>';

	}

	function get_logo() {

		$src = CSS_TRICKS_CAN_HE_LOGINZ_URL . 'img/logo.jpg';

		$login_width = '320px';

		$out = "
		    <style>
		        body.login h1 a {
		            background-image: url( $src );
		            display: block;
		            max-width: 100%;
		            width: $login_width;
		            height: $login_width;
		            background-size: 100%;
		        }
	    	</style>
		";	

		return $out;

	}
	
	function the_logo() {

		echo $this -> get_logo();

	}


}