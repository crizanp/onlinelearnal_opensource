<? ob_start(); ?><?php
require_once("includes/Db.php");
require_once("includes/Functions.php");
require_once("includes/Sessions.php");
require_once("includes/DateTime.php");
?>
<!DOCTYPE html lang="en">
<head>
<!-- Basic -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Site Metas -->
<title>Onlinelearnal | Educational Blog and Latest Educational Information</title>
<meta name="keywords" content="Education of Nepal,Onlinelearnal blog,onlinelearnal best educational platform,nepal's education system,nepali syllabus, onlinelearnal">
<meta name="description" content="OnlineLearnal also provides various ideas related to technological and educational context">
<meta name="author" content="">
<meta name="robots" content="INDEX,FOLLOW"/>

<!-- Design fonts -->
<link href="https://fonts.googleapis.com/css?family=Droid+Sans:400,700" rel="stylesheet">

<!-- Custom styles for this template -->
<link href="css/style.css" rel="stylesheet">


<!-- Colors for this template -->
<link href="css/colors.css" rel="stylesheet">

<link href="css/blog.css" rel="stylesheet">

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"><link rel="shortcut icon" type="images/png" href="img/logo/ol.png">
<script src="https://kit.fontawesome.com/85a5fdd30e.js" async></script>

<style type="text/css">

    nav > .nav.nav-tabs{

      border: none;
      color:#fff;
      background:#272e38;
      border-radius:0;

  }
  nav > div a.nav-item.nav-link,
  nav > div a.nav-item.nav-link.active
  {
      border: none;
      padding: 18px 25px;
      color:#fff;
      background:#272e38;
      border-radius:0;
  }

  nav > div a.nav-item.nav-link.active:after
  {
      content: "";
      position: relative;
      bottom: -60px;
      left: -10%;
      border: 15px solid transparent;
      border-top-color: #e74c3c ;
  }
  .tab-content{
      background: #fdfdfd;
      line-height: 25px;
      border: 1px solid #ddd;
      border-top:5px solid #e74c3c;
      border-bottom:5px solid #e74c3c;
      padding:30px 25px;
  }

  nav > div a.nav-item.nav-link:hover,
  nav > div a.nav-item.nav-link:focus
  {
      border: none;
      background: #e74c3c;
      color:#fff;
      border-radius:0;
      transition:background 0.20s linear;
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
 <!-- NAVBAR -->
  <?php
                        echo SuccessMessage();
                        echo ErrorMessage();
                        ?> </center>
 <?php
 require_once("includes/navbar.php");?>
 <!-- NAVBAR -->


 <section class="section wb">
    <div class="p-3">
        <div class="row">
            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                <div class="page-wrapper">
                  
                    <div class="blog-list clearfix">
                       
                        <?php
                        global $ConnectingDb;
                        if (isset($_GET["SearchButton"])) {
                                    # code...
                            $Search=$_GET["Search"];
                            $sql="SELECT * FROM posts
                            WHERE datetime LIKE :search
                            OR title LIKE :search
                            OR category LIKE :search
                            OR post LIKE :search ";
                            $stmt =$ConnectingDb->prepare($sql);
                            $stmt->bindValue(':search','%'.$Search.'%');
                            $stmt->execute();
                        }
                        elseif (isset($_GET["category"])) {
                            $Category=$_GET["category"];
                            $sql="SELECT * FROM posts WHERE category='$Category' ORDER BY id desc";
                            $stmt=$ConnectingDb->query($sql);
                            # code...
                        }
                        else{

                            $sql="SELECT * FROM posts ORDER BY id desc";
                            $stmt=$ConnectingDb->query($sql);

                        }

                        while ($DataRows=$stmt->fetch()) {
                # code...
                            $PostId=$DataRows["id"];
                            $DateTime=$DataRows["datetime"];
                            $PostTitle=$DataRows["title"];
                            $Category=$DataRows["category"];
                            $Admin=$DataRows["author"];
                            $Image=$DataRows["image"];
                            $PostDescription=$DataRows["post"];
                              $PostSummary=$DataRows["summary"];
                            $ViewsCount=$DataRows["views"];


                            ?>
                            <div class="blog-box row pt-3">
                                <div class="col-md-4">
                                    <div class="post-media">
                                        <a href="FullPost.php?id=<?php echo $PostId; ?>" title="">
                                            <img class="img-fluid" src="uploads/<?php echo $Image;?>" />
                                            <div class="hovereffect"></div>
                                        </a>
                                    </div><!-- end media -->
                                </div><!-- end col -->

                                <div class="blog-meta big-meta col-md-8">

                                    <h4><a href="FullPost.php?id=<?php echo $PostId; ?>" title=""class="text-dark"><?php echo $PostTitle;?></a></h4>
                                    <span class="bg-secondary text-light">
                                        <a href="blog.php?category=<?php echo $Category;?>" title="" class="text-light"><?php echo $Category;?></a></span>
                                        <p><?php
                                        if (strlen($PostSummary)>150) {
                       # code...
                                            $PostSummary=substr($PostSummary, 0,150)."...";
                                        } echo $PostSummary; ?></p>
                                        <small><a href="#" title="" class="text-muted"><i class="fa fa-eye"></i>
                                            <?php echo $ViewsCount; ?></a></small>
                                            <small><a href="#" title="" class="text-muted">
                                                <?php echo $DateTime;?></a></small>
                                                <small><a href="#" title="" class="text-muted">
                                                    <?php echo $Admin;?></a></small>
                                            <!-- <small><a href="#" title="" class="text-muted"><i class="fas fa-comment">
                                           <?php
                                         //  $sql="SELECT COUNT(*) FROM comments WHERE status='ON' AND post_id='$PostId'";
                                        //   $stmt=$ConnectingDb->query($sql);
                                        //   $TotalRows =$stmt->fetch();
                                         //  $TotalComments=array_shift($TotalRows);
                                         //  echo $TotalComments;

                                           ?>

                                       </i></a></small> -->

                                   </div><!-- end meta -->
                               </div><!-- end blog-box -->

                           <?php } ?>
                       </div>
                    
                   </div>
                   <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- square -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-8192321483115878"
     data-ad-slot="3773554511"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
                   <hr class="invis">

                   <div class="row">
                    <div class="col-md-12">
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-start">
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end col -->

            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
             <div class="p-2">
                 <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- onlinelearnal_sidebar1_AdSense1_1x1_as -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-8192321483115878"
     data-ad-slot="3852248390"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script><div class="sidebar">
                <div class="widget"><hr>
                    <h2 class="widget-title">Popular Posts</h2><hr>
                    <div class="blog-list-widget">
                        <div class="list-group">
                            <?php 
                            global $ConnectingDb;
                            $sql="SELECT * FROM posts ORDER BY views desc LIMIT 0,3";
                            $stmt =$ConnectingDb->query($sql);
                            while($DataRows=$stmt->fetch()){
                                $Id=$DataRows['id'];
                                $Title=$DataRows['title'];
                                $DateTime=$DataRows['datetime'];
                                $Image=$DataRows['image'];
                                 $Views=$DataRows['views'];


                                ?>
                                <a href="FullPost.php?id=<?php echo $Id;  ?>"
                                    class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="w-100 justify-content-between">
                                        <img src="uploads/<?php echo $Image;?>" alt="" class="img-fluid float-left">
                                        <h5 class="mb-1"><?php

                                        if (strlen($Title)>40) {
                   # code...
                                            $Title=substr($Title, 0,39).'....';
                                        }  echo $Title;?></h5>
                                        <small class="text-left"><?php echo $DateTime; ?></small>
                                    </div>
                                </a>
                            <?php }?>


                        </div>
                    </div><!-- end blog-list -->
                </div><!-- end widget -->
                <div class="list-group widget">
                    <hr><h2 class="widget-title">Popular Categories</h2><hr>
                    <?php
                    global $ConnectingDb;
                    $sql="SELECT * FROM category ORDER BY id desc";
                    $stmt=$ConnectingDb->query($sql);
                    while ($DataRows=$stmt->fetch()) {
  # code...
                      $CategoryId=$DataRows["id"];
                      $CategoryName=$DataRows["title"];


                      ?>
                      <a href="blog.php?category=<?php echo $CategoryName;?>" class="list-group-item list-group-item-action"><?php echo $CategoryName; ?></a>
                  <?php } ?>
                  
              </div><!-- end link-widget -->
              <div class="list-group widget">
                <hr><h2 class="widget-title">Popular Subjects</h2><hr>

                <?php
                global $ConnectingDb;
                $sql="SELECT * FROM subjects";
                $stmt=$ConnectingDb->query($sql);

                while ($DataRows=$stmt->fetch()) {
                # code...
                    $PostId=$DataRows["id"];
                    $DateTime=$DataRows["datetime"];
                    $PostTitle=$DataRows["title"];
                    $Admin=$DataRows["author"];



                    ?>
                    <a href="lessons.php?subject=<?php echo $PostTitle?>" class="list-group-item list-group-item-action">
                        <?php echo $PostTitle;?>
                    </a>
                <?php }?>
            </div>
            <div class="widget">
                </div>
</div>
</div>
</div>
</div><!-- end col -->
<!-- end row -->
<!-- end container -->
</section>

<?php
require_once("includes/footer.php");?><? ob_flush(); ?>



