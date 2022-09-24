<?php include_once '../librarian/header.php' ?>
<div class="main-content">
    <div class="card pt-2" style="width: 70%">
        <div class="card-header">
            <h4>Add new Book</h4>
        </div>
        <div class="card-body">




            <form action="../dbHelper/save-book.php" method="post" id="libraryBookFrom"  >

                <input id="bookId" type="hidden" value="<?php if(isset($_GET['id'] )) echo $_GET['id']; ?>">
                <div class="form-group">
                    <label>Book Quantity:</label>
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






        </div>
    </div>


</div>

<script>


    $('#btnEnterAccession').click(function () {
        var count = $('#booksStock').val();
        for (var i =1; i<=count; i++){
            $('#accessionEntry').append(' <div class="form-group"> <div class="input-group"><div class="input-group-prepend"> <span id="" class="input-group-text">book '+i+' </span> </div> <input id="accessionId'+i+'"  type="text" class="form-control" placeholder="enter Accession number" required> </div>   </div> ');

        }
    });


    $('#libraryBookFrom').submit(function (event) {
        event.preventDefault();
        var accessionArray = $('#accessionEntry input').map(function () {
            return this.value;
        });

        var bookId = $("#bookId").val();



        var data = new FormData();
        data.append('Ebook_id',bookId);
        data.append('accession', JSON.stringify(accessionArray));





        $.ajax({
            url: '../dbHelper/save-book.php',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type:'POST',
            success: function (response) {

                if (response === "1") {
                    setTimeout(function() {
                        swal({
                            title: "Success",
                            text: "Cards Updated successfully",
                            type: "success"
                        }, function() {
                            location.reload();
                        });
                    }, 100);
                } else {
                    setTimeout(function() {
                        swal({
                            title: "Failed!",
                            text: " Cards updates Failed",
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
