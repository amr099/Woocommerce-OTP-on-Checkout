add_action( 'woocommerce_checkout_process', 'wpcode_require_otp_before_checkout' );
function wpcode_require_otp_before_checkout() {

    if ( ! isset($_POST['otp_verified']) || $_POST['otp_verified'] != "1" ) {
        wc_add_notice("Please verify your phone number using OTP before placing order.", "error");
    }
}
