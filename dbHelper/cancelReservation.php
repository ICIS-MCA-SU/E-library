<?php
include_once 'dbhelper.php';
if(isset($_POST['reservationId'])){
    $reservationId=$_POST['reservationId'];
    $dbh = new dbhelper();
    $result= $dbh->__cancelReservation($reservationId);
    echo $result;
}