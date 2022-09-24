<?php
if (session_status() !== PHP_SESSION_ACTIVE || session_id() === "") {
    session_start();
}
include_once 'dbhelper.php';

$type = $_GET['type'];
if ($type == "Book") {
    $bookId = $_GET['book_id'];
    $dbh = new dbhelper();
    $result = $dbh->__getBookDetails($bookId);
    print json_encode($result);
} else if ($type == "Accession") {
    $bookId = $_GET['book_id'];
    $dbh = new dbhelper();
    $result = $dbh->__getAccessionAll($bookId);
    print json_encode($result);
} else if ($type == "DeleteAccession") {
    $id = $_GET['id'];

    $dbh = new dbhelper();
    $result = $dbh->__deleteAccessionAll($id);
    echo $result;
} 