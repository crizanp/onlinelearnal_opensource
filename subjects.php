<? ob_start(); ?><?php
require_once("includes/Db.php");
require_once("includes/Functions.php");
require_once("includes/Sessions.php");
require_once("includes/DateTime.php");
?>
<!DOCTYPE html lang="en">
<!-- Basic -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Site Metas -->
<title>Subjects List | Notes | Onlinelearnal</title>
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="author" content="">

<!-- Design fonts -->
<link href="https://fonts.googleapis.com/css?family=Droid+Sans:400,700" rel="stylesheet">

<!-- Bootstrap core CSS -->
<link href="css/bootstrap.css" rel="stylesheet">

<!-- FontAwesome Icons core CSS -->
<link href="css/font-awesome.min.css" rel="stylesheet">

<!-- Custom styles for this template -->
<link href="css/style.css" rel="stylesheet">


<!-- Colors for this template -->
<link href="css/colors.css" rel="stylesheet">

<!-- Version Garden CSS for this template -->
<link href="css/blog.css" rel="stylesheet">

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css">
<link rel="shortcut icon" type="images/png" href="img/logo/ol.png">
<script src="https://kit.fontawesome.com/85a5fdd30e.js" async></script>
<style>
    #middle .middle-item {
        position: relative;
    }

    section#middle {
        padding: 10px 0 0 0;
    }


    #middle .middle-item hr {
        border-top: 4px solid #FDCA00;
        box-shadow: none;
    }

    #middle .middle-item .position {
        text-align: center;
        position: absolute;
        top: -25px;
        width: 100%;
        background: transparent;
    }

    #middle h1 {
        margin: 0 auto;
        color: #000000;
        background: rgb(205, 238, 167);
        max-width: 300px;
        font-family: 'Oswald', serif;
        border-radius: 10px;
    }

    #middle .middle-item>.row {
        padding: 20px 0 50px 0;
    }

    .row {
        margin-right: -15px;
        margin-left: -15px;
    }

    .button{
        padding: 7px 20px;
        background: #d7c279a6 !important;
        color: #000;
        width: 100%;
        font-size: 1.51rem;
        font-weight:bold;
        border-radius: 44px;
        cursor: pointer;
        border: none;
        margin-top: 11px;
        border-bottom: 5px solid #b38913;
    }

    .button:hover {
        cursor: pointer;
        background-color: #bda750 !important;
        border-bottom: 6px solid #b38913;
        color:#2b2727;
    }

    .button:active {
        cursor: pointer;
        background-color: #bda750;
        border-bottom: 6px solid #b38913;
    }

    .jumbotron {
        margin-bottom: 0rem;

    }
    .index-content a:hover{
        color:black;
        text-decoration:none;
    }
    .index-content{
        margin-bottom:20px;

    }
    .index-content .row{
        margin-top:20px;
    }
    .index-content a{
        color: black;
    }
    .index-content .card{
        background-color: #FFFFFF;
        padding:0;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border-radius:4px;
        box-shadow: 0 4px 5px 0 rgba(0,0,0,0.14), 0 1px 10px 0 rgba(0,0,0,0.12), 0 2px 4px -1px rgba(0,0,0,0.3);

    }
    .index-content .card:hover{
        box-shadow: 0 16px 24px 2px rgba(0,0,0,0.14), 0 6px 30px 5px rgba(0,0,0,0.12), 0 8px 10px -5px rgba(0,0,0,0.3);
        color:black;
    }
    .index-content .card img{
        width:100%;
        border-top-left-radius: 4px;
        border-top-right-radius: 4px;
    }
    .index-content .card h4{
        margin:20px;
    }
    .index-content .card p{
        margin:20px;
        opacity: 0.65;
    }
    .index-content .blue-button{
        width: 100px;
        -webkit-transition: background-color 1s , color 1s; /* For Safari 3.1 to 6.0 */
        transition: background-color 1s , color 1s;
        min-height: 20px;
        background-color: #002E5B;
        color: #ffffff;
        border-radius: 4px;
        text-align: center;
        font-weight: lighter;
        margin: 0px 20px 15px 20px;
        padding: 5px 0px;
        display: inline-block;
    }
    .index-content .blue-button:hover{
        background-color: #dadada;
        color: #002E5B;
    }
    @media (max-width: 768px) {

        .index-content .col-lg-4 {
            margin-top: 20px;
        }
    }
