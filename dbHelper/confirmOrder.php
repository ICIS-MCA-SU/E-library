<?php
include_once 'dbhelper.php';

if(isset($_POST['id'])){
    $rows= (new dbhelper)->__getPendingOrderInfo($_POST['id']);
    echo $rows;


}

if(isset($_POST['orderid'])){
    $time = date("H:i:s");
    $rows= (new dbhelper)->__saveOrderConfirmation($_POST['orderid'],$_POST['comment'],$time);
    echo $rows;


}

if(isset($_POST['rejectId'])){
    $rows= (new dbhelper)->__rejectOrder($_POST['rejectId'],$_POST['remarks']);
    $accession = (new dbhelper)->__getAccessioFromOrder($_POST['rejectId']);
    $cardnumber = (new dbhelper)->__getCardNumberFromOrder($_POST['rejectId']);
    (new dbhelper)->__setAccessionStatusToZero($accession);
    (new dbhelper)->__setCardStatustoZero($cardnumber);
    echo $rows;


}


if(isset($_POST['aid'])){
    $rows= (new dbhelper)->__assignOrder($_POST['aid']);
    echo $rows;
}

if(isset($_POST['rid'])){
    $rows= (new dbhelper)->__cancelOrder($_POST['rid']);
    $accession = (new dbhelper)->__getAccessioFromOrder($_POST['rid']);
    $cardnumber = (new dbhelper)->__getCardNumberFromOrder($_POST['rid']);
    (new dbhelper)->__setAccessionStatusToZero($accession);
    (new dbhelper)->__setCardStatustoZero($cardnumber);
    echo 1;
}