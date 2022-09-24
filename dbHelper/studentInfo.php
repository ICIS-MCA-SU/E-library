<?php
include_once 'dbhelper.php';

if(isset($_POST['id'])){
    $rows= (new dbhelper)->__getPendingAprovalUserInfo($_POST['id']);
    echo $rows;
}

if(isset($_POST['eid'])){
    $rows= (new dbhelper)->__getStudentInfo($_POST['eid']);
    echo $rows;
}

if(isset($_POST['uid'])){
    $rows= (new dbhelper)->__deleteCardDetail($_POST['uid'],$_POST['cardnumber']);
    echo $rows;
}

if(isset($_GET['uid'])){
    $rows= (new dbhelper)->__getStudentDetailsById($_GET['uid']);
    print json_encode($rows);
}
