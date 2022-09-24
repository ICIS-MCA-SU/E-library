<?php
if (session_status() !== PHP_SESSION_ACTIVE || session_id() === ""){
    session_start();
}
include_once 'dbhelper.php';
if(isset($_POST['acn'])){
    if(isset($_SESSION['user_id'])){
        $userid = $_SESSION['user_id'];
        $isPending = (new dbhelper)->__isUserAprovalPending();
        if($isPending==1) {
            echo 1;
        }else{
            $cardnumber = (new dbhelper)->__getUserCardCount($userid);
            if($cardnumber==0){
                echo 2;
            }else{
                $accession = $_POST['acn'];
                $bookid=$_POST['bookid'];
                $date=date('Y-m-d');
                $rowsavd = (new dbhelper)->__getDateToReserve($bookid);
                $availableDate="";
                foreach ($rowsavd as $rowavd) {
                    $availableDate= $rowavd['return_date'];
                }
                $issueDate= date('Y-m-d', strtotime($availableDate. ' + 1 days'));
                $result = (new dbhelper)->__reserveBook($userid,$bookid,$accession,$date,$issueDate);
                echo 4;
            }


        }
    }else echo '0';
}else echo '-1';


