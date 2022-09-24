<?php
include_once 'dbhelper.php';

if(isset($_POST['cards'])){
    $jsonText = $_REQUEST['cards'];
    $decodedText = html_entity_decode($jsonText);
    $myArray = json_decode($decodedText, true);
    $userid =$_POST['uid'];
    $count = count($myArray);
    for( $i=0;$i<$count-2;$i++) {
        (new dbhelper)->__storeCards($userid, $myArray[$i]);
    }
    (new dbhelper)->__deleteFromPending($userid);
    echo 1;
} else echo "fail";