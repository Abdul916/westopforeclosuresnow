<?php
/**
 * Send SMS notification via ClickSend everytime we have a new Contact Form mail_sent.
 */

add_action('wpcf7_mail_sent', 'action_wpcf7_mail_sent');

function action_wpcf7_mail_sent($contact_form)
{
    // Get ClickSend Contact Form 7 Service instance.
    $service = ClickSend_ContactForm7Service::get_instance();

    // Notify admin.
    $result = $service->notifyAdmin($contact_form);

    // Notify sender, if any.
    $service->notifySender();

    return $result;
}