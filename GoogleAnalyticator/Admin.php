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
 * @todo
 *
 * @since 0.0.1
 */
class Admin {

	public $settings;

	/**
	 * Constructor. Hooks all interactions to initialize the class.
	 *
	 * @since 0.0.1
	 *
	 * @return void
	 */
	public function __construct() {

		$args = array(
			'id' => 'ga',
			'title' => __( 'Google Analytics', 'google-analyticator' ) . ' &rsaquo; ' . __( 'Settings', 'google-analyticator' ),
			'tabbed' => true,
		);
		
		$this->settings = new \GoogleAnalyticator\SettingsAPI( $args );

		add_action( 'admin_init', array( $this, 'admin_init' ) );
		add_action( 'admin_menu', array( $this, 'admin_menu' ), 9 );
		add_action( 'admin_menu', array( $this, 'admin_menu_settings' ), 99 );

	} // END __construct()

	function admin_init() {

		$this->settings->set_tabs( $this->get_tabs() );
		$this->settings->set_sections( $this->get_sections() );
		$this->settings->set_fields( $this->get_fields() );

        $this->settings->register_settings();
    }

	public function admin_menu() {

		add_menu_page(
			__( 'Analytics', 'google-analyticator' ),
			__( 'Analytics', 'google-analyticator' ),
			'manage_options',
			'google-analyticator',
			array( $this, 'page_overview' ),
			'dashicons-chart-area'
		);

		add_submenu_page(
			'google-analyticator',
			__( 'Analytics', 'google-analyticator' ) . ' &rsaquo; ' . __( 'Overview', 'google-analyticator' ),
			__( 'Overview', 'google-analyticator' ),
			'manage_options',
			'google-analyticator',
			array( $this, 'page_overview' )
		);

	} // END admin_menu()

	 public function admin_menu_settings() {

		add_submenu_page(
			'google-analyticator',
			__( 'Analytics', 'google-analyticator' ) . ' &rsaquo; ' . __( 'Settings', 'google-analyticator' ),
			__( 'Settings', 'google-analyticator' ),
			'manage_options',
			'google-analyticator-settings',
			array( $this, 'page_settings' )
		);

	 }

	public function page_settings() {

		$this->settings->display();

	} // END

	public function page_overview() {
		echo 'OVERVIEW';
	} // END

	public function get_tabs() {

		$tabs = array(
			'general'   => __( 'General', 'google-analyticator' ),
			'dashboard' => __( 'Dashboard', 'google-analyticator' ),
			'advanced'  => __( 'Advanced', 'google-analyticator' ),
		);

		return $tabs;

	}

	public function get_sections() {

		$sections = array(
			'main'		 => array(
				'tab'	 => 'general',
				'title'	 => __( 'Main Options', 'google-analyticator' ), // null -- hide the text
				'desc'	 => __( 'This is a short description for a settings SECTION', 'google-analyticator' ),
			),
			'widget' => array(
				'tab'	 => 'dashboard',
				'title'	 => __( 'Admin Dashboard Widget', 'google-analyticator' ),
				'desc'	 => __( 'This is a short description for a settings SECTION', 'google-analyticator' ),
			),
			'extend'	 => array(
				'tab'	 => 'advanced',
				'title'	 => __( 'Extending Tracking Code', 'google-analyticator' ),
				'desc'	 => __( '@todo for ext tracking code', 'google-analyticator' ),
			),
		);

		return $sections;

	}

	public function get_fields() {

		$fields = array(
			'main' => array(
				'google_ua'	 => array(
					'label'	 => __( 'Google Analytics UA', 'google-analyticator' ),
					'desc'	 => __( 'Set your UA', 'google-analyticator' ),
					'type'	 => 'google_ua',
//					'option' => 'analytics_2nd', // save into add_option('analytics_2nd') || if (!isset 'option') add_option( $this->_args['id'] )
				),
				'textarea'	 => array(
					'label'	 => __( 'Textarea Input', 'google-analyticator' ),
					'desc'	 => __( 'Textarea description', 'google-analyticator' ),
					'type'	 => 'text',
				),
			),
			'widget' => array(
				'google_ua'	 => array(
					'label'	 => __( 'Text Input (integer validation)', 'google-analyticator' ),
					'desc'	 => __( 'Text input description', 'google-analyticator' ),
					'type'	 => 'checkbox',
				),
				'textarea'	 => array(
					'label'	 => __( 'Textarea Input', 'google-analyticator' ),
					'desc'	 => __( 'Textarea description', 'google-analyticator' ),
					'type'	 => 'checkbox',
				),
				'checkbox'	 => array(
					'label'	 => __( 'Checkbox', 'google-analyticator' ),
					'desc'	 => __( 'Checkbox Label', 'google-analyticator' ),
					'type'	 => 'select', // multiselect
					'options' => array( // custom callback function to get user roles
                        'yes' => 'Yes',
                        'no' => 'No',
                    ),
				),
			),
			'dashboard' => array(
				'pre_snippet' => array(
					'label'	 => __( 'Pre-Snippet Code', 'google-analyticator' ),
					'desc'	 => __( 'Additional tracking code before tracker initialization', 'google-analyticator' ),
					'type'	 => 'textarea',
				),
				'post_snippet' => array(
					'label'	 => __( 'Post-Snippet Code', 'google-analyticator' ),
					'desc'	 => __( 'Additional tracking code after tracker initialization', 'google-analyticator' ),
					'type'	 => 'textarea',
				),
			),
			'extend' => array(
				'pre_snippet' => array(
					'label' => __( 'Pre-Snippet Code', 'google-analyticator' ),
					'desc'  => __( 'Additional tracking code before tracker initialization', 'google-analyticator' ),
					'type'  => 'textarea',
				),
				'post_snippet' => array(
					'label' => __( 'Post-Snippet Code', 'google-analyticator' ),
					'desc'  => __( 'Additional tracking code after tracker initialization', 'google-analyticator' ),
					'type'  => 'textarea',
				),
			),
		);

		return $fields;

	}

} // END class
