<?php

class FormService
{
    public function validateDomainKey($domainKey)
    {
        $response = wp_remote_get(Urls::CHEQ_TAG . 'i/' . $domainKey . '.js');
        $response_code = wp_remote_retrieve_response_code($response);
        return $response_code == "200";
    }
    public function validateBotzappingAuth($api_key, $tag_hash_key, $secret_key)
    {
        $validated = false;
        LogService::logErrorCode(ErrorCodes::PLUGIN_START_AUTHENTICATE);
        if ($api_key && $tag_hash_key && $secret_key) {
            $rtiService = new RTI_Service();
            $clientId = $rtiService->auth_with_botzapping($api_key, $tag_hash_key, $secret_key);
            if ($clientId) {
                $prev_validation_status = get_option('clickcease_bot_zapping_authenticated', '');
                $clickcease_api_key = get_option('clickcease_api_key', '');
                if(!$prev_validation_status && $clientId !== ''){
                    $rtiService = new RTI_Service();
                    $rtiService->updateUserStatus($clickcease_api_key, $clientId, DomainState::BZ_PLUGIN_ACTIVATED);
                }
                update_option('clickcease_bot_zapping_authenticated', true);
                LogService::logErrorCode(ErrorCodes::PLUGIN_SUCCESS_AUTHENTICATE);
            } else {
                update_option('clickcease_bot_zapping_authenticated', false);
                LogService::logErrorCode(ErrorCodes::AUTH_ERROR);
            }
        }
        return $clientId;
    }
}

require_once clickcease_plugin_PLUGIN_PATH . '/classes/logService.php';
require_once clickcease_plugin_PLUGIN_PATH . '/classes/rtiService.php';
require_once clickcease_plugin_PLUGIN_PATH . '/classes/enums.php';
