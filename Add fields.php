add_action( 'woocommerce_after_checkout_billing_form', 'wpcode_add_otp_fields_checkout' );
function wpcode_add_otp_fields_checkout( $checkout ) {
    ?>
    <div id="otp-section">
		<!--
        <p class="form-row form-row-wide">
            <label for="otp_phone">تأكيد رقم الجوال</label>
            <input type="text" id="otp_phone" />
        </p>
		-->
		
		<button type="button" id="send_otp_btn">Send OTP</button>
        <p class="form-row form-row-wide" id="otp_verify_wrap" style="display:none;">
            <label for="otp_code">Enter OTP</label>
            <input type="text" id="otp_code" />
            <button type="button" id="verify_otp_btn">Verify OTP</button>
        </p>

        <p id="otp_status" style="color:red;font-weight:bold;"></p>

        <input type="hidden" name="otp_verified" id="otp_verified" value="0">
    </div>
    <?php
}
