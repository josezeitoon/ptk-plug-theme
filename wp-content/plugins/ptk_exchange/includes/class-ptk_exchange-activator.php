<?php

/**
 * Fired during plugin activation
 *
 * @link       josevillalobos.com
 * @since      1.0.0
 *
 * @package    Ptk_exchange
 * @subpackage Ptk_exchange/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Ptk_exchange
 * @subpackage Ptk_exchange/includes
 * @author     Jose VILLALOBOS <contact@josevillalobos.com>
 */
class Ptk_exchange_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
	
		$ptk = new Ptk_exchange();
		$ptk_admin = new Ptk_exchange_Admin($ptk->get_plugin_name(), $ptk->get_version());

		$ptk_admin->add_specific_categories( );
		
		

	}

}
