<?php
include_once 'dbhelper.php';

$type = $_POST['type'];
if ($type == "AddUserLog") {
    $data = $_POST['data'];
    $dbh = new dbhelper();   
    $userLog = $dbh->__createUserLogArray($data);
    if ($userLog === 1) {
        echo "success";
    } else echo "fail";
}
