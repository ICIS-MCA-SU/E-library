<?php
include_once 'header.php'; ?>
<style>
    
    .btnSubmit {
        border: none;
        outline: none;
        height: 50px;
        width: 100%;
        background: #ff5821 !important;
        ;
        color: #fff;
        transition: 0.4s;
        border-radius: 4px;
        margin-bottom: 10px;
    }

    .btnSubmit:hover {
        background: #ff7e54 !important;
        ;
        color: white;
        border: 1px solid;
    }
</style>
<div class="container my-3 py-5" x-data="forgot_password">
    <div class="row">
        <div class="col-lg-6 offset-lg-3 offset-md-2 col-md-8">
            <div class="panel panel-password px-4 py-3">
                <div class="panel-heading">
                    <div class="row my-3">
                        <div class="col-12 text-center">
                            <h3> Forgot Password </h3>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                                </div>
                                <div class="form-group" id="SendOTPSection">
                                    <div class="row justify-content-center">
                                        <div class="col-md-4 col-12 text-center ">
                                            <input type="button" class="btn btnSubmit" value="Send OTP" x-on:click="sendOTP">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="OTPSection" style="display: none;">
                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                            <input type="text" name="otp" id="otp" class="form-control" placeholder="OTP" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="NewPasswordSection" style="display: none;">
                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                            <input type="password" name="newPassword" id="newPassword" class="form-control" placeholder="New Password" required>
                                        </div>
                                    </div>
                                    <br />
                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                            <input type="password" name="confirmPassword" id="confirmPassword" class="form-control" placeholder="Confirm Password" required>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-md-4 col-12  text-center mt-4">
                                            <input type="button" class="btn btnSubmit" value="Submit" x-on:click="submit">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<style>
    .panel-password {
        justify-content:center;
        align-items:center;
        background:white;
        border-radius:30px;
        box-shadow:10px 10px 22px grey;
    }

    .panel-password>.panel-heading {
        color: #00415d;
        background-color: #fff;
        border-color: #ccc;
    }

    .panel-password>.panel-heading .fa {
        color: #00415d;
    }

    .panel-password>.panel-body {
        background-color: #fff;
    }
</style>

<script>
        window.onload = () => {
        $('#overlay').hide();
    }
    let forgot_password = () => {
        return {
            iniit() {

            },
            sendOTP() {
                let email = $('#email').val();
                const sendMail = () => {
                    var otp = Math.floor(100000 + Math.random() * 900000);
                    $.ajax({
                        url: 'api/Mail.php',
                        type: 'POST',
                        data: {
                            action: 'forgot_password',
                            email: email,
                            otp: otp
                        },
                        success: function(data) {
                            if (data == 'success') {
                                var token = Math.random().toString(36).slice(2)
                                localStorage.setItem('token', token);
                                localStorage.setItem(token, otp);
                                swal({
                                    title: "OTP has been sent to your email",
                                    text: "Please enter the OTP to reset your password",
                                    type: "success"
                                });
                                $('#SendOTPSection').hide();
                                $('#OTPSection').show();
                                $('#NewPasswordSection').show();
                            } else {
                                swal({
                                    title: "Something went wrong",
                                    text: "Please try again later",
                                    type: "error"
                                });
                                $('#SendOTPSection').show();
                                $('#OTPSection').hide();
                                $('#NewPasswordSection').hide();
                            }
                        }
                    });
                }
                $.ajax({
                    url: 'dbHelper/forgot-password.php',
                    type: 'POST',
                    data: {
                        type: "forgot_password",
                        email: email
                    },
                    success: function(data) {
                        if (data == 'success') {
                            sendMail();
                        } else {
                            swal({
                                title: "Error",
                                text: "Email not found",
                                type: "error"
                            });
                        }
                    }
                });

            },
            submit() {
                let otp = $('#otp').val();
                let token = localStorage.getItem('token');
                let otp_from_local = localStorage.getItem(token);
                let email = $('#email').val();
                let newPassword = $('#newPassword').val();
                let confirmPassword = $('#confirmPassword').val();
                var valid = true;
                if (otp == "") {
                    swal({
                        title: "Error",
                        text: "Please enter the OTP",
                        type: "error"
                    });
                    valid = false;
                }
                if (newPassword == "") {
                    swal({
                        title: "Error",
                        text: "Please enter the new password",
                        type: "error"
                    });
                    valid = false;
                }
                if (confirmPassword == "") {
                    swal({
                        title: "Error",
                        text: "Please enter the confirm password",
                        type: "error"
                    });
                    valid = false;
                }
                if (valid) {
                    const sendConfirmationMessage = () => {
                        $.ajax({
                            url: 'api/Mail.php',
                            type: 'POST',
                            data: {
                                action: 'forgot_password_confirmation',
                                email: email
                            },
                            success: function(data) {
                                if (data == 'success') {
                                    swal({
                                        title: "Password has been reset",
                                        text: "Please login with your new password",
                                        type: "success"
                                    });
                                } else {
                                    swal({
                                        title: "Confirmation failed",
                                        text: "Please try again later",
                                        type: "error"
                                    });
                                }
                            }
                        });
                    }

                    if (otp == otp_from_local) {
                        if (newPassword == confirmPassword) {
                            $.ajax({
                                url: 'dbHelper/forgot-password.php',
                                type: 'POST',
                                data: {
                                    type: 'reset_password',
                                    email: email,
                                    newPassword: newPassword
                                },
                                success: function(data) {
                                    if (data == 'success') {
                                        sendConfirmationMessage();
                                        window.location.href = 'signin.php';
                                    } else {
                                        swal({
                                            title: "Something went wrong",
                                            text: "Please try again later",
                                            type: "error"
                                        });
                                        $('#SendOTPSection').show();
                                        $('#OTPSection').hide();
                                        $('#NewPasswordSection').hide();
                                    }
                                }
                            });
                        } else {
                            swal({
                                title: "Error",
                                text: "Password and confirm password does not match",
                                type: "error"
                            });
                        }
                    }
                } else {
                    swal({
                        title: "Error",
                        text: "Please enter the details correctly",
                        type: "error"
                    });
                }
            }
        }
    }
</script>
<?php include_once 'footer.php'; ?>