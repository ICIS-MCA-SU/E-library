<?php
ob_start();
if (session_status() !== PHP_SESSION_ACTIVE || session_id() === "") {
  session_start();
} ?>
<?php include_once 'dbHelper\dbhelper.php';


$rows =  (new dbhelper)->__oderReservedBooks();


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />

  <title>Digital Library</title>
  <meta content="" name="descriptison" />
  <meta content="" name="keywords" />

  <!-- Favicons -->
  <link href="images/favicon.ico" rel="icon" type="image/x-icon" />

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet" />
  <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />

  <!-- Stylesheet
    <link href="style.css" rel="stylesheet" type="text/css" /> -->

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet" />
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet" />
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet" />
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet" />
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet" />

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet" />

  <!-- /**
* Template Name: Eterna - v2.0.0
* Template URL: http://103.105.224.229/sulibrary/index.php
* Author: BootstrapMade.com
* License: http://103.105.224.229/sulibrary/index.php
*/ -->

  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
</head>

<body onload="">
  <!-- ======= Top Bar =======
  <section id="topbar" class="d-none d-lg-block">
    <div class="container d-flex">
      <div class="contact-info mr-auto">
        <i class="icofont-envelope"></i><a href="mailto:contact@example.com">contact@example.com</a>
        <i class="icofont-phone"></i> +1 5589 55488 55
      </div>
      <div class="social-links">
        <a href="#" class="twitter"><i class="icofont-twitter"></i></a>
        <a href="#" class="facebook"><i class="icofont-facebook"></i></a>
        <a href="#" class="instagram"><i class="icofont-instagram"></i></a>
        <a href="#" class="skype"><i class="icofont-skype"></i></a>
        <a href="#" class="linkedin"><i class="icofont-linkedin"></i></i></a>
      </div>
    </div>
  </section> -->

  <!-- ======= Header ======= -->
  <header id="header">

    <div class="container d-flex">
      <div class="logo mr-auto">
        <h1 class="text-light">
          <a href="index.php"><img src="assets/img/sulogo.png" class="img-logo" style="max-height:50px;" alt="" /></a>
        </h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active1"><a href="index.php">Home</a></li>
          <li class="drop-down active2"><a href="">Books</a>
            <ul>
              <!-- hide strat -->
              <li class="active21"><a href="emeterial.php">E-Books</a></li>
              <!-- hide end -->
              <!-- <li class="active22"><a href="physical.php">Physical-Books</a></li> -->
              <li class="active23"><a href="pdfBook.php">PDF Books</a></li>
              <li class="active24"><a href="studymeterial.php">SU Study Meterial</a></li>
              <li class="active25"><a href="questionpaper.php">SU Question Paper</a></li>
            </ul>
          </li>
          <li class="drop-down active3"><a href="">More</a>
            <ul>
              <li class="active31"><a href="https://srinivaspublication.com/" target="_blank">Publications</a></li>
              <li class="active33"><a href="index.php#service">Our Services</a></li>
              <li class="active34"><a href="https://srinivasuniversity.edu.in/" target="_blank">Visit Our Website</a></li>
            </ul>
          </li>
          <li class="active4"><a href="index.php#contact">Contact</a></li>
          </li>
          <?php if (isset($_SESSION["user_id"])) {
            echo '<li class="drop-down active5"><a href="">My Account</a>
                        <ul>
                            <li class="active51"><a href="profile.php">Profile</a></li>
                            <li class="active55"><a href="logout.php">Logout</a></li>
                            </ul>
                        </li>';
          } else {
            echo '<li class="active6"><a href="login.php" class="nav-last">Login / Register </a></li>';
          }
          ?>
        </ul>
      </nav>
      <!-- .nav-menu -->
      <!-- <li class="active53"><a href="reserved-books.php">Reserverd</a></li> -->
    </div>
  </header>
  <!-- End Header -->

  <!-- <li class="active52"><a href="cart.php">Cart</a></li>
                            <li class="active54"><a href="orders.php">Orders</a></li> -->