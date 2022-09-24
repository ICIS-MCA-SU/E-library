<?php
// PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// Base files 
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
// create object of PHPMailer class with boolean parameter which sets/unsets exception.
$mail = new PHPMailer(true);
try {
    $mail->isSMTP(); // using SMTP protocol                                     
    $mail->Host = 'smtp.gmail.com'; // SMTP host as gmail 
    $mail->SMTPAuth = true;  // enable smtp authentication                             
    $mail->Username = 'librarian@srinivasuniversity.edu.in';  // sender gmail host              
    $mail->Password = 'mzwulxhegdfebxuv'; // sender gmail host password                          
    $mail->SMTPSecure = 'tls';  // for encrypted connection                           
    $mail->Port = 587;   // port for SMTP     
    $mail->isHTML(true);
    $mail->setFrom('librarian@srinivasuniversity.edu.in', "Srinivas University");
    switch ($_POST["action"]) {
        case "otpVerification":
            $email = $_POST['email'];
            $otp = $_POST['OTP'];
            $mail->addAddress($email, "Receiver");
            $mail->Subject = 'Digital Library Registration';
            $mail->Body = "
                                        <h4>Dear Sir/Madam,</h4>
            <h3>You have successfully registered on Srinivas University Digital Library.
            Kindly verify your email id in order to login your account</h3>
            <h3>Please verify by using this link <a href='http://103.105.224.229/sulibrary/verify.php?email=$email&token=$otp'>Verify</a></h3>";
            $mail->send();
            echo 'Success';
            break;
        case "verificationConfirmation":
            $email = $_POST['email'];
            $mail->addAddress($email, "Receiver");
            $mail->Subject = 'Digital Library Registration';
            $mail->Body = "<h3>Your account has been verified successfully.</h3>";
            $mail->send();
            echo 'Success';
            break;
        case "forgot_password":
            $email = $_POST['email'];
            $otp = $_POST['otp'];
            $mail->addAddress($email, "Receiver");
            $mail->Subject = 'Digital Library Password Reset';
            $mail->Body = "<h3>Your One Time password is $otp</h3>";
            $mail->send();
            echo 'success';
            break;
        case "forgot_password_confirmation":
            $email = $_POST['email'];
            $mail->addAddress($email, "Receiver");
            $mail->Subject = 'Digital Library Password Reset';
            $mail->Body = "<h3>Your password has been reset successfully.</h3>";
            $mail->send();
            echo 'success';
            break;
        case "queryReply":
            $email = $_POST['email'];
            $response = $_POST['response'];
            $mail->addAddress($email, "Receiver");
            $mail->Subject = 'Digital Library Query Reply';
            $mail->Body = "<h3>".$response.+"</h3>";
            $mail->send();
            echo 'success';
            break;
    }
} catch (Exception $e) { // handle error.
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
