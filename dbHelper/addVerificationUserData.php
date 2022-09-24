<?php
include_once 'dbhelper.php';
$action = $_POST['action'];
if ($action == 'register') {
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $course = $_POST['course'];
    $sem = $_POST['sem'];
    $regNum = $_POST['regNum'];
    $otp = $_POST['otp'];

    switch ($sem) {
        case 1:
            $date = date('Y-m-d');
            $expdate = date('Y-m-d', strtotime($date . ' + 730 days'));
            break;
        case 2:
            $date = date('Y-m-d');
            $expdate = date('Y-m-d', strtotime($date . ' + 600 days'));
            break;
        case 3:
            $date = date('Y-m-d');
            $expdate = date('Y-m-d', strtotime($date . ' + 500 days'));
            break;
        case 4:
            $date = date('Y-m-d');
            $expdate = date('Y-m-d', strtotime($date . ' + 400 days'));
            break;
        case 5:
            $date = date('Y-m-d');
            $expdate = date('Y-m-d', strtotime($date . ' + 300 days'));
            break;
        case 6:
            $date = date('Y-m-d');
            $expdate = date('Y-m-d', strtotime($date . ' + 200 days'));
            break;
    }


    $registrationDateTime = new DateTime();
    $alreadyExists = (new dbhelper)->_checkVerificationdataExist($email, $regNum);
    if ($alreadyExists == 0) {
        $userid = (new dbhelper)->__createVerificationUserData($firstName, $lastName, $email, $password, $phone, $course, $sem, $regNum, $otp, $registrationDateTime->format('Y-m-d H:i:s'),  $expdate);
        echo $userid;
    } else {
        echo "Already Exists";
    }
}
if ($action == 'alreadyVerified') {
    $email = $_POST['email'];
    $isVerified = (new dbhelper)->__getVUserID($email);
    echo $isVerified;
}
if ($action == 'emailVerification') {
    $email = $_POST['email'];
    $otp = $_POST['OTP'];
    $result = (new dbhelper)->__verifyUser($email, $otp);
    if ($result === 1) {
        $delete=(new dbhelper)->__deleteVerificationUserData($email);
        echo "success";
    } else echo "fail";
}
