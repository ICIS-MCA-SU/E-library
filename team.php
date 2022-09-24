<?php include_once 'header.php';
if(!isset($_SESSION['user_id'])){
  header("Location:login.php");
}
?>
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
       <style>
      #Iframe-Master-CC-and-Rs {
        max-width:800px;
        max-height: 100%;
        overflow: hidden  !important;;
      }

      /* inner wrapper: make responsive */
      .responsive-wrapper {
        position: relative;
        height: 0; /* gets height from padding-bottom */

        /* put following styles (necessary for overflow and scrolling handling on mobile devices) inline in .responsive-wrapper around iframe because not stable in CSS:
    -webkit-overflow-scrolling: touch; overflow: auto; */
      }

      .responsive-wrapper iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;

        margin: 0;
        padding: 0;
        border: none;
      }

      /* padding-bottom = h/w as % -- sets aspect ratio */
      /* YouTube video aspect ratio */
      .responsive-wrapper-wxh-572x612 {
        padding-bottom: 107%;
      }

      /* general styles */
      /* ============== */
      .set-box-shadow {
        -webkit-box-shadow: 4px 4px 14px #4f4f4f;
        -moz-box-shadow: 4px 4px 14px #4f4f4f;
        box-shadow: 4px 4px 14px #4f4f4f;
      }
      .set-padding {
        padding: 40px;
      }
      .set-margin {
        margin: 30px;
      }
      .center-block-horiz {
        margin-left: auto !important;
        margin-right: auto !important;
      }
      #downloads{
          display:none;
      }
      @media screen and (max-width: 768px){
        .set-padding {
        padding: 10px;
      }
    }
    @media print {
  #print {
    display: none;
  }
}
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="//mozilla.github.io/pdf.js/build/pdf.js"></script>

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
                                $pdf=$row['pdf'];
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


<secction class="bkorder mt-5 pt-5">
    <div class="row no-gutters pt-5">
        <div class="col-lg-10 offset-lg-1 col-md-12 offset-md-0 col-sm-10 offset-sm-1 bkorder-page-row py-3">
          <div class="row bkorder-row">
          
            <div class="col-lg-3 col-md-3 col-sm-12 px-2 py-2 bkorder-img-row no-gutters" style="">
              <div class="bkorder-logo py-3">
                <img src="books/<?php echo $coverImg?>" alt="">
              </div>
            </div>
             <div class="col-lg-9 col-md-9 col-sm-12  bkorder-page px-2">
               <div class="row bkorder-body">
               <div class="col-lg-12 col-md-12 col-sm-12 col-12">
               <h3><strong>Book Details</strong></h3>
               <h4><strong>Book Name : </strong><?php echo $title?></h4>
               <p><strong>Author : </strong><?php echo $author?>
               <br><strong>Edition : </strong> <?php echo $edition?>
               <br><strong>Department : </strong><?php echo $department?>
               <br><strong>Description : </strong><?php echo strip_tags(substr($description,0,25)),'...';?></p>
               </div>
            </div>
            </div>
          </div>         
        </div>
    </div>
</secction>


<div
      id="Iframe-Master-CC-and-Rs"
      class="set-margin set-padding set-border set-box-shadow center-block-horiz mb-5"
    >
      <div
        class="responsive-wrapper responsive-wrapper-wxh-572x612"
        style="-webkit-overflow-scrolling: touch; overflow: auto"
      >
        <iframe src="books/pdf/<?php echo $pdf?>#toolbar=0&print=0&more=0&navpanes=0&statusbar=0&view=Fit;readonly=true;print=false;downloads=false">
          <p style="font-size: 110%">
            <em
              ><strong>ERROR: </strong> An &#105;frame should be displayed here
              but your browser version does not support &#105;frames. </em
            >Please update your browser to its most recent version and try
            again.
          </p>
        </iframe>
      </div>
    </div>
    <?php
                            }
                        }
                        ?> 


   
<?php include_once 'footer.php' ?>