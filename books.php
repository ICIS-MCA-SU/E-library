<?php include_once 'header.php' ?>
    <script
            src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
            crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <!-- Start: Page Banner -->
    <section class="page-banner services-banner">
        <div class="container">
            <div class="banner-header">
                <h2>Books & Media Listing</h2>
                <span class="underline center"></span>
                <p class="lead">Search for the book you need.</p>
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
    <h1 align="center">About books</h1>
 <!-- <p>there are 25 physical book and 25 emeterials.dfuhdjljdfjijedjiefjeifdefijedfjde.</p>
 <p>there are 25 physical book and 25 emeterials.dfuhdjljdfjijedjiefjeifdefijedfjde.</p>
 <p>there are 25 physical book and 25 emeterials.dfuhdjljdfjijedjiefjeifdefijedfjde.</p> -->
    <div class="container">
        <div class="row" style="margin-top: 10%;  width: 100%;">

            <!-- Start: Search Section -->
            <section class="search-filters">
                <div class="container">
                    <div class="filter-box">
                        <h3>What are you looking for at the library?</h3>
                        <form id="search-from" action="" method="post" name="search-form " enctype="multipart/form-data">
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label class="sr-only" for="keywords">Search by Keyword</label>
                                    <input class="form-control" placeholder="Search by Keyword" id="keywords" name="keywords" type="text">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="form-group">
                                    <select name="catalog" id="catalog" class="form-control">
                                    <option value="0">Sort By Department/College</option>
                                        <option value="College of Engineering & Technology">College of Engineering & Technology</option>
                                                            <option value="College of Management & Commerce">College of Management & Commerce</option>
                                                            <option value="College of Allied Health Science & Information Science">College of Allied Health Science & Information Science</option>
                                                            <option value="College of Computer Science & Information Science">College of Computer Science & Information Science</option>
                                                            <option value="College of Aviation Studieds">College of Aviation Studieds</option>
                                                            <option value="College of Social Science & Humanities">College of Social Science & Humanities</option>
                                                            <option value="College of Hotel Management & Tourism">College of Hotel Management & Tourism</option>
                                                            <option value="College of Physiotherapy">College of Physiotherapy</option>
                                                             <option value="College of Education">College of Education</option>
                                                             <option value="College of Nursing Science">College of Nursing Science</option>
															 <option value="College of Yoga Sanskrit & Research Centre">College of Yoga Sanskrit & Research Centre</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2 col-sm-2">
                                <div class="form-group" style="width: 100%; height: 100%">
                                    <input  style="width: 100%; height: 100%" class="btn btn-primary" type="submit" name="submit" id="btn"  value="Search">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
            <!-- End: Search Section -->
        </div>
        <script>
            $("#search-from").on('submit',function (e) {
                e.preventDefault();
                /*alert("hello");*/
                var keywords = $('#keywords').val();
                var deparmentVal = $('#catalog').val();
                var department="";
                if(deparmentVal !== 0){
                    department = $('#catalog').children(':selected').text();;
                }
                window.location.href = "books.php?keyword="+keywords+"&department="+department;
            });
        </script>

        <div class="row" >
            <?php
