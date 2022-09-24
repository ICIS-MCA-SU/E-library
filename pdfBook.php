<?php include_once 'header.php' ?>
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script> -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<style>
    .book-card {
        position: relative;
    }

    .active2 a {
        color: #e96b56 !important;
    }

    .active22 a,.active21 a,.active24 a,.active25 a{
        color: #545454 !important;
    }

    .psearch .pys-btn {
        background: #ff5821 !important;
        ;
        border: 0;
        padding: 6px 30px;
        color: #fff;
        transition: 0.4s;
        width: 100%;
    }

    .readnw-btn {
        position: absolute;
        left: 0;
        bottom: 0;
        background: #ff5821 !important;
        ;
        color: #fff;
        transition: 0.4s;
        padding: 10px;
        width: 100%;
        text-align: center;
    }

    .psearch .pys-btn:hover,
    .readnw-btn:hover {
        background: #ff7e54 !important;
        ;
        color: white;
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

    .bk-img {
        width: 260px;
        height: 250px;
    }

    .member-info h4 {
        text-transform: uppercase !important;
        ;
    }

    .member-info h5 {
        font-weight: 600;
    }


    @media (max-width: 520px) {

        .book-card .member .member-info h4 {
            font-size: 14px;
        }

        .book-card .member .member-info h5 {
            font-size: 12px;
        }


        .book-card .member .member-info p {
            font-size: 12px;
        }

        .bk-img {
            width: 200px;
            height: 150px;
        }

        .book-card .member {
            margin-bottom: 0;
        }
    }


    @media (max-width: 420px) {
        .col-6 {
            padding-right: 0;
            padding-left: 0;
        }
    }


    @media (max-width: 280px) {
        .book-card .member .member-info h4 {
            font-size: 10px;
        }

        .book-card .member .member-info h5 {
            font-size: 8px;
        }


        .book-card .member .member-info p {
            font-size: 8px;
        }
    }

    .pagenationBtn {
        padding: 5px 10px 5px 10px;

    }

    .pagenationBtn:hover {
        background-color: #ff5821 !important;
    }
</style>
<!-- ======= Banner Section ======= -->
<section id="physical-banner" class="d-flex flex-column justify-content-center align-items-center">

    <div class="container" data-aos="fade-in">
        <h1><strong>PDF Books</strong></h1>
        <h2>What are you looking for at the library?</h2>
    </div>
</section>
<!-- End Banner -->
<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">
        <ol>
            <li><a href="index1.php">Home</a></li>
            <li style="cursor:text;">Books & Media</li>
            <li style="cursor:text;">PDF Books</li>
        </ol>
    </div>
</section><!-- End Breadcrumbs -->
<div x-data="getBooks">
    <section id="book-card" class="book-card section-bg my-3 pb-5">
        <div class="container">
            <div class="row search-sec">
                <div class="col-lg-10 offset-lg-1 col-md-12">
                    <div class="form-row">
                        <div class="col-lg-12 col-md-12 col-sm-12 mb-5">
                            <div class="row">
                                <div class="col-lg-4 col-md-4">
                                    <div class="form-row">
                                        <input class="form-control my-2" placeholder="Search by Keyword" id="keywords" x-on:change="getBookBySearch" name="keywords" type="text">
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-5">
                                    <div class="form-row">
                                        <select name="catalog" id="catalog" class="form-control my-2">
                                            <option value="0" disabled="disabled">Sort By Department/College</option>
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
                                <div class="col-lg-3 col-md-3">
                                    <div class="form-row psearch">
                                        <input class="pys-btn my-2 form-control" type="button" name="submit" id="btn" value="Search" x-on:click="getBookBySearch">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <template x-for="item in booksJson" :key="item.book_id">
                    <!--ADD CLASSES HERE d-flex align-items-stretch-->
                    <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-3 d-flex align-items-stretch no-gutters">
                        <div class="card no-gutters member">
                            <img x-bind:src="'books/'+item.cover_photo" class="img-fluid  bk-img" alt="" />
                            <div class="card-body d-flex flex-column member-info">
                                <strong>
                                    <h4 x-text="item.title"></h4>
                                </strong>
                                <strong>
                                    <h5 x-text="item.edition+' Edition'"></h5>
                                </strong>
                                <strong>
                                    <h5 x-text="' Author: '+item.author"></h5>
                                </strong>
                                <p class="card-text mb-4">Start Learning</p>
                                <a href="#" class="readnw-btn text-white mt-auto align-self-start" x-on:click="addEBooktoCollections(item.book_id,<?php
                                                                                                                                                    if (isset($_SESSION['user_id'])) {
                                                                                                                                                        echo $_SESSION['user_id'];
                                                                                                                                                    } else {
                                                                                                                                                        header("Location: login.php");
                                                                                                                                                    } ?>)">Read now</a>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
            <template x-if="booksJson.length==0&isVisble">
            <div class="row">
                    <div class="col-12 justify-content-end" style="text-align:center;color:red">
                        <div class="card">
                            <div class="card-body shadow"> <span class="text-center">No data available</span>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
            <template x-if="!isSearch&isVisble&totalPages>1">
                <div class="row">
                    <div class="col-12 justify-content-end" style="text-align:center;">
                        <button class="btn btn-primary mb-2 pagenationBtn" x-bind:disabled="currentPage==1?true:false" type="button" x-on:click="getPrevPage">Prev</button>
                        <!-- <button class="btn btn-primary  mb-2 pagenationBtn" type="button" x-bind:id="1" style="display: none" x-on:click="getCurrentPageData">1</button>
                        <template x-for="no in totalPages" x-bind:key="no" style="display: none">
                            <template x-if="no!=1?true:false" style="display: none">
                                <button style="display: none" class="btn btn-primary pagenationBtn ml-1 mb-2" type="button" x-bind:id="no" x-text="no" x-on:click="getCurrentPageData"></button>
                            </template>
                        </template> -->

                        <button class="btn btn-primary pagenationBtn mr-1 mb-2" x-bind:disabled="currentPage==totalPages?true:false" type="button" x-on:click="getNextPage">Next</button>
                    </div>
                </div>
            </template>

        </div>
    </section>
