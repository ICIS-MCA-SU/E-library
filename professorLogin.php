<?php include_once 'header.php' ?>
<!-- Start: Page Banner -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>
<section class="page-banner services-banner">
    <div class="container">
        <div class="banner-header">
            <h2>Signin</h2>
            <span class="underline center"></span>
            <p class="lead">Sign in to Sulibrary
                .</p>
        </div>
        <div class="breadcrumb">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li>Signin</li>
            </ul>
        </div>
    </div>
</section>
<!-- End: Page Banner -->
<!-- Start: Cart Section -->
<div id="content" class="site-content">
    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <div class="signin-main">
                <div class="container">
                    <div class="woocommerce">
                        <div class="woocommerce-login">
                            <div class="company-info signin-register">
                                <div class="col-md-5 col-md-offset-4 ">
                                    <div class="row">
                                        <div class="col-md-12" style="position: center">
                                            <div class="company-detail bg-dark margin-left">
                                                <div class="signin-head">
                                                    <span class="underline left"></span>
                                                </div>
                                                <form id="loginForm" action="" class="login" method="post">
                                                    <p class="form-row form-row-first input-required">
                                                        <label>
                                                            <span class="first-letter">User name</span>
                                                            <span class="second-letter">*</span>
                                                        </label>
                                                        <input type="text"  id="username" name="username" class="input-text">
                                                    </p>
                                                    <p class="form-row form-row-last input-required">
                                                        <label>
                                                            <span class="first-letter">Password</span>
                                                            <span class="second-letter">*</span>
                                                        </label>
                                                        <input type="password" id="password" name="password" class="input-text" pattern=".{8,}" title="8 or more characters" required/>
                                                    </p>
                                                    <div class="clear"></div>
                                                    <div class="password-form-row">
                                                        <p class="form-row input-checkbox">
                                                            <input type="checkbox" value="forever" id="rememberme" name="rememberme">
                                                            <label class="inline" for="rememberme">Remember me</label>
                                                        </p>
                                                        <p class="lost_password">

                                                        </p>
                                                    </div>

                                                    <input type="submit"  value="Login" name="login" class="button btn btn-primary">
                                                    <br>

                                                    <p style="color: #f50000"  id="warningLable"></p>




                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>



<script>
    $(document).ready(function () {
        $('#loginForm').submit(function (event) {
            event.preventDefault();

            if ($.trim($("#username").val()).length > 0) {
                if ($.trim($("#password").val()).length > 0) {


                    $.ajax({
                        url: 'dbHelper/processProfessorLogin.php',
                        type: 'post',
                        data: $("#loginForm").serialize(),
                        success: function (response) {
                            if(response === "1"){
                                window.location.href="index.php";
                            }else {
                                $("#warningLable").html("Invalid Credential Provided");
                            }
                        }
                    });


                } else {
                    $("#warningLable").css("color", "#fa0606");
                    $("#warningLable").html("Please enter Password");


                }


            } else {
                $("#warningLable").css("color", "#fa0606");
                $("#warningLable").html("Please enter Email")

            }


        });


    });
</script>
<!-- End: Cart Section -->
<?php include_once 'footer.php' ?>
