<?php
/**
* Plugin Name:  Custom Support Chat
* Plugin URI: https://codewithwaqas.com/
* Description: Custom Support Chat use this shortcode [custom_support_chat] to use this plugin.
* Version: 1.0
* Author: Muhammad Waqas Amjad
* Author URI: https://codewithwaqas.com/
* License: GPL v2 or later
*/

if (!defined('ABSPATH')){
    die("Direct access forbidden");
}
define('ASSETS_URL', plugins_url('custom_support_chat/assets/'));
define('PLUGIN_DIR', dirname(__FILE__));
define("PLUGIN_DIR_PATH", plugin_dir_path(__FILE__));
define("PLUGIN_URL", plugins_url(). "/custom_support_chat");


include('inc/scripts.php');
include('inc/ajax_functions.php');
include('inc/chat_form.php');
