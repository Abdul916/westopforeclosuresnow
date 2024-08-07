<?php

/**
 * This class is loaded on the front-end since its main job is 
 * to display the WhatsApp box.
 */

class GMDPCF_Frontend {
	
	public function __construct () {
		add_action( 'wp_enqueue_scripts',  array( $this, 'gmdpcf_insta_scritps' ) );

		add_action( 'wp_footer', array($this,'GMDPCF_cf7_gpa_plugin_script'), 21, 1 );
	}
	public function gmdpcf_insta_scritps () {
		$gmdpcf_skin = get_option( 'gmdpcf_skin' );
		wp_enqueue_style('gmdpcf-jquery-ui', GMDPCF_PLUGIN_URL . '/assents/jquery-ui-themes/themes/'.$gmdpcf_skin.'/jquery-ui.css', array(), '1.0.0', 'all');
		wp_enqueue_style('gmdpcf-jquery-ui-theme', GMDPCF_PLUGIN_URL . '/assents/jquery-ui-themes/themes/'.$gmdpcf_skin.'/theme.css', array(), '1.0.0', 'all');
		wp_enqueue_style('gmdpcf-stylee', GMDPCF_PLUGIN_URL . '/assents/css/style.css', array(), '1.0.0', 'all');
		wp_enqueue_script( 'jquery-ui-datepicker' );
		wp_enqueue_script('gmdpcf-scirpt', GMDPCF_PLUGIN_URL . '/assents/js/script.js', array(), '1.0.0', 'all');	

	}
	public function GMDPCF_cf7_gpa_plugin_script() 
	{
			
	}
}