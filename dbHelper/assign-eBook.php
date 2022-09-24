<?php
include_once 'dbhelper.php';
if(isset($_POST['bookId'])){
    $bookId=$_POST['bookId'];
    $userId=$_POST['userId'];
    $dbh = new dbhelper();
    $isPending = (new dbhelper)->__isUserAprovalPending();
    if($isPending==1){
        echo 3;
    }else{
    $check = $dbh->__checkEBookExists($userId,$bookId);
    if($check >=1){
        echo 2;
    }else {
        $result = $dbh->__assignEbook($bookId, $userId);
        echo 1;
    }
    }
}