<?php
if (session_status() !== PHP_SESSION_ACTIVE || session_id() === "") {
    session_start();
}
 
include_once __DIR__ . '/connect.php';
class dbhelper extends connect
{
    public function __createUser($fname, $lname, $course, $rollno, $email, $phone, $passwd, $role, $expdate)
    {
        $sql = "SELECT * FROM sulibrary.users where email='$email' or regno='$rollno'";
        $stmt = $this->__connect()->query($sql);
        if ($stmt->rowCount()) {
            return 0;
        } else {

            $sql = "INSERT INTO sulibrary.users(`first_name`, `last_name`, `phone`, `email`, `course`, `regno`, `password`, `role`,exipry_date) VALUES (?,?,?,?,?,?,?,?,?);";
            $stmt = $this->__connect()->prepare($sql);
            $stmt->execute([$fname, $lname, $phone, $email, $course, $rollno, $passwd, $role, $expdate]);

            $userId = dbhelper::__getUserID($email);
            $date = date('Y-m-d');
            $sql = "INSERT INTO sulibrary.pending_aproval(`user_id`, `registration_date`) VALUES (?,?);";
            $stmt = $this->__connect()->prepare($sql);
            $stmt->execute([$userId, $date]);

            return 1;
        }
    }
    public function __createDummyUser($fname, $lname, $course, $rollno, $email, $phone, $passwd, $role, $status)
    {
        $sql = "SELECT * FROM sulibrary.users where email='$email' or regno='$rollno'";
        $stmt = $this->__connect()->query($sql);
        if ($stmt->rowCount()) {
            return 0;
        } else {

            $sql = "INSERT INTO sulibrary.users(`first_name`, `last_name`, `phone`, `email`, `course`, `regno`, `password`, `role`,`status`) VALUES (?,?,?,?,?,?,?,?,?);";
            $stmt = $this->__connect()->prepare($sql);
            $stmt->execute([$fname, $lname, $phone, $email, $course, $rollno, $passwd, $role, 1]);

            $userId = dbhelper::__getUserID($email);
            $date = date('Y-m-d');
            $sql = "INSERT INTO sulibrary.pending_aproval(`user_id`, `registration_date`) VALUES (?,?);";
            $stmt = $this->__connect()->prepare($sql);
            $stmt->execute([$userId, $date]);

            return 1;
        }
    }
    public function __createUserLog($userId, $enterDateTime)
    {
        $sql = "INSERT INTO sulibrary.userlogs(`userId`, enterDateTime) VALUES (?,?);";
        $stmt = $this->__connect()->prepare($sql);
        $stmt->execute([$userId, $enterDateTime]);

        $sql = "SELECT * FROM sulibrary.userlogs WHERE userId='$userId' order by enterDateTime desc limit 1";
        $stmt = $this->__connect()->query($sql);
        $rows = $stmt->fetchAll();
        $_SESSION['userlogId'] = $rows[0]['Id'];
        // $rows = $stmt->fetchAll();

        // $_SESSION["userLogId"] =$stmt->Id;
        return  1;
    }
    public function __createUserLogWithEndDatetime($userId, $enterDateTime, $endDateTime)
    {
        $sql = "INSERT INTO sulibrary.userlogs(`userId`, enterDateTime,outDateTime) VALUES (?,?,?);";
        $stmt = $this->__connect()->prepare($sql);
        $stmt->execute([$userId, $enterDateTime, $endDateTime]);

        $sql = "SELECT * FROM sulibrary.userlogs WHERE userId='$userId' order by enterDateTime desc limit 1";
        $stmt = $this->__connect()->query($sql);
        $rows = $stmt->fetchAll();
        $_SESSION['userlogId'] = $rows[0]['Id'];
        // $rows = $stmt->fetchAll();

        // $_SESSION["userLogId"] =$stmt->Id;
        return  1;
    }
    public function __createUserLogArray($data)
    {
        $sql = "INSERT INTO sulibrary.userlogs(`userId`, enterDateTime,outDateTime) VALUES (?,?,?);";
        $stmt = $this->__connect()->prepare($sql);
        foreach ($data as $item) {

            $enterTime = new DateTime($item['startDate']);
            $outTime = new DateTime($item['endDate']);
            $stmt->execute([($item['userId']), $enterTime->format('Y-m-d H:i:s'), $outTime->format('Y-m-d H:i:s')]);
        }
        return  1;
    }
    public function __getUsersByLimit($endLimit)
    {
        try {
            $sql =  "SELECT * FROM sulibrary.users  ORDER BY RAND() LIMIT $endLimit";
            $stmt = $this->__connect()->query($sql);
            if ($stmt->rowCount()) {
                $rows = $stmt->fetchAll();
                return $rows;
            } else return 0;
        } catch (ErrorException $e) {
            die($e);
        }
    }
    public function __updateUserLog($userId, $outDateTime)
    {
        $sql = "update sulibrary.userlogs set outDateTime='$outDateTime' where Id='$userId'";
        $stmt = $this->__connect()->prepare($sql);
        $stmt->execute();

        return 1;
    }
    //Verification User Data

