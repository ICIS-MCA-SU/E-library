<?php include_once '..\dbHelper\dbhelper.php';
session_start();
if (!isset($_SESSION["admin_id"])) {
    header("Location:login.php");
} ?>

<!DOCTYPE html>
<html lang="en">


<!-- index.html  21 Nov 2019 03:44:50 GMT -->

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Digital Library - Admin Dashboard </title>
    <link href="../assets/vendor/icofont/icofont.min.css" rel="stylesheet" />
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet" />
    <link href="../assets/vendor/animate.css/animate.min.css" rel="stylesheet" />
    <!-- General CSS Files -->
    <link rel="stylesheet" href="assets/css/app.min.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/fontawesome.min.css" integrity="sha512-xX2rYBFJSj86W54Fyv1de80DWBq7zYLn2z0I9bIhQG+rxIF6XVJUpdGnsNHWRa6AvP89vtFupEPDP8eZAtu9qA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.1/xlsx.full.min.js"></script>
    <style>
        .main-content {
            padding-top: 50px;
            padding-left: 265px;

            padding-right: 20px;

        }

        @media (max-width: 1024px) {
            .main-content {
                padding-left: 20px;
                padding-right: 0px;
            }
        }
    </style>
    
</head>

<body>
    <div class="loader"></div>
    <div id="app" style="margin-bottom: 7%">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar sticky">
                <div class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
									collapse-btn"> <i data-feather="align-justify"></i></a></li>
                        <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                                <i data-feather="maximize"></i>
                            </a></li>
                        <li>
                            <form class="form-inline mr-auto">
                                <div class="search-element">
                                    <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="200">
                                    <button class="btn" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </li>
                    </ul>
                </div>
                <ul class="navbar-nav navbar-right">



                    <!--                <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"-->
                    <!--                                                             class="nav-link nav-link-lg message-toggle"><i-->
                    <!--                                data-feather="mail"></i>-->
                    <!--                        <span class="badge headerBadge1">-->
                    <!--                6 </span> </a>-->
                    <!--                    <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">-->
                    <!--                        <div class="dropdown-header">-->
                    <!--                            Messages-->
                    <!--                            <div class="float-right">-->
                    <!--                                <a href="#">Mark All As Read</a>-->
                    <!--                            </div>-->
                    <!--                        </div>-->
                    <!--                        <div class="dropdown-list-content dropdown-list-message">-->
                    <!--                            <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar-->
                    <!--											text-white"> <img alt="image" src="assets/img/users/user-1.png" class="rounded-circle">-->
                    <!--                  </span> <span class="dropdown-item-desc"> <span class="message-user">John-->
                    <!--                      Deo</span>-->
                    <!--                    <span class="time messege-text">Please check your mail !!</span>-->
                    <!--                    <span class="time">2 Min Ago</span>-->
                    <!--                  </span>-->
                    <!---->
                    <!--                        </div>-->
                    <!--                        <div class="dropdown-footer text-center">-->
                    <!--                            <a href="#">View All <i class="fas fa-chevron-right"></i></a>-->
                    <!--                        </div>-->
                    <!--                    </div>-->
                    <!--                </li>-->

                    <li class="dropdown dropdown-list-toggle">
                        <a class="nav-link notification-toggle nav-link-lg" href="logout.php" style="color: #b749ca; font-weight: bold" onclick="window.location.href='logout.php'"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="20" height="20">
                                <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                <path d="M96 480h64C177.7 480 192 465.7 192 448S177.7 416 160 416H96c-17.67 0-32-14.33-32-32V128c0-17.67 14.33-32 32-32h64C177.7 96 192 81.67 192 64S177.7 32 160 32H96C42.98 32 0 74.98 0 128v256C0 437 42.98 480 96 480zM504.8 238.5l-144.1-136c-6.975-6.578-17.2-8.375-26-4.594c-8.803 3.797-14.51 12.47-14.51 22.05l-.0918 72l-128-.001c-17.69 0-32.02 14.33-32.02 32v64c0 17.67 14.34 32 32.02 32l128 .001l.0918 71.1c0 9.578 5.707 18.25 14.51 22.05c8.803 3.781 19.03 1.984 26-4.594l144.1-136C514.4 264.4 514.4 247.6 504.8 238.5z" />
                            </svg>
                        </a>
                    </li>

                    <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg"><i data-feather="bell" class="bell"></i>
                            <?php
                            $rows = (new dbhelper)->__getPendingAprovalUsers();
                            $count = 0;
                            if ($rows != 0) {
                                foreach ($rows as $row) {
                                    $count++;
                                }
                            }
                            ?>
                            <span class="badge headerBadge2"> <?php echo $count; ?> </span>
                        </a>
                        <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
                            <div class="dropdown-header">
                                Notifications
                                <div class="float-right">
                                    <a onclick="function f() {
                                  $('#notifications').empty();
                                }">Mark All As Read</a>
                                </div>
                            </div>
                            <div class="dropdown-list-content dropdown-list-icons" id="notifications">
                                <?php
                                if ($rows != 0) {
                                    $i = 1;
                                    foreach ($rows as $row) {
                                        $uid = $row['user_id'];
                                        $date = $row['registration_date'];
                                        $fname = $row['first_name'];
                                        $laname = $row['last_name'];
                                        $course = $row['course'];
                                ?>

                                        <a href="student-aproval.php" class="dropdown-item">
                                            <span class="dropdown-item-icon bg-info text-white">
                                                <i class="fas fa-bell"></i>
                                            </span>
                                            <span class="dropdown-item-desc">
                                                New Student <?php echo $fname, '&nbsp', $laname; ?> from <?php echo $course ?> has registered with library
                                                <span class="time"> <?php echo $date ?></span>
                                            </span>
                                        </a>
                                <?php }
                                } ?>
                            </div>
                            <div class="dropdown-footer text-center">
                                <a href="student-aproval.php">View All <i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </li>





                    <!--                <li class="dropdown"><a href="#" data-toggle="dropdown"-->
                    <!--                                        class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image" src="assets/img/user.png"-->
                    <!--                                                                                                         class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block"></span></a>-->
                    <!--                    <div class="dropdown-menu dropdown-menu-right pullDown">-->
                    <!--                        <div class="dropdown-title">Hello Sarah Smith</div>-->
                    <!--                        <a href="profile.html" class="dropdown-item has-icon"> <i class="far-->
                    <!--										fa-user"></i> Profile-->
                    <!--                        </a> <a href="#" class="dropdown-item has-icon"> <i class="fas fa-cog"></i>-->
                    <!--                            Settings-->
                    <!--                        </a>-->
                    <!--                        <div class="dropdown-divider"></div>-->
                    <!--                        <a href="auth-login.html" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>-->
                    <!--                            Logout-->
                    <!--                        </a>-->
                    <!--                    </div>-->
                    <!--                </li>-->
                </ul>
            </nav>
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand py-3">
                        <a href="index.php"><img src="../assets/img/sulogo.png" class="img-logo" style="max-height:50px;" alt="" /></a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">Main</li>
                        <li class="dropdown active">
                            <a href="index.php" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
                        </li>
                        <li>
                            <a class="nav-link" href="loginReports.php"><i data-feather="users"></i>
                                <span>User Logs</span></a>
                        </li>
                        <li>
                            <a class="nav-link" href="contactus.php"><i data-feather="message-square"></i>
                                <span>Queries</span></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="shield"></i><span>Approval</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="student-aproval.php">student Approval</a></li>
                                <li><a class="nav-link" href="professor-aproval.php">Professor Approval</a></li>

                            </ul>
                        </li>

                        <li class="dropdown">
                            <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="shopping-bag"></i><span>Orders</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="manage-orders.php">student order</a></li>
                                <li><a class="nav-link" href="manage-professors-order.php">Professor Order</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="rotate-cw"></i><span>returns</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="manage-returns.php">student returns</a></li>
                                <li><a class="nav-link" href="manage-professors-returns.php">Professor returns</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="nav-link" href="assign-books.php"><i data-feather="book-open"></i><span>Confirm book Pickup</span></a>
                        </li>


                        <li class="menu-header">Libarairy</li>
                        <li class="dropdown">
                            <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="book"></i><span>Books</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="add-books.php">add books</a></li>
                                <li><a class="nav-link" href="view-book.php">view books</a></li>

                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="shortage-alert.php"><i data-feather="alert-triangle"></i><span>shortage alerts</span></a>
                        </li>

                        <li class="dropdown">
                            <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="database"></i><span>records</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="manage-students.php">Student records</a></li>
                                <li><a class="nav-link" href="manage-professors.php">professor records</a></li>
                            </ul>
                        </li>




                    </ul>
                </aside>
            </div>