<?php include_once 'header.php';
if(!isset($_SESSION['user_id'])){
    header("Location:signin.php");
}

?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<style>
    .heading-text{
        font-size: 30px;
        background: -webkit-linear-gradient(#1d1b1b, #d7975d);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 8px;
    }
    .heading-text2{
        font-size: 40px;
        background: -webkit-linear-gradient(#0f57ec, #86603e);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 8px;
    }
    .heading-text3{
        font-size: 20px;
        background: -webkit-linear-gradient(#ffaa36, #fac418);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 8px;
    }
</style>
<script
    src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
    crossorigin="anonymous"></script>
<!-- Start: Page Banner -->
<section class="page-banner services-banner">
    <div class="container">
        <div class="banner-header">
            <h2>Reserved books</h2>
            <span class="underline center"></span>
            <p class="lead">You can see all your reserves listed here.</p>
        </div>
        <div class="breadcrumb">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li>Books & Media</li>
            </ul>
        </div>
    </div>
</section>
<!-- End: Page Banner -->

<!-- Start: Products Section -->
<div id="content" class="site-content">
    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <div class="booksmedia-detail-main">
                <div class="container">
                    <div class="row" style="margin-top: 4%; margin-bottom: 3%">

                        <div class="container">
                            <h1 class="heading-text2"> Your Reservation <i class="fa fa-shopping-cart"></i>...</h1>
                        </div>

                        <!-- End: Search Section -->
                    </div>

                    <hr>
                    <div class="booksmedia-detail-box">
                        <?php
                        $bid=0;
                        $userId="";
                        function dateDiff($cin, $cout){
                            $date1_ts = strtotime($cin);
                            $date2_ts = strtotime($cout);
                            $diff = $date2_ts - $date1_ts;
                            return abs(round($diff / 86400));
                        }

                        if(isset($_SESSION['user_id'])){
                            $userId= $_SESSION['user_id'];
                        }
                        $rows =  (new dbhelper)->__getUsserReservations($userId);
                        if ($rows != 0) {
                            $i = 1;
                            foreach ($rows as $row) {
                                $bookId = $row['book_id'];
                                $edition = $row['edition'];
                                $author = $row['author'];
                                $title = $row['title'];
                                $department = $row['book_department'];
                                $description = $row['description'];
                                $accession=$row['accession_number'];
                                $bookType = $row['book_type'];
                                $coverImg = $row['cover_photo'];
                                $reservationId=$row['reservation_id'];
                                $reservationDate = $row['reservation_date'];
                                $issueDate =$row['issue_date'];
                                $date=date('Y-m-d');
                                $daysLeft = dateDiff($date,$issueDate);

                                ?>

                                <div class="detailed-box" style="box-shadow: 4px 4px 5px 1px rgba(59,58,58,0.37);">
                                    <div class="col-xs-12 col-sm-5 col-md-3">
                                        <div class="post-thumbnail">
                                            <img style="width: 350px; height: 400px;" src="books/<?php echo $coverImg?>" alt="Book Image">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-7 col-md-6"  >
                                        <div class="post-center-content" style="width: 500px; height: 400px; margin-left: 1%">
                                            <h2 class="heading-text" ><?php echo $title?></h2>
                                            <hr>
                                            <p><strong>Author :</strong><?php echo $author?></p><br>
                                            <p><strong>Edition :</strong> <?php echo $edition?> edition</p><br>
                                            <p><strong>Department :</strong><?php echo $department?></p><br>
                                            <p><strong>Description :</strong><?php echo strip_tags(substr($description,0,30)),'...';?></p><br>>
                                            <div class="float-right">


                                                    <a  onclick="cancelReservation(<?php echo $reservationId?>)" id="cancelBtn" class="btn btn-dark-gray" style="width: 200px; border-radius: 9px">Cancel Reservation</a>



                                            </div>

                                        </div>

                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-3 ">
                                        <div class="post-right-content" >
                                            <h3 class="heading-text3">Reservation details</h3><br>

                                            <h3 style="color: #e30b23"><strong style="color: #0f57ec"> Get the Book On :</strong> <?php echo $issueDate?></h3><br>
                                            <p><strong style="f"> Reservation Id:</strong> <?php echo $reservationDate?></p><br>
                                            <p><strong>Accession:</strong> <?php echo $accession?></p><br>
                                            <p><strong>Book Id:</strong> <?php echo $bookId?></p><br>
                                            <p><strong>Reserved Date:</strong> <?php echo $reservationDate?></p><br>
                                            <p><strong>Days Left:</strong> <?php echo $daysLeft?></p>
                                        </div>


                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <?php
                            }
                        }
                        ?>

                        <div class="clearfix"></div>

                        <!-- End: Products Section -->


                    </div>



                </div>
            </div>
        </main>

    </div>
</div>


<script>

    function cancelReservation(reservationId){
        swal({
            title: "confirmation",
            text: "Do you want to Cancel this Reservation ?",
            type: "info",
            showCancelButton: true

        }, function() {
            $.ajax({
                url: 'dbHelper/cancelReservation.php',
                type: 'post',
                data:{'reservationId':reservationId} ,
                success:function (response) {
                    var result = $.trim(response);

                    if(result === "1"){
                        swal({
                            title: "Reservation canceled",
                            text: "Reservation canceled Successfully",
                            type: "success",

                        }, function() {
                            location.reload();
                        });
                    }else{
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
