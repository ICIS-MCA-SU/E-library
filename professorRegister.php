<?php include_once 'header.php' ?>
<script src="js/emailScript.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<style>
        .active6 a{
        color: #e96b56  !important;
    }
    *{
        padding: 0;
        margin:0;
        box-sizing:border-box;
    }
    body{
        background:rgb(219,226,226);
    }
    .warningLable{
        display:none;
    }
    .signup-page{
        justify-content:center;
        align-items:center;
        background:white;
        border-radius:30px;
        box-shadow:12px 12px 22px grey;
    }
    .signup-head{
        padding:40px 0 5px 0;
        font-weight:bold;
    }
    .signup-head2{
        padding:0 0 5px 0;
        font-weight:bold;
    }
    .signup-btn{
        border:none;
        outline:none;
        height:50px;
        width:100%;
        background: #ff5821  !important;;
    color: #fff;
    transition: 0.4s;
        border-radius:4px;
        margin-bottom:10px;
    }
    .signup-btn:hover{
        background: #ff7e54  !important;;
        color:white;
        border:1px solid;
    }
    p a:hover{
        color:blue;
        text-decoration:underline;
    }
    @media (max-width: 768px) {
        .signup-head{
            font-size:19px;
    }
    .signup-head2{
        font-size:16px;
    }
    }
        /*--------------------------------------------------------------
# Breadcrumbs
--------------------------------------------------------------*/
.breadcrumbss {
  padding: 15px 0;
  text-align:center;
  justify-content:center;
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


.breadcrumbss ol li + li::before {
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
          <li><a href="signup.php">Student Sign up</a></li>
          <li>Faculty Sign up</li>
      </div>
    </section><!-- End Breadcrumbs -->
<secction class="form my-2 mx-5" >
    <div class="container pb-5">
        <div class="row no-gutters">
            <div class="offset-lg-1 col-lg-10 col-md-12 px-5 signup-page">
                <h4 class="signup-head text-center">Looks like you're new here!</h4>
                <h5 class="signup-head2 text-center">Faculty Sign up</h4>
                <form id="registerFrom" name="registerFrom" method="post" style="justify-content:center;align-items:center;margin:auto;" action="" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="col-lg-12 col-md-12">
                        <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <input type="text" name="firstname" class="form-control my-3" placeholder="First-Name" id="firstname" required>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <input type="text" name="lastname" class="form-control my-3" placeholder="Last-Name" id="lastname" >
                        </div>
                    </div>
                        </div>
                    </div> 
                    <div class="form-row">
                        <div class="col-lg-12 col-md-12">
                        <select onchange="valChanged()" id="course" name="course" class="form-control my-3">
                                <option selected value="0" disabled="disabled"> Select Department/College </option>
                                                            <option value="engg">College of Engineering & Technology</option>
                                                            <option value="com">College of Management & Commerce</option>
                                                            <option value="hlth">College of Allied Health Science & Information Science</option>
                                                            <option value="ccis"> College of Computer Science & Information Science</option>
                                                            <option value="avia"> College of Aviation Studieds</option>
                                                            <option value="soci"> College of Social Science & Humanities</option>
                                                            <option value="hotl"> College of Hotel Management & Tourism</option>
                                                            <option value="phys">College of Physiotherapy</option>
                                                             <option value="edu"> College of Education</option>
                                                             <option value="nurs"> College of Nursing Science</option>
															 <option value="yoga"> College of Yoga Sanskrit & Research Centre</option>
						</select>
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
                        <input type="password" name="password" class="form-control my-3" placeholder="Password" id="password"  pattern=".{8,}" title="8 or more characters" required>
                        </div>
                        <div class="col-lg-6 col-md-6">
                        <input type="password" name="vpassword" class="form-control my-3" placeholder="Confirm Password" id="vpassword"  pattern=".{8,}" title="8 or more characters" required>
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
                        <button class="signup-btn mt-3" x-on:click="validate">Submit</button>
                        </div>
                    </div>
                    <p class="mx-3 p-4 text-center">Already Have an Account ? <a href="login.php">Login Here</a></p>
                </form>
            </div>
        </div>
    </div>
</secction>

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

<script>
function validatePhone() {
        var phone = document.getElementById("phone").value;
        var phoneReg = /^\d{10}$/;
        if (phone.match(phonneReg)) {
            document.getElementById("phone").style.border = "2px solid green";
        } else {
            document.getElementById("phone").style.border = "2px solid red";
        }
    }

    
</script>
<script type="text/javascript">
    window.onload = () => {
        $('#overlay').hide();
    }
    $(document).ready(function () {
        $("#registerFrom").submit(function (event) {
            event.preventDefault();
            if ($.trim($("#firstname").val()).length > 0) {
                if ($.trim($("#course").val()) !== "0") {


                            if ($.trim($("#phone").val()).length > 0) {

                                if ($.trim($("#email").val()).length > 0) {
                                    if ($.trim($("#password").val()).length > 0) {
                                        if ($.trim($("#vpassword").val()).length > 0) {

                                            if ($("#termsCheck").prop('checked') == true) {
                                                if ($.trim($("#password").val()) === $.trim($("#vpassword").val())) {
                                                    $('#overlay').show();
                                                    setTimeout(function () {
                                                        $.ajax({
                                                            url: 'dbHelper/processProfRegister.php',
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
                                                                        window.location.href = "login.php";
                                                                    });
                                                                } else {
                                                                    alert(result);
                                                                    // swal({
                                                                    //     title: "OPPS!!",
                                                                    //     text: "InValid Details Found!! Registration failed",
                                                                    //     type: "warning",
                                                                    //
                                                                    // });
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
                    $("#course").focus();
                        document.getElementById("course").style.border = "2px solid red";
                }


            } else {
                $("#firstname").focus();
                    document.getElementById("firstname").style.border = "2px solid red";
            }




        });

        $("#firstname").keyup(function (e) {
            $("#firstnameLable").css("color","#000000")
            $("#firstname").css("border-color", "#f4f4f4");

        });

        $("#course").change(function() {
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

<?php include_once 'footer.php' ?>