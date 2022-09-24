<?php include_once 'header.php' ?>
<script src="js/emailScript.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
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

    .signup-page {
        justify-content: center;
        align-items: center;
        background: white;
        border-radius: 30px;
        box-shadow: 12px 12px 22px grey;
    }

    .signup-head {
        padding: 40px 0 5px 0;
        font-weight: bold;
    }

    .signup-head2 {
        padding: 0 0 5px 0;
        font-weight: bold;
    }

    .signup-btn {
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

    .signup-btn:hover {
        background: #ff7e54 !important;
        ;
        color: white;
        border: 1px solid;
    }

    p a:hover {
        color: blue;
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        .signup-head {
            font-size: 19px;
        }

        .signup-head2 {
            font-size: 16px;
        }
    }

    /*--------------------------------------------------------------
# Breadcrumbs
--------------------------------------------------------------*/
    .breadcrumbss {
        padding: 15px 0;
        text-align: center;
        justify-content: center;
    }

    .breadcrumbss h2 {
        font-size: 28px;
        font-weight: 500;
    }

    .breadcrumbss ol {
        display: flex;
        flex-wrap: wrap;
        list-style: none;
        padding: 0 0 10px 0;
        margin: 0;
        font-size: 14px;
    }


    .breadcrumbss ol li+li::before {
        display: inline-block;
        padding: 0 10px 0;
        color: #635551;
        content: "  /";
    }
</style>

<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbss">
    <div class="container">
        <ol>
            <li>Student Sign up</li>
            <li><a href="professorRegister.php">Faculty Sign up</a></li>
    </div>
</section><!-- End Breadcrumbs -->

<div x-data="register">
<secction class="form my-4 mx-5">
    <div class="container pb-5 ">
        <div class="row no-gutters">
            <div class="offset-lg-1 col-lg-10 col-md-12 px-5 signup-page" id="registerForm">
                <h4 class="signup-head text-center">Looks like you're new here!</h4>
                <h5 class="signup-head2 text-center">Create Account</h4>
                    <form id="registerFrom" name="registerFrom" method="post" style="justify-content:center;align-items:center;margin:auto;" action="" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="col-lg-12 col-md-12">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <input type="text" name="firstname" class="form-control my-3" placeholder="First-Name" id="firstname" required>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <input type="text" name="lastname" class="form-control my-3" placeholder="Last-Name" id="lastname">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-12 col-md-12">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <select onchange="valChanged()" id="course" name="course" class="form-control my-3">
                                            <option selected value="0" disabled="disabled">Select Course</option>
                                            <option value="mca">MCA</option>
                                            <option value="mba">MBA</option>
                                            <option value="bca">BCA</option>
                                            <option value="bba">BBA</option>
                                            <option value="bcom">BCom</option>
                                            <option value="bhm">BHM</option>
                                            <option value="bed">BEd</option>
                                            <option value="bpt">BPT</option>
                                            <option value="msw">MSW</option>
                                            <option value="mpt">MPT</option>
                                            <option value="bdes">B.Des</option>
                                            <option value="bsw">B.S.W</option>
                                            <option value="btech">B.Tech</option>
                                            <option value="bsw">M.Tech</option>
                                            <option value="bsc">B.Sc Animation,DFM and VFX</option>
                                            <option value="bjmc">B.Journalism & Mass Communication</option>
                                            <option value="ma">MA in English</option>
                                            <option value="mcom">M.Com</option>
                                            <option value="Phd">Research Scholar</option>
                                            <option value="nur">BSC Nursing and general Nursing</option>
                                            <option value="bscid">BSC ID</option>
											    <option value="ahs">Allied Health Sciences</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <select id="sem" name="sem" class="form-control my-3">
                                            <option selected value="0" disabled="disabled">Select Semister</option>
                                            <option value="1">I</option>
                                            <option value="2">II</option>
                                            <option value="3">III</option>
                                            <option value="4">IV</option>
                                            <option value="5">V</option>
                                            <option value="6">VI</option>
                                            <option value="7">VII</option>
                                            <option value="8">VIII</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-12 col-md-12">
                                <input type="text" name="regNum" class="form-control my-3" placeholder="Register Number" id="regNum" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-12 col-md-12">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <input type="number" name="phone" class="form-control my-3" placeholder="Phone Number" id="phone" pattern=".{10,}" title="Enter Valid Number" onchange="validatePhone()" required>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <input type="email" name="email" class="form-control my-3" placeholder="Email-Address" id="email" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-12 col-md-12">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <input type="password" name="password" class="form-control my-3" placeholder="Password" id="password" pattern=".{8,}" title="8 or more characters" required>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <input type="password" name="vpassword" class="form-control my-3" placeholder="Confirm Password" id="vpassword" pattern=".{8,}" title="8 or more characters" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-12 col-md-12">
                                <div class="row mx-3 my-3 p-2 text-center">
                                    <input class="form-check-input" type="checkbox" value="" id="termsCheck" name="termsCheck" required />
                                    <label class="form-check-label" for="termsCheck">I Agree to the Digital Library Terms And Conditions</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="offset-lg-3 offset-md-2 col-lg-6 col-md-8">
                                <button class="signup-btn mt-3" type="button" x-on:click="validate">Submit</button>
                            </div>
                        </div>
                        <p class="mx-3 p-4 text-center">Already Have an Account ? <a href="login.php">Login Here</a></p>
                    </form>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="card" id="otpForm">
                                <div class="card-body py-5">
                                    <div class="row">
                                        <div class="col-md-2">
                                        </div>
                                        <div class="col-md-8">
                                            <label>Please Enter OTP</label>
                                            <input type="text" class="form-control" id="otp" name="otp" placeholder="">
                                            <br />
                                            <button class="btn btn-primary" type="button" x-on:click="verify">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2"></div>

                    </div>
            </div>
        </div>
    </div>
</secction>
</div>

<style>
    #overlay {
        background-image: url('images/Circle-Loading.svg');
        background-color: rgba(255, 255, 255, 0.5);
        background-position: center center;
        background-repeat: no-repeat;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=#50FFFFFF, endColorstr=#50FFFFFF);
        width: 100%;
        height: 100%;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 9999;
    }
