<?php
include_once 'dbhelper.php';


if(isset($_POST['firstname'])){
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




    $dbh = new dbhelper();
   $result= $dbh->__createUser($fname,$lname,$course,$rollno,$email,$phone,$passwd,$role,$expdate);
   if($result === 1){
       echo "success";
   }else echo "fail";

}




