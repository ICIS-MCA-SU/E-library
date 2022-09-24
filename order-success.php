<?php include_once 'header.php'?>

<!-- Start: Page Banner -->
<section class="page-banner services-banner">
    <div class="container">
        <div class="banner-header">
            <h2>Order Successful</h2>
            <span class="underline center"></span>
            <p class="lead">Your Order has been placed successfully.</p>
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
<div class="container">
<section class="section">
    <div class="section-body">
        <div class="invoice">
            <div class="invoice-print">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="invoice-title">
                            <h1 style="color: darkolivegreen">Your Order Has Been Placed Successfully</h1>


                        </div>

                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <?php
                                $userDetails=(new dbhelper)->__getUserRecords();
                                if($userDetails != 0){

                                foreach ($userDetails as $user){


                                ?>
                                <address>
                                    <strong>Your details:</strong><br>
                                    <?php echo $user['first_name']; echo "&nbsp;"; echo $user['last_name']; ?><br>
                                    <?php echo $user['course']; ?>,<br>
                                    <?php echo $user['regno'];  ?>,<br>
                                    <?php echo $user['phone'];  ?>, <?php echo $user['email'];  ?>
                                </address>
                                    <?php
                                }
                                }?>
                            </div>
                            <div class="col-md-6 text-md-right">
                                <address>
                                    <strong> <h3 class="invoice-number " >Order #<?php echo $_SESSION['orderId'];  ?></h3></strong>
                                </address>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <address>
                                    <strong>Order date</strong><br>
                                    <?php echo  $_SESSION['orderDate']?><br>

                                </address>
                            </div>
                            <div class="col-md-6 text-md-right">
                                <address>
                                    <strong>Return Date:</strong><br>
                                    <?php echo  $_SESSION['returnDate']?><br><br>
                                </address>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="section-title">Order Summary</div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-md">
                                <tbody><tr>
                                    <th data-width="40" style="width: 40px;">#</th>
                                    <th>Book</th>
                                    <th class="text-center">Edition</th>
                                    <th class="text-center">Author</th>
                                    <th class="text-right">accession number</th>
                                    <th class="text-right">book id</th>
                                    <th class="text-right">Totals</th>

                                </tr>

                                <?php $orderid=  $_SESSION['orderId'];

                                $rows = (new dbhelper)->__getOrderDetails($orderid);
                                foreach ($rows as $row){


                                    echo '

                                <tr>
                                    <td>1</td>
                                    <td>'.$row["title"].'</td>
                                    <td class="text-center">'.$row["edition"].'</td>
                                    <td class="text-center">'.$row["author"].'</td>
                                    <td class="text-right">'.$row["accession_number"].'</td>
                                    <td class="text-center">'.$row["book_id"].'</td>
                                    <td class="text-right">1</td>
                                </tr>';
                                    }
                                ?>

                                </tbody></table>
                        </div>

                    </div>
                </div>
            </div>
            <hr>

        </div>
    </div>
    <button class="btn btn-primary float-right" onclick="print()">Print</button>
</section>


</div>

<?php include_once 'footer.php' ?>
