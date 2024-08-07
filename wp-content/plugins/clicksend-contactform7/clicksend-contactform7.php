<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://clicksend.com/help
 * @since             1.0.0
 * @package           Clicksend_Contactform7
 *
 * @wordpress-plugin
 * Plugin Name:       ClickSend Contact Form 7
 * Plugin URI:        https://clicksend.com
 * Description:       A ContactForm7 plugin for ClickSend.
 * Version:           1.2.2
 * Author:            ClickSend
 * Author URI:        https://clicksend.com/help
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       clicksend-contactform7
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-clicksend-contactform7-activator.php
 */
function activate_clicksend_contactform7()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-clicksend-contactform7-activator.php';
    Clicksend_Contactform7_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-clicksend-contactform7-deactivator.php
 */
function deactivate_clicksend_contactform7()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-clicksend-contactform7-deactivator.php';
    Clicksend_Contactform7_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_clicksend_contactform7');
register_deactivation_hook(__FILE__, 'deactivate_clicksend_contactform7');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-clicksend-contactform7.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_clicksend_contactform7()
{

    $plugin = new Clicksend_Contactform7();
    $plugin->run();

}

run_clicksend_contactform7();
