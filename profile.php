<?php include_once 'header.php' ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<style>
  .active5 a {
    color: #e96b56 !important;
  }

  .active55 a,
  .active54 a,
  .active52 a,
  .active53 a {
    color: #545454 !important;
  }

  * {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
  }

  body {
    background: white;
  }

  /* .login-page{
        justify-content:center;
        align-items:center;
    }
    .login-page-row{
        background:white;
        border-radius:30px;
        box-shadow:12px 12px 22px grey;
        
    } */
  .accounts-row {
    margin: 20px;
    background: white;
    border-radius: 10px;
    box-shadow: 0px 5px 25px 0px rgba(0, 0, 0, 0.2);
  }

  .accounts-img-logo {
    border-radius: 5px;
    margin: 10px auto 0px;
  }

  .accounts-logo {
    margin: 0 auto;
    height:20vh;
    width:15vw;
  }

  .accounts-img-row {
    background-image: linear-gradient(to right top, #167c97, #006c97, #005b95, #00498f, #003484, #2d2d86, #472385, #5e0f81, #860a8c, #ad0194, #d30099, #f9049a);
    background-size: cover;
    position: relative;
    text-align: center;
    color: white;
  }

  .accounts-logo img {
    width: 100%;
    height: 100%;
  }

  .accounts-img-row h3 {
    padding: 30px 0 10px 0;
  }

  .accounts-img-row h4 {
    font-size: 20px;
    padding: 10px 0 10px 0;
  }

  .accounts-img-row h5 {
    font-size: 20px;
  }

  .accounts-head {
    padding: 40px 0 20px 0;
    font-weight: bold;
  }

  .login-btn:hover {
    background: #ff7e54 !important;
    ;
    color: white;
    border: 1px solid;
  }

  .login-forgot {
    margin: 20px 0 10px 0;
    display: flex;
    justify-content: space-between;
  }

  .login-forgot a:hover {
    color: blue;
    text-decoration: underline;
  }

  p a:hover {
    color: blue;
    text-decoration: underline;
  }

  @media (max-width: 1050px) {
    .accounts-logo {
      margin: 0 auto;
      width: 200px;
    }
  }

  @media (max-width: 425px) {
    .login-forgot {
      display: block;
    }
  }
</style>
<style>
  a {
    color: #f96332;
  }

  a:hover,
  a:focus {
    color: #f96332;
  }

  p {
    line-height: 1.61em;
    font-weight: 300;
    font-size: 1.2em;
  }


  .nav-item .nav-link,
  .nav-tabs .nav-link {
    -webkit-transition: all 300ms ease 0s;
    -moz-transition: all 300ms ease 0s;
    -o-transition: all 300ms ease 0s;
    -ms-transition: all 300ms ease 0s;
    transition: all 300ms ease 0s;
  }

  .acccount-card a {
    -webkit-transition: all 150ms ease 0s;
    -moz-transition: all 150ms ease 0s;
    -o-transition: all 150ms ease 0s;
    -ms-transition: all 150ms ease 0s;
    transition: all 150ms ease 0s;
  }

  .nav-tabs {
    border: 0;
    padding: 15px 0.7rem;
  }

  .nav-tabs:not(.nav-tabs-neutral)>.nav-item>.nav-link.active {
    box-shadow: 0px 5px 35px 0px rgba(0, 0, 0, 0.3);
  }

  .card .nav-tabs {
    border-top-right-radius: 0.1875rem;
    border-top-left-radius: 0.1875rem;
  }

  .nav-tabs>.nav-item>.nav-link {
    color: #888888;
    margin: 0;
    margin-right: 5px;
    background-color: transparent;
    border: 1px solid transparent;
    border-radius: 30px;
    font-size: 14px;
    padding: 11px 23px;
    line-height: 1.5;
  }

  .nav-tabs>.nav-item>.nav-link:hover {
    background-color: transparent;
  }

  .nav-tabs>.nav-item>.nav-link.active {
    background-color: #444;
    border-radius: 30px;
    color: #FFFFFF;
  }


  .acccount-card {
    border: 0;
    border-radius: 0.1875rem;
    display: inline-block;
    position: relative;
    width: 100%;
    margin-bottom: 30px;
  }

  .acccount-card .acccount-card-header {
    background-color: transparent;
    border-bottom: 0;
    background-color: transparent;
    border-radius: 0;
    padding: 0;
  }


  @media screen and (max-width: 768px) {

    .nav-tabs {
      display: flex;
      width: auto;
      text-align: center;
    }

    .nav-tabs .nav-item>.nav-link {
      margin-bottom: 5px;
    }
  }


  /*--------------------------------------------------------------
# activities
--------------------------------------------------------------*/
  .activities {
    padding: 20px 20px 0;
  }

  .activities .activities-box {
    box-shadow: -10px -5px 40px 0 rgba(0, 0, 0, 0.1);
    padding: 50px 30px 30px 30px;
    width: 100%;
    margin-bottom: 20px;
    text-align: center;
  }

  /* .counts .count-box i {
  display: block;
  font-size: 30px;
  color: #e96b56;
  float: left;
} */

  .activities .activities-box .cicon {
    height: 60px;
    text-align: center;
    margin-bottom: 10px;
  }

  .activities .activities-box span {
    font-size: 42px;
    line-height: 20px;
    display: block;
    font-weight: 700;
    color: white;
  }

  .activities .activities-box p {
    padding: 30px 0 0 0;
    margin: 0;
    font-family: "Raleway", sans-serif;
    font-size: 14px;
    color: white;
  }

  @media (max-width: 768px) {
    .activities {
      padding-left: 20px;
      padding-right: 20px;
    }

    .activities .activities-box {
      box-shadow: -10px -5px 40px 0 rgba(0, 0, 0, 0.1);
      width: 100%;
      padding: 15px;
      margin-bottom: 20px;
      text-align: center;
    }

    .activities .activities-box span {
      font-size: 30px;
      line-height: 18px;
    }

    .activities .activities-box p {
      padding: 30px 0 0 0;
      margin: 0;
      font-family: "Raleway", sans-serif;
      font-size: 10px;
    }
  }

  /*--------------------------------------------------------------
# table responsive
--------------------------------------------------------------*/

  table {
    margin-top: 20px;
    font-family: sans-serif;
    border-collapse: collapse;
    width: 100%;
    justify-content: center;
  }

  th {
    background-color: #2a2464;
    color: #fff;
  }

  th,
  td {
    padding: .8rem;
    font-size: 14px;
  }

  tbody {
    color: #555;
  }

  tr:nth-child(odd) {
    background-color: #ccb7cf;
  }

  tr:nth-child(even) {
    background-color: #e5b0edb0;
  }

  .isbkreturn {
    transition: 0.4s;
    padding: 10px;
    width: 100%;
    text-align: center;
    background: #545454;
    color: #fff;
    border-radius: 5px;
    border: none;
  }

  .isbkreturn:hover {
    background: #e96b56;
    color: #fff;
  }

  .icon {
    font-size: 18px;
    display: inline-block;
    background: #545454;
    color: #fff;
    line-height: 1;
    padding: 8px 0;
    margin-right: 4px;
    border-radius: 50%;
    text-align: center;
    width: 36px;
    height: 36px;
    transition: 0.3s;
  }

  .icon i {
    color: white;
  }

  .icon:hover {
    background: #e96b56;
    color: #fff;
    text-decoration: none;
  }

  @media screen and (max-width: 600px) {
    thead {
      display: none;
    }

    tr {
      margin-top: 20px;
      clear: both !important;
      ;
      box-shadow: 0px 5px 25px 0px rgba(0, 0, 0, 0.2);
    }

    td {
      display: block;
      padding: .5rem;
      font-size: 10px;
    }

    td:first-child {
      background-color: #333;
      color: #fff;
      text-align: center;
    }


    .icard_number::before {
      content: "Card no";
    }

    .iorder_date::before {
      content: "Issued Date";
    }

    .ireturn_date::before {
      content: "Return date";
    }

    .ifine::before {
      content: "Fines";
    }

    .rauthor::before {
      content: "Author";
    }

    .raccession::before {
      content: "Accession no";
    }

    .rreservationDate::before {
      content: "Reserved Date";
    }

    .rissueDate::before {
      content: "Issue date";
    }

    .eauthor::before {
      content: "Author";
    }

    .eedition::before {
      content: "Edition";
    }

    .ebook_department::before {
      content: "Department";
    }

    .seauthor::before {
      content: "Professor";
    }
    .qeauthor::before {
      content: "University Name";
    }

    .qedition::before {
      content: "Year";
    }

    td {
      text-align: right;
    }

    td::before {
      float: left;
      margin-right: 3rem;
      font-weight: bold;
    }
  }

  .profile-pic {
    border-radius: 50%;
    height: 150px;
    width: 150px;
    background-size: cover;
    background-position: center;
    background-blend-mode: multiply;
    vertical-align: middle;
    text-align: center;
    color: transparent;
    transition: all .3s ease;
    text-decoration: none;
    cursor: pointer;
  }

  .profile-pic:hover {
    background-color: rgba(0, 0, 0, .5);
    z-index: 10000;
    color: #fff;
    transition: all .3s ease;
    text-decoration: none;
  }

  .profile-pic .chimage {
    display: inline-block;
    padding-top: 4.5em;
    padding-bottom: 4.5em;
  }

  form input[type="file"] {
    display: none;
    cursor: pointer;
  }

  /* .edit{
   padding:10px;
   background:#6664648a;
   border-radius:20px;
   margin-bottom:10px;
   color:white;
 }
 .edit:hover{
   background:#b598988a;
   color:white;
 } */

  /*--------------------------------------------------------------
# Breadcrumbs
--------------------------------------------------------------*/
  .breadcrumbs {
    padding: 15px 0;
  }

  .breadcrumbs h2 {
    font-size: 28px;
    font-weight: 500;
  }

  .breadcrumbs ol {
    display: flex;
    flex-wrap: wrap;
    list-style: none;
    padding: 0 0 10px 0;
    margin: 0;
    font-size: 14px;
    cursor: pointer;
  }

  .breadcrumbs ol li+li {
    padding-left: 10px;
  }

  .breadcrumbs ol li+li::before {
    display: inline-block;
    padding-right: 10px;
    color: #635551;
    content: "/";
  }
</style>
<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs">
  <div class="container">
    <ol>
      <li><a href="index1.php">Home</a></li>
      <li style="cursor:text;">My Account</li>
      <li style="cursor:text;">Profile</li>
  </div>
</section><!-- End Breadcrumbs -->
<secction class="accounts my-5 pb-5">
  <?php
  if (isset($_SESSION['user_id'])) {
  } else {
    header("Location: login.php");
  } ?>
  <div class="row no-gutters pb-5" x-data="profile">
    <div class="col-lg-12 accounts-page-row">
      <div class="row accounts-row">
        <div class="col-lg-3 col-md-4 accounts-img-row no-gutters">
          <div class="form-row">
            <div class="col-lg-12 col-md-12 text-center">
              <h3 style="  font-family: sans-serif;">My Info</h3>
            </div>
          </div>
          <div class="form-row">
            <div class="col-lg-12 col-md-12">
              <div class="accounts-img-logo">
                <div class="accounts-logo">
                  <img x-bind:src="imgUrl" class="rounded-circle" alt="Upload Your Photo">
                </div>
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-lg-12 col-md-12 text-center">
              <?php
              $daysLeftToExpiry = "";
              $userId = $_SESSION['user_id'];
              $role = "";
              $userDetails = (new dbhelper)->__getUserRecords();
              if ($userDetails != 0) {

                foreach ($userDetails as $user) {
                  $role = $user['role'];
                  function dateDiff($cin, $cout)
                  {
                    $date1_ts = strtotime($cin);
                    $date2_ts = strtotime($cout);
                    $diff = $date2_ts - $date1_ts;
                    return abs(round($diff / 86400));
                  }
                  $expdate = $user['exipry_date'];
                  $date = date('Y-m-d');
                  $daysLeftToExpiry = dateDiff($date, $expdate);

              ?>
              <?php
                }
              }

              $isPending = (new dbhelper)->__isUserAprovalPending();
              $verificationStaus = "";
              $color = "";
              $icon = "";
              if ($isPending == 1) {
                $verificationStaus = "Verification pending by librarian!!";
                $color = "blue";
                $icon = "fa-warning";
              } else {
                $verificationStaus = "Aproved By Librarian";
                $color = "green";
                $icon = "fa-check-circle-o";
              }
              if ($daysLeftToExpiry <= 0) {
                (new dbhelper)->__expireAccount($userId);
                $verificationStaus = "Account Expired";
                $color = "red";
                $icon = "fa-warning";
              }
              ?>
              <h4 style="  font-family: sans-serif;         text-transform: uppercase;"><?php echo $user['first_name'];
                  echo "&nbsp;";
                  echo $user['last_name']; ?><br><?php echo $user['regno'] ?><br><?php echo $user['course']; ?><br><?php echo $user['phone'];  ?><br><?php echo $user['email'];  ?></h4>
              <h5>Status:&nbsp;&nbsp;<i class="fa <?php echo $icon ?>"><?php echo $verificationStaus ?> </i></h5>
              <!-- <a class="nav-link edit" data-toggle="tab" href="#profile" role="tablist" class="edit"><strong>Edit Your Profile</strong></a> -->
            </div>
          </div>
        </div>
        <div class="col-lg-9 col-md-8 col-sm-12 col-12 accounts-page">
          <div class="col-lg-12 col-md-12 col-sm-12 col-12">

            <div class="acccount-card">
              <div class="acccount-card-header">
                <ul class="nav nav-tabs justify-content-center" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#Activities" role="tab">Activities</a>
                  </li>
                  <!-- hide strat -->
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#Ematerials" role="tab">E materials</a>
                  </li>
                  <!-- hide end -->
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#PDFBooks" role="tab">PDF Books</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#StudyMaterial" role="tab">Study Meterial</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#QuestionPaper" role="tab">Question Paper</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#profile" role="tab">Edit Your Profile</a>
                  </li>
                </ul>
              </div>
              <div class="acccount-card-body">
                <!-- Tab panes -->
                <div class="tab-content text-center">
                  <div class="tab-pane active" id="Activities" role="tabpanel">
                    <!-- ======= Counts Section ======= -->
                    <section id="counts" class="activities section-bg">

                      <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-5 d-md-flex align-items-md-stretch">
                          <div class="activities-box" style="background:#09446E">
                            <img class="cicon" src="assets/icon/pdfbook.png" alt="">
                            <span data-toggle="counter-up"><?php
                                                           $userEBooks = (new dbhelper)->__getUserPDFBooks($userId);
                                                           $p = 0;
                                                           if ($userEBooks != 0) {

                                                             foreach ($userEBooks as $row) {
                                                               $p++;
                                                             }
                                                           }
                                                           ?><?php echo $p ?></span>
                            <p> <strong>PDF Books</strong></p>
                          </div>
                        </div>

                        <div class="col-lg-4 col-md-5 d-md-flex align-items-md-stretch">
                          <div class="activities-box" style="background:#0065FF">
                            <img class="cicon" src="assets/icon/studymeterial.png" alt="">
                            <span data-toggle="counter-up">
                            <?php
                                                    $userEBooks = (new dbhelper)->__getUserStudyMaterialBooks($userId);
                                                           $s = 0;
                                                           if ($userEBooks != 0) {

                                                             foreach ($userEBooks as $row) {
                                                               $s++;
                                                             }
                                                           }
                                                           ?><?php echo $s ?></span>
                            <p><strong>Study Meterial</strong></p>
                          </div>
                        </div>

                        <div class="col-lg-4 col-md-5 d-md-flex align-items-md-stretch">
                          <div class="activities-box" style="background:#FF562F">
                            <img class="cicon" src="assets/icon/questionpaper.png" alt="">
                            <span data-toggle="counter-up"><?php
                                                            $userEBooks = (new dbhelper)->__getUserQuestionPaperBooks($userId);
                                                            $q = 0;
                                                            if ($userEBooks != 0) {
 
                                                              foreach ($userEBooks as $row) {
                                                                $q++;
                                                              }
                                                            }
                                                            ?><?php echo $q ?></span>
                            <p><strong>Question Paper</strong></p>
                          </div>
                        </div>
<!-- hide strat -->
                        <div class="col-lg-4 col-md-5 d-md-flex align-items-md-stretch">
                          <div class="activities-box" style="background:#37B37F">
                            <img class="cicon" src="assets/icon/ebook.png" alt="">
                            <span data-toggle="counter-up"><?php
                                                            $userEBooks = (new dbhelper)->__getUserEBooks($userId);
                                                            $i = 0;
                                                            if ($userEBooks != 0) {

                                                              foreach ($userEBooks as $row) {
                                                                $i++;
                                                              }
                                                            }
                                                            ?><?php echo $i ?></span>
                            <p><strong>E Materials</strong></p>
                          </div>
                        </div>

                        

                        <div class="col-lg-4 col-md-5 d-md-flex align-items-md-stretch">
                          <div class="activities-box" style="background:#6553BF">
                            <img class="cicon" src="assets/icon/tcard.png" alt="">
                            <span data-toggle="counter-up"><?php
                                                            $totalCards = (new dbhelper)->__getTotalCards($userId);
                                                            ?><?php echo $totalCards ?></span>
                            <p><strong>Total Library Card</strong></p>
                          </div>
                        </div>

                        <div class="col-lg-4 col-md-5 d-md-flex align-items-md-stretch">
                          <div class="activities-box" style="background:#13B5A6">
                            <img class="cicon" src="assets/icon/available.png" alt="">
                            <span data-toggle="counter-up"><?php
                                                            $availableCards = (new dbhelper)->__availableCards($userId);
                                                            ?><?php echo $availableCards ?></span>
                            <p><strong>Available Library Card</strong></p>
                          </div>
                        </div>
                        <!-- hide end -->
                      </div>
                    </section><!-- End Counts Section -->
                  </div>

                  <div class="tab-pane" id="Ematerials" role="tabpanel">
                    <table>
                      <thead>
                        <tr>
                          <th>Book</th>
                          <th>Author</th>
                          <th>Edition</th>
                          <th>Department</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $userEBooks = (new dbhelper)->__getUserEBooks($userId);
                        if ($userEBooks != 0) {
                          $i = 0;
                          foreach ($userEBooks as $row) {
                        ?>
                            <tr>
                              <td><strong><?php echo $row['title']; ?></td>
                              <td class="eauthor"><?php echo $row['author']; ?></td>
                              <td class="eedition"><?php echo $row['edition']; ?></td>
                              <td class="ebook_department"><?php echo $row['book_department']; ?></td>
                              <td class="icon-btn">
                              <?php if ($row['book_type'] == "e book") { ?>
                                  <a href="e-read.php?pdf=<?php echo $row['pdf']; ?>" class="icon mt-1"><i class="icofont-eye"></i></a>
                                <?php } ?>
                                <a onclick="removeEbook( <?php echo $row['book_id']; ?> , <?php echo $userId ?>)" class="icon mt-1"><i class="icofont-ui-delete"></i></a>
                            </tr>
                        <?php
                          }
                        } ?>
                      </tbody>
                    </table>
                  </div>
                  <div class="tab-pane" id="PDFBooks" role="tabpanel">
                    <table>
                      <thead>
                        <tr>
                          <th>Book</th>
                          <th>Author</th>
                          <th>Edition</th>
                          <th>Department</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $userEBooks = (new dbhelper)-> __getUserPDFBooks($userId);
                        if ($userEBooks != 0) {
                          $i = 0;
                          foreach ($userEBooks as $row) {
                        ?>
                            <tr>
                              <td><strong><?php echo $row['title']; ?></td>
                              <td class="eauthor"><?php echo $row['author']; ?></td>
                              <td class="eedition"><?php echo $row['edition']; ?></td>
                              <td class="ebook_department"><?php echo $row['book_department']; ?></td>
                              <td class="icon-btn">
                              <?php if ($row['book_type'] == "PDF Books") {
                                ?>
                                  <a href="e-read.php?pdf=<?php echo $row['pdf']; ?>" class="icon mt-1"><i class="icofont-eye"></i></a>
                                <?php }?>
                                <a onclick="removeEbook( <?php echo $row['book_id']; ?> , <?php echo $userId ?>)" class="icon mt-1"><i class="icofont-ui-delete"></i></a>
                            </tr>
                        <?php
                          }
                        } ?>
                      </tbody>
                    </table>
                  </div>
                  <div class="tab-pane" id="StudyMaterial" role="tabpanel">
                    <table>
                      <thead>
                        <tr>
                          <th>Book</th>
                          <th>Professor</th>
                          <th>Edition</th>
                          <th>Department</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $userEBooks = (new dbhelper)->__getUserStudyMaterialBooks($userId);
                        if ($userEBooks != 0) {
                          $i = 0;
                          foreach ($userEBooks as $row) {
                        ?>
                            <tr>
                              <td><strong><?php echo $row['title']; ?></td>
                              <td class="seauthor"><?php echo $row['author']; ?></td>
                              <td class="eedition"><?php echo $row['edition']; ?></td>
                              <td class="ebook_department"><?php echo $row['book_department']; ?></td>
                              <td class="icon-btn">
                              <?php if ($row['book_type'] == "Study Material") {
                                ?>
                                  <a href="e-read.php?pdf=<?php echo $row['pdf']; ?>" class="icon mt-1"><i class="icofont-eye"></i></a>
                                <?php }  ?>
                                <a onclick="removeEbook( <?php echo $row['book_id']; ?> , <?php echo $userId ?>)" class="icon mt-1"><i class="icofont-ui-delete"></i></a>
                            </tr>
                        <?php
                          }
                        } ?>
                      </tbody>
                    </table>
                  </div>
                  <div class="tab-pane" id="QuestionPaper" role="tabpanel">
                    <table>
                      <thead>
                        <tr>
                          <th>Book Name</th>
                          <th>University Name</th>
                          <th>Year</th>
                          <th>Department</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $userEBooks = (new dbhelper)->__getUserQuestionPaperBooks($userId);
                        if ($userEBooks != 0) {
                          $i = 0;
                          foreach ($userEBooks as $row) {
                        ?>
                            <tr>
                              <td><strong><?php echo $row['title']; ?></td>
                              <td class="qeauthor"><?php echo $row['author']; ?></td>
                              <td class="qedition"><?php echo $row['edition']; ?></td>
                              <td class="ebook_department"><?php echo $row['book_department']; ?></td>
                              <td class="icon-btn">
                              <?php if ($row['book_type'] == "Question Paper") {
                                ?>
                                  <a href="e-read.php?pdf=<?php echo $row['pdf']; ?>" class="icon mt-1"><i class="icofont-eye"></i></a>
                                <?php } ?>
                                <a onclick="removeEbook( <?php echo $row['book_id']; ?> , <?php echo $userId ?>)" class="icon mt-1"><i class="icofont-ui-delete"></i></a>
                            </tr>
                        <?php
                          }
                        } ?>
                      </tbody>
                    </table>
                  </div>
                  <div class="tab-pane" id="profile" role="tabpanel">
                    <!-- ======= Contact Section ======= -->
                    <section id="contact" class="contact">
                      <div class="container" data-aos="fade-up">
                        <div class="row mt-5">
                          <div class="col-lg-12 mt-5 mt-lg-0">

                            <form action="" method="post">
                              <?php

                              $userDetails = (new dbhelper)->__getUserRecords();
                              if ($userDetails != 0) {

                                foreach ($userDetails as $user) {
                              ?>
                                  <div class="form-group">
                                    <label for="fileUpload" x-on:click="fileOpen">
                                      <div class="profile-pic shadow" x-bind:style="'background-image: url('+imgUrl+');'">
                                        <span class="glyphicon glyphicon-camera"></span>
                                        <span class="chimage">Change Image</span>
                                      </div>
                                    </label>
                                    <input type="file" name="fileToUpload" id="fileToUpload" x-on:change="assignUrl">
                                  </div>
                                  <input type="hidden" class="form-control" name="photo" id="photo" value="<?php echo $user['photo'] ?>" />
                                  <input type="hidden" class="form-control" name="user_id" id="user_id" value="<?php echo $user['user_id'] ?>" />

                                  <div class="form-row" style="text-align:start!important">
                                    <div class="col-md-6 form-group">
                                      <input type="text" name="fname" class="form-control" id="fname" placeholder="First Name" data-rule="minlen:4" data-msg="Please Enter at least 4 chars" value="<?php echo $user['first_name'] ?>" />
                                      <label id="lblfname" style="color:red"></label>
                                    </div>
                                    <div class="col-md-6 form-group">
                                      <input type="text" class="form-control" name="name" id="lname" placeholder="Last Name" data-rule="minlen:1" data-msg="Please Enter Last Name" value="<?php echo $user['last_name'] ?>" />
                                      <label id="lbllname" style="color:red"></label>
                                    </div>
                                  </div>
                                  <div class="form-row" style="text-align:start!important">
                                    <div class="col-md-6 form-group">
                                      <input type="number" name="phone" class="form-control" id="phone" placeholder="Phone Number" data-rule="minlen:10" data-msg="Please Enter valid number" value="<?php echo $user['phone'] ?>" />
                                      <label id="lblphone" style="color:red"></label>
                                    </div>
                                    <div class="col-md-6 form-group">
                                      <input type="hidden" class="form-control" name="existingemail" id="existingemail" value="<?php echo $user['email'] ?>" />

                                      <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please Enter a valid email" value="<?php echo $user['email'] ?>" />
                                      <label id="lblemail" style="color:red"></label>
                                    </div>
                                  </div>
                                  <div class="form-group" style="text-align:start!important">
                                    <input type="text" class="form-control" name="regno" id="regno" placeholder="Register Number" data-rule="minlen:0" data-msg="Please Enter Register Number" value="<?php echo $user['regno'] ?>" />
                                    <label id="lblregno" style="color:red"></label>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-5 col-4"></div>
                                    <div class="col-md-2 col-4">
                                      <button type="button" class="btn btn-primary btn-block" x-on:click="submit">Save</button>
                                    </div>
                                    <div class="col-md-5 col-4"></div>
                                  </div>
                              <?php }
                              } ?>
                            </form>

                          </div>

                        </div>

                      </div>
                    </section><!-- End Contact Section -->
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
    </div>
  </div>
  </div>
</secction>

<script>
  let profile = () => {
    return {
      imgUrl: "images/user.png",
      init() {
        this.photoLoad();
      },
      photoLoad() {
        var photo = $("#photo").val();
        if (photo != "") {
          this.imgUrl = "data:image/jpg;base64," + photo;
        } else {
          this.imgUrl = "images/user.png";
        }
      },
      fileOpen() {
        $("#fileToUpload").click();
      },
      assignUrl() {
        var image = document.getElementById("fileToUpload");
        this.imgUrl = URL.createObjectURL(image.files[0]);
      },
      validate() {
        let valid = true;
        let fname = document.getElementById("fname").value;
        let lname = document.getElementById("lname").value;
        let phone = document.getElementById("phone").value;
        let email = document.getElementById("email").value;
        let regno = document.getElementById("regno").value;
        let existEmail = document.getElementById("existingemail").value;
        if (fname == "") {
          document.getElementById("lblfname").innerHTML = "First Name is required";
          valid = false;
        }
        if (lname == "") {
          document.getElementById("lbllname").innerHTML = "Last Name is required";
          valid = false;
        }
        if (phone == "") {
          document.getElementById("lblphone").innerHTML = "Phone is required";
          valid = false;
        }
        if (email == "") {
          document.getElementById("lblemail").innerHTML = "Email is required";
          valid = false;
        }
        if (regno == "") {
          document.getElementById("lblregno").innerHTML = "Regno is required";
          valid = false;
        }
        if (email != existEmail) {
          $.ajax({
            url: 'dbHelper/profile.php',
            type: 'POST',
            data: {
              action: "checkEmailExist",
              email: email,
            },
            success: function(response) {

              if (response == 1) {
                valid = false;
                swal({
                  title: "OPPS!!",
                  text: "Email already used",
                  type: "warning",
                });
              } else {
                valid = true;
              }
            }
          });
        }
        if (valid) {
          return true;
        } else {
          return false;
        }
      },
      submit() {
        var image = document.getElementById("fileToUpload");
        var valid = this.validate();
        let base64 = "";
        if (valid) {
          let fname = document.getElementById("fname").value;
          let lname = document.getElementById("lname").value;
          let phone = document.getElementById("phone").value;
          let email = document.getElementById("email").value;
          let regno = document.getElementById("regno").value;
          let user_id = document.getElementById("user_id").value;
          const update = (data) => {
            if (image != null) {
              var reader = new FileReader();

              reader.onload = (function(image) {
                return function(e) {
                  var binaryData = e.target.result;
                  var base64String = window.btoa(binaryData);
                  var data = {
                    action: "update",
                    user_id: user_id,
                    email: email,
                    fname: fname,
                    lname: lname,
                    phone: phone,
                    regno: regno,
                    image: base64String
                  };
                  $.ajax({
                    url: 'dbHelper/profile.php',
                    type: 'POST',
                    data: data,
                    success: function(response) {
                      if (response == 1) {
                        swal({
                          title: "Successfull",
                          text: "Profile Updatd succssfully",
                          type: "success",

                        }, function() {
                          location.reload();
                        });
                      } else {
                        swal({
                          title: "OPPS!!",
                          text: "Failed update please try again",
                          type: "warning",
                        });
                      }
                    }
                  });
                };
              })(image.files[0]);
              reader.readAsBinaryString(image.files[0]);
            } else {
              $.ajax({
                url: 'dbHelper/profile.php',
                type: 'POST',
                data: {
                  action: "update",
                  user_id: user_id,
                  email: email,
                  fname: fname,
                  lname: lname,
                  phone: phone,
                  regno: regno,
                  image: ""
                },
                success: function(response) {
                  if (response == 1) {
                    swal({
                      title: "Successfull",
                      text: "Profile Updatd succssfully",
                      type: "success",

                    }, function() {
                      location.reload();
                    });
                  }

                }
              });
            }
          }
          if (image.files.length > 0) {
            if (image.files[0].size < 1048576) {
              update();
            } else {
              swal({
                title: "OPPS!!",
                text: "File size should be less than 1MB",
                type: "warning",
              });
            }
          } else {
            image = null;
            update();
          }

        }
      }

    }
  }

  function requestReturn(orderId, accession) {
    // alert(orderId +' ,'+ accession)
    swal({
      title: "confirmation",
      text: "Do you want to Request Return for this ?",
      type: "info",
      showCancelButton: true

    }, function() {
      $.ajax({
        url: 'dbHelper/processReturn.php',
        type: 'post',
        data: {
          'accession': accession,
          'orderId': orderId
        },
        success: function(response) {
          var result = $.trim(response);

          if (result === "0") {
            swal({
              title: "Failed",
              text: "Return Request Faled",
              type: "warning",

            });
          } else if (result === "1") {
            swal({
              title: "Return Requested",
              text: "Return Request Successfully placed",
              type: "success",

            }, function() {
              location.reload();
            });
          }
        }
      });

    });


  }

  function removeEbook(bookId, userId) {
    swal({
      title: "confirmation",
      text: "Do you want to Remove this book ?",
      type: "info",
      showCancelButton: true

    }, function() {
      $.ajax({
        url: 'dbHelper/removeEBook.php',
        type: 'post',
        data: {
          'bookId': bookId,
          'userId': userId
        },
        success: function(response) {
          var result = $.trim(response);

          if (result === "0") {
            swal({
              title: "Failed",
              text: "Remove Failed",
              type: "warning",

            });
          } else if (result === "1") {
            swal({
              title: "Removed",
              text: "E Book Removed From Profile",
              type: "success",

            }, function() {
              location.reload();
            });
          }
        }
      });

    });
  }
</script>

<script>
  window.onload = () => {
    $('#summery-tab').click();
  }

  $(document).ready(function() {


    $(".selectProfileImg").click(function() {
      $("#imageUpload").click()
    });

    function fasterPreview(uploader) {
      if (uploader.files && uploader.files[0]) {
        $('#profilepic__image').attr('src',
          window.URL.createObjectURL(uploader.files[0]));
      }
    }

    $("#imageUpload").change(function() {
      fasterPreview(this);
    });

  });


  function cancelReservation(reservationId) {
    swal({
      title: "confirmation",
      text: "Do you want to Cancel this Reservation ?",
      type: "info",
      showCancelButton: true

    }, function() {
      $.ajax({
        url: 'dbHelper/cancelReservation.php',
        type: 'post',
        data: {
          'reservationId': reservationId
        },
        success: function(response) {
          var result = $.trim(response);
          if (result === "1") {
            swal({
              title: "Reservation canceled",
              text: "Reservation canceled Successfully",
              type: "success",

            }, function() {
              window.location.reload();
            });
          } else {
            swal({
              title: "Failed",
              text: "Cancel Request Faled",
              type: "warning",

            });
          }
        }
      });

    });


  }
</script>

<?php include_once 'footer.php' ?>