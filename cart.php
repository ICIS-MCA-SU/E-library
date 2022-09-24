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
    .active55 a,.active54 a, .active51 a, .active53 a{
        color: #545454  !important;
    }
    *{
        padding: 0;
        margin:0;
        box-sizing:border-box;
    }
    body{
        background:white;
        box-sizing:border-box;
    }
    /* .cart-row{
        background:white;
        border-radius:10px;
        box-shadow: 0px 5px 25px 0px rgba(0, 0, 0, 0.2);
    } */
 /*--------------------------------------------------------------
# table responsive
--------------------------------------------------------------*/

table{
  font-family: sans-serif;
  border-collapse: collapse;
  width:100%;
  justify-content:center;
  text-align:center;
}

th{
  background-color: #2a2464;
  color: #fff;
}

th, td{
  padding: .8rem;
  font-size: 14px;
}

tbody{
  color: #555;
}
tr:nth-child(odd) {
    background-color: #ccb7cf;
}
tr:nth-child(even) {
    background-color: #e5b0edb0;
}

.icon {
  font-size: 18px;
  display: inline-block;
  background: #545454;
  color: #fff;
  line-height: 1;
  padding: 8px 0;
  margin-right: 4px;
  border-radius: 50%;
  text-align: center;
  width: 36px;
  height: 36px;
  transition: 0.3s;
}
.icon i{
  color:white;
}

.icon:hover {
  background: #e96b56;
  color: #fff;
  text-decoration: none;
}

.btnbk{
    font-size: 14px;
  display: inline-block;
  background: #545454;
  color: #fff;
  line-height: 1;
  padding: 10px;
  margin-right: 4px;
  text-align: center;
  transition: 0.3s;
  border-radius:10px;
}
.btnbk:hover {
  background: #e96b56;
  color: #fff;
  text-decoration: none;
}
@media screen and (max-width: 600px){
  thead{
    display: none;
  }
  tr{
    margin-top:20px;
    clear:both !important;;
    box-shadow: 0px 5px 25px 0px rgba(0, 0, 0, 0.2);
  }
  td{
    display: block;
  padding: .5rem;
  font-size: 10px;
  }

  td:nth-child(2){
    background-color: #333;
    color: #fff;
    text-align: center;
  }
  

  .cauthor::before{
    content: "Author";
  }

  .cedition::before{
    content: "Edition";
  }
  .cbook_department::before{
    content: "Department";
  }
  .cstock::before{
    content: "Stocks Left";
  }

  td{
    text-align: right;
  }

  td::before{
    float: left;
    margin-right: 3rem;
    font-weight: bold;
  }
  .bkimg{
      display:none;
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
    <h1><strong>My Cart</strong></h1>
  </div>
</section>
<!-- End Hero -->
           <!-- ======= Breadcrumbs ======= -->
           <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">
        <ol>
        <li><a href="index1.php">Home</a></li>
        <li style="cursor:text;">My Account</li>
        <li style="cursor:text;">Cart</li>
      </div>
    </section><!-- End Breadcrumbs -->



<section class="cart my-5 pb-5 ">
        <div class="cart-row col-lg-8 offset-lg-2">
        <form method="post">
            <table>
              <thead>
              <tr>
              <th>Image</th>
              <th>Book</th>
              <th>Author</th>
              <th>Edition</th>
              <th>Department</th>
              <th>Stocks Left</th>
              <th>Action</th>
              </tr>
              </thead>
              <tbody>
              <?php
                    $userId = $_SESSION['user_id'];
                    $booksinCart=(new dbhelper)->__getBooksInCart($userId);
                    if($booksinCart != 0){
                        $i=0;
                        foreach ($booksinCart as $row){
                            $bookId = $row['book_id'];
                            $stock = (new dbhelper)->__getStocks($bookId);
                            ?>
              <tr>
              <td  class="bkimg"><a href="#"><img src="books/<?php echo $row['cover_photo'];?>" alt="Book-Cover-Image" width="50" height="50"></a></td>
              <td class="cbook"><strong><?php echo $row['title']; ?></td>
                <td class="cauthor"><?php echo $row['author']; ?></td>
                <td class="cedition"><?php echo $row['edition']; ?></td>
                <td class="cbook_department"><?php echo $row['book_department']; ?></td>
                <td class="cstock"><?php echo $stock;?></td>
                <td class="icon-btn justify-content-center">


                <?php if ($stock > 0) { ?>
                    <a href="book-details.php?id=<?php echo $bookId ?>" class="btnbk mt-1" >Issue Now</a> 
                            <?php } else {
                                $rowsavd = (new dbhelper)->__getDateToReserve($bookId);
                                $availableDate = "";
                                if ($rowsavd != 0) {
                                    foreach ($rowsavd as $rowavd) {
                                        $availableDate = $rowavd['return_date'];
                                    }
                                }
                            ?>
                    <a href="reserve-book.php?id=<?php echo $bookId ?>" class="btnbk mt-1" >Reserve Now</a> 
                                <?php }      ?> 
                <a onclick="removeFromCart( <?php echo $userId;?> , <?php echo $row['book_id'];?>)" class="icon mt-1" ><i class="icofont-ui-delete"></i></a>  
              </tr>
              <?php  
                }
                } ?>
              </tbody>
            </table>
              </form>
    </div>

</section>


<div id="preloader"></div>
<script>
    window.onload = () => {
        $('#preloader').hide();
    }

    function removeFromCart(userid,bookid){
        $.ajax({
            url: 'dbHelper/addToCart.php',
            type: 'POST',
            data: {"book_id": bookid,"user_id":userid},
            success: function (response) {
                if (response === "1") {
                    setTimeout(function() {
                        swal({
                            title: "Success",
                            text: "Removed from Cart",
                            type: "success"
                        }, function() {
                            location.reload();
                        });
                    }, 100);
                } else {
                    setTimeout(function() {
                        swal({
                            title: "Failed!",
                            text: "Remove Failed",
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