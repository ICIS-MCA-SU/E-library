<?php
include_once 'dbhelper.php';
if (isset($_POST['etitle'])) {
    $title = $_POST['etitle'];
    $author = $_POST['eauthor'];
    $edition = $_POST['eedition'];
    $department = $_POST['edepartment'];
    $booktype = $_POST['bmaterial'];
    $description = $_POST['edescription'];
    $stock=0;

    $book_id = (new dbhelper)->__saveBookDetails($title, $author, $edition, $department, $description, $stock, $booktype);

    if (isset($_FILES['ecoverPhoto'])) {
              $allowed = array(".pdf", ".doc", ".docx",".txt",".jpeg",".jpg");
        $file_name = strtolower($_FILES['ecoverPhoto']['name']);
        $file_size = $_FILES['ecoverPhoto']['size'];
        $file_ext = substr($file_name, strrpos($file_name, '.'));
        if (in_array($file_ext, $allowed)) {
            if ($file_size < 40000000000) {
                $prefix = 'SUbook'.md5(time() * rand(1, 9999));
                $file_name_new = $prefix . $file_ext;
                $path = '../books/' . $file_name_new;
                /* check if the file uploaded successfully */
                if (move_uploaded_file($_FILES['ecoverPhoto']['tmp_name'], $path)) {

                    (new dbhelper)->__saveImgToDatabase( $file_name_new,$book_id);

                }
            } else {
                echo 'file is too large';
            }
        } else {
            echo 'type not allowed';
        }


    }

    if (isset($_FILES['pdf'])) {
        $allowed = array(".pdf", ".doc", ".docx",".txt",".jpeg");
        $file_name = strtolower($_FILES['pdf']['name']);
        $file_size = $_FILES['pdf']['size'];
        $file_ext = substr($file_name, strrpos($file_name, '.'));
        if (in_array($file_ext, $allowed)) {
            if ($file_size < 1500000000000) {
                $prefix = 'SUEbook'.md5(time() * rand(1, 9999));
                $file_name_new = $prefix.$file_ext;
                $path = '../books/pdf/'.$file_name_new;
                /* check if the file uploaded successfully */
                if (move_uploaded_file($_FILES['pdf']['tmp_name'], $path)) {

                    (new dbhelper)->__saveFileToDatabase( $file_name_new,$book_id);

                } else echo "failed here";
            } else {
                echo 'file is too large';
            }
        } else {
            echo 'type not allowed';
        }


    }else echo "failed here ";



    echo 1;


}else echo "not set";

