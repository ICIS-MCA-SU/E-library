<?php include_once 'header.php' ?>

<!-- Start: Page Banner -->
<script src="js/emailScript.js"></script>
<script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<section class="page-banner services-banner">
    <div class="container">
        <div class="banner-header">
            <h2>SignUp</h2>
            <span class="underline center"></span>
            <p class="lead">Signup to SuLibrary.</p>
        </div>
        <div class="breadcrumb">
            <ul>
                <li>Student SignUp</li>
                <li><a href="professorRegister.php">  / Faculty SignUp</a></li>
                
            </ul>
        </div>
    </div>
</section>
<!-- End: Page Banner -->
<!-- Start: Cart Section -->

<div class="signup__container" style="background-color: #eeeeee; ">


    <section >
        <div class="container">
        <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px;">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-8 col-xl-8 order-2 order-lg-1">

                                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Student Sign up</p>

                                    <form id="registerFrom" name="registerFrom" method="post" action="" class="mx-1 mx-md-4" enctype="multipart/form-data">
                                        <div class="card" style="border: none">
                                            <div class="card-body">
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="firstname" id="firstnameLable">First Name</label>
                                                        <input type="text" class="form-control" id="firstname" name="firstname"  placeholder="Fist name" >
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="lastname" id="lastnameLable">Last Name</label>
                                                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" >
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="course" id="courselable">Course</label>
                                                        <select onchange="valChanged()" id="course" name="course" class="form-control" >
                                                            <option selected>--Select Course--</option>
                                                            <option value="mca">MCA</option>
                                                            <option value="mba">MBA</option>
                                                            <option value="bca">BCA</option>
                                                            <option value="bba">BBA</option>
                                                            <option value="bcom">BCom</option>
                                                            <option value="bhm"> BHM</option>
                                                            <option value="bed">BEd</option>
                                                            <option value="bpt">BPT</option>
                                                            <option value="msw">MSW</option>
                                                            <option value="mpt"> MPT</option>
															<option value="bdes">B.Des</option>
                                                            <option value="bsw"> B.S.W</option>
															<option value="btech">B.Tech</option>
                                                            <option value="bsw"> M.Tech</option>
                                                            <option value="bsc">B.Sc Animation</option>
                                                            <option value="bjmc">B.Journalism & Mass Communication</option>
                                                             <option value="ma">MA in English</option>
                                                             <option value="mcom"> M.Com</option>
															 <option value="Phd">Research Scholar</option>
															   <option value="nur">BSC Nursing and general Nursing</option>
                                                             <option value="bscid"> BSC ID</option>
														
															 

                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="regNum" id="regNumlable">Register number</label>
                                                        <input type="text" class="form-control" id="regNum" name="regNum" >
                                                    </div>
                                                </div>

                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="course" id="semlable">Sem</label>
                                                        <select  id="sem" name="sem" class="form-control" >
                                                            <option selected value="0">--Select Course--</option>
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

                                                <div class="form-group">
                                                    <label for="phone" id="phoneLable">Phone</label>
                                                    <input type="number" class="form-control" id="phone" name="phone" placeholder="" >
                                                </div>

                                                <div class="form-row">
                                                    <div class="form-group col-md-8">

                                                        <label for="email" id="emailLable">Email</label>
                                                        <input type="email" class="form-control" id="email" name="email"  >

                                                    </div>
<!--                                                    <div class="form-group col-md-4">-->
<!--                                                        <label for="sendOtp"></label>-->
<!--                                                        <input type="button" class="form-control btn btn-info" style="border-radius: 25px;  border: 2px solid" value="send otp" id="sendOtp" name="sendOpt">-->
<!--                                                    </div>-->
                                                </div>
<!--                                                <div class="form-row">-->
<!--                                                    <div class="form-group col-md-8">-->
<!---->
<!--                                                        <label for="otp" id="verfyotpLable">enter Otp</label>-->
<!--                                                        <input type="text" class="form-control" id="otp"  name="otp" placeholder="">-->
<!---->
<!--                                                    </div>-->
<!--                                                    <div class="form-group col-md-4">-->
<!--                                                        <label for="verify"></label>-->
<!--                                                        <input type="button" class="form-control btn  btn-info " style="border-radius: 25px;  border: 2px solid"  value="Verify" id="verify">-->
<!--                                                    </div>-->
<!--                                                </div>-->
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">

                                                        <label for="password" id="passwordLable">enter Password</label>
                                                        <input type="password" class="form-control" id="password"  name="password" placeholder=""pattern=".{8,}" title="8 or more characters" required>

                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="vpassword" id="verifypasswordLable">Confirm password</label>
                                                        <input type="password" class="form-control "  id="vpassword"  name="vpassword" pattern=".{8,}" title="8 or more characters" required/>
                                                    </div>
                                                </div>
                                                <br>

                                                <div class="form-group mb-0">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="termsCheck" name="termsCheck">
                                                        <label class="form-check-label" for="gridCheck" id="termsLable">
                                                           &nbsp;&nbsp;&nbsp; I Agree to the Srinivas University Library Terms And Conditions
                                                        </label>
                                                        <label class="form-check-label" for="gridCheck" id="termsLable">
                                                         <!-- <a style="color: #0d6aad" href="professorRegister.php"> &nbsp;&nbsp;or Register as professor</a> -->
                                                        </label>
                                                    </div>
                                                </div>
                                                <br>
                                            </div>

                                                <button class="btn btn-primary">Submit</button>

                                        </div>

                                    </form>

                                </div>
                                <div class="col-md-10 col-lg-4 col-xl-4 d-flex align-items-center order-1 order-lg-2">

                                    <img src="images/registerPage.png" class="img-fluid" alt="Sample image">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<style>
    #overlay{background-image: url('images/Circle-Loading.svg');background-color: rgba(255,255,255,0.5);background-position: center center;background-repeat: no-repeat; filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#50FFFFFF,endColorstr=#50FFFFFF);width: 100%; height: 100%; position: fixed; top: 0; left: 0; z-index: 9999;}
