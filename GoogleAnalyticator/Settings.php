<?php
/**
 * @author    Video User Manuals Pty Ltd
 * @copyright Copyright (c) 2014, Video User Manuals Pty Ltd
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GPL-2.0+
 * @package   GoogleAnalyticator
 */

namespace GoogleAnalyticator;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Extends the SettingsAPI class to add custom field types
 *
 * @since 0.0.1
 */
class Settings extends \GoogleAnalyticator\SettingsAPI {

	/**
	 * Constructor. Hooks all interactions to initialize the class.
	 *
	 * @since 0.0.1
	 *
	 * @return void
	 */
	public function __construct( $instance_args = array() ) {

		parent::__construct( $instance_args );

	} // END __construct()

	public function field_google_ua( $args ) {

        echo 'Google UA: ' . $args['option'] . '_' . $args['id'];

    }

} // END class
