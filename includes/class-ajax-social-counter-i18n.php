<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://github.com/tuxrafa
 * @since      1.0.0
 *
 * @package    Ajax_Social_Counter
 * @subpackage Ajax_Social_Counter/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Ajax_Social_Counter
 * @subpackage Ajax_Social_Counter/includes
 * @author     Rafael Oliveira <tuxrafa@gmail.com>
 */
class Ajax_Social_Counter_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'ajax-social-counter',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
