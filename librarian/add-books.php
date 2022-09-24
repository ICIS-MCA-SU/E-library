<?php include_once '../librarian/header.php' ?>
<div class="main-content">
    <div class="card pt-2" style="width: 70%">
        <div class="card-header">
            <h4>Add new Book</h4>
        </div>
        <div class="card-body">



            <fieldset class="form-group">
                <div class="row">
                    <div class="col-form-label col-sm-3 pt-0">Book Type</div>
                    <div class="col-sm-9">
                        <div class="form-check" style="display: flex">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio3" name="customRadio" class="custom-control-input">
                                <label class="custom-control-label" for="customRadio3">Physical book</label>
                            </div>
                            &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                            <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                                <label class="custom-control-label" for="customRadio2">E material</label>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
            <form action="../dbHelper/save-book.php" method="post" id="libraryBookFrom" style="display: none" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Book Title</label>
                    <input type="text" id="title" name="title" class="form-control">
                </div>
                <div class="form-group">
                    <label>Book Edition:</label>
                    <input type="text" id="edition" name="edition" class="form-control">
                </div>
                <div class="form-group">
                    <label>Book Author:</label>
                    <input type="text " id="author" name="author" class="form-control">
                </div>
                <div class="form-group">
                    <label>Book Department:</label>
                    <select class="form-control" id="department" name="department">
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
                    <textarea class="form-control" id="description" name="description" rows="4"></textarea>
                </div>


                <div class="form-group">
                    <label>Total Book Stock:</label>
                    <div class="input-group mb-3">
                        <input type="text" id="booksStock" name="booksStock" class="form-control" placeholder="" aria-label="">
                        <div class="input-group-append">
                            <button class="btn btn-primary" id="btnEnterAccession" type="button">Enter Accession Numbers</button>
                        </div>
                    </div>
                </div>

                <div id="accessionEntry">

                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-danger">Reset</button>
            </form>



            <form action="" method="post" id="eMaterialForm" style="display: none;" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Book Title</label>
                    <input type="text" id="etitle" name="etitle" class="form-control">
                </div>
                <div class="form-group">
                    <label>Book Edition:</label>
                    <input type="text" id="eedition" name="eedition" class="form-control">
                </div>
                <div class="form-group">
                    <label>Book Author:</label>
                    <input type="text " id="eauthor" name="eauthor" class="form-control">
                </div>
                <div class="form-group">
                    <label>Book Department:</label>
                    <select class="form-control" id="edepartment" name="edepartment">
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
                <div class="form-group">
                    <label>Book Meterial:</label>
                    <select class="form-control" id="bmaterial" name="bmaterial">
                        <option selected disabled>--Select Book Meterial--</option>
                        <option value="PDF Books">PDF Books</option>
                        <option value="Question Paper">Question Paper</option>
                        <option value="Study Meterial">Study Meterial</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Book Image:</label>
                    <div class="custom-file">
                        <input onchange="javascript: esetLableName();" type="file" id="ecoverPhoto" name="ecoverPhoto" class="custom-file-input">
                        <label class="custom-file-label" id="ecoverPhotoLable">Choose file</label>
                    </div>
                </div>

                <div class="form-group">
                    <label>Book pdf:</label>
                    <div class="custom-file">
                        <input onchange="javascript: esetPdfLableName();" type="file" class="custom-file-input" id="pdf" name="pdf">
                        <label class="custom-file-label" id="pdfLable">Choose file</label>
                    </div>
                </div>
                <div class="form-group">
                    <label>Book Description:</label>
                    <textarea class="form-control" id="edescription" name="edescription" rows="4"></textarea>
                </div>


                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-danger">Reset</button>
            </form>



        </div>
    </div>


</div>

