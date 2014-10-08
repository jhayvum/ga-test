<?php
/**
 * @author    Video User Manuals Pty Ltd
 * @copyright Copyright (c) 2014, Video User Manuals Pty Ltd
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GPL-2.0+
 * @package   GoogleAnalyticator
 * @version   7.0.0
 */
/*
Plugin Name: Google Analyticator
Plugin URI:  @todo
Description: @todo
Version:     7.0.0
Author:      Video User Manuals Pty Ltd
Author URI:  http://www.videousermanuals.com/?utm_campaign=analyticator&utm_medium=plugin&utm_source=readme-txt
License:     GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: google-analyticator
Domain Path: /languages

    Google Analyticator
    Copyright (C) 2014 Video User Manuals Pty Ltd (http://www.videousermanuals.com)

    This program is free software; you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	as published by the Free Software Foundation; either version 2
	of the License, or (at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) { exit; }

require 'libs/autoload.php';

/**
 * @since 7.0.0
 */
class GoogleAnalyticator {

	/**
	 * Current version of the plugin.
	 *
	 * @since 7.0.0
	 * @var string
	 */
	public $version = '7.0.0';

	/**
	 * Main File of the plugin.
	 *
	 * @since 7.0.0
	 * @var string
	 */
	public $file = __FILE__;

	/**
	 * Holds a copy of the object for easy reference.
	 *
	 * @since 7.0.0
	 * @static
	 * @var object $_instance
	 */
	protected static $_instance = null;

	/**
	 * Main ScrollDepth Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since  7.0.0
	 * @static
	 * @return object Instance
	 */
	public static function get_instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;

	} // END get_instance()

	/**
	 * Constructor. Hooks all interactions to initialize the class.
	 *
	 * @since  7.0.0
	 * @return void
	 */
	public function __construct() {

		register_activation_hook( __FILE__, array( 'GoogleAnalyticator', 'activation' ) );

		// Frontend
		if ( ! is_admin() ) {
			// new \GoogleAnalyticator\Frontend();
		} // END if

		// WP-Admin
		if ( is_admin() ) {
			new \GoogleAnalyticator\Admin();
		} // END if

	} // END __construct()

	public function get_defaults() {

		$defaults = array();

		return apply_filters( 'google_analyticator_defaults', $defaults );

	} // END get_defaults()


	/** Helper functions ******************************************************/

	/**
	 * Get the plugin version.
	 *
	 * @since  7.0.0
	 * @return string
	 */
	public function get_version() {
		return $this->version;
	}

	/**
	 * Get the main plugin file.
	 *
	 * @since  7.0.0
	 * @return string
	 */
	public function get_file() {
		return $this->file;
	}

	/**
	 * Pre-Activation checks
	 *
	 * @since  7.0.0
	 * @param  bool $network_wide
	 * @return void
	 */
	public function activation( $network_wide ) {

		// @todo

	} // END activation()

} // END class

/**
 * Returns the main instance
 *
 * @since  7.0.0
 * @return object GoogleAnalyticator Instance
 */
function GoogleAnalyticator() {
	return \GoogleAnalyticator::get_instance();
}

GoogleAnalyticator();