</style>
<div id="overlay"></div>

<script type="text/javascript">
    function validatePhone() {
        var phone = document.getElementById("phone").value;
        var phoneReg = /^\d{10}$/;
        if (phone.match(phonneReg)) {
            document.getElementById("phone").style.border = "2px solid green";
        } else {
            document.getElementById("phone").style.border = "2px solid red";
        }
    }

    let register = () => {
        return {
            isFirstNameEmpty: false,
            isLastNameEmpty: false,
            isEmailEmpty: false,
            isPhoneEmpty: false,
            isPasswordEmpty: false,
            isCPasswordEmpty: false,
            isTermsChecked: false,
            isOtpEmpty: false,
            isCourseEmpty: false,
            isSemEmpty: false,
            isRegNumEmpty: false,
            init() {
                $("#otpForm").hide();
            },
            hide() {


            },
            validate() {
                var otp = Math.random().toString(36).slice(2)

                const register = () => {
                    $.ajax({
                        url: 'dbHelper/addVerificationUserData.php',
                        type: 'post',
                        data: {
                            action: "register",
                            firstname: $("#firstname").val(),
                            lastname: $("#lastname").val(),
                            email: $("#email").val(),
                            phone: $("#phone").val(),
                            password: $("#password").val(),
                            course: $("#course").val(),
                            sem: $("#sem").val(),
                            regNum: $("#regNum").val(),
                            otp: localStorage.getItem("otp")
                        },
                        success: function(response) {
                            if (response == "Already Exists") {
                                swal({
                                    title: "Hi, " + $("#firstname").val() + " " + $("#lastname").val(),
                                    text: "You are already registered.Please check your email for verification",
                                    type: "info",
                                });
                            } else {
                                // $("#registerForm").hide();
                                // $("#otpForm").show();
                                $.ajax({
                                    url: 'api/Mail.php',
                                    type: 'post',
                                    data: {
                                        action: "otpVerification",
                                        email: $("#email").val(),
                                        OTP: otp,
                                    },
                                    success: function(response) {
                                        if (response == "Success") {

                                        } else {
                                            swal({
                                                title: "OPPS!!",
                                                text: "Something went wrong please try again",
                                                type: "warning",
                                            });
                                        }
                                    }
                                });
                                swal({
                                    title: "Hi, " + $("#firstname").val() + " " + $("#lastname").val(),
                                    text: "You are successfully registered.Please check your email for verification",
                                    type: "success",
                                }, function() {
                                    window.location.href = "index.php";
                                });
                            }
                        },
                        error: function(response) {

                        }
                    });
                }
                if ($.trim($("#firstname").val()).length > 0) {
                    if ($.trim($("#course").val()) !== "0") {
                        if ($.trim($("#sem").val()) !== "0") {
                            if ($.trim($("#regNum").val()).length > 0) {
                                if ($.trim($("#phone").val()).length == 10) {

                                    if ($.trim($("#email").val()).length > 0) {
                                        if ($.trim($("#password").val()).length > 0) {
                                            if ($.trim($("#vpassword").val()).length > 0) {

                                                if ($("#termsCheck").prop('checked') == true) {
                                                    if ($.trim($("#password").val()) === $.trim($("#vpassword").val())) {
                                                        localStorage.setItem("otp", otp);
                                                        register();

                                                    } else {
                                                        swal({
                                                            title: "OPPS!!",
                                                            text: "password did not match",
                                                            type: "info",

                                                        });
                                                    }


                                                } else {
                                                    document.getElementById("termsLable").style.border = "2px solid red";
                                                }

                                            } else {
                                                //
                                                $("#vpassword").focus();
                                                document.getElementById("vpassword").style.border = "2px solid red";

                                            }

                                        } else {

                                            $("#password").focus();
                                            document.getElementById("password").style.border = "2px solid red";
                                        }


                                    } else {
                                        $("#email").focus();
                                        document.getElementById("email").style.border = "2px solid red";
                                    }

                                } else {
                                    $("#phone").focus();
                                    document.getElementById("phone").style.border = "2px solid red";
                                }


                            } else {

                                $("#regNum").focus();
                                document.getElementById("regNum").style.border = "2px solid red";
                            }
                        } else {
                            $("#sem").focus();
                            document.getElementById("sem").style.border = "2px solid red";
                        }

                    } else {

                        $("#course").focus();
                        document.getElementById("course").style.border = "2px solid red";
                    }


                } else {
                    $("#firstname").focus();
                    document.getElementById("firstname").style.border = "2px solid red";
                }

            },
            verify() {
                var otp = localStorage.getItem("otp");
                if ($.trim($("#otp").val()) == otp) {
                    $.ajax({
                        url: 'dbHelper/addVerificationUserData.php',
                        type: 'post',
                        data: {
                            action: "emailVerification",
                            email: $("#email").val(),
                            OTP: $.trim($("#otp").val()),
                        },
                        success: function(response) {
                            if (response == "success") {
                                swal({
                                    title: "Success",
                                    text: "You have successfully registered",
                                    type: "success",
                                    confirmButtonText: "OK",
                                    closeOnConfirm: false,
                                }, function() {
                                    window.location.href = "index.php";
                                });
                            } else {
                                console.log(response);
                                swal({
                                    title: "OPPS!!",
                                    text: "Something went wrong please try again",
                                    type: "warning",
                                });
                            }
                        }
                    });
                } else {
                    swal({
                        title: "OPPS!!",
                        text: "OTP did not match",
                        type: "warning",
                    });
                }
            }

        }
    }

    window.onload = () => {
        $('#overlay').hide();
    }
    $(document).ready(function() {

        $("#firstname").keyup(function(e) {
            $("#firstnameLable").css("color", "#000000")
            $("#firstname").css("border-color", "#f4f4f4");

        });

        $("#course").change(function() {
            $("#courselable").css("color", "#000000")
            $("#course").css("border-color", "#f4f4f4");
        });
        $("#regNum").keyup(function(e) {
            $("#regNumlable").css("color", "#000000")
            $("#regNum").css("border-color", "#f4f4f4");

        });
        $("#phone").keyup(function(e) {
            $("#phoneLable").css("color", "#000000")
            $("#phone").css("border-color", "#f4f4f4");

        });
        $("#email").keyup(function(e) {
            $("#emailLable").css("color", "#000000")
            $("#email").css("border-color", "#f4f4f4");

        });
        $("#password").keyup(function(e) {
            $("#passwordLable").css("color", "#000000")
            $("#password").css("border-color", "#f4f4f4");

        });
        $("#vpassword").keyup(function(e) {
            $("#verifypasswordLable").css("color", "#000000")
            $("#vpassword").css("border-color", "#f4f4f4");

        });


    });
</script>

<?php include_once 'footer.php' ?>