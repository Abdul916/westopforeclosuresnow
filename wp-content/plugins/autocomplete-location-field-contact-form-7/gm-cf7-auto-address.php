<?php
/*
Plugin Name: Autocomplete Location field Contact Form 7 
description: Woo Customer auto fill fields in cf7
Version: 2.0
Author: Gravity Master
License: GPL2
*/

/* Stop immediately if accessed directly. */
if ( ! defined( 'ABSPATH' ) ) {
   die();
}

/* All constants should be defined in this file. */
if ( ! defined( 'GWAA_PLUGIN_DIR' ) ) {
   define( 'GWAA_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
}
if ( ! defined( 'GWAA_PLUGIN_BASENAME' ) ) {
   define( 'GWAA_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
}
if ( ! defined( 'GWAA_PLUGIN_URL' ) ) {
   define( 'GWAA_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}

/* Auto-load all the necessary classes. */
if( ! function_exists( 'GWAA_class_auto_loader' ) ) {
   
   function GWAA_class_auto_loader( $class ) {
      
      $includes = GWAA_PLUGIN_DIR . 'includes/' . $class . '.php';
      
      if( is_file( $includes ) && ! class_exists( $class ) ) {
         include_once( $includes );
         return;
      }
      
   }
}
spl_autoload_register('GWAA_class_auto_loader');

/* Initialize all modules now. */
if (!function_exists('is_plugin_active')) {
    include_once(ABSPATH . 'wp-admin/includes/plugin.php');
}

if ( ( is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ) ) {
   new GWAA_Backend();
   new GWAA_Display();
   new GWAA_Frontend();
}