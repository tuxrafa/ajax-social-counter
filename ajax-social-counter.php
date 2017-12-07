<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/tuxrafa
 * @since             1.0.0
 * @package           Ajax_Social_Counter
 *
 * @wordpress-plugin
 * Plugin Name:       Ajax Social Counter
 * Plugin URI:        https://github.com/tuxrafa/ajax-social-counter
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Rafael Oliveira
 * Author URI:        https://github.com/tuxrafa
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ajax-social-counter
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently pligin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-ajax-social-counter-activator.php
 */
function activate_ajax_social_counter() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ajax-social-counter-activator.php';
	Ajax_Social_Counter_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-ajax-social-counter-deactivator.php
 */
function deactivate_ajax_social_counter() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ajax-social-counter-deactivator.php';
	Ajax_Social_Counter_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_ajax_social_counter' );
register_deactivation_hook( __FILE__, 'deactivate_ajax_social_counter' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-ajax-social-counter.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_ajax_social_counter() {

	$plugin = new Ajax_Social_Counter();
	$plugin->run();

}
run_ajax_social_counter();
