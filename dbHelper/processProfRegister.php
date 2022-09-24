<?php
include_once 'dbhelper.php';

if(isset($_POST['firstname'])){
    $fname=$_POST['firstname'];
    $lname=$_POST['lastname'];
    $course=$_POST['course'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $passwd=$_POST['password'];
    $role="professor";

    $dbh = new dbhelper();
    $result= $dbh->__createProfessor($fname,$lname,$course,$email,$phone,$passwd,$role);
    if($result === 1){
        echo "success";
    }else echo "fail";

}




