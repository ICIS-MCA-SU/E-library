<?php include_once 'header.php' ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<!-- Start: Page Banner -->
<section class="page-banner services-banner">
    <div class="container">
        <div class="banner-header">
            <h2>Books & Media Listing</h2>
            <span class="underline center"></span>
            <p class="lead">Browse from thousands of books.</p>
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
                                    <option value="1">Computer Science</option>
                                    <option value="2">Business</option>
                                    <option value="3">physiotherapy</option>
                                    <option value="4">BCom</option>
                                    <option value="5">BHM</option>
                                    <option value="6">BBA</option>
                                    <option value="7">BEd</option>
                                    <option value="8">MSW</option>
                                    <option value="9">MPT</option>
                                    <option value="10">BCom</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2 col-sm-2">
                            <div class="form-group" style="width: 100%; height: 100%">
                                <input style="width: 100%; height: 100%" class="btn btn-primary" type="submit" name="submit" id="btn" value="Search">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!-- End: Search Section -->
    </div>
    <h3 style="margin-top: 3%">Search Results..</h3>
    <div class="row">
        <?php
         $keywords = "";
         $search_department = "";
         if (isset($_GET['keyword'])) {
             if(strlen($keywords > 0)){
                 $keywords = $_GET['keyword'];
             }else{
                 $keywords = "";
             }
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
        ?>

                <div class="col-md-4 " style="margin-top: 2%; margin-bottom: 2%; ">
                    <figure class="card card-product" style="box-shadow: 0px 0px 5px -1px rgba(0, 0, 0, 0.37);">
                        <div class="img-wrap wow fadeInUp animated" data-wow-delay=".5s"><img style="width: 350px; height: 400px; animation-name: hvr-icon-pulse-grow; " src="books/<?php echo $coverImg ?>"></div>
                        <figcaption class="info-wrap wow fadeInUp animated" data-wow-delay=".5s" style="margin-left: 4px; margin-top: 4px">
                            <h4 class="title"><?php echo $title ?></h4>
                            <p class="desc"><?php echo  strip_tags(substr($description, 0, 60)), '...'; ?></p>
                            <div class="rating-wrap">
                                <div class="label-rating"><?php echo $edition ?> Edition</div>
                                <div class="label-rating">Author: <?php echo $author ?></div>
                            </div> <!-- rating-wrap.// -->
                        </figcaption>
                        <?php if ($stock > 0) { ?>
                            <div class="bottom-wrap wow fadeInUp animated" data-wow-delay=".5s" style="margin-left: 4px; ">
                                <a href="book-details.php?id=<?php echo $bookId ?>" class="btn btn-sm btn-primary float-right" style="margin-bottom: 10px; margin-right: 6px; color: whitesmoke ">Order Now</a>
                                <div class="price-wrap h5">

                                    <span class="price-new">Total copies left <?php echo $stock ?></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="#" target="_blank" data-toggle="blog-tags" data-placement="top" title="" data-original-title="Like">
                                        <i class="fa fa-heart" style="font-size: 1.5em;"></i>
                                    </a>


                                </div>

                            </div>
                        <?php } else {

                            $rowsavd = (new dbhelper)->__getDateToReserve($bookId);
                            $availableDate = "";
                            if ($rowsavd != 0) {
                                foreach ($rowsavd as $rowavd) {
                                    $availableDate = $rowavd['return_date'];
                                }
                            }

                        ?>


                            <div class="bottom-wrap wow fadeInUp animated" data-wow-delay=".5s" style="margin-left: 4px; ">
                                <a href="reserve-book.php?id=<?php echo $bookId ?>" class="btn btn-sm btn-warning float-right" style="margin-bottom: 10px; margin-right: 6px; color: whitesmoke ">Reserve Now</a>
                                <div class="price-wrap h5">
                                    <span class="price-new" style="color: red">Currently not Available</span>
                                    <span>Back on : <?php echo $availableDate ?> </span>
                                </div>
                            <?php } ?>
                    </figure>
                </div>
        <?php       }
        } else {
            echo '<h1 style="color: #f12e04; margin-top: 5%; margin-bottom: 5%; text-align: center" >OOPS!! No data Found, Try different Keywords</h1>';
        }
        ?>


    </div>
</div>


<script>
    $("#search-from").on('submit', function(e) {
        e.preventDefault();
        var keywords = $('#keywords').val();
        var deparmentVal = $('#catalog').val();
        var department = "";
        if (deparmentVal !== 0) {
            department = $('#catalog').children(':selected').text();;
        }
        window.location.href = "books-list-view.php?keyword=" + keywords + "&department=" + department;
    });
</script>


<?php include_once 'footer.php' ?>