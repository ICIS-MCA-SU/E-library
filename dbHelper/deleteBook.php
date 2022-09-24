<?php
include_once 'dbhelper.php';
if(isset($_POST['bookId'])){
    $bookId=$_POST['bookId'];
    $dbh = new dbhelper();
    $result= $dbh->__deleteBook($bookId);
    echo $result;
}