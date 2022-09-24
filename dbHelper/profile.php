<?php
include_once 'dbhelper.php';
$type = $_POST['action'];
if ($type == "checkEmailExist") {
    $email = $_GET['email'];
    $dbh = new dbhelper();
    $result = $dbh->__checkEmailExist($email);
    echo $result;
} else {
    $user_id = $_POST['user_id'];
    $email = $_POST['email'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];
    $regno = $_POST['regno'];
    $image = $_POST['image'];

    $dbh = new dbhelper();
    $result = $dbh->__userDataUpdate($user_id, $email, $fname, $lname, $phone, $regno, $image);
    echo $result;
}
