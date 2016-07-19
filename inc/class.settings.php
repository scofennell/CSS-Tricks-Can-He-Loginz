<?php

/**
 * A class for getting and setting the CSS-Tricks Can He Loginz options.
 *
 * @package WordPress
 * @subpackage CSS_Tricks_Can_He_Loginz
 * @since CSS_Tricks_Can_He_Loginz 1.0
 */

class CSS_Tricks_Can_He_Loginz_Settings extends CSS_Tricks_WP_API_Client_CRUD {

	/**
	 * Call the parent class, handing it our settings_slug and our settings.
	 */
	public function __construct() {

		$this -> set_settings_slug();
		$this -> set_settings_array();

	}

	/**
	 * Get the unique namespace for our plugin settings.  What you'd call in get_site_option( $slug ).
	 * 
	 * @return string The unique namespace for our plugin settings.
	 */
	public function set_settings_slug() { $this -> settings_slug = CSS_TRICKS_CAN_HE_LOGINZ; }

	/**
	 * Define our multidimensional array of sections and settings.
	 * 
	 * @return array A multidimensional array of sections and settings.
	 */
	public function set_settings_array() {

		$out = array();

		// Create the "zone" section.
		$out['zone'] = array(

			// The label for this settings section.
			'label' => esc_html__( 'Settings Pertaining to the Zone to Which the Highway Goes', 'css-tricks-can-he-loginz' ),
			
			// The array of settings for this section.
			'settings' => array(				

        	    // The setting for designating if the highway leads to a zone that carries some measure of danger.
				'danger' => array(

					// The user-facing label text for this setting.
					'label' => esc_html__( 'Danger?', 'css-tricks-can-he-loginz' ),
					
					// The type of form input.
					'type'     => 'checkbox',

					// Some notes for this setting.
					'notes' => esc_html__( 'Is the zone dangerous?', 'css-tricks-can-he-loginz' ),

					// A sanitization callback for this setting.
					'sanitize' => 'absint',

					// Designate that this setting comes from the control install.
					'is_remote' => TRUE,

					// The value for this setting.
					'value' => 1,

				// End this setting.
				),
				
			// End the list of settings for this section.
			)

		// End this section.
		);
		
		// Create the "kicking_off_shoes" section.
		$out['kicking_off_shoes'] = array(

			// The label for this settings section.
			'label' => esc_html__( 'Settings Pertaining to the Kicking-Off of Shoes', 'css-tricks-can-he-loginz' ),
			
			// The array of settings for this section.
			'settings' => array(				

        	    // The setting for determining which pair of shoes are to be kicked off.
				'which_pair' => array(

					// The user-facing label text for this setting.
					'label'    => esc_html__( 'Which Pair?', 'css-tricks-can-he-loginz' ),
					
					// The type of form input.
					'type'     => 'text',

					// Some notes for this setting.
					'notes' => esc_html__( 'Which shoes are to be kicked off?', 'css-tricks-can-he-loginz' ),

					// A sanitization callback for this setting.
					'sanitize' => 'sanitize_text_field',

				// End this setting.
				),
				
			// End the list of settings for this section.
			),

		// End this section.
		);
		
		$this -> settings_array = $out;

	}

}