<?php include_once '../librarian/header.php' ?>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<style>
    ::-webkit-scrollbar {
        width: 4px;
    }

    ::-webkit-scrollbar-button {
        background: #ccc
    }

    ::-webkit-scrollbar-track-piece {
        background: #888
    }

    ::-webkit-scrollbar-thumb {
        background: #eee
    }

    .main-content {
        padding-top: 80px;
    }
</style>
<div class="main-content" x-data="book">

    <div class="card pt-2">
        <div class="card-header">
            <h4>Edit Book</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-3" style="text-align:center">
                    <img id="coverImage" x-bind:src="'../books/'+bookDetail[0]?.cover_photo" alt="No Image" class="img-thumbnail shadow-warning">

                </div>
                <div class="col-md-8">

                    <form id="libraryBookFrom" enctype="multipart/form-data" method="post" action="../dbHelper/edit-books.php">
                        <input type="hidden" id="book_id" name="book_id" class="form-control" x-bind:value="bookDetail[0]?.book_id">

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Book Title</label>
                                    <input type="text" id="title" name="title" class="form-control" x-bind:value="bookDetail[0]?.title">
                                </div>
                                <div class="col-md-6">
                                    <label>Book Edition:</label>
                                    <input type="text" id="edition" name="edition" class="form-control" x-bind:value="bookDetail[0]?.edition">
                                </div>
                            </div>

                        </div>

                        <input type="hidden" id="book_type" name="book_type" class="form-control" x-bind:value="bookDetail[0]?.book_type">

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Book Author:</label>
                                    <input type="text " id="author" name="author" class="form-control" x-bind:value="bookDetail[0]?.author">
                                </div>
                                <div class="col-md-6">
                                    <label>Book Department:</label>
                                    <select class="form-control" id="department" name="department" x-bind:value="bookDetail[0]?.book_department">
                                        <option selected="" disabled="">--Select Department--</option>
                                        <option>College of Engineering & Technology</option>
                                        <option>College of Management & Commerce</option>
                                        <option>College of Allied Health Science & Information Science</option>
                                        <option> College of Computer Science & Information Science</option>
                                        <option> College of Aviation Studieds</option>
                                        <option> College of Social Science & Humanities</option>
                                        <option> College of Hotel Management & Tourism</option>
                                        <option> College of Physiotherapy</option>
                                        <option> College of Education</option>
                                        <option> College of Nursing Science</option>
                                        <option> College of Yoga Sanskrit & Research Centre</option>
                                    </select>
                                </div>
                            </div>


                        </div>
                        <div class="form-group">
                            <label>Book Image:</label>
                            <div class="custom-file">
                                <input onchange="javascript: setLableName();" type="file" id="coverPhoto" name="coverPhoto" class="custom-file-input">
                                <label class="custom-file-label" id="coverPhotoLable">Choose file</label>
                            </div>
                        </div>

                        <!--                <div class="form-group">-->
                        <!--                    <label>Book Description:</label>-->
                        <!--                    <input type="file" class="form-control-file" id="img" name="img" >-->
                        <!--                </div>-->
                        <div class="form-group">
                            <label>Book Description:</label>
                            <textarea class="form-control" id="description" name="description" rows="4" x-bind:value="bookDetail[0]?.description"></textarea>
                        </div>
                        <div class="form-group" x-show="bookDetail[0]?.book_type=='physical book'?false:true">
                            <div class="form-group">
                                <label>Book Meterial:</label>
                                <select class="form-control" id="bmaterial" name="bmaterial" x-bind:value="bookDetail[0]?.book_type">
                                    <option>--Select Book Meterial--</option>
                                    <option value="PDF Books">PDF Books</option>
                                    <option value="Question Paper">Question Paper</option>
                                    <option value="Study Material">Study Material</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Book pdf:</label>
                                <div class="custom-file">
                                    <input onchange="javascript: esetPdfLableName();" type="file" class="custom-file-input" id="pdf" name="pdf">
                                    <label class="custom-file-label" id="pdfLable">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" x-show="bookDetail[0]?.book_type=='physical book'?true:false">
                            <label>Total Book Stock:</label>
                            <div class="input-group mb-3">
                                <input type="text" id="booksStock" name="booksStock" class="form-control" placeholder="" aria-label="" x-bind:value="bookDetail[0]?.total_stock">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" id="btnEnterAccession" type="button">Enter Accession Numbers</button>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="totalBooksStock" name="totalBooksStock" x-bind:value="bookDetail[0]?.total_stock">

                        <div class="card shadow-none" id="accessionEntryNo" x-show="bookDetail[0]?.book_type=='physical book'?true:false">
                            <div class="card-body " style="max-height:400px;overflow-y:scroll;" class="px-4">
                                <template x-for="(item,index) in accession" :key="index">
                                    <div class="form-group" x-bind:id="'Accession'+item.id">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span id="" class="input-group-text">book <span x-text="index+1"></span> </span>
                                            </div> <input x-bind:id="item.id" type="text" class="form-control" placeholder="enter Accession number" required x-bind:value="item.accession_number">
                                            <a x-on:click="deleteAccessionDetails(item.id)" class="d-flex align-self-center" style="cursor:pointer"><i class="fas fa-trash-alt" style="font-size: 20px;color:red"></i></a>

                                        </div>
                                    </div>
                                </template>
                                <div id="accessionEntry">

                                </div>
                            </div>
                        </div>

                        <div class="form-group px-4">
                            <button type="submit" class="btn btn-primary  px-5">Submit</button>
                            <a href="/sulibrary/librarian/view-book.php" class="btn btn-danger px-5">Cancel</a>
                        </div>


                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
