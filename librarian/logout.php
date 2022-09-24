<?php
include_once '../dbHelper/dbhelper.php';

session_start();
$dbh1 = new dbhelper();

$outTime = new DateTime();
$userLog = $dbh1->__updateUserLog($_SESSION["userlogId"], $outTime->format('Y-m-d H:i:s'));
session_destroy();

header('location:index.php');