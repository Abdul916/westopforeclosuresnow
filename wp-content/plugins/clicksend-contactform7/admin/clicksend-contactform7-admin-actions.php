<?php

/**
 * Add ClickSend Contact Form Service on admin_init.
 */

add_action('wpcf7_admin_init', 'wpcf7_clicksend_register_service');

function wpcf7_clicksend_register_service()
{
    // Get integration instance.
    $integration = WPCF7_Integration::get_instance();

    // The service category.
    $categories = array(
        'sms' => __('SMS', 'contact-form-7'),
    );

    foreach ($categories as $name => $category) {
        $integration->add_category($name, $category);
    }

    $services = array(
        'clicksend' => ClickSend_ContactForm7Service::get_instance(),
    );

    // Add service.
    foreach ($services as $name => $service) {
        $integration->add_service($name, $service);
    }

}