    public function _checkVerificationdataExist($email, $regNum)
    {
        $sql = "SELECT * FROM sulibrary.users where email='$email' or regno='$regNum'";
        $stmt1 = $this->__connect()->query($sql);

        if ($stmt1->rowCount()) {
            return 1;
        } else {
            $sql = "SELECT * FROM sulibrary.userverification WHERE email='$email'";
            $stmt = $this->__connect()->prepare($sql);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            if (count($rows) > 0) {
                return 1;
            } else {
                return 0;
            }
        }
    }
    public function __createVerificationUserData($firstName, $lastName, $email, $password, $phone, $course, $sem, $regNum, $otp, $registrationDateTime, $exipryDateTime)
    {
        $sql = "INSERT INTO sulibrary.userverification(`first_name`, `last_name`, `email`,`password`, `phone`, `course`,`sem`, `regno`, `otp`,`registrationDateTime`,`role`,`expiry_date`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?);";
        $stmt = $this->__connect()->prepare($sql);
        $stmt->execute([$firstName, $lastName, $email, $password, $phone, $course, $sem, $regNum, $otp, $registrationDateTime, 'student', $exipryDateTime]);
        return  1;
    }
    public function __verifyUser($email, $otp)
    {
        $sql = "SELECT * FROM sulibrary.userverification WHERE email='$email' and otp='$otp'";
        $stmt = $this->__connect()->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        if (count($rows) > 0) {
            $sqlUpdate = "UPDATE sulibrary.userverification SET isVerified=1 WHERE email='$email'";
            $sqlUpdate = $this->__connect()->prepare($sqlUpdate);
            $sqlUpdate->execute();
            $sql = "INSERT INTO sulibrary.users(`first_name`, `last_name`, `email`,`password`, `phone`, `course`, `regno`,`role`,`exipry_date`,`status`) VALUES (?,?,?,?,?,?,?,?,?,?);";
            $stmt = $this->__connect()->prepare($sql);
            $stmt->execute([$rows[0]['first_name'], $rows[0]['last_name'], $rows[0]['email'], $rows[0]['password'], $rows[0]['phone'], $rows[0]['course'], $rows[0]['regno'], 'student', $rows[0]['expiry_date'], 0]);
            $userId = dbhelper::__getUserID($email);
            $date = date('Y-m-d');
            $sql = "INSERT INTO sulibrary.pending_aproval(`user_id`, `registration_date`) VALUES (?,?);";
            $stmt = $this->__connect()->prepare($sql);
            $stmt->execute([$userId, $date]);
            return 1;
        } else {
            return 0;
        }
    }
    public function __deleteVerificationUserData($email)
    {
        $sql = "DELETE FROM sulibrary.userverification WHERE email='$email'";
        $stmt = $this->__connect()->prepare($sql);
        $stmt->execute();
        return  1;
    }
    public function __getVUserID($email)
    {
        $sql = "SELECT * FROM sulibrary.userverification WHERE email='$email'";
        $stmt = $this->__connect()->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return $rows[0]['isVerified'];
    }
    public function __getAllUser()
    {
        try {
            $sql = "SELECT * FROM sulibrary.users where status=0";
            $stmt = $this->__connect()->query($sql);
            if ($stmt->rowCount()) {
                $rows = $stmt->fetchAll();
                return $rows;
            } else
                return 0;
        } catch (PDOException $ex) {
            return 0;
        }
    }
    public function __checkEmailExist($email)
    {
        $sql = "SELECT * FROM sulibrary.users where email='$email'";
        $stmt = $this->__connect()->query($sql);
        $rows = $stmt->fetchAll();
        if (count($rows) > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    public function __userDataUpdate($id, $email, $first_name, $last_name, $phone, $regno, $image)
    {
        $sql = "";
        if ($image != "") {
            $sql = "UPDATE sulibrary.users SET email='$email',regno='$regno',first_name='$first_name',last_name='$last_name',phone='$phone',photo='$image' where user_id='$id'";
        } else {
            $sql = "UPDATE sulibrary.users SET email='$email',regno='$regno',first_name='$first_name',last_name='$last_name',phone='$phone' where user_id='$id'";
        }
        $stmt = $this->__connect()->prepare($sql);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    public function __resetPassword($email, $password)
    {
        $sql = "UPDATE sulibrary.users SET password='$password' WHERE email='$email'";
        $stmt = $this->__connect()->prepare($sql);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    public function __contactus($data)
    {
        $sql = "INSERT INTO sulibrary.queries(`name`, `email`,`subject`, `message`,`createdOn`) VALUES (?,?,?,?,?);";
        $stmt = $this->__connect()->prepare($sql);
        $stmt->execute([$data['name'], $data['email'], $data['subject'], $data['message'], date('Y-m-d H:i:s')]);
        if ($stmt->rowCount() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    public function __getQueries()
    {
        try {
            $sql = "SELECT * FROM sulibrary.queries order by createdOn desc";
            $stmt = $this->__connect()->query($sql);
            if ($stmt->rowCount()) {
                $rows = $stmt->fetchAll();
                return $rows;
            } else
                return 0;
        } catch (PDOException $ex) {
            return 0;
        }
    }
    public function __replyQuery($id, $reply, $repliedOn)
    {
        $sql = "UPDATE sulibrary.queries SET response='$reply',repliedOn='$repliedOn' WHERE id='$id'";
        $stmt = $this->__connect()->prepare($sql);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    public function __deleteQuery($id)
    {
        $sql = "DELETE FROM sulibrary.queries WHERE id='$id'";
        $stmt = $this->__connect()->prepare($sql);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function __createProfessor($fname, $lname, $course, $email, $phone, $passwd, $role)
    {
        $sql = "SELECT * FROM sulibrary.users where email='$email' ";
        $stmt = $this->__connect()->query($sql);
        if ($stmt->rowCount()) {
            return 0;
        } else {

            $sql = "INSERT INTO sulibrary.users(`first_name`, `last_name`, `phone`, `email`, `course`, `password`, `role`) VALUES (?,?,?,?,?,?,?);";
            $stmt = $this->__connect()->prepare($sql);
            $stmt->execute([$fname, $lname, $phone, $email, $course, $passwd, $role]);

            $userId = dbhelper::__getUserID($email);
            $date = date('Y-m-d');
            $sql = "INSERT INTO sulibrary.pending_aproval(`user_id`, `registration_date`) VALUES (?,?);";
            $stmt = $this->__connect()->prepare($sql);
            $stmt->execute([$userId, $date]);

            return 1;
        }
    }

    public function __getUserID($email)
    {
        $sql = "SELECT * FROM sulibrary.users where email='$email'  ";
        $stmt = $this->__connect()->query($sql);
        $rows = $stmt->fetchAll();
        foreach ($rows as $row) {
            return $row['user_id'];
        }
    }

    public function __fetchUser($username, $password)
    {
        $sql = "SELECT * FROM sulibrary.users where users.email='$username' and users.password ='$password' ";
        $stmt = $this->__connect()->query($sql);
        return $stmt;
    }

    public function __getUserRecords()
    {
        try {
            if (isset($_SESSION['user_id'])) {
                $userId = $_SESSION['user_id'];
                $sql = "SELECT * FROM sulibrary.users where user_id='$userId' ;";
                $stmt = $this->__connect()->query($sql);
                if ($stmt->rowCount()) {
                    $rows = $stmt->fetchAll();
                    return $rows;
                } else
                    return 0;
            } else return 0;
        } catch (PDOException $ex) {
            return 0;
        }
    }

    public function __isUserAprovalPending()
    {
        try {
            if (isset($_SESSION['user_id'])) {
                $userId = $_SESSION['user_id'];
                $sql = "SELECT * FROM sulibrary.pending_aproval where user_id='$userId' ;";
                $stmt = $this->__connect()->query($sql);
                if ($stmt->rowCount()) {
                    return 1;
                } else
                    return 0;
            } else return -1;
        } catch (PDOException $ex) {
            return -1;
        }
    }


    public function __getPendingAprovalUsers()
    {
        try {
            $role = "student";
            $sql = "SELECT * FROM sulibrary.pending_aproval inner join sulibrary.users on users.user_id= pending_aproval.user_id and users.role='$role'";
            $stmt = $this->__connect()->query($sql);
            if ($stmt->rowCount() > 0) {
                return $stmt->fetchAll();
            } else
                return 0;
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __getNewRegistrationCount()
    {
        try {
            $sql = "SELECT * FROM sulibrary.pending_aproval";
            $stmt = $this->__connect()->query($sql);

            return $stmt->rowCount();
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __getPendingAprovalProfessor()
    {
        try {
            $role = "professor";
            $sql = "SELECT * FROM sulibrary.pending_aproval inner join sulibrary.users on users.user_id= pending_aproval.user_id and users.role='$role'";
            $stmt = $this->__connect()->query($sql);
            if ($stmt->rowCount() > 0) {
                return $stmt->fetchAll();
            } else
                return 0;
        } catch (ErrorException $e) {
            die($e);
        }
    }
    public function __getPendingAprovalUserInfo($id)
    {
        try {
            $sql = "SELECT * FROM sulibrary.users  inner join sulibrary.pending_aproval on users.user_id=  pending_aproval.user_id where users.user_id='$id'";
            $stmt = $this->__connect()->query($sql);
            if ($stmt->rowCount() > 0) {
                $rows = $stmt->fetchAll();

                $userId = array_map(function ($a) {
                    return $a["user_id"];
                }, $rows);
                $firstname = array_map(function ($a) {
                    return $a["first_name"];
                }, $rows);
                $lastname = array_map(function ($a) {
                    return $a["last_name"];
                }, $rows);
                $course = array_map(function ($a) {
                    return $a["course"];
                }, $rows);
                $regno = array_map(function ($a) {
                    return $a["regno"];
                }, $rows);
                echo json_encode(array(
                    array('userid' => $userId, 'firstname' => $firstname, 'lastname' => $lastname, 'course' => $course, 'regno' => $regno)

                ));
            } else
                return 0;
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __storeCards($userid, $card)
    {
        try {
            $sql = "INSERT INTO sulibrary.cards(`user_id`, `card_number`) VALUES(?,?);";
            $stmt = $this->__connect()->prepare($sql);
            $stmt->execute([$userid, $card]);

            //            $userId=dbhelper::__getUserID($email);
            //            $date=date('Y-m-d');
            //            $sql="INSERT INTO sulibrary.pending_aproval(`user_id`, `registration_date`) VALUES (?,?);";
            //            $stmt=$this->__connect()->prepare($sql);
            //            $stmt->execute([$userId,$date]);

        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __deleteFromPending($userid)
    {
        try {
            $sql = "DELETE FROM sulibrary.pending_aproval WHERE user_id='$userid'";
            $this->__connect()->query($sql);
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __updateUserStatus($userid)
    {
        try {
            $sql = "UPDATE sulibrary.users set status = 1 WHERE user_id='$userid'";
            $this->__connect()->query($sql);
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __saveBookDetails($title, $author, $edition, $department, $description, $stock, $booktype)
    {
        try {
            $sql = "INSERT INTO sulibrary.books(`title`, `edition`, `author`, `total_stock`, `book_department`, `description`, `book_type`) VALUES(?,?,?,?,?,?,?);";
            $stmt = $this->__connect()->prepare($sql);
            $stmt->execute([$title, $edition, $author, $stock, $department, $description, $booktype]);

            $sql = "SELECT book_id FROM sulibrary.books order by book_id DESC LIMIT 1;";
            $stmt = $this->__connect()->query($sql);
            if ($stmt->rowCount() > 0) {

                $rows = $stmt->fetchAll();
                foreach ($rows as $row) {
                    return $row['book_id'];
                }
            }
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __updateBookDetails($book_id, $title, $author, $edition, $department, $description, $stock, $booktype)
    {
        try {
            $sql = "Update sulibrary.books set `title`=?, `edition`=?, `author`=?, `total_stock`=?, `book_department`=?, `description`=?, `book_type`=? where  book_id='$book_id';";
            $stmt = $this->__connect()->prepare($sql);
            $stmt->execute([$title, $edition, $author, $stock, $department, $description, $booktype]);
            return 1;
        } catch (ErrorException $e) {
            die($e);
        }
    }
    public function __saveImgToDatabase($file_name_new, $book_id)
    {
        try {
            $sql = "UPDATE  sulibrary.books SET `cover_photo` =? where book_id =?;";
            $stmt = $this->__connect()->prepare($sql);
            $stmt->execute([$file_name_new, $book_id]);
        } catch (ErrorException $e) {
            die($e);
        }
    }
    public function __deleteAccessionNumbers($book_id)
    {
        try {
            $sql = "DELETE FROM sulibrary.accession_details where book_id='$book_id'";
            $this->__connect()->query($sql);
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __updateAccessionNumbers($book_id, $accession)
    {
        try {
            $sql = "INSERT INTO sulibrary.accession_details(`book_id`, `accession_number`) VALUES (?,?);";
            $stmt = $this->__connect()->prepare($sql);
            $stmt->execute([$book_id, $accession]);
        } catch (ErrorException $e) {
            die($e);
        }
    }
    public function __saveAccessionNumbers($book_id, $accession)
    {
        try {
            $sql = "INSERT INTO sulibrary.accession_details(`book_id`, `accession_number`) VALUES (?,?);";
            $stmt = $this->__connect()->prepare($sql);
            $stmt->execute([$book_id, $accession]);
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __getBooks()
    {
        try {
            $sql = "SELECT * FROM sulibrary.books ;";
            $stmt = $this->__connect()->query($sql);
            if ($stmt->rowCount() > 0) {
                $rows = $stmt->fetchAll();
                return $rows;
            } else return 0;
        } catch (ErrorException $e) {
            die($e);
        }
    }
    public function __getGeneralBooks($book_type)
    {
        try {
            $sql = "SELECT * FROM sulibrary.books where book_type='$book_type' ;";
            $stmt = $this->__connect()->query($sql);
            if ($stmt->rowCount() > 0) {
                $rows = $stmt->fetchAll();
                return $rows;
            } else return 0;
        } catch (ErrorException $e) {
            die($e);
        }
    }
    public function __getGeneralBooksByLimit($book_type, $startLimit, $endLimit)
    {
        try {
            $sql = "SELECT * FROM sulibrary.books where book_type='$book_type' limit $startLimit,$endLimit ;";
            $stmt = $this->__connect()->query($sql);
            if ($stmt->rowCount() > 0) {
                $rows = $stmt->fetchAll();
                return $rows;
            } else return 0;
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __getBooksByLimit($startLimit, $endLimit)
    {
        try {
            $sql = "SELECT * FROM sulibrary.books limit $startLimit,$endLimit ;";
            $stmt = $this->__connect()->query($sql);
            if ($stmt->rowCount() > 0) {
                $rows = $stmt->fetchAll();
                return $rows;
            } else return 0;
        } catch (ErrorException $e) {
            die($e);
        }
    }
    public function __getGeneralSearchResults($book_type, $keywords, $search_department)
    {
        // $sql = "SELECT * FROM sulibrary.books where title like '%$keywords%' or author like  '%$keywords%' or edition like  '%$keywords%' or description like '%$keywords%' or book_department like  '%$keywords1%' or book_department like  '%$keywords%';";

        try {
            if ($keywords != "") {
                $sql = "SELECT * FROM sulibrary.books where book_type='$book_type' and title like '%$keywords%' or author like  '%$keywords%' or edition like  '%$keywords%' or description like '%$keywords%' or book_department like  '%$search_department%';";
            } else {
                $sql = "SELECT * FROM sulibrary.books where book_type='$book_type' and book_department like  '%$search_department%'";
            }
            $stmt = $this->__connect()->query($sql);
            if ($stmt->rowCount() > 0) {
                $rows = $stmt->fetchAll();
                return $rows;
            } else return 0;
        } catch (ErrorException $e) {
            die($e);
        }
    }
    public function __getBookDetails($book_id)
    {
        try {
            $sql = "SELECT * FROM sulibrary.books where book_id='$book_id';";
            $stmt = $this->__connect()->query($sql);
            if ($stmt->rowCount() > 0) {
                $rows = $stmt->fetchAll();
                return $rows;
            } else return 0;
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __getStocks($bookId)
    {
        try {
            $sql = "SELECT * FROM sulibrary.accession_details WHERE book_id='$bookId' and status = 0;";
            $stmt = $this->__connect()->query($sql);
            return  $stmt->rowCount();
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __getAccession($bookId)
    {
        try {
            $sql = "SELECT accession_number FROM sulibrary.accession_details WHERE book_id='$bookId' and status = 0 LIMIT 1;";
            $stmt = $this->__connect()->query($sql);
            if ($stmt->rowCount()) {
                $rows = $stmt->fetchAll();
                foreach ($rows as $row)
                    return $row['accession_number'];
            }
            return 0;
        } catch (ErrorException $e) {
            die($e);
        }
    }
    public function __getAccessionAll($bookId)
    {
        try {
            $sql = "SELECT * FROM sulibrary.accession_details WHERE book_id='$bookId';";
            $stmt = $this->__connect()->query($sql);
            if ($stmt->rowCount()) {
                $rows = $stmt->fetchAll();
                return $rows;
            }
            return 0;
        } catch (ErrorException $e) {
            die($e);
        }
    }
    public function __deleteAccessionAll($id)
    {
        try {
            $sql = "Delete FROM sulibrary.accession_details WHERE id='$id';";
            $stmt = $this->__connect()->prepare($sql);
            $stmt->execute();
            if ($stmt->rowCount() > 0)
                return 1;
            else return 0;
        } catch (ErrorException $e) {
            die($e);
        }
    }
    public function __getDepartmentBooks($dept, $bid)
    {
        try {
            $sql = "SELECT * FROM sulibrary.books where book_department='$dept' and book_id != '$bid';";
            $stmt = $this->__connect()->query($sql);
            if ($stmt->rowCount() > 0) {
                $rows = $stmt->fetchAll();
                return $rows;
            } else return 0;
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __getUserCardCount($userId)
    {
        try {
            $sql = "SELECT card_number FROM sulibrary.cards WHERE user_id='$userId' and status = 0 LIMIT 1;";
            $stmt = $this->__connect()->query($sql);
            if ($stmt->rowCount()) {
                $rows = $stmt->fetchAll();
                foreach ($rows as $row)
                    return $row['card_number'];
            } else {
                return 0;
            }
            return 0;
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __storeOrder($orderid, $userid, $date, $returnDate, $accessionNumber, $cardnumber, $bookid)
    {
        try {
            $sql = "INSERT INTO sulibrary.orders(order_id, card_number,accession_number, user_id, order_date, return_date,book_id) VALUES (?,?,?,?,?,?,?);";
            $stmt = $this->__connect()->prepare($sql);
            $stmt->execute([$orderid, $cardnumber, $accessionNumber, $userid, $date, $returnDate, $bookid]);
            return 1;
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __getOrderId()
    {
        try {
            $sql = "select order_id from sulibrary.orders order by order_id desc limit 1;";
            $stmt = $this->__connect()->query($sql);
            if ($stmt->rowCount()) {
                $rows = $stmt->fetchAll();
                foreach ($rows as $row)
                    return $row['order_id'];
            } else return 111;
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __getOrderDetails($orderid)
    {
        try {
            $sql =  "SELECT * FROM sulibrary.orders INNER JOIN sulibrary.accession_details on orders.accession_number = accession_details.accession_number INNER JOIN sulibrary.books on accession_details.book_id = books.book_id and orders.order_id ='$orderid';";
            $stmt = $this->__connect()->query($sql);
            if ($stmt->rowCount()) {
                $rows = $stmt->fetchAll();
                return $rows;
            } else return 0;
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __updateUserCard($userid, $cardnumber, $status)
    {
        try {
            $sql = "UPDATE  sulibrary.cards SET `status` =? where card_number =? and user_id =?;";
            $stmt = $this->__connect()->prepare($sql);
            $stmt->execute([$status, $cardnumber, $userid]);
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __updateAccession($book_id, $accession, $status)
    {
        try {
            $sql = "UPDATE  sulibrary.accession_details SET `status` =? where accession_number =? and book_id =?;";
            $stmt = $this->__connect()->prepare($sql);
            $stmt->execute([$status, $accession, $book_id]);
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __getBookId($accession)
    {
        try {
            $sql =  "SELECT * FROM  sulibrary.accession_details where accession_number  ='$accession';";
            $stmt = $this->__connect()->query($sql);
            if ($stmt->rowCount()) {
                $rows = $stmt->fetchAll();
                foreach ($rows as $row) {
                    return $row['book_id'];
                }
            } else return 0;
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __checkBookOder($bookId, $userId)
    {
        try {
            $sql =  "SELECT * FROM  sulibrary.orders where user_id = '$userId' and book_id='$bookId' and ( status =0 or status = 1 or status = 2 or status = 4 );";
            $stmt = $this->__connect()->query($sql);
            if ($stmt->rowCount()) {
                return 1;
            } else return 0;
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __getUserOrderDetails($userId)
    {
        try {
            $sql =  "SELECT * FROM sulibrary.orders INNER JOIN sulibrary.accession_details on orders.accession_number = accession_details.accession_number INNER JOIN sulibrary.books on accession_details.book_id = books.book_id and orders.user_id ='$userId';";
            $stmt = $this->__connect()->query($sql);
            if ($stmt->rowCount()) {
                $rows = $stmt->fetchAll();
                return $rows;
            } else return 0;
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __checkOrderStatus($accession, $userId)
    {
        try {
            $sql =  "SELECT * FROM  sulibrary.orders  where user_id ='$userId' and accession_number='$accession';";
            $stmt = $this->__connect()->query($sql);
            if ($stmt->rowCount()) {
                $rows = $stmt->fetchAll();
                foreach ($rows as $row) {
                    return $row['status'];
                }
            } else return 0;
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __getPendingOrders($role)
    {
        try {
            $sql =  "SELECT * FROM  sulibrary.orders inner join sulibrary.users on orders.user_id=users.user_id inner join sulibrary.books on books.book_id=orders.book_id where orders.status=0 and users.role='$role';";
            $stmt = $this->__connect()->query($sql);
            if ($stmt->rowCount()) {
                $rows = $stmt->fetchAll();
                return $rows;
            } else return 0;
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __getTotalOrdersCount()
    {
        try {
            $sql =  "SELECT * FROM  sulibrary.orders where  orders.status=0";
            $stmt = $this->__connect()->query($sql);

            return  $rows = $stmt->rowCount();
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __getPendingOrderInfo($id)
    {
        try {
            $sql =  "SELECT * FROM  sulibrary.orders inner join sulibrary.users on orders.user_id=users.user_id inner join sulibrary.books on books.book_id=orders.book_id where orders.id='$id';";
            $stmt = $this->__connect()->query($sql);
            if ($stmt->rowCount()) {
                $rows = $stmt->fetchAll();

                $firstname = array_map(function ($a) {
                    return $a["first_name"];
                }, $rows);
                $bookname = array_map(function ($a) {
                    return $a["title"];
                }, $rows);
                $accession = array_map(function ($a) {
                    return $a["accession_number"];
                }, $rows);
                $regno = array_map(function ($a) {
                    return $a["regno"];
                }, $rows);
                echo json_encode(array(
                    array('firstname' => $firstname, 'bookname' => $bookname, 'accession' => $accession, 'regno' => $regno)

                ));
            } else return 0;
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __saveOrderConfirmation($orderid, $comment, $time)
    {
        try {
            $sql = "UPDATE sulibrary.orders SET status = 1 , comment= ?,aprove_time=? where id =?;";
            $stmt = $this->__connect()->prepare($sql);
            $stmt->execute([$comment, $time, $orderid]);
            return 1;
        } catch (ErrorException $e) {
            die($e);
            return 0;
        }
    }

    public function __rejectOrder($rejectId, $comment)
    {
        try {
            $sql = "UPDATE sulibrary.orders SET status = -1 , comment= ? where id =?;";
            $stmt = $this->__connect()->prepare($sql);
            $stmt->execute([$comment, $rejectId]);
            return 1;
        } catch (ErrorException $e) {
            die($e);
            return 0;
        }
    }

    public function __generateReturnRequest($accession, $orderId)
    {
        try {
            $date = date('Y-m-d');
            $sql = "UPDATE sulibrary.orders SET status = 2 , returned_date= ? where order_id =? and accession_number=?;";
            $stmt = $this->__connect()->prepare($sql);
            $stmt->execute([$date, $orderId, $accession]);
            return 1;
        } catch (ErrorException $e) {
            die($e);
            return 0;
        }
    }

    public function __getReturnRequests()
    {
        try {
            $sql =  "SELECT * FROM  sulibrary.orders inner join sulibrary.users on orders.user_id=users.user_id inner join sulibrary.books on books.book_id=orders.book_id where orders.status=2 and users.role='student';";
            $stmt = $this->__connect()->query($sql);
            if ($stmt->rowCount()) {
                $rows = $stmt->fetchAll();
                return $rows;
            } else return 0;
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __getReturnRequestCount()
    {
        try {
            $sql =  "SELECT * FROM  sulibrary.orders  where orders.status=2 ";
            $stmt = $this->__connect()->query($sql);
            return $stmt->rowCount();
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __getPendingReturns()
    {
        try {
            $sql =  "SELECT * FROM  sulibrary.orders  where orders.status=20 ";
            $stmt = $this->__connect()->query($sql);
            return $stmt->rowCount();
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __getProfessorReturnRequests()
    {
        try {
            $sql =  "SELECT * FROM  sulibrary.orders inner join sulibrary.users on orders.user_id=users.user_id inner join sulibrary.books on books.book_id=orders.book_id where orders.status=2 and users.role='professor';";
            $stmt = $this->__connect()->query($sql);
            if ($stmt->rowCount()) {
                $rows = $stmt->fetchAll();
                return $rows;
            } else return 0;
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __confirmReturn($oid)
    {
        try {
            $sql = "UPDATE sulibrary.orders SET status = 3 where id =?;;";
            $stmt = $this->__connect()->prepare($sql);
            $stmt->execute([$oid]);
            return 1;
        } catch (ErrorException $e) {
            die($e);
            return 0;
        }
    }

    public function __rejectRetun($oid)
    {
        try {
            $sql = "UPDATE sulibrary.orders SET status = 4 where id =?;;";
            $stmt = $this->__connect()->prepare($sql);
            $stmt->execute([$oid]);
            return 1;
        } catch (ErrorException $e) {
            die($e);
            return 0;
        }
    }

    public function __getStudentDetails()
    {
        try {
            $sql = "SELECT * FROM sulibrary.users where role='student'";
            $stmt = $this->__connect()->query($sql);
            if ($stmt->rowCount() > 0) {
                return $stmt->fetchAll();
            } else
                return 0;
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __getProfessorDetails()
    {
        try {
            $sql = "SELECT * FROM sulibrary.users where role='professor'";
            $stmt = $this->__connect()->query($sql);
            if ($stmt->rowCount() > 0) {
                return $stmt->fetchAll();
            } else
                return 0;
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __getStudentCardDetails($uid)
    {
        try {
            $sql = "SELECT * FROM sulibrary.users  inner join sulibrary.cards on users.user_id=  cards.user_id where users.user_id='$uid'";
            $stmt = $this->__connect()->query($sql);
            if ($stmt->rowCount() > 0) {
                return $stmt->fetchAll();
            } else
                return 0;
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __getStudentInfo($id)
    {
        try {
            $sql = "SELECT * FROM sulibrary.users where users.user_id='$id'";
            $stmt = $this->__connect()->query($sql);
            if ($stmt->rowCount() > 0) {
                $rows = $stmt->fetchAll();

                $userId = array_map(function ($a) {
                    return $a["user_id"];
                }, $rows);
                $firstname = array_map(function ($a) {
                    return $a["first_name"];
                }, $rows);
                $lastname = array_map(function ($a) {
                    return $a["last_name"];
                }, $rows);
                $course = array_map(function ($a) {
                    return $a["course"];
                }, $rows);
                $regno = array_map(function ($a) {
                    return $a["regno"];
                }, $rows);
                echo json_encode(array(
                    array('userid' => $userId, 'firstname' => $firstname, 'lastname' => $lastname, 'course' => $course, 'regno' => $regno)

                ));
            } else
                return 0;
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __getStudentDetailsById($uid)
    {
        try {
            $sql = "SELECT * FROM sulibrary.users where users.user_id='$uid'";
            $stmt = $this->__connect()->query($sql);
            if ($stmt->rowCount() > 0) {
                return $stmt->fetchAll();
            } else
                return 0;
        } catch (ErrorException $e) {
            die($e);
        }
    }
    public function __deActivateUser($uid)
    {
        try {
            $sql = "update sulibrary.users SET Isdeleted=1 where user_id='$uid'";
            $stmt = $this->__connect()->query($sql);
            if ($stmt->rowCount() > 0) {
                return 1;
            } else
                return 0;
        } catch (ErrorException $e) {
            die($e);
        }
    }
    public function __activateUser($uid)
    {
        try {
            $sql = "update sulibrary.users SET Isdeleted=0 where user_id='$uid'";
            $stmt = $this->__connect()->query($sql);
            if ($stmt->rowCount() > 0) {
                return 1;
            } else
                return 0;
        } catch (ErrorException $e) {
            die($e);
        }
    }
    public function __deleteUserDetail($uid)
    {
        try {
            $sql = "DELETE FROM sulibrary.cards where user_id='$uid'";
            $stmt = $this->__connect()->query($sql);

            $sql1 = "DELETE FROM sulibrary.users where user_id='$uid'";
            $stmt1 = $this->__connect()->query($sql1);
            if ($stmt1->rowCount() > 0) {
                return 1;
            } else
                return 0;
        } catch (ErrorException $e) {
            die($e);
        }
    }
    public function __deletePendingapproval($id, $uid)
    {
        try {
            $sql = "DELETE FROM sulibrary.pending_aproval where id='$id'";
            $stmt = $this->__connect()->query($sql);

            $sql1 = "DELETE FROM sulibrary.cards where user_id='$uid'";
            $stmt1 = $this->__connect()->query($sql1);
            if ($stmt->rowCount() > 0) {
                return 1;
            } else
                return 0;
        } catch (ErrorException $e) {
            die($e);
        }
    }
    public function __deleteCardDetail($uid, $cardnumber)
    {
        try {
            $sql = "DELETE FROM sulibrary.cards where card_number='$cardnumber' and user_id='$uid'";
            $stmt = $this->__connect()->query($sql);
            return 1;
        } catch (ErrorException $e) {
            die($e);
        }
    }
    public function __loginReportsDeatails()
    {
        try {
            $sql =  "SELECT userId,first_name,last_name,enterDateTime,outDateTime FROM  sulibrary.userlogs ul,sulibrary.users u where ul.userId=u.user_id";
            $stmt = $this->__connect()->query($sql);
            if ($stmt->rowCount()) {
                $rows = $stmt->fetchAll();
                return $rows;
            } else return 0;
        } catch (ErrorException $e) {
            die($e);
        }
    }

    
    public function __loginReportsDeatailsByLimit($startLimit, $endLimit)
    {
        try {
            $sql =  "SELECT * FROM  sulibrary.userlogs inner join sulibrary.users on userlogs.userId=users.user_id limit $startLimit,$endLimit;";
            $stmt = $this->__connect()->query($sql);
            if ($stmt->rowCount()) {
                $rows = $stmt->fetchAll();
                return $rows;
            } else return 0;
        } catch (ErrorException $e) {
            die($e);
        }
    }

    // public function __loginReportsDeatailsByLimit($startLimit, $endLimit)
    // {
    //     try {
    //         $sql =  "SELECT userId,first_name,last_name,enterDateTime,outDateTime FROM  sulibrary.userlogs JOIN sulibrary.users where userlogs.userId=users.user_id AND enterDateTime BETWEEN $startLimit AND $endLimit;";
    //         $stmt = $this->__connect()->query($sql);
    //         if ($stmt->rowCount()) {
    //             $rows = $stmt->fetchAll();
    //             return $rows;
    //         } else return 0;
    //     } catch (ErrorException $e) {
    //         die($e);
    //     }
    // }

    public function __loginReportsDeatailSearchbyLimit($startDate, $endDate)
    {
        try {
            $sql =  "SELECT * FROM  sulibrary.users inner join sulibrary.userlogs  on userlogs.userId=users.user_id and date(userlogs.enterDateTime) BETWEEN date('$startDate') AND date('$endDate')";
            $stmt = $this->__connect()->query($sql);
            if ($stmt->rowCount()) {
                $rows = $stmt->fetchAll();
                return $rows;
            } else return 0;
        } catch (ErrorException $e) {
            die($e);
        }
    }

    
    public function __issuedBookDeatails($userid)
    {
        try {
            $sql =  "SELECT * FROM  sulibrary.orders inner join sulibrary.users on orders.user_id=users.user_id inner join sulibrary.books on books.book_id=orders.book_id where orders.status=1 and users.user_id='$userid';";
            $stmt = $this->__connect()->query($sql);
            if ($stmt->rowCount()) {
                $rows = $stmt->fetchAll();
                return $rows;
            } else return 0;
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __issuedBooksCount($userid)
    {
        try {
            $sql =  "SELECT * FROM  sulibrary.orders inner join sulibrary.users on orders.user_id=users.user_id inner join sulibrary.books on books.book_id=orders.book_id where orders.status=1 and users.user_id='$userid';";
            $stmt = $this->__connect()->query($sql);
            return $stmt->rowCount();
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __reservedBoksCount($userid)
    {
        try {
            $sql =  "SELECT * FROM  sulibrary.orders inner join sulibrary.users on orders.user_id=users.user_id inner join sulibrary.books on books.book_id=orders.book_id where orders.status=5 and users.user_id='$userid';";
            $stmt = $this->__connect()->query($sql);
            return $stmt->rowCount();
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __getTotaFines($userId)
    {
        try {
            $sql =  "SELECT sum(fine) as 'total_fine' FROM  sulibrary.orders where user_id='$userId';";
            $stmt = $this->__connect()->query($sql);
            $rows = $stmt->rowCount();
            $rows = $stmt->fetchAll();
            foreach ($rows as $row) {
                return $row['total_fine'];
            }
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __getTotalCards($userId)
    {
        try {
            $sql =  "SELECT count(*) as 'total_cards'  FROM  sulibrary.cards where user_id='$userId';";
            $stmt = $this->__connect()->query($sql);
            $rows = $stmt->rowCount();
            $rows = $stmt->fetchAll();
            foreach ($rows as $row) {
                return $row['total_cards'];
            }
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __availableCards($userId)
    {
        try {
            $sql =  "SELECT count(*) as 'total_cards'  FROM  sulibrary.cards where user_id='$userId' and status = 0;";
            $stmt = $this->__connect()->query($sql);
            $rows = $stmt->rowCount();
            $rows = $stmt->fetchAll();
            foreach ($rows as $row) {
                return $row['total_cards'];
            }
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __getBooksInCart($userId)
    {
        try {
            $sql =  "SELECT *  FROM  sulibrary.cart inner join sulibrary.books on cart.book_id = books.book_id where user_id='$userId';";
            $stmt = $this->__connect()->query($sql);
            if ($stmt->rowCount()) {
                return $stmt->fetchAll();
            } else return 0;
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __addToCart($bid, $userid)
    {
        try {
            $sql = "INSERT INTO sulibrary.cart(user_id,book_id) VALUES (?,?);";
            $stmt = $this->__connect()->prepare($sql);
            $stmt->execute([$userid, $bid]);
            return 1;
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __checkWhetherAlreadyExistsInCart($bid, $userid)
    {
        try {
            $sql =  "SELECT *  FROM  sulibrary.cart where user_id='$userid' and book_id = '$bid';";
            $stmt = $this->__connect()->query($sql);
            return $stmt->rowCount();
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __removeFromCart($bid, $userid)
    {
        try {
            $sql = "DELETE FROM sulibrary.cart where book_id='$bid' and user_id='$userid'";
            $stmt = $this->__connect()->query($sql);
            return 1;
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __totalBooks()
    {
        try {
            $sql =  "SELECT * FROM  sulibrary.books where book_type='physical book';";
            $stmt = $this->__connect()->query($sql);
            return $stmt->rowCount();
        } catch (ErrorException $e) {
            die($e);
        }
    }
    public function __totaleBooks()
    {
        try {
            $sql =  "SELECT * FROM  sulibrary.books where book_type='e book';";
            $stmt = $this->__connect()->query($sql);
            return $stmt->rowCount();
        } catch (ErrorException $e) {
            die($e);
        }
    }
    public function __getDateToReserve($bookId)
    {

        $sql = "SELECT * from sulibrary.orders WHERE book_id ='$bookId' and status IN (0,1,2,4) and accession_number NOT IN(SELECT accession_number FROM sulibrary.reserved WHERE book_id='$bookId') order by return_date ASC LIMIT 1;";
        $stmt = $this->__connect()->query($sql);
        if ($stmt->rowCount()) {
            $rows = $stmt->fetchAll();
            return $rows;
        } else return 0;
    }

    public function __checkReservation($bookId, $userId)
    {
        $sql = "SELECT * FROM sulibrary.reserved WHERE book_id='$bookId' and user_id='$userId';";
        $stmt = $this->__connect()->query($sql);
        return $stmt->rowCount();
    }

    public function __reserveBook($userid, $bookid, $accession, $date, $issueDate)
    {
        try {
            $sql = "INSERT INTO sulibrary.reserved (user_id, book_id, accession_number, reservation_date, issue_date) VALUES  (?,?,?,?,?);";
            $stmt = $this->__connect()->prepare($sql);
            $stmt->execute([$userid, $bookid, $accession, $date, $issueDate]);
            return 1;
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __getUsserReservations($userId)
    {
        $sql = "SELECT * FROM sulibrary.reserved inner join sulibrary.books on reserved.book_id= books.book_id where user_id='$userId';";
        $stmt = $this->__connect()->query($sql);
        if ($stmt->rowCount()) {
            $rows = $stmt->fetchAll();
            return $rows;
        } else return 0;
    }

    public function __cancelReservation($reservationId)
    {
        try {
            $sql = "DELETE FROM sulibrary.reserved where reservation_id='$reservationId'";
            $stmt = $this->__connect()->query($sql);
            return 1;
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __getSearchResults($keywords, $search_department)
    {
        // $sql = "SELECT * FROM sulibrary.books where title like '%$keywords%' or author like  '%$keywords%' or edition like  '%$keywords%' or description like '%$keywords%' or book_department like  '%$keywords1%' or book_department like  '%$keywords%';";

        try {
            if ($keywords != "") {
                $sql = "SELECT * FROM sulibrary.books where title like '%$keywords%' or author like  '%$keywords%' or edition like  '%$keywords%' or description like '%$keywords%' or book_department like  '%$search_department%';";
            } else {
                $sql = "SELECT * FROM sulibrary.books where book_department like  '%$search_department%'";
            }
            $stmt = $this->__connect()->query($sql);
            if ($stmt->rowCount() > 0) {
                $rows = $stmt->fetchAll();
                return $rows;
            } else return 0;
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __saveFileToDatabase($file_name_new, $book_id)
    {
        try {
            $sql = "UPDATE  sulibrary.books SET pdf =? where book_id =?;";
            $stmt = $this->__connect()->prepare($sql);
            $stmt->execute([$file_name_new, $book_id]);
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __deleteBook($bookId)
    {
        try {
            $sql = "DELETE FROM sulibrary.books where book_id='$bookId'";
            $stmt = $this->__connect()->query($sql);
            return 1;
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __assignEbook($bookId, $userId)
    {
        try {
            $sql = "INSERT INTO sulibrary.books_owned(user_id, book_id) VALUES  (?,?);";
            $stmt = $this->__connect()->prepare($sql);
            $stmt->execute([$userId, $bookId]);
            return 1;
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __checkEBookExists($userId, $bookId)
    {
        try {
            $sql = "Select * From sulibrary.books_owned where user_id = '$userId' and book_id='$bookId'";
            $stmt = $this->__connect()->query($sql);
            return $stmt->rowCount();
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __getUserEBooks($userId)
    {
        try {
            $sql = "Select * From sulibrary.books_owned inner join sulibrary.books on books_owned.book_id=books.book_id where user_id = '$userId'";
            $stmt = $this->__connect()->query($sql);
            if ($stmt->rowCount() > 0) {
                $rows = $stmt->fetchAll();
                return $rows;
            } else return 0;
        } catch (ErrorException $e) {
            die($e);
        }
    }


    public function __getUserPDFBooks($userId)
    {
        try {
            $sql = "Select * From sulibrary.books_owned inner join sulibrary.books on books_owned.book_id=books.book_id where  book_type='PDF Books' and user_id = '$userId'";
            $stmt = $this->__connect()->query($sql);
            if ($stmt->rowCount() > 0) {
                $rows = $stmt->fetchAll();
                return $rows;
            } else return 0;
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __getUserQuestionPaperBooks($userId)
    {
        try {
            $sql = "Select * From sulibrary.books_owned inner join sulibrary.books on books_owned.book_id=books.book_id where  book_type='Question Paper' and user_id = '$userId'";
            $stmt = $this->__connect()->query($sql);
            if ($stmt->rowCount() > 0) {
                $rows = $stmt->fetchAll();
                return $rows;
            } else return 0;
        } catch (ErrorException $e) {
            die($e);
        }
    }
    public function __getUserStudyMaterialBooks($userId)
    {
        try {
            $sql = "Select * From sulibrary.books_owned inner join sulibrary.books on books_owned.book_id=books.book_id where  book_type='Study Material' and user_id = '$userId'";
            $stmt = $this->__connect()->query($sql);
            if ($stmt->rowCount() > 0) {
                $rows = $stmt->fetchAll();
                return $rows;
            } else return 0;
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __removeEbook($bookId, $userId)
    {
        try {
            $sql = "DELETE FROM sulibrary.books_owned where book_id='$bookId' and user_id='$userId'";
            $stmt = $this->__connect()->query($sql);
            return 1;
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __fetchProfessor($username, $password)
    {
        $sql = "SELECT * FROM sulibrary.professor where username='$username' and password ='$password' ";
        $stmt = $this->__connect()->query($sql);
        return $stmt;
    }

    public function __oderReservedBooks()
    {
    }

    public function __expireAccount($userId)
    {
        try {
            $sql = "UPDATE  sulibrary.users SET status =1 where user_id =?;";
            $stmt = $this->__connect()->prepare($sql);
            $stmt->execute([$userId]);
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __isExpired($userid)
    {
        try {
            if (isset($_SESSION['user_id'])) {
                $sql = "SELECT * FROM sulibrary.users where staus=1 and user_id='$userid' ;";
                $stmt = $this->__connect()->query($sql);
                if ($stmt->rowCount()) {
                    return 1;
                } else
                    return 0;
            } else return -1;
        } catch (PDOException $ex) {
            return -1;
        }
    }

    public function __getPendingOrdersAprovals()
    {
        try {
            $sql =  "SELECT * FROM  sulibrary.orders inner join sulibrary.users on orders.user_id=users.user_id inner join sulibrary.books on books.book_id=orders.book_id where orders.status=1;";
            $stmt = $this->__connect()->query($sql);
            if ($stmt->rowCount()) {
                $rows = $stmt->fetchAll();
                return $rows;
            } else return 0;
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __assignOrder($aid)
    {
        try {
            $sql = "UPDATE  sulibrary.orders SET status =20 where id =?;";
            $stmt = $this->__connect()->prepare($sql);
            $stmt->execute([$aid]);
            return 1;
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __cancelOrder($aid)
    {
        try {
            $sql = "UPDATE  sulibrary.orders SET status =-1 where id =?;";
            $stmt = $this->__connect()->prepare($sql);
            $stmt->execute([$aid]);
            return 1;
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __getAccessioFromOrder($rejectId)
    {
        try {
            $sql =  "SELECT * FROM  sulibrary.orders  where order_id='$rejectId'";
            $stmt = $this->__connect()->query($sql);
            if ($stmt->rowCount()) {
                $rows = $stmt->fetchAll();
                foreach ($rows as $row) {
                    return  $row['accession_number'];
                }
            } else return 0;
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __setAccessionStatusToZero($accession)
    {
        try {
            $sql = "UPDATE  sulibrary.accession_details SET status=0 where accession_number=?;";
            $stmt = $this->__connect()->prepare($sql);
            $stmt->execute([$accession]);
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __getCardNumberFromOrder($rejectId)
    {
        try {
            $sql =  "SELECT * FROM  sulibrary.orders  where order_id='$rejectId'";
            $stmt = $this->__connect()->query($sql);
            if ($stmt->rowCount()) {
                $rows = $stmt->fetchAll();
                foreach ($rows as $row) {
                    return  $row['card_number'];
                }
            } else return 0;
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __setCardStatustoZero($cardnumber)
    {
        try {
            $sql = "UPDATE  sulibrary.cards SET status =0 where card_number =?;";
            $stmt = $this->__connect()->prepare($sql);
            $stmt->execute([$cardnumber]);
        } catch (ErrorException $e) {
            die($e);
        }
    }

    public function __getUserRole($userid)
    {
        try {
            $sql =  "SELECT * FROM  sulibrary.users  where user_id='$userid'";
            $stmt = $this->__connect()->query($sql);
            if ($stmt->rowCount()) {
                $rows = $stmt->fetchAll();
                foreach ($rows as $row) {
                    return  $row['role'];
                }
            } else return 0;
        } catch (ErrorException $e) {
            die($e);
        }
    }
}
