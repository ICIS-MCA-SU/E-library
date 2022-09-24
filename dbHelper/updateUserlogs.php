<?php
include_once 'dbhelper.php';
$type = $_GET['type'];
if ($type == "allUsers") {
    $dbh = new dbhelper();
    $result = $dbh->__getAllUser();
    print json_encode($result);
} else if ($type == "export") {
    $dbh = new dbhelper();
    $result = $dbh->__loginReportsDeatails();
    print json_encode($result);
} else if ($type == "search") {
    $startDate = $_GET['searchStartDate'];
    $endDate = $_GET['searchEndDate'];
    $dbh = new dbhelper();

    $result = $dbh->__loginReportsDeatailSearchbyLimit($startDate, $endDate);
    print json_encode($result);
}
if ($type == "exportWithSearch") {
    $startDate = $_GET['searchStartDate'];
    $endDate = $_GET['searchEndDate'];
    $dbh = new dbhelper();

    $result = $dbh->__loginReportsDeatailSearchbyLimit($startDate, $endDate);
    print json_encode($result);
}
if ($type == "AddUserLog") {
    $userId = $_GET['userId'];
    $startDate = $_GET['startDate'];
    $endDate = $_GET['endDate'];
    $dbh1 = new dbhelper();

    $enterTime = new DateTime($startDate);
    $outTime = new DateTime($endDate);
    $userLog = $dbh1->__createUserLogWithEndDatetime($userId, $enterTime->format('Y-m-d H:i:s'), $outTime->format('Y-m-d H:i:s'));
    if ($userLog === 1) {
        echo "success";
    } else echo "fail";
}
