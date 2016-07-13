<?php

/**
 * @package CSS_Tricks_Can_He_Loginz
 */

/**
 * Plugin Name: CSS-Tricks Can He Loginz
 * Plugin URI: https://css-tricks.com
 * Description: A plugin for adding a photograph of American singer/songwriter Kenny Loggins to the login screen.
 * Version: 1.0
 * Author: Scott Fennell
 * Author URI: http://scottfennell.org
 * License: GPLv2 or later
 * Text Domain: css-tricks-can-he-loginz
 */

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

// Make sure we don't expose any info if called directly
if ( ! function_exists( 'add_action' ) ) {
	echo 'Hi!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

// Define a slug for our plugin to use in CSS classes and such.
define( 'CSS_TRICKS_CAN_HE_LOGINZ', 'css_tricks_can_he_loginz' );

/**
 * Define a version that's more easily accessible than the docblock one,
 * for cache-busting.
 */
define( 'CSS_TRICKS_CAN_HE_LOGINZ_VERSION', '1.0' );

// Define paths and urls for easy loading of files.
define( 'CSS_TRICKS_CAN_HE_LOGINZ_URL', plugin_dir_url( __FILE__ ) );
define( 'CSS_TRICKS_CAN_HE_LOGINZ_DIR', plugin_dir_path( __FILE__ ) );

// For each php file in the inc/ folder, require it.
foreach( glob( CSS_TRICKS_CAN_HE_LOGINZ_DIR . 'inc/*.php' ) as $filename ) {

    require_once( $filename );

}