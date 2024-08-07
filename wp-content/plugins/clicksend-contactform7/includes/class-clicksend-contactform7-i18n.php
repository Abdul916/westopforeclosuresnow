<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://clicksend.com/help
 * @since      1.0.0
 *
 * @package    Clicksend_Contactform7
 * @subpackage Clicksend_Contactform7/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Clicksend_Contactform7
 * @subpackage Clicksend_Contactform7/includes
 * @author     ClickSend <support@clicksend.com>
 */
class Clicksend_Contactform7_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'clicksend-contactform7',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
