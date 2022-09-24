<?php
include_once 'dbhelper.php';
if(isset($_POST['bookId'])){
    $bookId=$_POST['bookId'];
    $userId=$_POST['userId'];

    $dbh = new dbhelper();
    $result= $dbh->__removeEbook($bookId,$userId);
    echo $result;
}