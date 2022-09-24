<?php
include_once 'dbhelper.php';

$type = $_POST['type'];
if ($type == "forgot_password") {
    $email = $_POST['email'];
    if ($email != "") {
        $dbh = new dbhelper();
        $isExist = $dbh->__checkEmailExist($email);
        if ($isExist == 1) {
            echo "success";
        } else {
            echo "fail";
        }
    }
} else if ($type == "reset_password") {
    $newPassword = $_POST['newPassword'];
    $email = $_POST['email'];
    $dbh = new dbhelper();
    $result = $dbh->__resetPassword($email, $newPassword);
    if ($result == 1) {
        echo "success";
    } else {
        echo "fail";
    }
}
