<? ob_start(); ?><?php
require_once("includes/Db.php");
require_once("includes/Functions.php");
require_once("includes/Sessions.php");
require_once("includes/DateTime.php");
?>
<?php
global $ConnectingDb;
$PostIdFromURL=$_GET["subject"];
if (!isset($PostIdFromURL)) {
    $_SESSION["ErrorMessage"]="This page isn't available. Sorry about that.!!";
    Redirect_to("subjects.php");
                                # code...
}
$sql="SELECT * FROM lesson WHERE subject='$PostIdFromURL'";
$stmt=$ConnectingDb->query($sql);

while ($DataRows=$stmt->fetch()) {
                # code...
    $PostId=$DataRows["id"];
    $DateTime=$DataRows["datetime"];
    $PostTitle=$DataRows["title"];
    $Category=$DataRows["subject"];
    $Admin=$DataRows["author"];
    $Image=$DataRows["image"];
    $PostDescription=$DataRows["post"];
}
?>

<!DOCTYPE html lang="en">
<head>
<!-- Basic -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Site Metas -->
<title><?php echo $PostIdFromURL;?> - Chapterlist | Notes | Onlinelearnal</title>
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

<style type="text/css">
    #middle .middle-item .position {
        width: 280px;
        background: transparent;
    }

    #middle h1 {
        max-width: 100%;
        padding: 12px;
        background: rgb(205, 238, 167);
        color: black;
        font-size: 23px;
    }
    .subbar{
        display: flex;
    flex-flow: column-reverse;
    }
</style>

</head>

<body>
    <center>
        <?php
        echo ErrorMessage();
        echo SuccessMessage();
        ?>   </center>
        <!-- NAVBAR -->
        <?php
        require_once("includes/navbar.php");?>
        <!-- NAVBAR -->
        <header id="main-header" class="p-3 bg-dark text-light">
            <div class="container">
                <div class="row">
                    <div class="col align-self-center" id="header-div">
                        <h4 class="text-light"><i class="fas fa-edit"></i> Lesson / <?php echo strtolower($PostIdFromURL);?>

                    </h4>
                </div>
            </div>
        </div>
    </header>
    <section class="section wb">
        <div class="container">
             <div class="alert alert-warning alert-dismissible fade show">
        <strong>Note!</strong> In case of any mistake in content or have any queries feel free to Contact us!!
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
            <div class="row">

                <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                    <section id="middle">







                      
                           <div class="text-center">
                          <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- in homepage -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-8192321483115878"
     data-ad-slot="4949236511"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script></div> <center>
                         <div class="middle-item">
                            <div class="position">
                                <h1>Select Lesson !!</h1>
                            </div>

                            <div class="row">
                             <?php
                             global $ConnectingDb;
                             $PostIdFromURL=$_GET["subject"];

                             $sql="SELECT * FROM lesson WHERE subject='$PostIdFromURL'";
                             $stmt=$ConnectingDb->query($sql);


                             while ($DataRows=$stmt->fetch()) {
                # code...
                                $PostId=$DataRows["id"];
                                $DateTime=$DataRows["datetime"];
                                $PostTitle=$DataRows["title"];
                                $Category=$DataRows["subject"];
                                $Admin=$DataRows["author"];
                                $Image=$DataRows["image"];
                                $PostDescription=$DataRows["post"];
                                $Level=$DataRows["level"];
                                if ($Level='School') {
                                # code...


                                    ?>
                                    <div class="btn col-lg-4 col-md-6 col-sm-6 col-xs-6">   
                                        <a href="LessonPost.php?lesson=<?php echo $PostTitle?>" class="list-group-item bg-secondary text-white list-group-item-action">
                                            <?php echo $PostTitle;?>
                                        </a>
                                    </div><hr><hr>

                    <?php }
                    else{?>
                        <div class="btn col-lg-4 col-md-6 col-sm-6 col-xs-6">   
                                        <a href="LessonPost.php?lesson=<?php echo $PostTitle?>" class="list-group-item bg-secondary text-white list-group-item-action">
                                            <?php echo $PostTitle;?>
                                        </a>
                                    </div><hr>
                   <?php }?>
                
                <?php }?>


            </div>
        </div>
    </center><!-- end middle-item -->

    <hr class="invis">

</section>
</div><!-- end col -->


<div class="col-lg-3 col-md-12 col-sm-12 col-xs-12 subbar">
 <div class="sidebar">
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

  <div class="widget"><hr>
    <h2 class="widget-title">Recent Posts</h2><hr>
    <div class="blog-list-widget">
        <div class="list-group">
            <?php 
            global $ConnectingDb;
            $sql="SELECT * FROM posts ORDER BY id desc LIMIT 0,5";
            $stmt =$ConnectingDb->query($sql);
            while($DataRows=$stmt->fetch()){
                $Id=$DataRows['id'];
                $Title=$DataRows['title'];
                $DateTime=$DataRows['datetime'];
                $Image=$DataRows['image'];


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
                        <small class="text-right"><?php echo $DateTime; ?></small>
                    </div>
                </a>
            <?php }?>


        </div>
    </div><!-- end blog-list -->
</div><!-- end widget -->

</div><!-- end sidebar -->
</div><!-- end col -->
</div><!-- end row -->
</div><!-- end container -->
</section>

<?php
require "includes/footer.php"; ?><? ob_flush(); ?>
