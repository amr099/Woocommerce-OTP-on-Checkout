jQuery(function($) {

    // Utility function to show message
    function showMessage(message, type = "success") {
        let color = type === "success" ? "green" : "red";
        $("#otp_status").text(message).css("color", color);
    }

    // Send OTP
    $("#send_otp_btn").click(function() {
        let phone = $("#phone").val();

        if (!phone) {
            showMessage("الرجاء إدخال رقم الهاتف", "fail");
            return;
        }

        $.post(
            wp_vars.ajax,
            { action: "send_otp", phone: phone },
            function(res) {
                let r = JSON.parse(res);
                console.log("Send OTP Response:", r);

                if (r.ResponseStatus === "success") {
                    showMessage("تم إرسال الرمز بنجاح", "success");
                    $("#otp_verify_wrap").show();
                } else if (r.ResponseStatus === "fail" && r.Error && r.Error.MessageAr) {
                    showMessage(r.Error.MessageAr, "fail");
                } else {
                    showMessage("حدث خطأ غير متوقع، يرجى المحاولة لاحقاً", "fail");
                }
            }
        );
    });

    // Verify OTP
    $("#verify_otp_btn").click(function() {
        let phone = $("#phone").val();
        let otp   = $("#otp_code").val();

        if (!phone || !otp) {
            showMessage("الرجاء إدخال الرقم والرمز", "fail");
            return;
        }

        $.post(
            wp_vars.ajax,
            { action: "verify_otp", phone: phone, otp: otp },
            function(res) {
                let r = JSON.parse(res);
                console.log("Verify OTP Response:", r);

                if (r.ResponseStatus === "success" && r.Data && r.Data.result == 10) {
                    $("#otp_verified").val(1);
                    showMessage("تم التحقق من الرقم!", "success");
                } else if (r.ResponseStatus === "fail" && r.Error && r.Error.MessageAr) {
                    showMessage(r.Error.MessageAr, "fail");
                } else {
                    showMessage("رمز التحقق غير صحيح", "fail");
                }
            }
        );
    });

});