</style>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-172911420-2"></script>
<script>
window.dataLayer = window.dataLayer || [];

function gtag() {
    dataLayer.push(arguments);
}
gtag('js', new Date());

gtag('config', 'UA-172911420-2');
</script>
</head>

<body>
     <center>
        <?php
        echo ErrorMessage();
        echo SuccessMessage();
        ?>   </center>
    <?php
    require "includes/navbar.php"; ?>
    <div class="jumbotron  p-md-5 text-primary rounded bg-dark">
        <div class="col-md-12 px-0">
            <h3 class="display-5 text-center font-weight-bold animate__animated animate__bounceInLeft">COURSES OFFERED BY
            ONLINELEARNAL</h3>
        </div>
    </div>
    <section id="middle">

        <div class="container">
            

            <div class="middle-item">


                <div class="row">
                    <?php
                    global $ConnectingDb;
                    $sql="SELECT * FROM subjects ORDER BY id asc";
                    $stmt=$ConnectingDb->query($sql);
                    while ($DataRows=$stmt->fetch()) {
  # code...
                      $SubjectId=$DataRows["id"];
                      $SubjectName=$DataRows["title"];


                      ?>
                      <div class="col-xs-12 col-sm-6 col-md-6">
                        <h2 class="mt-3"><a class="btn button" href="lessons.php?subject=<?php echo $SubjectName;?>"><?php echo $SubjectName;?></a> </h2></div>  <?php } ?>
                        <!--<div class="col-xs-12 col-sm-6 col-md-6">-->
                        <!--<h2 class="mt-3"><a class="btn button" href="universe-1.php">Universe</a> </h2></div>-->
                        
                        </div>                



                        <!-- end .row -->
                    </div>


                </div><!-- end middle-item -->

            </div>
            


        </section>
        <div class="container">
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- short highted ads -->
<ins class="adsbygoogle"
     style="display:inline-block;width:100%;height:90px"
     data-ad-client="ca-pub-8192321483115878"
     data-ad-slot="2267039333"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script></div>
         <header id="main-header" class="py-2 text-dark">
    <div class="container">
      <div class="row">
        <div class="col align-self-center" id="header-div">
          <h3 class="text-dark text-center font-weight-bold pb-2"><i class="fas fa-folder"></i> <u>Recent blog Posts</u></h3>
        </div>
      </div>
    </div>
  </header>
        <div class="index-content">
            <div class="container">
                <div class="row">
                   <?php 
                   global $ConnectingDb;
                   $sql="SELECT * FROM posts ORDER BY id desc LIMIT 0,3";
                   $stmt =$ConnectingDb->query($sql);
                   while($DataRows=$stmt->fetch()){
                    $Id=$DataRows['id'];
                    $Title=$DataRows['title'];
                    $DateTime=$DataRows['datetime'];
                    $Image=$DataRows['image'];
                    $Post=$DataRows['post']


                    ?>
                    <a href="FullPost.php?id=<?php echo $Id;  ?>">
                        <div class="col-lg-4">
                            <div class="card">
                                <img src="uploads/<?php echo $Image;?>">
                                <h4><?php

                                if (strlen($Title)>40) {
                   # code...
                                    $Title=substr($Title, 0,39).'....';
                                }  echo $Title;?></h4>
                               
                                <a href="FullPost.php?id=<?php echo $Id;  ?>" class="blue-button">Read More</a>
                            </div>
                        </div>
                    </a>
                <?php }?>

            </div>

        </div>
    </div>


    <!-- footer -->
    <?php
    require "includes/footer.php"; ?><? ob_flush(); ?>
