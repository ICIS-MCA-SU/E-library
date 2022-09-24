<?php
include_once 'dbhelper.php';


if(isset($_POST['useeId'])){
    $fname=$_POST['firstname'];
    $lname=$_POST['lastname'];
    $course=$_POST['course'];
    $sem=$_POST['sem'];
    $rollno=$_POST['regNum'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $passwd=$_POST['password'];
    $role="student";
    $expdate="";


    $dbh = new dbhelper();
   $result= $dbh->__createUser($fname,$lname,$course,$rollno,$email,$phone,$passwd,$role,$expdate);
   if($result === 1){
       echo "success";
   }else echo "fail";

}




