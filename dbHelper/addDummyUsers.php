<?php
include_once 'dbhelper.php';


$fname = $_POST['first_name'];
$lname = $_POST['last_name'];
$course = $_POST['course'];
$rollno = $_POST['regNum'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$passwd = $_POST['password'];
$role = "student";
$status = 1;

$expdate = "";


$dbh = new dbhelper();
$result = $dbh->__createDummyUser($fname, $lname, $course, $rollno, $email, $phone, $passwd, $role,$status);
if ($result === 1) {
    echo "success";
} else echo "fail";
