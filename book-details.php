<?php include_once 'header.php';
if(!isset($_SESSION['user_id'])){
  header("Location:login.php");
}
?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<style>
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
</style>

<secction class="bkorder my-5 py-5">
    <div class="row no-gutters py-5">
        <div class="col-lg-9 offset-lg-1 col-md-12 offset-md-0 col-sm-10 offset-sm-1 bkorder-page-row py-3">
          <div class="row bkorder-row">
          <?php
                        $bid=0;
                    if(isset($_GET['id'])){
                        $bid= $_GET['id'];
                    }
                    $dept ="";
                        $rows = (new dbhelper)->__getBookDetails($bid);
                        if ($rows != 0) {
                            $i = 1;
                            foreach ($rows
                                     as $row) {
                                $bookId = $row['book_id'];
                                $edition = $row['edition'];
                                $author = $row['author'];
                                $title = $row['title'];
                                $department = $row['book_department'];
                                $dept=$department;
                                $description = $row['description'];
                                $stock = (new dbhelper)->__getStocks($bookId);
                                $messege="No Stock left";
                                if($stock>0){
                                    $messege ="Book Available";
                                }
                                $accession =  (new dbhelper)->__getAccession($bookId);
                                $bookType = $row['book_type'];
                                $coverImg = $row['cover_photo'];
                                ?>
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
               <br><strong>Description : </strong><?php echo strip_tags(substr($description,0,25)),'...';?></p>
               </div>
               <div class="col-lg-6 col-md-6 col-sm-6 col-12">
               <h3><strong><?php echo $messege?></strong></h3>
               <p><strong> Total Copies available : </strong><?php echo $stock?><br>
               <strong>Accession : </strong><?php echo $accession?></p> 
               <label style="display: none" id="accession" name="accession"><?php echo $accession?></label>
                                    <label style="display: none" id="bookid" name="bookid"><?php echo $bookId?></label>   
                                    <?php if(isset($_SESSION['user_id'])){
                          $userId= $_SESSION['user_id'];
                          $hasOdered = (new dbhelper)->__checkBookOder($bookId,$userId);
                       if($hasOdered == 1){
                             echo '<p style="color: red"> Your Have already made an order for this book</p>';
                          } else{
                              ?>
                              <div>
                              <a href="" id="btnPlaceHold" class="btnhold">Place Now</a>
                              </div>
                              <div class=" mt-4 mb-3">
                              <a href="" id="btnAddToCart" onclick="addToCart(<?php echo $bookId?>)" class="btncart mt-3 mb-3">Add to Cart</a>
                              </div>
              
               <?php   }
                   }?>   
                   <div  id="divErr" class="alert alert-danger alert-dismissible" role="alert" style="display: none">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Failed!</strong> <label id="errMsg"></label>
                </div>            
                <div  id="divscs" class="alert alert-success alert-dismissible" role="alert" style="display: none">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Success</strong> <label id="scsMsg"></label>
                </div>            
                            <div class="clearfix"></div>

               </div>     
            </div>
            </div>
            <?php
                            }
                        }
                        ?>       
          </div>         
        </div>
    </div>
</secction>

<div id="preloader"></div>

<script>
    window.onload = () => {
        $('#preloader').hide();
    }
    $("#btnPlaceHold").click(function (event) {
        event.preventDefault();
        const acn = $("#accession").html();
        const bookid = $("#bookid").html();
        $('#preloader').show();
        setTimeout(function () {
            $.ajax({
                url: 'dbHelper/processOrder.php',
                type: 'post',
                data: {'acn': acn, 'bookid': bookid},
                success: function (response) {
                    $('#preloader').hide();
                    var result = $.trim(response);
                    if (result === "0") {
                        $("#divErr").css("display", "block");
                        $("#errMsg").html("Please Login to make an order");
                    } else if (result === "1") {
                        $("#divErr").css("display", "block");
                        $("#errMsg").html("You do not have permission to make an order!");
                    } else if (result === "2") {
                        $("#divErr").css("display", "block");
                        $("#errMsg").html("Opps!! You Have no cards Left to Order");
                    } else if (result === "4") {
                        $("#divscs").css("display", "block");
                        $("#scsMsg").html("Book is Placed");
                    } else {
                        alert(response);
                        $("#divErr").css("display", "block");
                        $("#errMsg").html("opps!! some error occured");
                    }
                }
            });
        },3000);

    });

    function addToCart(id){
        $.ajax({
                url: 'dbHelper/addToCart.php',
                type: 'POST',
                data: {"bid": id},
                success: function (response) {
                    if (response === "1") {
                        setTimeout(function() {
                            swal({
                                title: "Success",
                                text: "Book Added to Cart",
                                type: "success"
                            }, function() {
                                location.reload();
                            });
                        }, 100);
                    } else  if (response === "2")  {
                        setTimeout(function() {
                            swal({
                                title: "Already Exists!",
                                text: "book Already exists in you Cart",
                                type: "warning"
                            }, function() {

                            });
                        }, 100);
                    }else {
                        setTimeout(function() {
                            swal({
                                title: "Failed!",
                                text: "Book Not Added to Cart",
                                type: "warning"
                            }, function() {

                            });
                        }, 100);
                    }

                }
            });

    }
</script>

<?php include_once 'footer.php' ?>