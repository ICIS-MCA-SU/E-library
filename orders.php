<?php include_once 'header.php';
if(!isset($_SESSION['user_id'])){
  header("Location:login.php");
}
?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<style>
              .active5 a{
        color: #e96b56  !important;
    }
    .active55 a,.active51 a, .active52 a, .active53 a{
        color: #545454  !important;
    }
    *{
        padding: 0;
        margin:0;
        box-sizing:border-box;
    }
    body{
        background:white;
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
    .bkorder-row{
        margin:20px;
        border-radius:10px;
        box-shadow: 0px 5px 25px 0px rgba(0, 0, 0, 0.2);
    }
    .bkorder-img-logo{
        border-radius: 5px;
        margin: 10px auto 0px;
    }
    .bkorder-logo{
        margin:0 auto;
        width:230px;
    }
    .bkorder-img-row{
      background-size:cover;
        position: relative;
        text-align: center;
    }
    .bkorder-logo{
      margin:0 auto;
        width:200px;
        height:300px;
    }
    .bkorder-logo img{
  overflow: hidden;
        width: 100%;
        height:100%;
    }
    .bkorder-page h3{
      font-size:25px;
        padding:0 0 0;
    }
    .bkorder-page h4{
        font-size:15px;
        padding:10px 0 0;
    }
    .bkorder-page p{
      font-size:15px;
    }
    .btnhold{
    background: #ff5821  !important;;
    color:white;
    transition: 0.4s;
    padding:10px 15px 10px;
    width:100%;
    text-align:center;
    }
    .btncart{
    background: #ff5821  !important;;
    color:white;
    transition: 0.4s;
    padding:10px;
    width:100%;
    text-align:center;
    }
    .btnhold:hover,.btncart:hover{
        background: #ff7e54  !important;;
        color:white;
    }
    .bkorder-body{
    margin-top: 30px;
    margin-left: 10px;
    width: 100%;
    margin-bottom: 30px;
    }
    @media (max-width: 574px) {
        .bkorder-page{
            padding-left: 3rem;
            padding-right: 3rem;
    }

    }
    @media (max-width: 425px) {
        .bkorder-page{
            padding-left: 1.6rem;
            padding-right: 1.6rem;
    }
    }
    @media (max-width: 300px) {
        .bkorder-page{
            padding-left: 0;
            padding-right: 0;
    }
    }
    @media (max-width: 768px ) {
      .bkorder-page-row{
        display:block;
        margin:0 Auto;
      }
        .bkorder-forgot{
        display: block;
    }
    .bkorder-body{
    margin-top: 0;
    margin-left: 5px;
    margin-bottom: 20px;
    }
    }



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
  cursor:pointer;
}

 .breadcrumbs ol li + li {
  padding-left: 10px;
}

 .breadcrumbs ol li + li::before {
  display: inline-block;
  padding-right: 10px;
  color: #635551;
  content: "/";
}

</style>

<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex flex-column justify-content-center align-items-center">
  <div class="container" data-aos="fade-in">
    <h1><strong>My Orders</strong></h1>
  </div>
</section>
<!-- End Hero -->

           <!-- ======= Breadcrumbs ======= -->
           <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">
        <ol>
        <li><a href="index1.php">Home</a></li>
        <li style="cursor:text;">My Account</li>
        <li style="cursor:text;">Order</li>
      </div>
    </section><!-- End Breadcrumbs -->

<secction class="bkorder my-5 pb-5">
    <div class="row no-gutters pb-5">
        <div class="col-lg-9 offset-lg-1 col-md-12 offset-md-0 col-sm-10 offset-sm-1 bkorder-page-row py-3">
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
                        $rows =  (new dbhelper)->__getUserOrderDetails($userId);
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
                                $orderId=$row['order_id'];
                                $oderDate = $row['order_date'];
                                $returnDate =$row['return_date'];
                                $comment=$row['comment'];
                                $date=date('Y-m-d');
                                $hasOdered = (new dbhelper)->__checkOrderStatus($accession, $userId);

                                $daysLeft = dateDiff($date,$returnDate);

                                ?>
          <div class="row bkorder-row">
          
            <div class="col-lg-3 col-md-3 col-sm-12 py-2 bkorder-img-row no-gutters" style="">
              <div class="bkorder-logo py-3">
                <img src="books/<?php echo $coverImg?>" alt="">
              </div>
            </div>
             <div class="col-lg-9 col-md-9 col-sm-12  bkorder-page">
               <div class="row bkorder-body">
               <div class="col-lg-6 col-md-6 col-sm-6 col-12">
               <h3><strong>Book Details</strong></h3>
               <h4><strong>Book Name : </strong><?php echo $title?></h4>
               <p><strong>Author : </strong><?php echo $author?>
               <br><strong>Edition : </strong> <?php echo $edition?>
               <br><strong>Department : </strong><?php echo $department?>
               <br><strong>Description : </strong><?php echo strip_tags(substr($description,0,30)),'...';?>
               <br><strong>Remarks by librarian  :</strong><?php echo $comment?></p>
               <?php
                                             if($hasOdered==20 || $hasOdered==4)  {
                                                 ?>
                <div class=" mt-4 mb-3">
                 <a href="" id="retunBtn" onclick="requestReturn(<?php echo $orderId?>,<?php echo $accession?>)" class="btncart">Request Return</a>
                 </div>
                                                     <?php
                                             }

                                             ?>
               </div>
               <div class="col-lg-6 col-md-6 col-sm-6 col-12">
               <h3><strong>Order details</strong></h3>
               <?php if (isset($_SESSION['user_id'])) {
                                                $userId = $_SESSION['user_id'];

                                                $status="";
                                                if ($hasOdered == 1) {
                                                    $status="Approved";
                                                } elseif ($hasOdered == 0) {
                                                    $status="Pending";

                                                } elseif($hasOdered== -1) {
                                                    $status="Rejected";

                                                } elseif($hasOdered== 2) {
                                                    $status="Return Requested";
                                                }elseif($hasOdered== 3) {
                                                    $status="Returned";
                                                }elseif($hasOdered== 4) {
                                                    $status="Return Rejected";
                                                }elseif($hasOdered== 20) {
                                                    $status="Book Assigned";
                                                }
                                            } ?>
                <h4><strong> Status :</strong> <?php echo $status?></h4>
                <p><strong style="f"> Order Id:</strong> <?php echo $orderId?>
               <br><strong>Accession:</strong> <?php echo $accession?>
               <br><strong>Book Id:</strong> <?php echo $bookId?>
               <br><strong>Oder Date:</strong> <?php echo $oderDate?>
               <br><strong>Return Date:</strong> <?php echo $returnDate?>
               <br><strong>Days Left:</strong> <?php echo $daysLeft?></p>
          
                            <div class="clearfix"></div>

               </div>     
            </div>
            </div>
       
          </div>  
          <?php
                            }
                        }
                        ?>       
        </div>
    </div>
</secction>

<div id="preloader"></div>
<script>
    window.onload = () => {
        $('#preloader').hide();
    }
    function requestReturn(orderId,accession){
           swal({
                title: "confirmation",
                text: "Do you want to Request Return for this ?",
                type: "info",
               showCancelButton: true

            }, function() {
                $.ajax({
                    url: 'dbHelper/processReturn.php',
                    type: 'post',
                    data:{'accession':accession,'orderId':orderId} ,
                    success:function (response) {
                        var result = $.trim(response);
                        if(result === "0"){
                            swal({
                                title: "Failed",
                                text: "Return Request Faled",
                                type: "warning",

                            });
                        } else {
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
</script>

<?php include_once 'footer.php' ?>