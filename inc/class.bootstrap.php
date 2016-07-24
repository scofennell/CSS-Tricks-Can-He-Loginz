<?php

/**
 * Check for plugin dependencies.  If they're met, load the plugin.  If not, warn the user.
 *
 * @package WordPress
 * @subpackage CSS_Tricks_Can_He_Loginz
 * @since CSS_Tricks_Can_He_Loginz 1.0
 */

/**
 * Fire up our plugin by checking for dependancies and requiring files.
 * 
 * It's worth noting that this occurs at slot #1 in the plugins_loaded action.
 * We have to do this before any other component of our plugin attempts to run.
 */
function css_tricks_ce_he_loginz_bootstrap_init() {

	new CSS_Tricks_Can_He_Loginz_Bootstrap;

}
add_action( 'plugins_loaded', 'css_tricks_ce_he_loginz_bootstrap_init', 1 );

class CSS_Tricks_Can_He_Loginz_Bootstrap {

	function __construct() {

		// Determine if the plugins on which this pluign is dependant, are loaded.
		$this -> set_is_ready();

		// Attempt to load the files that power our plugin.
		add_action( 'plugins_loaded', array( $this, 'init' ) );

		// Warn the user about missing dependancies.
		add_action( 'network_admin_notices', array( $this, 'warn' ) );
		add_action( 'admin_notices', array( $this, 'warn' ) );

	}

	/**
	 * Get the answer to the question, are all the dependancies loaded?
	 * 
	 * @return boolean TRUE if all dependancies are met, else FALSE.
	 */
	function set_is_ready() {

		//  Is the abstraction layer for calling the control blog missing?
		if( ! defined( 'CSS_TRICKS_WP_API_CLIENT' ) ) {

			$this -> is_ready = FALSE;

		}

		$this -> is_ready = TRUE;

	}

	/**
	 * If the dependant plugins are installed, for each php file in the inc/ folder, require it.
	 * 
	 * @return boolean Returns TRUE if dependancies are installed, else FALSE.
	 */
	function init() {

		if( ! $this -> is_ready ) { return FALSE; }

		// For each php file in the inc folder...
		foreach( glob( CSS_TRICKS_CAN_HE_LOGINZ_DIR . 'inc/*.php' ) as $filename ) {

			// Load it!
			require_once( $filename );

		}

		return TRUE;

	}

	/**
	 * Print a message to the admin notice area, warning the user about missing dependancies.
	 * 
	 * @return boolean Returns FALSE if there is nothing to warn about, else returns TRUE.
	 */
	function warn() {

		//  Is the abstraction layer for calling the control blog missing?
		if( $this -> is_ready ) { return FALSE; }

		// Then create an error message.
		$message = $this -> get_message();

		// Print the warning in network admin.
		if( is_network_admin() && ( current_filter() == 'network_admin_notices' ) ) {

			echo $message;

			return TRUE;

		// Print the warning in single-site admin.
		} elseif( ! is_network_admin() && ( current_filter() == 'admin_notices' ) ) {

			echo $message;

			return TRUE;

		}

	}

	/**
	 * Get the text for warning the user about missing dependancies.
	 * 
	 * @return string The text for warning the user about missing dependancies.
	 */
	function get_message() {

		$message = esc_html__( 'CSS-Tricks Can He Loginz requires the CSS-Tricks WP API Client for making calls to the control install.', 'css-tricks-can-he-loginz' );
		$out = "
			<div class='notice error is-dismissible'>
				<p>$message</p>
			</div>
		";

		return $out;

	}

}