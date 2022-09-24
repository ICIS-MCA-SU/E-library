<?php
include_once 'dbhelper.php';

$startLimit = $_GET['startLimit'];
$endLimit = $_GET['endLimit'];

$type = $_GET['type'];
if ($type == "All") {
    $dbh = new dbhelper();
    $result = $dbh->__loginReportsDeatails();
    print json_encode($result);
} else {
    $dbh = new dbhelper();
    $result = $dbh->__loginReportsDeatailsByLimit($startLimit, $endLimit);
    print json_encode($result);
}