</div>


</div>
<script>
    function setLableName() {
        var filename = $('#coverPhoto').val().split('\\').pop();;
        $('#coverPhotoLable').html(filename);
        var coverPhoto = $("#coverPhoto").prop('files')[0];
        $("#coverImage").attr("src", URL.createObjectURL(coverPhoto));

    }

    function esetLableName() {
        var filename = $('#ecoverPhoto').val().split('\\').pop();;
        $('#ecoverPhotoLable').html(filename);
    }


    function esetPdfLableName() {
        var filename = $('#pdf').val().split('\\').pop();;
        $('#pdfLable').html(filename);
    }

    $('#btnEnterAccession').click(function() {
        var totalCount = $('#totalBooksStock').val();
        var newCount = $('#booksStock').val();
        var total = 0;
        if (totalCount > newCount) {
            total = 0;
        } else {
            total = parseInt(newCount) - parseInt(totalCount);
        }
        for (var i = 1; i <= total; i++) {
            $('#accessionEntry').append(' <div class="form-group"> <div class="input-group"><div class="input-group-prepend"> <span id="" class="input-group-text">book ' + (parseInt(totalCount) + i) + ' </span> </div> <input id="accessionId' + (parseInt(totalCount) + i) + '"  type="text" class="form-control" placeholder="enter Accession number" required> </div>   </div> ');

        }
    });
    let book = () => {
        return {
            bookDetail: [],
            accession: [],
            isDeleted: 0,
            book_id: location.search.split('id=')[1],

            init() {
                this.book_id = location.search.split('id=')[1];
                this.getBookDetails();
                this.getBookAccessionDetails();
            },
            getBookDetails() {
                var book_id = location.search.split('id=')[1]
                const setBook = (data) => {
                    this.bookDetail = JSON.parse(data);
                }

                $.ajax({
                    type: "GET",
                    url: "../dbHelper/edit-books.php",
                    data: {
                        book_id: this.book_id,
                        type: "Book"
                    },
                    success: function(res) {
                        setBook(res);
                    },
                    error: function(res) {
                        console.log(res);
                    }
                });
            },
            getBookAccessionDetails() {
                var book_id = location.search.split('id=')[1]
                const setAccession = (data) => {
                    this.accession = JSON.parse(data);
                }

                $.ajax({
                    type: "GET",
                    url: "../dbHelper/edit-books.php",
                    data: {
                        book_id: this.book_id,
                        type: "Accession"
                    },
                    success: function(res) {
                        setAccession(res);
                    },
                    error: function(res) {
                        console.log(res);
                    }
                });
            },
            deleteAccessionDetails(id) {
                const deleteAccession = (data) => {
                    this.isDeleted = data;
                    if (this.isDeleted == 1) {
                        $('#Accession' + id).remove();
                        var stockVal = $('#booksStock').val();
                        $('#booksStock').val(stockVal - 1);
                        swal("Hi there!", "Accession detail successsfully deleted", "success");
                    }
                }

                $.ajax({
                    type: "GET",
                    url: "../dbHelper/edit-books.php",
                    data: {
                        id: id,
                        type: "DeleteAccession"
                    },
                    success: function(res) {
                        deleteAccession(res);
                    },
                    error: function(res) {
                        setTimeout(function() {
                            swal({
                                title: "Failed!",
                                text: " Books Deletion Failed",
                                type: "warning"
                            }, function() {});
                        }, 100);
                        console.log(res);
                    }
                });
            },


        }
    }

    $('#libraryBookFrom').submit(function(event) {
        event.preventDefault();

        var book_id = $("#book_id").val();

        var title = $("#title").val();
        var edition = $("#edition").val();
        var author = $("#author").val();
        var department = $("#department").children(':selected').text();
        var description = $("#description").val();
        var stock = $("#booksStock").val();
        var book_type = $("#book_type").val();
        if (book_type != "physical book") {
            book_type = $("#bmaterial").val();
        }
        var coverPhoto = $("#coverPhoto").prop('files')[0];
        var data = new FormData();
        data.append('book_id', book_id);
        data.append('book_type', book_type);

        data.append('title', title);
        data.append('edition', edition);
        data.append('author', author);
        data.append('department', department);
        data.append('description', description);
        data.append('cover', coverPhoto);
        if (book_type!= "physical book") {
            data.append('stock', 0);
            // var department = $("#bmeterial").children(':selected').text();
            var pdf = $("#pdf").prop('files')[1];
            // data.append('bmeterial', bmeterial);
            data.append('pdf', pdf);
        } else {
            var accessionArray = $('#accessionEntryNo input').map(function() {
                return this.value;
            });
            data.append('stock', stock);

            data.append('accession', JSON.stringify(accessionArray));
        }


        // , function() {
        //                     window.location = '/sulibrary/librarian/view-book.php';
        //                 });
        $.ajax({
            url: "../dbHelper/updateBookDetails.php",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            success: function(response) {
                console.log(response);
                if (response === "1") {
                    setTimeout(function() {
                        swal({
                            title: "Success",
                            text: "Books updated successfully",
                            type: "success"
                        }, function() {
                            window.location = '/sulibrary/librarian/view-book.php';
                        });
                    }, 100);
                } else {
                    setTimeout(function() {
                        swal({
                            title: "Failed!",
                            text: " Books updation Failed.Please check book image size and type(.pdf, .doc, .docx, .txt, .jpeg, .jpg)",
                            type: "warning"
                        }, function() {
                            // window.location = '/sulibrary/librarian/edit-book.php?id=' + book_id;
                        });
                    }, 100);
                }

            }
        });



    });
</script>

<?php include_once '../librarian/footer.php' ?>