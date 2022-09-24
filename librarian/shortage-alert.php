<?php include_once '../librarian/header.php' ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/choices.js/2.7.4/choices.min.js" integrity="sha512-4XQu6HU9s7WLdid0x9X9vkZ5W+Xo2iz26Q4hEPcwBoIoNrJaD1ZMovt6x7zsVUiMRNz1ZeAEkDaOzndYr8ayWg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/choices.js/2.7.4/styles/css/choices.css" integrity="sha512-YjTNJiRbUshymoRn5Gpe/pVEN0816n5ifxryaXva/bhRNIHwgt20BJRxR/IknDklsy+eSc15ISEloGoOCJVeYQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.debug.js"></script>
<style>
    .pagenationBtn {
        padding: 5px 10px 5px 10px;

    }

    .pagenationBtn:hover {
        background-color: #f1f1f1;
    }

    .btnDelete {
        font-size: 20px;
        color: red;
        cursor: pointer;
    }

    .btnExportCol {
        text-align: end;
    }

    .bookCount {
        display: flex;
        justify-content: end;
    }
</style>
<div class="main-content" x-data="getBooks">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card pt-2">
                    <div class="card-header d-flex justify-content-between" style="border-bottom: solid 1px gray">
                        <div class="header-title">
                            <h4 class="card-title">Shortage Alert</h4>
                        </div>
                        <div class="card-header-toolbar d-flex align-items-center">
                            <a href="add-books.php" class="btn btn-primary">Add New book</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <form id="search-from" action="" method="post" name="search-form " enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-4 col-6">
                                            <div class="form-group">
                                                <label class="sr-only" for="keywords">Search by Keyword</label>
                                                <input class="form-control" placeholder="Search by Keyword" id="keywords" x-on:change="getBookBySearch" name="keywords" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-6">
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

                                        <div class="col-md-2 col-12">
                                            <div class="form-group" style="margin-top:4px;display:flex">
                                                <input class="btn btn-primary" type="button" name="submit" id="btn" value="Search" x-on:click="getBookBySearch">
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-12 btnExportCol">
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-primary" style="padding:11px 15px" x-on:click="reload">
                                                    <i class="fa fa-refresh" aria-hidden="true" tool-tip="reload" style="font-size:20px;cursor:pointer"></i>
                                                </button>
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalDownload">
                                                    <i class="fa-solid fa-download" style="font-size:20px;cursor:pointer;"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="row">
                                        <div class="col-12 bookCount">
                                            <h6>Book Count</h6>:&nbsp;
                                            <h6><span x-text="bookCount" x-effect="bookCount"></span></h6>
                                        </div>
                                    </div> -->
                                </form>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-hover mb-0 ">
                                            <thead>
                                                <tr role="row">
                                                    <th style="width: 21px;" data-sort-type="numeric">No
                                                    </th>
                                                    <th style="width: 45px;">Book Image </th>
                                                    <th style="width: 62px;">Book Name </th>
                                                    <th style="width: 63px;"> Edition </th>
                                                    <th style="width: 49px;">Book Author </th>
                                                    <th style="width: 37px;">Department </th>
                                                    <th style="width: 38px;">total Stock </th>
                                                    <th style="width: 37px;">Book Type </th>
                                                    <th style="width: 47px;">Action </th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <template x-for="item in booksJson" :key="item.book_id">
                                                    <template x-if="item.total_stock<5">
                                                        <tr>
                                                            <td><span x-text="item.book_id"></span></td>

                                                            <td><img class="img-fluid rounded" x-bind:src="'../books/'+item.cover_photo" alt=""></td>
                                                            <td><span x-text="item.title"></span></td>
                                                            <td><span x-text="item.edition"></span></td>
                                                            <td><span x-text="item.author"></span></td>
                                                            <td><span x-text="item.book_department"></span></td>
                                                            <td>
                                                                <span x-text="item.total_stock"></span>
                                                            <td>
                                                                <span x-text="item.book_type"></span>
                                                            </td>
                                                            <td>
                                                                <div class="flex align-items-center list-user-action">
                                                                    <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" x-bind:href="'add-shortage.php?id='+item.book_id"><i class="fa fa-plus-circle" style="font-size: 1.5em;"></i></a>

                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </template>
                                                </template>
                                            </tbody>
                                        </table>
                                        <br />
                                        <template x-if="!isSearch">
                                            <div class="row">
                                                <div class="col-12 justify-content-end" style="text-align:center;">
                                                    <button class="btn btn-primary mb-2 pagenationBtn" x-bind:disabled="currentPage==1?true:false" type="button" x-on:click="getPrevPage">Prev</button>
                                                    <button class="btn btn-primary  mb-2 pagenationBtn" type="button" x-bind:id="1" x-on:click="getCurrentPageData">1</button>
                                                    <template x-for="no in totalPages" x-bind:key="no">
                                                        <template x-if="no!=1?true:false">
                                                            <button class="btn btn-primary pagenationBtn ml-1 mb-2" type="button" x-bind:id="no" x-text="no" x-on:click="getCurrentPageData"></button>
                                                        </template>
                                                    </template>

                                                    <button class="btn btn-primary pagenationBtn mr-1 mb-2" x-bind:disabled="currentPage==totalPages?true:false" type="button" x-on:click="getNextPage">Next</button>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                                <!-- <div class="row">
                                    <div class="col-sm-12 col-md-5">
                                        <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Showing 1 to 10 of 10 entries
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                                            <ul class="pagination">
                                                <li class="paginate_button page-item previous disabled" id="DataTables_Table_0_previous"><a href="#" aria-controls="DataTables_Table_0" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
                                                </li>
                                                <li class="paginate_button page-item active"><a href="#" aria-controls="DataTables_Table_0" data-dt-idx="1" tabindex="0" class="page-link">1</a>
                                                </li>
                                                <li class="paginate_button page-item next disabled" id="DataTables_Table_0_next"><a href="#" aria-controls="DataTables_Table_0" data-dt-idx="2" tabindex="0" class="page-link">Next</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="modal fade" x-data="getBooks" id="exampleModalDownload" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Export</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <!-- <label for="exportFileType">Export File type</label>
                                        <select class="form-control" id="exportType" name="exportType">
                                            <option value="">Select</option>
                                            <option value="pdf">PDF</option>
                                            <option value="excel">Excel</option>
                                        </select>

                                        <br /> -->
                                    <label for="selectFoelds">Select Fields</label>
                                    <select class="form-control" id="bookItems" multiple>
                                        <option value="">Select</option>
                                        <option value="book_id"> Book ID </option>
                                        <option value="title">Title </option>
                                        <option value="author">Author</option>
                                        <option value="edition">Edition</option>
                                        <option value="book_type">Book Type</option>
                                        <option value="description">Description</option>
                                        <option value="total_stock">Total Stock</option>
                                        <option value="book_department">Department</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" x-on:click="exportPDF()">Export</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {

        var multipleCancelButton = new Choices('#bookItems', {
            removeItemButton: true,
            maxItemCount: 10,
            searchResultLimit: 5,
            renderChoiceLimit: 5
        });


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
            prevPage: 1,
            bookCount: 0,
            init() {
                this.currentPage = 1;
                this.getBook();
                this.getAllBooks();
            },
            getBook() {
                const setBooksJson = (data) => {
                    this.booksJson = JSON.parse(data);
                }
                $.ajax({
                    type: "GET",
                    url: "../dbHelper/books.php",
                    data: {
                        startLimit: this.startLimit,
                        endLimit: this.endLimit,
                        type: "limitBy"
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

                const setBooksJson = (data) => {

                    if (search != "" && department != "0") {
                        this.booksJson = JSON.parse(data);
                        this.bookCount = this.booksJson.length;
                    } else {
                        if (search == "" && department == "0") {
                            this.isSearch = false;
                            this.getBook();
                            this.getAllBooks();
                        } else {
                            if (search == "") {

                                this.booksJson = JSON.parse(data);
                                this.bookCount = this.booksJson.length;
                            } else {
                                this.booksJson = JSON.parse(data);
                                this.bookCount = this.booksJson.length;
                            }
                        }

                    }
                    console.log("Book", JSON.parse(data).length);

                }
                $.ajax({
                    type: "GET",
                    url: "../dbHelper/books.php",
                    data: {
                        startLimit: this.startLimit,
                        endLimit: this.endLimit,
                        keyword: search,
                        department: selectedDepartment,
                        type: "searchBy",
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
                    this.bookCount = JSON.parse(data).length;

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
                    url: "../dbHelper/books.php",
                    data: {
                        startLimit: 0,
                        endLimit: 0,
                        type: "All"
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
                    this.prevPage = this.currentPage;
                    var currentPageButtonExist = document.getElementById(this.currentPage + 1);
                    if (currentPageButtonExist != null) {
                        document.getElementById(this.currentPage + 1).style.background = "orange";

                        document.getElementById(this.currentPage).style.background = "#6777ef";
                        this.newElement = 5;
                    } else {
                        this.newElement = this.newElement + 1;

                        document.getElementById(this.newElement + 2).style.background = "orange";

                        document.getElementById(this.newElement - 1).style.background = "#6777ef";
                    }
                    this.currentPage++;
                    this.startLimit = ((this.currentPage - 1) * 50);
                    this.endLimit = 50;

                    this.getBook();
                }
            },
            getPrevPage() {


                if (this.currentPage > 1) {
                    this.prevPage = this.currentPage;

                    document.getElementById(this.currentPage - 1).style.background = "orange";
                    document.getElementById(this.currentPage).style.background = "#6777ef";

                    this.currentPage--;
                    this.startLimit = (this.currentPage - 1) * 50;
                    this.endLimit = 50;
                    this.getBook();
                }
            },
            getCurrentPageData(e) {
                if (this.currentPage >= 1) {
                    document.getElementById(this.prevPage).style.background = "#6777ef";
                }
                this.currentPage = e.target.innerText;
                document.getElementById(this.currentPage).style.background = "orange";


                this.startLimit = ((this.currentPage - 1) * 50);
                this.prevPage = this.currentPage;
                this.endLimit = 50;
                this.getBook();
            },
            reload() {
                ;
                location.reload();

            },
            exportPDF() {

                var isbook_id = false;
                var isbook_name = false;
                var isbook_author = false;
                var isbook_price = false;
                var isbook_department = false;
                var isbook_description = false;
                var isbook_image = false;
                var isbook_edition = false;
                var istotal_stock = false;
                var isbook_type = false;
                var ispdf = false;
                var itemTitle = ["book_id", "title", "author", "book_department", "edition", "description", "total_stock", "book_type", "cover_photo", "pdf"];
                // var exportType = document.getElementById("exportType").value;
                var exportType = "excel";
                var items = $('#bookItems option:selected')
                    .toArray().map(item => item.value);
                var str = "";
                var search = document.getElementById("keywords").value;
                var department = document.getElementById("catalog").value;
                var selectedDepartment = document.getElementById('catalog').options[document.getElementById('catalog').selectedIndex].text;




                const exportData = (data) => {
                    if (items.length > 0) {
                        var bookList = [];
                        if (data == 0) {
                            bookList = this.booksJson.filter((ele) => ele.total_stock < 5);
                        } else {
                            bookList = JSON.parse(data).filter((ele) => ele.total_stock < 5);
                        }
                        items.forEach(element => {
                            if (element == "book_id") {
                                isbook_id = true;

                            }
                            if (element == "title") {
                                isbook_name = true;

                            }
                            if (element == "author") {
                                isbook_author = true;

                            }

                            if (element == "book_department") {
                                isbook_department = true;

                            }
                            if (element == "description") {
                                isbook_description = true;

                            }

                            if (element == "edition") {
                                isbook_edition = true;

                            }
                            if (element == "total_stock") {
                                istotal_stock = true;

                            }
                            if (element == "book_type") {
                                isbook_type = true;

                            }

                        });
                        console.log(isbook_id);
                        console.log(isbook_name);
                        console.log(isbook_author);
                        console.log(isbook_department);
                        console.log(isbook_description);
                        console.log(istotal_stock);
                        console.log(isbook_type);
                        console.log(isbook_edition);
                        console.log(isbook_image);
                        console.log(ispdf);
                        if (!isbook_id) {
                            bookList.forEach(element => {
                                delete element.book_id;
                            });
                        }
                        if (!isbook_name) {
                            bookList.forEach(element => {
                                delete element.title;
                            });
                        }
                        if (!isbook_author) {
                            bookList.forEach(element => {
                                delete element.author;
                            });
                        }
                        if (!isbook_department) {
                            bookList.forEach(element => {
                                delete element.book_department;
                            });
                        }
                        if (!isbook_description) {
                            bookList.forEach(element => {
                                delete element.description;
                            });
                        }
                        if (!istotal_stock) {
                            bookList.forEach(element => {
                                delete element.total_stock;
                            });
                        }
                        if (!isbook_type) {
                            bookList.forEach(element => {
                                delete element.book_type;
                            });
                        }
                        if (!isbook_edition) {
                            bookList.forEach(element => {
                                delete element.edition;
                            });
                        }
                        if (!isbook_image) {
                            bookList.forEach(element => {
                                delete element.cover_photo;
                            });
                        }
                        if (!ispdf) {
                            bookList.forEach(element => {
                                delete element.pdf;
                            });
                        }

                        if (exportType == "excel") {
                            var filename = "books.csv";
                            var ws = XLSX.utils.json_to_sheet(bookList);
                            var wb = XLSX.utils.book_new();
                            XLSX.utils.book_append_sheet(wb, ws, "People");
                            XLSX.writeFile(wb, filename);
                        } else {

                            // var doc = new jsPDF();
                            // bookList.forEach(function(ele, i) {
                            //     doc.text(20, 10 + (i * 10),
                            //         "Book Id: " + ele?.book_id +
                            //         "Title: " + ele?.title +
                            //         "Author: " + ele?.author +
                            //         "Book Department: " + ele?.book_department +
                            //         "Edition: " + ele?.edition +
                            //         "Description: " + ele?.description +
                            //         "Total Stock: " + ele?.total_stock +
                            //         "Book Type: " + ele?.book_type
                            //     );
                            // });
                            // doc.save('Test.pdf');
                        }
                        isbook_id = false;
                        isbook_name = false;
                        isbook_author = false;
                        isbook_department = false;
                        isbook_description = false;
                        istotal_stock = false;
                        isbook_type = false;
                        isbook_edition = false;
                        isbook_image = false;
                        ispdf = false;
                    } else {
                        swal({
                            title: "Please select atleast one field to export",
                            text: "",
                            type: "warning"
                        });
                    }
                }

                if (search != "" && department != "0") {
                    exportData(0);
                } else if (search != "" && department == "0") {
                    exportData(0);
                } else {

                    $.ajax({
                        type: "GET",
                        url: "../dbHelper/books.php",
                        data: {
                            startLimit: 0,
                            endLimit: 0,
                            type: "All"
                        },
                        success: function(res) {
                            exportData(res);

                        },
                        error: function(res) {
                            console.log(res);
                        }
                    });
                }
            }

        }
    }
    $("#search-from").on('submit', function(e) {

        e.preventDefault();
        var keywords = $('#keywords').val();
        var deparmentVal = $('#catalog').val();
        var department = "";
        if (deparmentVal !== 0) {
            department = $('#catalog').children(':selected').text();;
        }
        window.location.href = "shortage-alert.php?keyword=" + keywords + "&department=" + department;
    });
</script>
<?php include_once '../librarian/footer.php' ?>