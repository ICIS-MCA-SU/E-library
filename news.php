<?php include_once 'header.php' ?>
<!-- Start: Page Banner -->
<section class="page-banner news-listing-banner services-banner">
    <div class="container">
        <div class="banner-header">
            <h2>News </h2>
            <span class="underline center"></span>
            <p class="lead">Get the latest news on your feed.</p>
        </div>
        <div class="breadcrumb">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li>News</li>
            </ul>
        </div>
    </div>
</section>
<!-- End: Page Banner -->


<div  style="margin-bottom: 3%; margin-top: 3%">
    <div class="container">
        <h1 class="heading-text2"> Top News From India <i class="fa fa-newspaper"></i>...</h1><hr><br>
    </div>
    <?php

    $json = file_get_contents('https://newsapi.org/v2/top-headlines?country=in&apiKey=b272685d2fb142aa914e7382753911d7');
    $news = json_decode($json, true);

    foreach ($news["articles"] as $i => $article) {


        ?>
        <div class="container" >
            <div class="card mb-3" style="min-height: 300px; box-shadow: 0px 0px 5px -1px rgba(0, 0, 0, 0.37);">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src=" <?php echo $article['urlToImage'] ?>" style="min-height: 300px; border-radius: 9%" class="card-img" alt="No image">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h3 class="card-title"><strong><?php echo $article['title'] ?></strong> </h3>
                            <p class="card-text" style="font-size: larger"><?php echo $article['description'] ?></p>
                            <p class="card-text">Author:<small class="text-muted" style="font-size: medium"><?php echo $article['author'] ?></small> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Published At:<small class="text-muted" style="font-size: medium"><?php echo $article['publishedAt'] ?></small></p>
                            <a href="<?php echo $article['url'] ?>" style="font-size: 15px; color: #0d6aad"><i class="fa arrow-right"></i> View more Details >>></a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    <?php } ?>
</div>





<div  style="margin-bottom: 3%; margin-top: 3%">
    <div class="container">
        <h1 class="heading-text2"> Latest Technical news from world wide <i class="fa fa-newspaper"></i>...</h1><hr><br>
    </div>
<?php

$json = file_get_contents('https://newsapi.org/v2/top-headlines?sources=techcrunch&apiKey=b272685d2fb142aa914e7382753911d7');
$news = json_decode($json, true);

foreach ($news["articles"] as $i => $article) {


?>
    <div class="container" >
        <div class="card mb-3" style="min-height: 300px; box-shadow: 0px 0px 5px -1px rgba(0, 0, 0, 0.37);">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <img src=" <?php echo $article['urlToImage'] ?>" style="min-height: 300px; border-radius: 9%" class="card-img" alt="No image">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h3 class="card-title"><strong><?php echo $article['title'] ?></strong> </h3>
                        <p class="card-text" style="font-size: larger"><?php echo $article['description'] ?></p>
                        <p class="card-text">Author:<small class="text-muted" style="font-size: medium"><?php echo $article['author'] ?></small> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Published At:<small class="text-muted" style="font-size: medium"><?php echo $article['publishedAt'] ?></small></p>
                        <a href="<?php echo $article['url'] ?>" style="font-size: 15px; color: #0d6aad"><i class="fa arrow-right"></i> View more Details >>></a>
                    </div>
                </div>
            </div>
        </div>

    </div>
<?php } ?>
</div>


<div  style="margin-bottom: 3%; margin-top: 3%">
    <div class="container">
        <h1 class="heading-text2"> Top Business news <i class="fa fa-newspaper"></i>...</h1><hr><br>
    </div>
    <?php

    $json = file_get_contents('https://newsapi.org/v2/top-headlines?country=us&category=business&apiKey=b272685d2fb142aa914e7382753911d7');
    $news = json_decode($json, true);

    foreach ($news["articles"] as $i => $article) {


        ?>
        <div class="container" >
            <div class="card mb-3" style="min-height: 300px; box-shadow: 0px 0px 5px -1px rgba(0, 0, 0, 0.37);">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src=" <?php echo $article['urlToImage'] ?>" style="min-height: 300px; border-radius: 9%" class="card-img" alt="No image">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h3 class="card-title"><strong><?php echo $article['title'] ?></strong> </h3>
                            <p class="card-text" style="font-size: larger"><?php echo $article['description'] ?></p>
                            <p class="card-text">Author:<small class="text-muted" style="font-size: medium"><?php echo $article['author'] ?></small> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Published At:<small class="text-muted" style="font-size: medium"><?php echo $article['publishedAt'] ?></small></p>
                            <a href="<?php echo $article['url'] ?>" style="font-size: 15px; color: #0d6aad"><i class="fa arrow-right"></i> View more Details >>></a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    <?php } ?>
</div>
<!--b272685d2fb142aa914e7382753911d7-->
<!--<script>-->
<!--    window.onload = () => {-->
<!--        var xhttp = new XMLHttpRequest();-->
<!--        xhttp.onreadystatechange = function() {-->
<!--            if (this.readyState == 4 && this.status == 200) {-->
<!--                document.getElementById("demo").innerHTML =-->
<!--                    this.responseText;-->
<!--            }-->
<!--        };-->
<!--        xhttp.open("GET", "https://newsapi.org/v2/everything?q=tesla&from=2021-07-29&sortBy=publishedAt&apiKey=b272685d2fb142aa914e7382753911d7", true);-->
<!--        xhttp.onload = function(){-->
<!--            var Rdata = JSON.parse(xhttp.responseText);-->
<!--            document.getElementById("demo").innerHTML =-->
<!--                Rdata.data.id;-->
<!--        }-->
<!--        xhttp.send();-->
<!--    }-->
<!--</script>-->


<?php include_once 'footer.php' ?>
