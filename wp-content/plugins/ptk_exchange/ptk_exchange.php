<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              josevillalobos.com
 * @since             1.0.0
 * @package           Ptk_exchange
 *
 * @wordpress-plugin
 * Plugin Name:       ptk exchange
 * Plugin URI:        josevillalobos.com/ptkexchange
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Jose VILLALOBOS
 * Author URI:        josevillalobos.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ptk_exchange
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-ptk_exchange-activator.php
 */
function activate_ptk_exchange() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ptk_exchange-activator.php';
	Ptk_exchange_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-ptk_exchange-deactivator.php
 */
function deactivate_ptk_exchange() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ptk_exchange-deactivator.php';
	Ptk_exchange_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_ptk_exchange' );
register_deactivation_hook( __FILE__, 'deactivate_ptk_exchange' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-ptk_exchange.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_ptk_exchange() {

	$plugin = new Ptk_exchange();
	$plugin->run();

}
run_ptk_exchange();
