/* -------------------------
   SEND OTP
--------------------------*/
add_action('wp_ajax_nopriv_send_otp', 'wpcode_send_otp');
add_action('wp_ajax_send_otp', 'wpcode_send_otp');

function wpcode_send_otp() {

    $phone = sanitize_text_field($_POST['phone']);

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.taqnyat.sa/verify.php',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'[
            {
                "apiKey": "a20ca8ea1b061753f2483cb82724fd5c",
                "numbers": [ "'.$phone.'" ],
                "sender": "I-Makeup",
                "method": "sms",
                "lang": "ar",
                "note": "Checkout Login"
            }
        ]',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);

    echo $response;
    wp_die();
}

/* -------------------------
   VERIFY OTP
--------------------------*/
add_action('wp_ajax_nopriv_verify_otp', 'wpcode_verify_otp');
add_action('wp_ajax_verify_otp', 'wpcode_verify_otp');

function wpcode_verify_otp() {

    $phone = sanitize_text_field($_POST['phone']);
    $otp   = sanitize_text_field($_POST['otp']);

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.taqnyat.sa/verify.php',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'[
            {
                "apiKey": "a20ca8ea1b061753f2483cb82724fd5c",
                "numbers": [ "'.$phone.'" ],
                "activeKey": "'.$otp.'"
            }
        ]',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);

    echo $response;
    wp_die();
}
