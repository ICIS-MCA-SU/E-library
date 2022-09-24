<?php include_once 'header.php' ?>
<style>
    .active6 a {
        color: #e96b56 !important;
    }

    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }

    body {
        background: rgb(219, 226, 226);
    }

    .warningLable {
        display: none;
    }

    .login-page {
        justify-content: center;
        align-items: center;
    }

    .login-page-row {
        background: white;
        border-radius: 30px;
        box-shadow: 12px 12px 22px grey;

    }

    .login-img-logo {
        border-radius: 5px;
        background: white;
        width: 150px;
        height: 70px;
        margin: 40px auto 0px;
    }

    .login-img-row {
        border-top-left-radius: 30px;
        border-bottom-left-radius: 30px;
        background-image: linear-gradient(to right top, #167c97, #006c97, #005b95, #00498f, #003484, #2d2d86, #472385, #5e0f81, #860a8c, #ad0194, #d30099, #f9049a);
        /* background: url("../img/hero-bg.jpg") center center; */
        background-size: cover;
        position: relative;
        text-align: center;
        color: white;
    }

    .login-logo {
        padding: 10px;
    }

    .login-img-row h4 {
        padding: 40px 0 10px 0;
    }

    .login-head {
        padding: 40px 0 20px 0;
        font-weight: bold;
    }

    .login-btn {
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

    .login-btn:hover {
        background: #ff7e54 !important;
        ;
        color: white;
        border: 1px solid;
    }

    .login-forgot {
        margin: 20px 0 10px 0;
        display: flex;
        justify-content: space-between;
    }

    .login-forgot a:hover {
        color: blue;
        text-decoration: underline;
    }

    p a:hover {
        color: blue;
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        .login-img-row {
            display: none;
        }
    }

    @media (max-width: 500px) {
        .row {
            margin-left: 0rem !important;
            margin-right: 0rem !important;
        }
    }

    @media (max-width: 425px) {
        .login-forgot {
            display: block;
        }
    }

    .col-sm-12 {
        padding-left: 0;
        padding-right: 0;
    }

    .col-12 {
        padding-left: 0;
        padding-right: 0;
    }
</style>
<secction class="form my-5 mx-5 py-5">
    <div class="container py-5">
        <div class="row no-gutters mx-5 login">
            <div class="col-lg-10 col-sm-12 col-12 offset-lg-1 offset-sm-0 login-page-row">
                <div class="row">
                    <div class="col-lg-5 col-md-5 login-img-row no-gutters">
                        <div class="form-row">
                            <div class="col-lg-12 col-md-12">
                                <div class="login-img-logo">
                                    <div class="login-logo">
                                        <a href="index.php">
                                            <img src="assets/img/sulogo.png" class="" style="max-height:50px;" alt="" />
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-12 col-md-12 text-center">
                                <h4>Welcome back to<strong><br>Srinivas University <br>Digital Library</strong></h4>
                                <h5>Online Learning Anytime, Anywhere!</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-12 col-12 px-5 login-page">
                        <h4 class="login-head pt-5">Log in to Your Account</h4>
                        <span id="warningLable"></span>
                        <form id="loginForm" action="" method="post">
                            <div class="form-row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                    <input type="email" name="username" class="form-control my-2" placeholder="Email-Address" id="username" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                    <input type="password" name="password" class="form-control my-2" placeholder="Password" id="password" pattern=".{8,}" title="8 or more characters" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                    <input type="submit" value="Login" name="Login" class="login-btn mt-3">
                                </div>
                            </div>
                            <div class="login-forgot">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="forever" id="rememberme" name="rememberme" />
                                    <label class="form-check-label" for="rememberme"> Remember me </label>
                                </div>
                                <a href="forgot-password.php">Forgot Password</a>
                            </div>
                            <p class="pb-5">Don't have an Account ? <a href="signup.php"> <strong>Register Here</strong> </a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</secction>

<script>
    $(document).ready(function() {
        $('#loginForm').submit(function(event) {
            event.preventDefault();

            if ($.trim($("#username").val()).length > 0) {
                if ($.trim($("#password").val()).length > 0) {


                    $.ajax({
                        url: 'dbHelper/processLogin.php',
                        type: 'post',
                        data: $("#loginForm").serialize(),
                        success: function(response) {
                            if (response === "1") {
                                window.location.href = "index.php";
                            } else if (response == "Deactivated") {
                                $("#warningLable").css("display", "block");
                                $("#warningLable").css("color", "#fa0606");
                                $("#warningLable").html("Your account has been deactivated by the librarian");
                            } else {
                                $("#warningLable").css("display", "block");
                                $("#warningLable").css("color", "#fa0606");
                                $("#warningLable").html("Invalid Credential Provided");
                            }
                        }
                    });


                } else {
                    $("#warningLable").css("display", "block");
                    $("#warningLable").css("color", "#fa0606");
                    $("#warningLable").html("Please Check Your Details");


                }


            } else {
                $("#warningLable").css("display", "block");
                $("#warningLable").css("color", "#fa0606");
                $("#warningLable").html("Please Check Your Details")

            }


        });


    });
</script>

<?php include_once 'footer.php' ?>