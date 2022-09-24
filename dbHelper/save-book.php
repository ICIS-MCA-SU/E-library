<?php
include_once 'dbhelper.php';
if (isset($_POST['title'])) {
    $jsonText = $_REQUEST['accession'];
    $decodedText = html_entity_decode($jsonText);
    $myArray = json_decode($decodedText, true);
    $count = count($myArray);

    $title = $_POST['title'];
    $author = $_POST['author'];
    $edition = $_POST['edition'];
    $department = $_POST['department'];
    $description = $_POST['description'];
    $stock = $_POST['stock'];
    $booktype = "physical book";

    $book_id = (new dbhelper)->__saveBookDetails($title, $author, $edition, $department, $description, $stock, $booktype);

    if (isset($_FILES['cover'])) {
             $allowed = array(".pdf", ".doc", ".docx",".txt",".jpeg",".jpg");
        $file_name = strtolower($_FILES['cover']['name']);
        $file_size = $_FILES['cover']['size'];
        $file_ext = substr($file_name, strrpos($file_name, '.'));
        if (in_array($file_ext, $allowed)) {
            if ($file_size <1500000000000) {
                $prefix = 'SUbook'.md5(time() * rand(1, 9999));
                $file_name_new = $prefix . $file_ext;
                $path = '../books/' . $file_name_new;
                /* check if the file uploaded successfully */
                if (move_uploaded_file($_FILES['cover']['tmp_name'], $path)) {

                     (new dbhelper)->__saveImgToDatabase( $file_name_new,$book_id);

                }
            } else {
                echo 'file is too large';
            }
        } else {
            echo 'type not allowed';
        }


    }


    for ($i = 0; $i < $count - 2; $i++) {
        (new dbhelper)->__saveAccessionNumbers($book_id,$myArray[$i]);
    }
    echo 1;


}elseif(isset($_POST['Ebook_id'])){
    $jsonText = $_REQUEST['accession'];
    $book_id=$_POST['Ebook_id'];
    $decodedText = html_entity_decode($jsonText);
    $myArray = json_decode($decodedText, true);
    $count = count($myArray);
    for ($i = 0; $i < $count-2; $i++) {
        (new dbhelper)->__saveAccessionNumbers($book_id,$myArray[$i]);

    }
    echo 1;

}