<script>
    $('#customRadio3').click(function() {
        if ($("#customRadio3")[0].checked) {
            $('#libraryBookFrom').css("display", "block");
            $('#eMaterialForm').css("display", "none");
        }
    });

    $('#customRadio2').click(function() {
        if ($("#customRadio2")[0].checked) {
            $('#libraryBookFrom').css("display", "none");
            $('#eMaterialForm').css("display", "block");
        }
    });

    $('#btnEnterAccession').click(function() {
        var count = $('#booksStock').val();
        for (var i = 1; i <= count; i++) {
            $('#accessionEntry').append(' <div class="form-group"> <div class="input-group"><div class="input-group-prepend"> <span id="" class="input-group-text">book ' + i + ' </span> </div> <input id="accessionId' + i + '"  type="text" class="form-control" placeholder="enter Accession number" required> </div>   </div> ');

        }
    });


    function setLableName() {
        var filename = $('#coverPhoto').val().split('\\').pop();;
        $('#coverPhotoLable').html(filename);
    }

    function esetLableName() {
        var filename = $('#ecoverPhoto').val().split('\\').pop();;
        $('#ecoverPhotoLable').html(filename);
    }


    function esetPdfLableName() {
        var filename = $('#pdf').val().split('\\').pop();;
        $('#pdfLable').html(filename);
    }


    $('#libraryBookFrom').submit(function(event) {
        event.preventDefault();
        var accessionArray = $('#accessionEntry input').map(function() {
            return this.value;
        });

        var title = $("#title").val();
        var edition = $("#edition").val();
        var author = $("#author").val();
        var department = $("#department").children(':selected').text();
        var description = $("#description").val();
        var stock = $("#booksStock").val();
        var coverPhoto = $("#coverPhoto").prop('files')[0];


        var data = new FormData();
        data.append('title', title);
        data.append('edition', edition);
        data.append('author', author);
        data.append('department', department);
        data.append('description', description);
        data.append('stock', stock);
        data.append('accession', JSON.stringify(accessionArray));
        data.append('cover', coverPhoto);




        $.ajax({
            url: '../dbHelper/save-book.php',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            success: function(response) {
                if (response === "1") {
                    setTimeout(function() {
                        swal({
                            title: "Success",
                            text: "Books Added successfully",
                            type: "success"
                        }, function() {
                            location.reload();
                        });
                    }, 100);
                } else {
                    setTimeout(function() {
                        swal({
                            title: "Failed!",
                            text: " Books Adding Failed",
                            type: "warning"
                        }, function() {

                        });
                    }, 100);
                }

            }
        });



    });

    $('#eMaterialForm').submit(function(event) {
        event.preventDefault();
        // var title = $("#etitle").val();
        // var edition = $("#eedition").val();
        // var author = $("#eauthor").val();
        // var department = $("#edepartment").children(':selected').text();
        // var description = $("#edescription").val();
        // var coverPhoto = $("#ecoverPhoto").prop('files')[0];
        // var pdf = $("#pdf").prop('files')[1];
        //
        //
        // var data = new FormData();
        // data.append('title', title);
        // data.append('edition', edition);
        // data.append('author', author);
        // data.append('department', department);
        // data.append('description', description);
        // data.append('cover', coverPhoto);
        // data.append('file', pdf);

        var form = $('#eMaterialForm')[0];
        var data = new FormData(form);

        $.ajax({
            url: '../dbHelper/save-ebook.php',
            data: data,
            cache: false,
            enctype: 'multipart/form-data',
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            success: function(response) {
                if (response === "1") {
                    setTimeout(function() {
                        swal({
                            title: "Success",
                            text: "Books Added successfully",
                            type: "success"
                        }, function() {
                            location.href="view-book.php";
                        });
                    }, 100);
                } else {
                    console.log(response);
                    setTimeout(function() {
                        swal({
                            title: "Failed!",
                            text: " Books Adding Failed",
                            type: "warning"
                        }, function() {

                        });
                    }, 100);
                }

            }
        });



    });
</script>

<?php include_once '../librarian/footer.php' ?>