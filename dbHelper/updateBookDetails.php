<?php
if (session_status() !== PHP_SESSION_ACTIVE || session_id() === "") {
    session_start();
}
include_once 'dbhelper.php';

$book_id = $_POST['book_id'];
$title = $_POST['title'];
$author = $_POST['author'];
$edition = $_POST['edition'];
$department = $_POST['department'];
$description = $_POST['description'];
$stock = $_POST['stock'];
$booktype = $_POST['book_type'];
$dbh = new dbhelper();
if ($booktype != 'physical book') {
    if (isset($_FILES['cover'])) {
        $allowed = array(".pdf", ".doc", ".docx", ".txt", ".jpeg", ".jpg",".png");
        $file_name = strtolower($_FILES['cover']['name']);
        $file_size = $_FILES['cover']['size'];
        $file_ext = substr($file_name, strrpos($file_name, '.'));
        if (in_array($file_ext, $allowed)) {
            if ($file_size < 1500000000000) {
                $prefix = 'SUbook' . md5(time() * rand(1, 9999));
                $file_name_new = $prefix . $file_ext;
                $path = '../books/' . $file_name_new;
                /* check if the file uploaded successfully */
                if (move_uploaded_file($_FILES['cover']['tmp_name'], $path)) {

                    (new dbhelper)->__saveImgToDatabase($file_name_new, $book_id);
                }
            }
        }
    }
    if (isset($_FILES['pdf'])) {
        $allowed = array(".pdf", ".doc", ".docx", ".txt", ".jpeg");
        $file_name = strtolower($_FILES['pdf']['name']);
        $file_size = $_FILES['pdf']['size'];
        $file_ext = substr($file_name, strrpos($file_name, '.'));
        if (in_array($file_ext, $allowed)) {
            if ($file_size < 1500000000000) {
                $prefix = 'SUEbook' . md5(time() * rand(1, 9999));
                $file_name_new = $prefix . $file_ext;
                $path = '../books/pdf/' . $file_name_new;
                /* check if the file uploaded successfully */
                if (move_uploaded_file($_FILES['pdf']['tmp_name'], $path)) {

                    (new dbhelper)->__saveFileToDatabase($file_name_new, $book_id);
                }
            }
        }
    }
} else {
    $jsonText = $_REQUEST['accession'];
    $decodedText = html_entity_decode($jsonText);
    $myArray = json_decode($decodedText, true);
    $count = count($myArray);

    if (isset($_FILES['cover'])) {
        $allowed = array(".pdf", ".doc", ".docx", ".txt", ".jpeg", ".jpg");
        $file_name = strtolower($_FILES['cover']['name']);
        $file_size = $_FILES['cover']['size'];
        $file_ext = substr($file_name, strrpos($file_name, '.'));
        if (in_array($file_ext, $allowed)) {
            if ($file_size < 1500000000000) {
                $prefix = 'SUbook' . md5(time() * rand(1, 9999));
                $file_name_new = $prefix . $file_ext;
                $path = '../books/' . $file_name_new;
                /* check if the file uploaded successfully */
                if (move_uploaded_file($_FILES['cover']['tmp_name'], $path)) {

                    (new dbhelper)->__saveImgToDatabase($file_name_new, $book_id);
                }
            }
        }
    }
    (new dbhelper)->__deleteAccessionNumbers($book_id);
    for ($i = 0; $i < $count - 2; $i++) {
        (new dbhelper)->__updateAccessionNumbers($book_id, $myArray[$i]);
    }
}

$result = $dbh->__updateBookDetails($book_id, $title, $author, $edition, $department, $description, $stock, $booktype);
echo $result;
