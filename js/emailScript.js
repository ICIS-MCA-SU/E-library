function sendRegistrationMessage() {
    var email = $("#email").val();
    var password = $("#password").val();
    if(email.length !== 0)
    {
        var input ={
            "password" : password,
            "email" : email,
            "action" : "register_message"
        }
        // $("#loading-image").show();
        $.ajax({

            url : 'api/controller.php',
            type : 'POST',
            data : input,
            success : function(response)
            {
                alert("sent msg");
                // $(".container").html(response);
            },
            complete : function()
            {
                // $("#loading-image").hide();
            }

        });
    }
    else
        $("#message1").html("Enter your name").css('color','red');

}

function verifyOTP() {
    // $(".err").html("").hide();
    // $(".success").html("").hide();
    var otp = $("#mobileOtp").val();
    alert(otp);
    var input = {
        "otp" : otp,
        "action" : "verify_otp"
    };
    if (otp.length == 6 && otp != null) {
        $.ajax({
            url : 'api/controller.php',
            type : 'POST',
            dataType : "json",
            data : input,
            success : function(response) {
                    alert(response.message);
                // $("." + response.type).html(response.message)
                // $("." + response.type).show();
                // $("#frm-mobile-verification").html("").hide();

            },
            error : function() {
                alert("Error");
            }
        });
    } else {
        $(".err").html('You have entered wrong OTP.')
        $(".err").show();
    }
}