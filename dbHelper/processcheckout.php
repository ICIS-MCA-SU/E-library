<?php
include_once 'dbhelper.php';
if (session_status() !== PHP_SESSION_ACTIVE || session_id() === ""){
    session_start();
}
if (isset($_REQUEST['books'])) {
    $books = $_REQUEST['books'];
    $userid = $_POST['user_id'];
    $cardCount = (new dbhelper)->__availableCards($userid);
    if($cardCount < count($books)){
        echo 1;
    }else{
        $prevOrderId=(new dbhelper)->__getOrderId();
        $orderId=$prevOrderId+1;
        $date=date('Y-m-d');
        $returnDate= date('Y-m-d', strtotime($date. ' + 20 days'));
        foreach ($books as $bookid){
            $cardnumber = (new dbhelper)->__getUserCardCount($userid);
            $accession = (new dbhelper)->__getAccession($bookid);
            $result = (new dbhelper)->__storeOrder($orderId,$userid,$date,$returnDate,$accession,$cardnumber,$bookid);
            if($result == 1){
                (new dbhelper)->__updateUserCard($userid,$cardnumber,1);
                $book_id= (new dbhelper)->__getBookId($accession);
                (new dbhelper)->__updateAccession($book_id,$accession,1);
                (new dbhelper)->__removeFromCart($book_id,$userid);;

            }

        }
        $_SESSION['orderId']=$orderId;
        $_SESSION['orderDate']=$date;
        $_SESSION['returnDate']=$returnDate;
        echo 4;
    }
}