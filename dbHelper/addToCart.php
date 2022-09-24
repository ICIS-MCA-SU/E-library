<?php
if (session_status() !== PHP_SESSION_ACTIVE || session_id() === ""){
    session_start();
}
include_once 'dbhelper.php';

if(isset($_POST['bid'])){
    $bid=$_POST['bid'];
    $userid=$_SESSION['user_id'];
    $check=(new dbhelper)->__checkWhetherAlreadyExistsInCart($bid,$userid);
    if($check >= 1){
        echo 2;
    } else {
        $rows = (new dbhelper)->__addToCart($bid, $userid);
        echo 1;
    }

}elseif(isset($_POST['book_id'])){
    $bid=$_POST['book_id'];
    $userid=$_SESSION['user_id'];
    (new dbhelper)->__removeFromCart($bid,$userid);
    echo 1;
}else echo 0;
