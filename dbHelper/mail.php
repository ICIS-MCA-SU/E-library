<?php
$email ="aprabhu848@gmail.com";
$subject = $_POST['subject'];
$message = $_POST['message'];
$to = $email;
$body = $message;
$header = "From:ajprabhu450@gmail.com\r\n";
$header .= "MIME-Version: 1.0\r\n";
$header .= "Content-type: text/html\r\n";

$retval = mail($to, $subject, $body, $header);

if ($retval == true) {
   echo "Success";
} else {
   echo "Message could not be sent...";
}
