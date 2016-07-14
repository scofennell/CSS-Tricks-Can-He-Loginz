<?php

/**
 * A class for altering the output of the wp-login screen.
 *
 * @package WordPress
 * @subpackage CSS_Tricks_Can_He_Loginz
 * @since CSS_Tricks_Can_He_Loginz 1.0
 */

class CSS_Tricks_Can_He_Loginz_Login_Screen  {

	public function __construct() {

		add_action( 'login_enqueue_scripts', array( $this, 'logo' ) );
		
	}

	function logo() {

		$out "
		    <style>
		        #login h1 a,
		        #.login h1 a {
		            background-image: url( $logo_url );
		            padding-bottom: 30px;
		        }
	    	</style>
		";	

		echo $out;

	}
	
}