</div>

<!-- End Team Section -->

<div id="preloader"></div>
<script>
    $("catalog").on('change', function(e) {
        var department = $('#catalog').val();
    });
    let getBooks = () => {
        return {
            booksJson: [],
            startLimit: 0,
            endLimit: 50,
            totalPages: 0,
            currentPage: 1,
            isSearch: false,
            newElement: 5,
            isVisble: false,
            init() {
                this.currentPage = 1;
                this.getAllBooks();
                this.getBook();
                setTimeout(() => {
                    this.isVisble = true;
                }, 2000)
            },
            getBook() {
                const setBooksJson = (data) => {
                    this.booksJson = JSON.parse(data);
                }
                $.ajax({
                    type: "GET",
                    url: "dbHelper/books.php",
                    data: {
                        startLimit: this.startLimit,
                        endLimit: this.endLimit,
                        book_type: "PDF Books",
                        type: "generalLimitBy"
                    },
                    success: function(res) {
                        setBooksJson(res);
                    },
                    error: function(res) {
                        console.log(res);
                    }
                });
            },
            getBookBySearch() {
                this.isSearch = true;
                var search = document.getElementById("keywords").value;
                var department = document.getElementById("catalog").value;
                var selectedDepartment = document.getElementById('catalog').options[document.getElementById('catalog').selectedIndex].text;
                $('#preloader').show();
                const setBooksJson = (data) => {
                    $('#preloader').hide();
                    if (search != "" && department != "0") {
                        this.booksJson = JSON.parse(data);
                    } else {
                        if (search == "" && department == "0") {
                            this.isSearch = false;
                            this.getBook();
                            this.getAllBooks();
                        } else {
                            if (search == "") {
                                if (data != 0) {
                                    this.booksJson = JSON.parse(data);
                                } else {
                                    this.booksJson = [];
                                }
                            } else {
                                if (data != 0) {
                                    this.booksJson = JSON.parse(data);
                                } else {
                                    this.booksJson = [];
                                }
                            }
                        }

                    }
                    console.log("Book", JSON.parse(data).length);

                }
                $.ajax({
                    type: "GET",
                    url: "dbHelper/books.php",
                    data: {
                        startLimit: this.startLimit,
                        endLimit: this.endLimit,
                        keyword: search,
                        department: selectedDepartment,
                        book_type: "PDF Books",
                        type: "generalSearchBy",
                    },
                    success: function(res) {
                        setBooksJson(res);
                    },
                    error: function(res) {
                        console.log(res);
                    }
                });


            },
            getAllBooks() {

                const setBooksJson = (data) => {
                    var pageLen = Math.ceil(JSON.parse(data).length / 50);
                    if (pageLen > 0) {
                        this.totalPages = parseInt(pageLen);
                    } else {
                        this.totalPages = 1;
                    }
                    document.getElementById("1").style.background = "orange";

                }
                $.ajax({
                    type: "GET",
                    url: "dbHelper/books.php",
                    data: {
                        startLimit: 0,
                        endLimit: 0,
                        book_type: "PDF Books",
                        type: "generalAll"
                    },
                    success: function(res) {
                        setBooksJson(res);

                    },
                    error: function(res) {
                        console.log(res);
                    }
                });

            },
            getNextPage() {
                if (this.currentPage <= this.totalPages) {
                    var currentPageButtonExist = document.getElementById(this.currentPage + 1);
                    if (currentPageButtonExist != null) {
                        document.getElementById(this.currentPage + 1).style.background = "orange";

                        document.getElementById(this.currentPage).style.background = "#007bff";
                        this.newElement = 5;
                    } else {
                        this.newElement = this.newElement + 1;

                        document.getElementById(this.newElement + 2).style.background = "orange";

                        document.getElementById(this.newElement - 1).style.background = "#007bff";
                    }
                    this.currentPage++;
                    this.startLimit = ((this.currentPage - 1) * 50);
                    this.endLimit = 50;

                    this.getBook();
                }
            },
            getPrevPage() {


                if (this.currentPage > 1) {
                    document.getElementById(this.currentPage - 1).style.background = "orange";
                    document.getElementById(this.currentPage).style.background = "#007bff";

                    this.currentPage--;
                    this.startLimit = (this.currentPage - 1) * 50;
                    this.endLimit = 50;
                    this.getBook();
                }
            },
            getCurrentPageData(e) {
                if (this.currentPage >= 1) {
                    document.getElementById(this.currentPage).style.background = "#007bff";
                }
                this.currentPage = e.target.innerText;
                document.getElementById(this.currentPage).style.background = "orange";


                this.startLimit = ((this.currentPage - 1) * 50);
                this.endLimit = 50;
                this.getBook();
            },
            addEBooktoCollections(bookId, userId) {
                $('#overlay').show();
                setTimeout(function() {
                    $.ajax({
                        url: 'dbHelper/assign-eBook.php',
                        type: 'post',
                        data: {
                            'bookId': bookId,
                            'userId': userId
                        },
                        success: function(response) {
                            $('#overlay').hide();
                            var result = $.trim(response);
                            if (result === "3") {
                                swal({
                                    title: "Failed",
                                    text: "Your Authorization is pending!",
                                    type: "warning",

                                });
                            } else if (result === "0") {
                                swal({
                                    title: "Failed",
                                    text: "Failed to Open E book",
                                    type: "warning",

                                });
                            } else if (result === "1") {
                                swal({
                                    title: "Success",
                                    text: "PDF Book Added To Your Profile. Please go to profile to View",
                                    type: "success",

                                }, function() {
                                    location.reload();
                                });
                            } else if (result === "2") {
                                swal({
                                    title: "Success",
                                    text: "PDF Book Added To Your Profile. Please go to profile to View",
                                    type: "success",


                                }, function() {
                                    location.reload();
                                });
                            } else {
                                swal({
                                    title: "error",
                                    text: "we are sorry!! some error occurred while processing",
                                    type: "info",

                                }, function() {
                                    location.reload();
                                });
                            }
                        }
                    });

                }, 2000);


            }
        }
    }
    window.onload = () => {
        $('#preloader').hide();
    }

    function addEBooktoCollections(bookId, userId) {
        alert(bookId)
        $('#overlay').show();
        setTimeout(function() {
            $.ajax({
                url: 'dbHelper/assign-eBook.php',
                type: 'post',
                data: {
                    'bookId': bookId,
                    'userId': userId
                },
                success: function(response) {
                    $('#overlay').hide();
                    var result = $.trim(response);
                    if (result === "3") {
                        swal({
                            title: "Failed",
                            text: "Your Authorization is pending!",
                            type: "warning",

                        });
                    } else if (result === "0") {
                        swal({
                            title: "Failed",
                            text: "Failed to Open E book",
                            type: "warning",

                        });
                    } else if (result === "1") {
                        swal({
                            title: "Success",
                            text: "E-Book Added To Your Profile. Please go to profile to View",
                            type: "success",

                        }, function() {
                            location.reload();
                        });
                    } else if (result === "2") {
                        swal({
                            title: "Already Exists",
                            text: "E-Book Already exists in your Profile",
                            type: "info",

                        }, function() {
                            location.reload();
                        });
                    } else {
                        swal({
                            title: "error",
                            text: "we are sorry!! some error occurred while processing",
                            type: "info",

                        }, function() {
                            location.reload();
                        });
                    }
                }
            });

        }, 2000);


    }
</script>


<?php include_once 'footer.php' ?>