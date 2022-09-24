<?php
include_once 'dbhelper.php';
$type = $_POST['type'];
if ($type == "contactus") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $data = array(
        "type" => $type,
        "name" => $name,
        "email" => $email,
        "subject" => $subject,
        "message" => $message
    );
    $dbh = new dbhelper();
    $result = $dbh->__contactus($data);
    if ($result == 1) {
        echo "success";
    } else {
        echo "fail";
    }
}
if ($type == "getQueries") {
    $dbh = new dbhelper();
    $result = $dbh->__getQueries();
    echo json_encode($result);
}
if ($type == "reply") {
    $id = $_POST['id'];
    $reply = $_POST['response'];
    $dbh = new dbhelper();
    $result = $dbh->__replyQuery($id, $reply, date('Y-m-d H:i:s'));
    if ($result == 1) {
        echo "success";
    } else {
        echo "fail";
    }
}
if ($type == "deleteQuery") {
    $id = $_POST['id'];
    $dbh = new dbhelper();
    $result = $dbh->__deleteQuery($id);
    if ($result == 1) {
        echo "success";
    } else {
        echo "fail";
    }
}