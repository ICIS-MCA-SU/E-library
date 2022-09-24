<?php
if (session_status() !== PHP_SESSION_ACTIVE || session_id() === ""){
    session_start();
}
include_once 'dbhelper.php';
if(isset($_POST['acn'])){
if(isset($_SESSION['user_id'])){
   $userid = $_SESSION['user_id'];
    $isPending = (new dbhelper)->__isUserAprovalPending();
    $isExpired = (new dbhelper)->__isExpired($userid);
    if($isPending==1 || $isExpired==1) {
     echo 1;
    }else{
        $cardnumber="";
        $userRole =  (new dbhelper)->__getUserRole($userid);
        $canOrder=false;
        if($userRole=="student") {
            $cardnumber = (new dbhelper)->__getUserCardCount($userid);
            if ($cardnumber == 0) {
                $canOrder=false;
                echo 2;

            }
            else{
                $canOrder=true;
            }
        } else{
            $canOrder=true;
        }

        if($canOrder){
            $bookid=$_POST['bookid'];
            $accession =   (new dbhelper)->__getAccession($bookid);
            $date=date('Y-m-d');
            $prevOrderId=(new dbhelper)->__getOrderId();
            $orderId=$prevOrderId+1;
            $returnDate="";
            $result="";
            if($userRole=="student") {
                $returnDate = date('Y-m-d', strtotime($date . ' + 20 days'));
                $result = (new dbhelper)->__storeOrder($orderId, $userid, $date, $returnDate, $accession, $cardnumber, $bookid);

                if($result == 1){
                    (new dbhelper)->__updateUserCard($userid,$cardnumber,1);
                    $book_id= (new dbhelper)->__getBookId($accession);
                    (new dbhelper)->__updateAccession($book_id,$accession,1);
                    $_SESSION['orderId']=$orderId;
                    $_SESSION['orderDate']=$date;
                    $_SESSION['returnDate']=$returnDate;
                    echo 4;
                }
            }else{
                $result = (new dbhelper)->__storeOrder($orderId, $userid, $date, "", $accession, "", $bookid);

                if($result == 1){
                    $book_id= (new dbhelper)->__getBookId($accession);
                    (new dbhelper)->__updateAccession($book_id,$accession,1);
                    $_SESSION['orderId']=$orderId;
                    $_SESSION['orderDate']=$date;
                    $_SESSION['returnDate']="----";
                    echo 4;
                }
            }


        }


    }
}else echo '0';
}else echo '-1';


