<?php
/*
Plugin Name: Date Picker For Contact Form 7
description: Google Map for contact form 7 show as field
Version: 1.0
Author: Gravity Master
License: GPL2
*/

/* Stop immediately if accessed directly. */
if ( ! defined( 'ABSPATH' ) ) {
   die();
}

/* All constants should be defined in this file. */
if ( ! defined( 'GMDPCF_PLUGIN_DIR' ) ) {
   define( 'GMDPCF_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
}
if ( ! defined( 'GMDPCF_PLUGIN_BASENAME' ) ) {
   define( 'GMDPCF_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
}
if ( ! defined( 'GMDPCF_PLUGIN_URL' ) ) {
   define( 'GMDPCF_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}

/* Auto-load all the necessary classes. */
if( ! function_exists( 'GMDPCF_class_auto_loader' ) ) {
   
   function GMDPCF_class_auto_loader( $class ) {
      
      $includes = GMDPCF_PLUGIN_DIR . 'includes/' . $class . '.php';
      
      if( is_file( $includes ) && ! class_exists( $class ) ) {
         include_once( $includes );
         return;
      }
      
   }
}
spl_autoload_register('GMDPCF_class_auto_loader');

/* Initialize all modules now. */

if (!function_exists('is_plugin_active')) {
    include_once(ABSPATH . 'wp-admin/includes/plugin.php');
}

if ( ( is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ) ) {
   new GMDPCF_Cron();
   new GMDPCF_Backend();
   new GMDPCF_Display();
   new GMDPCF_Frontend();
}