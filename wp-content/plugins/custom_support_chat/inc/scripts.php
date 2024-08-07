<?php
function users_scripts() {
	wp_deregister_script('jquery');
	wp_register_script('jquery', 'https://code.jquery.com/jquery-3.6.0.min.js');
	wp_enqueue_script('jquery');

	wp_enqueue_script('validation', 'https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js');

	wp_register_script('form_validation', ASSETS_URL.'js/form_validation.js', array('jquery'));
	wp_enqueue_script('form_validation', ['jquery', 'validation']);

}
add_action( 'wp_enqueue_scripts', 'users_scripts');

function enqueue_sendclick_script() {
    wp_enqueue_script('sendclick-script', get_template_directory_uri() . '/path/to/sendclick-script.js', array('jquery'), null, true);

    // Pass SendClick API key to the script
    wp_localize_script('sendclick-script', 'sendclick_params', array(
        'api_key' => '6A1D6C60-D8AA-C740-525F-462B849C9564',
    ));
}

add_action('wp_enqueue_scripts', 'enqueue_sendclick_script');
