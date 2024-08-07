<?php
add_action('wp_head','generate_sys_ajaxurl');
function generate_sys_ajaxurl() { ?>
    <script type="text/javascript">
        var ajaxurl = '<?php echo admin_url("admin-ajax.php"); ?>';
    </script>
    <?php
}


function support_chat_contect() {
    global $wpdb;
    $created_at = date('Y-m-d H:i:s');
    $dataa = array();
    parse_str($_POST['data'], $dataa);

    $data = [
        'messages' => [
            [
                'source' => 'php',
                'body' => 'Your message here',
                'to' => '030',
            ]
        ]
    ];


    $jsonData = json_encode($data);

    $username = 'adeel123';
    $apiKey = '6A1D6C60-D8AA-C740-525F-462B849C9564';

    $ch = curl_init('https://rest.clicksend.com/v3/sms/send');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Basic ' . base64_encode("$username:$apiKey")
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);

    // Execute the request
    $response = curl_exec($ch);

    // Check for errors
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }

    // Close the cURL session
    curl_close($ch);

    // Output the response
    echo $response;
    exit();

    // $lastid = $wpdb->insert_id;
    // if ($lastid) {
    //     $finalResult = array('msg' => 'success', 'response'=>'Form submitted successfully.');
    //     echo json_encode($finalResult);
    //     exit();
    // } else {
    //     $finalResult = array('msg' => 'error', 'response'=>'Something went wrong.');
    //     echo json_encode($finalResult);
    //     exit();
    // }
}

add_action ('wp_ajax_support_chat_contect', 'support_chat_contect');
add_action ('wp_ajax_nopriv_support_chat_contect', 'support_chat_contect');