<?php
include_once 'dbhelper.php';
if (session_status() !== PHP_SESSION_ACTIVE || session_id() === "") {
    session_start();
}
if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $dbh = new dbhelper();
    $result = $dbh->__fetchUser($username, $password);
    $total_row = $result->rowCount();
    if ($total_row > 0) {
        $rows = $result->fetchAll();
        foreach ($rows as $row) {
            if ($row['Isdeleted'] == 0) {
                if ($row['role'] === "professor") {
                    $_SESSION['p_id'] = $row['user_id'];
                    $_SESSION["user_id"] = $row['user_id'];
                    $dbh1 = new dbhelper();

                    $enterTime = new DateTime();
                    $userLog = $dbh1->__createUserLog($_SESSION["user_id"], $enterTime->format('Y-m-d H:i:s'));
                    echo 1;
                } else {
                    $_SESSION["user_id"] = $row['user_id'];
                    $dbh1 = new dbhelper();

                    $enterTime = new DateTime();
                    $userLog = $dbh1->__createUserLog($_SESSION["user_id"], $enterTime->format('Y-m-d H:i:s'));
                    echo 1;
                }
            } else {
                echo "Deactivated";
            }
        }
    } else {
        echo "Please Check Your Username or password";
    }
}
