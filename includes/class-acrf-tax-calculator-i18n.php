<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://mcsaatchi.com.au/
 * @since      1.0.0
 *
 * @package    Acrf_Tax_Calculator
 * @subpackage Acrf_Tax_Calculator/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Acrf_Tax_Calculator
 * @subpackage Acrf_Tax_Calculator/includes
 * @author     M&C Saatchi <ticiana.andrade@mcsaatchi.com.au>
 */
class Acrf_Tax_Calculator_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'acrf-tax-calculator',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