</style>
<div id="overlay"  ></div>


<script type="text/javascript">
    window.onload = () => {
        $('#overlay').hide();
    }
    $(document).ready(function () {
        $("#registerFrom").submit(function (event) {
            event.preventDefault();
            if ($.trim($("#firstname").val()).length > 0) {
                if ($.trim($("#course").val()) !== "0") {
                    if ($.trim($("#sem").val()) !== "0") {
                        if ($.trim($("#regNum").val()).length > 0) {
                            if ($.trim($("#phone").val()).length > 0) {

                                if ($.trim($("#email").val()).length > 0) {
                                    if ($.trim($("#password").val()).length > 0) {
                                        if ($.trim($("#vpassword").val()).length > 0) {

                                            if ($("#termsCheck").prop('checked') == true) {
                                                if ($.trim($("#password").val()) === $.trim($("#vpassword").val())) {
                                                    $('#overlay').show();
                                                    setTimeout(function () {
                                                        $.ajax({
                                                            url: 'dbHelper/processRegister.php',
                                                            type: 'post',
                                                            data: $("#registerFrom").serialize(),
                                                            success: function (response) {
                                                                var result = $.trim(response);
                                                                $('#overlay').hide();
                                                                if (result === "success") {
                                                                    swal({
                                                                        title: "Registered",
                                                                        text: "You have Registered Successfully",
                                                                        type: "success",

                                                                    }, function () {
                                                                        window.location.href = "signin.php";
                                                                    });
                                                                } else {
                                                                    swal({
                                                                        title: "OPPS!!",
                                                                        text: "InValid Details Found!! Registration failed",
                                                                        type: "warning",

                                                                    });
                                                                }
                                                            }
                                                        });
                                                    }, 3000);
                                                } else {
                                                    swal({
                                                        title: "OPPS!!",
                                                        text: "password did not match",
                                                        type: "info",

                                                    });
                                                }


                                            } else {
                                                $("#termsLable").css("color", "#fa0606")
                                            }

                                        } else {
                                            //
                                            $("#verifypasswordLable").css("color", "#fa0606")
                                            $("#vpassword").css("border", "3px solid #fa0606");
                                            $("#vpassword").focus();

                                        }

                                    } else {
                                        $("#passwordLable").css("color", "#fa0606")
                                        $("#password").css("border", "3px solid #fa0606");
                                        $("#password").focus();

                                    }


                                } else {
                                    $("#emailLable").css("color", "#fa0606")
                                    $("#email").css("border", "3px solid #fa0606");
                                    $("#email").focus();

                                }

                            } else {
                                $("#phoneLable").css("color", "#fa0606")
                                $("#phone").css("border", "3px solid #fa0606");
                                $("#phone").focus();

                            }


                        } else {
                            $("#regNumlable").css("color", "#fa0606")
                            $("#regNum").css("border", "3px solid #fa0606");
                            $("#regNum").focus();

                        }
                    }else {
                        $("#semlable").css("color","#fa0606")
                        $("#sem").css("border", "3px solid #fa0606");
                        $("#sem").focus();

                    }

                } else {
                    $("#courselable").css("color","#fa0606")
                    $("#course").css("border", "3px solid #fa0606");
                    $("#course").focus();

                }


            } else {
                $("#firstnameLable").css("color","#fa0606")
                $("#firstname").css("border-color", "#fa0606");
                $("#firstname").focus();

            }




        });

        $("#firstname").keyup(function (e) {
            $("#firstnameLable").css("color","#000000")
            $("#firstname").css("border-color", "#f4f4f4");

        });

        $("#course").change(function() {
            alert("hell");
            $("#courselable").css("color","#000000")
            $("#course").css("border-color", "#f4f4f4");
        });
        $("#regNum").keyup(function (e) {
            $("#regNumlable").css("color","#000000")
            $("#regNum").css("border-color", "#f4f4f4");

        });
        $("#phone").keyup(function (e) {
            $("#phoneLable").css("color","#000000")
            $("#phone").css("border-color", "#f4f4f4");

        });
        $("#email").keyup(function (e) {
            $("#emailLable").css("color","#000000")
            $("#email").css("border-color", "#f4f4f4");

        });
        $("#password").keyup(function (e) {
            $("#passwordLable").css("color","#000000")
            $("#password").css("border-color", "#f4f4f4");

        });
        $("#vpassword").keyup(function (e) {
            $("#verifypasswordLable").css("color","#000000")
            $("#vpassword").css("border-color", "#f4f4f4");

        });


    });




</script>


<!--<script type="text/javascript">-->
<!---->
<!--    $(document).ready(function ($) {-->
<!--        var $form = $('#registerFrom');-->
<!---->
<!--        $form.submit(function () {-->
<!--            alert("hello");-->
<!--            $.ajax({-->
<!--                type: 'POST',-->
<!--                url: "xyz.php",-->
<!--                data: $form.serialize(),-->
<!--                // success: function (response) {-->
<!--                //     alert(response);-->
<!--                // }-->
<!--            });-->
<!---->
<!---->
<!--        });-->
<!--    });-->
<!--</script>-->





<!-- End: Cart Section -->
<?php include_once 'footer.php' ?>