$keywords = "";
$search_department = "";
if (isset($_GET['keyword'])) {
        $keywords = $_GET['keyword'];
}
if (isset($_GET['department'])) {
    $search_department = $_GET['department'];
}
$rows = "";
if (strlen($keywords > 0) || strlen($search_department) > 0) {
    $rows = (new dbhelper)->__getSearchResults($keywords, $search_department);
} else {
    $rows = (new dbhelper)->__getBooks();
}
            if ($rows != 0) {
                $i = 1;
                foreach ($rows as $row) {
                    $bookId = $row['book_id'];
                    $edition = $row['edition'];
                    $author = $row['author'];
                    $title = $row['title'];
                    $department = $row['book_department'];
                    $description = $row['description'];
                    $stock = (new dbhelper)->__getStocks($bookId);
                    $bookType = $row['book_type'];
                    $coverImg = $row['cover_photo'];
                    if($bookType != "e book"){

                   ?>

                    <div class="col-md-4 " style="margin-top: 2%; margin-bottom: 2%; ">
                        <figure class="card card-product" style="box-shadow: 0px 0px 5px -1px rgba(0, 0, 0, 0.37);">
                            <div class="img-wrap wow fadeInUp animated" data-wow-delay=".5s"><img
                                        style="width: 350px; height: 400px; animation-name: hvr-icon-pulse-grow; "
                                        src="books/<?php echo $coverImg ?>"></div>
                            <figcaption class="info-wrap wow fadeInUp animated" data-wow-delay=".5s"
                                        style="margin-left: 4px; margin-top: 4px">
                                <h4 class="title"><?php echo $title ?></h4>
                                <p class="desc"><?php echo  strip_tags(substr($description,0,60)),'...'; ?></p>
                                <div class="rating-wrap">
                                    <div class="label-rating"><?php echo $edition ?> Edition</div>
                                    <div class="label-rating">Author: <?php echo $author ?></div>
                                    <div class="label-rating">Book type: <?php echo  $bookType ?></div>
                                </div> <!-- rating-wrap.// -->
                            </figcaption>
                            <?php if($stock >0){ ?>
                            <div class="bottom-wrap wow fadeInUp animated" data-wow-delay=".5s"
                                 style="margin-left: 4px; ">
                                <a href="book-details.php?id=<?php echo $bookId ?>" class="btn btn-sm btn-primary float-right"
                                   style="margin-bottom: 10px; margin-right: 6px; color: whitesmoke ">Order Now</a>
                                <div class="price-wrap h5">

                                    <span class="price-new">Total copies left <?php echo $stock ?></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="#" target="_blank" data-toggle="blog-tags" data-placement="top" title=""
                                       data-original-title="Like">
                                        <i class="fa fa-heart" style="font-size: 1.5em;"></i>
                                    </a>


                                </div>

                            </div>
                            <?php } else{

                             $rowsavd = (new dbhelper)->__getDateToReserve($bookId);
                            $availableDate="";
                            if($rowsavd != 0) {
                                foreach ($rowsavd as $rowavd) {
                                    $availableDate = $rowavd['return_date'];
                                }
                            }

                                ?>


                            <div class="bottom-wrap wow fadeInUp animated" data-wow-delay=".5s"
                                 style="margin-left: 4px; ">
                                <a href="reserve-book.php?id=<?php echo $bookId ?>" class="btn btn-sm btn-warning float-right"
                                   style="margin-bottom: 10px; margin-right: 6px; color: whitesmoke ">Reserve Now</a>
                                <div class="price-wrap h5">
                                <span class="price-new" style="color: red">Currently not Available</span>
                                    <span>Back on : <?php echo $availableDate ?> </span>
                                </div>
                            <?php }?>
                        </figure>
                    </div>
         <?php
                    }else{ ?>


                         <div class="col-md-4 " style="margin-top: 2%; margin-bottom: 2%; ">
                        <figure class="card card-product" style="box-shadow: 0px 0px 5px -1px rgba(0, 0, 0, 0.37);">
                            <div class="img-wrap wow fadeInUp animated" data-wow-delay=".5s"><img
                                        style="width: 350px; height: 400px; animation-name: hvr-icon-pulse-grow; "
                                        src="books/<?php echo $coverImg ?>"></div>
                            <figcaption class="info-wrap wow fadeInUp animated" data-wow-delay=".5s"
                                        style="margin-left: 4px; margin-top: 4px">
                                <h4 class="title"><?php echo $title ?></h4>
                                <p class="desc"><?php echo  strip_tags(substr($description,0,60)),'...'; ?></p>
                                <div class="rating-wrap">
                                    <div class="label-rating"><?php echo $edition ?> Edition</div>
                                    <div class="label-rating">Author: <?php echo $author ?></div>
                                    <div class="label-rating">Book type: <?php echo  $bookType ?></div>
                                </div> <!-- rating-wrap.// -->
                            </figcaption>

                                <div class="bottom-wrap wow fadeInUp animated" data-wow-delay=".5s"
                                 style="margin-left: 4px; ">
                                <a  onclick="addEBooktoCollections(<?php echo $bookId ?>,<?php
                                if(isset($_SESSION['user_id'])){
                                echo $_SESSION['user_id']; }else{
                                    header("Location: signin.php");
                                }?>)"  class="btn btn-sm btn-primary float-right"
                                   style="margin-bottom: 10px; margin-right: 6px; color: whitesmoke ">Read Now</a>
                                <div class="price-wrap h5">

                                    <span class="price-new"> Start Learning </span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="#" target="_blank" data-toggle="blog-tags" data-placement="top" title=""
                                       data-original-title="Like">
                                        <i class="fa fa-heart" style="font-size: 1.5em;"></i>
                                    </a>


                                </div>

                            </div>

                        </figure>
                    </div>
            <?php
                    }
                }
            }
            ?>


        </div>
    </div>
    <style>
        #overlay{background-image: url('images/Circle-Loading.svg');background-color: rgba(255,255,255,0.5);background-position: center center;background-repeat: no-repeat; filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#50FFFFFF,endColorstr=#50FFFFFF);width: 100%; height: 100%; position: fixed; top: 0; left: 0; z-index: 9999;}
    </style>
    <div id="overlay"  ></div>


    <script>
        window.onload = () => {
            $('#overlay').hide();
        }
        function addEBooktoCollections(bookId,userId){
            $('#overlay').show();
            setTimeout(function () {
                $.ajax({
                    url: 'dbHelper/assign-eBook.php',
                    type: 'post',
                    data: {'bookId': bookId,'userId':userId},
                    success: function (response) {
                        $('#overlay').hide();
                        var result = $.trim(response);
                        if (result === "3") {
                            swal({
                                title: "Failed",
                                text: "Your Authorization is pending!",
                                type: "warning",

                            });
                        }else if (result === "0") {
                            swal({
                                title: "Failed",
                                text: "Failed to Open E book",
                                type: "warning",

                            });
                        } else if (result === "1") {
                            swal({
                                title: "Success",
                                text: "E-Book Added To Your Profile",
                                type: "success",

                            }, function () {
                                location.reload();
                            });
                        } else if (result === "2") {
                            swal({
                                title: "Already Exists",
                                text: "E-Book Already exists in your Profile",
                                type: "info",

                            }, function () {
                                location.reload();
                            });
                        } else {
                            swal({
                                title: "error",
                                text: "we are sorry!! some error occurred while processing",
                                type: "info",

                            }, function () {
                                location.reload();
                            });
                        }
                    }
                });

            },2000);


        }
    </script>


<?php include_once 'footer.php'?>