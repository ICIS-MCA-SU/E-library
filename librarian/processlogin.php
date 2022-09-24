<?php
include_once '../dbHelper/dbhelper.php';
session_start();
if (isset($_POST['email'])) {
    $username = $_POST['email'];
    $password = $_POST['password'];

    $dbh = new dbhelper();
    $result = $dbh->__fetchUser($username, $password);
    $total_row = $result->rowCount();
    if ($total_row > 0) {
        $rows = $result->fetchAll();
        foreach ($rows as $row) {
            $_SESSION["admin_id"] = $row['user_id'];
            header("Location:index.php");
        }
        $dbh1 = new dbhelper();

        $enterTime = new DateTime();
        $userLog = $dbh1->__createUserLog($_SESSION["admin_id"], $enterTime->format('Y-m-d H:i:s'));
    } else {
        echo '<script>alert("invalid Credentials")</script>';
        header("Location:login.php");
    }
}
