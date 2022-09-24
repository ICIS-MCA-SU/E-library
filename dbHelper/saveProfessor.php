<?php
include_once 'dbhelper.php';

if(isset($_POST['uid'])){
    $userid =$_POST['uid'];
    (new dbhelper)->__deleteFromPending($userid);
    (new dbhelper)->__updateUserStatus($userid);
    echo 1;
} else echo "fail";