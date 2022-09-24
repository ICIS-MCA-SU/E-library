<?php
include_once 'dbhelper.php';
 
$type = $_GET['type'];
if ($type == "All") {
    $dbh = new dbhelper();
    $result = $dbh->__getBooks();
    print json_encode($result);
}
if ($type == "generalAll") {
    $book_type = $_GET['book_type'];
    $dbh = new dbhelper();
    $result = $dbh->__getGeneralBooks($book_type);
    print json_encode($result);
}
if ($type == "generalLimitBy") {
    $startLimit = $_GET['startLimit'];
    $endLimit = $_GET['endLimit'];
    $book_type = $_GET['book_type'];
    $dbh = new dbhelper();
    $result = $dbh->__getGeneralBooksByLimit($book_type,$startLimit, $endLimit);
    print json_encode($result);
}
if ($type == "generalSearchBy") {
    $keyword = $_GET['keyword'];
    $department = $_GET['department'];
    $book_type = $_GET['book_type'];
    $dbh = new dbhelper();
    $result = $dbh->__getGeneralSearchResults($book_type,$keyword, $department);
    print json_encode($result);
}
if ($type == "limitBy") {

    $startLimit = $_GET['startLimit'];
    $endLimit = $_GET['endLimit'];

    $dbh = new dbhelper();
    $result = $dbh->__getBooksByLimit($startLimit, $endLimit);
    print json_encode($result);
}
if ($type == "searchBy") {
    $keyword = $_GET['keyword'];
    $department = $_GET['department'];
    $dbh = new dbhelper();
    $result = $dbh->__getSearchResults($keyword, $department);
    print json_encode($result);
}
if ($type == "getReturnDate") {
    $bookId = $_GET['bookId'];
    $dbh = new dbhelper();
    $result = $dbh->__getDateToReserve($bookId);
    print json_encode($result);
}
