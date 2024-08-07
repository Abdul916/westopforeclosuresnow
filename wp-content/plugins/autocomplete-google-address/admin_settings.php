<?php
//including meta box
include('metabox/init.php');


add_action( 'cmb2_admin_init', 'myprefix_register_theme_options_metabox' );
/**
 * Hook in and register a metabox to handle a theme options page and adds a menu item.
 */
function myprefix_register_theme_options_metabox() {

	/**
	 * Registers options page menu item and form.
	 */
	$cmb_options = new_cmb2_box( array(
		'id'           => 'myprefix_option_metabox',
		'title'        => esc_html__( 'Autocomplete', 'myprefix' ),
		'object_types' => array( 'options-page' ),

		/*
		 * The following parameters are specific to the options-page box
		 * Several of these parameters are passed along to add_menu_page()/add_submenu_page().
		 */
		'option_key'      => 'autocomplete', // The option key and admin menu page slug.
		 'icon_url'        => 'dashicons-location-alt', // Menu icon. Only applicable if 'parent_slug' is left empty.
		// 'menu_title'      => esc_html__( 'Options', 'myprefix' ), // Falls back to 'title' (above).
		// 'parent_slug'     => 'themes.php', // Make options page a submenu item of the themes menu.
		'capability'      => 'manage_options', // Cap required to view options-page.
		// 'position'        => 1, // Menu position. Only applicable if 'parent_slug' is left empty.
		// 'admin_menu_hook' => 'network_admin_menu', // 'network_admin_menu' to add network-level options page.
		// 'display_cb'      => false, // Override the options-page form output (CMB2_Hookup::options_page_output()).
		// 'save_button'     => esc_html__( 'Save Theme Options', 'myprefix' ), // The text for the options-page save button. Defaults to 'Save'.
		'cmb_styles' => false,
	) );
	/*
	 * Options fields ids only need
	 * to be unique within this box.
	 * Prefix is not needed.
	 */
	$cmb_options->add_field( array(
		'name' => __( 'Google Place API Key', 'myprefix' ),
		'desc' => __( 'Type your Google Place Api key here', 'myprefix' ),
		'id'   => 'google_place_api',
		'type' => 'text',
		'default' => '',
	) );

  $cmb_options->add_field( array(
    'name' => __( 'Form ID', 'myprefix' ),
    'desc' => __( 'Type your Form ID without "#". if you want to add multiple ID just seprate by " , " ', 'myprefix' ),
    'id'   => 'form_id',
    'type' => 'text',
    'default' => '',
  ) );
  $cmb_options->add_field( array(
    'name' => __( 'Autocomplete Pro Features ', 'myprefix' ),
	'desc' => __( '<ul>
	<ol>2 Type of Address (Full Address & Smart Address)</ol>
	<ol>Use in unlimited form</ol>
	<ol>Work on any form</ol>
	<ol>single or multiple Country restriction</ol>
	<ol>Woocommerce location map picker with autocomplete all input</ol>
	<ol><a href="https://www.nishath.com.bd/google-autocomplete-pro/">Go For Pro</a></ol>

	</ul>', 'myprefix' ),
    'id'   => 'ext',
    'type' => 'title',
    'default' => '',
  ) );
}
/**
 * Wrapper function around cmb2_get_option
 * @since  0.1.0
 * @param  string $key     Options array key
 * @param  mixed  $default Optional default value
 * @return mixed           Option value
 */
function myprefix_get_option( $key = '', $default = false ) {
	if ( function_exists( 'cmb2_get_option' ) ) {
		// Use cmb2_get_option as it passes through some key filters.
		return cmb2_get_option( 'autocomplete', $key, $default );
	}
	// Fallback to get_option if CMB2 is not loaded yet.
	$opts = get_option( 'autocomplete', $default );
	$val = $default;
	if ( 'all' == $key ) {
		$val = $opts;
	} elseif ( is_array( $opts ) && array_key_exists( $key, $opts ) && false !== $opts[ $key ] ) {
		$val = $opts[ $key ];
	}
	return $val;
}
