<?php

session_start();
error_reporting(E_ALL & ~ E_NOTICE);

class Controller
{
    function __construct() {
        $this->processEmailVerification();
    }
    function processEmailVerification()
    {
        switch ($_POST["action"]) {

            case "register_message":
                $email = $_POST['email'];
                $password=$_POST['password'];
                $message = "<h3>Congratulation's!! You have successfully registered in SuLibrary <br></h3>";
                $message .= "<h1 style='color: #00adef'> Your username is: $email <hr> Your password is: $password </h1>";
                $sub = "Registration message";
                $headers ="From: srinivaslibrary.pandeshwara@gmail.com\r\n";
                $headers .=    "X-Mailer: PHP/" . PHP_VERSION."\r\n";
                $headers .= "MIME-Version: 1.0 \r\n";
                $headers .= "Content-type: text/html \r\n";
               // $headers = implode("\r\n", $headers);
                try{
                    $retval = mail($email,$sub,$message,$headers);

                }

                catch(Exception $e)
                {
                    die('Error: '.$e->getMessage());
                }

                break;

//            case "verify_otp":
//                $otp = $_POST['otp'];
////                echo '<script>alert('.$otp.')</script>';
//                if ($otp == $_SESSION['session_otp'])
//                {
////                    echo '<script>alert('.$_SESSION['session_otp'].')</script>';
//                    unset($_SESSION['session_otp']);
//                    echo json_encode(array("type"=>"success", "message"=>"Your Email is verified!"));
//                }
//                else {
//                    echo json_encode(array("type"=>"error", "message"=>"Mobile Email verification failed"));
//                }
//                break;
        }
    }
}
$controller = new Controller();
