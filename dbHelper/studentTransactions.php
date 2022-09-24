<?php
include_once 'dbhelper.php';
$type = $_POST["type"];

if ($type == "Delete") {
    $result = (new dbhelper)->__deleteUserDetail($_POST['uid']);
    echo $result;
}

if ($type == "Deactivate") {
    $result = (new dbhelper)->__deActivateUser($_POST['uid']);
    echo $result;
}
if ($type == "Activate") {
    $result = (new dbhelper)->__activateUser($_POST['uid']);
    echo $result;
}
if ($type == "DeleteApproval") {
    $result = (new dbhelper)->__deletePendingapproval($_POST['id'],$_POST['uid']);
    echo $result;
}
