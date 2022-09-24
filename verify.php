<?php include_once 'header.php' ?>

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<div id="content" class="site-content py-5" >

</div>
<script>
    $(document).ready(function() {
        let params = new URLSearchParams(location.search);
        $.ajax({
            url: 'dbHelper/addVerificationUserData.php',
            type: 'post',
            data: {
                action: "alreadyVerified",
                email: params.get('email'),
            },
            success: function(response) {
                if (response == 1) {
                    $('#content').html('<div class="w3-content w3-section py-5 my-5" style="max-width:500px"><div class="w3-container w3-card w3-white w3-round w3-margin"><br><h3>Email already verified</h3><p>You can now login to your account.</p><p class="text-center"><a href="login.php" class="w3-button w3-theme-d2 w3-margin-bottom"><i class="fa fa-home w3-margin-right"></i>Login</a></p></div></div>');
                } else {
                    $.ajax({
                        url: 'dbHelper/addVerificationUserData.php',
                        type: 'post',
                        data: {
                            action: "emailVerification",
                            email: params.get('email'),
                            OTP: params.get('token'),
                        },
                        success: function(response) {
                            if (response == "success") {
                                $.ajax({
                                    url: 'api/Mail.php',
                                    type: 'post',
                                    data: {
                                        action: "verificationConfirmation",
                                        email:params.get('email'),
                                    },
                                    success: function(response) {
                                    }
                                });
                                $("#content").html("<div class='w3-content w3-section' style='max-width:500px'><div class='w3-container w3-card w3-white w3-round w3-margin'><br><h3>Email successfully verified</h3><p>You can now login to your account.</p><p class='text-center'><a href='login.php' class='w3-button w3-theme-d2 w3-margin-bottom'><i class='fa fa-home w3-margin-right'></i>Login</a></p></div></div>");
                            } else {
                                $("#content").html("<div class='w3-content w3-section' style='max-width:500px'><div class='w3-container w3-card w3-white w3-round w3-margin'><br><h3>Email verification failed</h3><p>Please try again.</p><p>Note:Either your email is already verified or invalid token/email.</p><p class='text-center'><a href='login.php' class='w3-button w3-theme-d2 w3-margin-bottom'><i class='fa fa-home w3-margin-right'></i>Login</a></p></div></div>");
                            }
                        }
                    });
                }
            }
        });
        // $.ajax({
        //     url: 'dbHelper/addVerificationUserData.php',
        //     type: 'post',
        //     data: {
        //         action: "emailVerification",
        //         email: params.get('email'),
        //         OTP: params.get('token'),
        //     },
        //     success: function(response) {
        //         if (response == "success") {
        //             $("#content").html("<div class='w3-content w3-section' style='max-width:500px'><div class='w3-container w3-card w3-white w3-round w3-margin'><br><h3>Email successfully verified</h3><p>You can now login to your account.</p><p class='text-center'><a href='login.php' class='w3-button w3-theme-d2 w3-margin-bottom'><i class='fa fa-home w3-margin-right'></i>Login</a></p></div></div>");
        //         } else {
        //             $("#content").html("<div class='w3-content w3-section' style='max-width:500px'><div class='w3-container w3-card w3-white w3-round w3-margin'><br><h3>Email verification failed</h3><p>Please try again.</p><p class='text-center'><a href='login.php' class='w3-button w3-theme-d2 w3-margin-bottom'><i class='fa fa-home w3-margin-right'></i>Login</a></p></div></div>");
        //         }
        //     }
        // });
    });
</script>
<?php include_once 'footer.php' ?>