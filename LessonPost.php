<? ob_start(); ?><?php
require_once("includes/Db.php");
require_once("includes/Functions.php");
require_once("includes/Sessions.php");
require_once("includes/DateTime.php");
?>
<?php
global $ConnectingDb;
$PostIdFromURL=$_GET["lesson"];
if (!isset($PostIdFromURL)) {
    $_SESSION["ErrorMessage"]="This page isn't available. Sorry about that.!";
    Redirect_to("subjects.php");
                                # code...
}
$sql="SELECT * FROM lesson WHERE title='$PostIdFromURL'";
    $stmt=$ConnectingDb->query($sql);
     $sqlviews="UPDATE lesson SET views = views+1 WHERE title ='$PostIdFromURL'";
                                    $ConnectingDb->query($sqlviews);
while ($DataRows=$stmt->fetch()) {
                # code...
    $PostId=$DataRows["id"];
    $DateTime=$DataRows["datetime"];
    $PostTitle=$DataRows["title"];
    $Category=$DataRows["subject"];
    $Admin=$DataRows["author"];
    $Image=$DataRows["image"];
    $PostDescription=$DataRows["post"];
    $PostTag=$DataRows["tag"];
    $PostDescription=$DataRows["description"];
    $PostViews=$DataRows["views"];
}?>

<!DOCTYPE html lang="en">
<head>
<!-- Basic -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Site Metas -->
<title>Notes on <?php echo $PostIdFromURL;?> | Onlinelearnal</title>
<meta name="keywords" content="<?php echo $PostTag;?>">
<meta name="description" content="<?php echo $PostDescription;?>">
<meta name="author" content="">
<meta name="robots" content="INDEX,FOLLOW"/>
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
    .make-me-sticky{
  position: -webkit-sticky;
    position: sticky;
    top: 0;
    
  

    }
</style>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v9.0" nonce="GtXCZLUh"></script>
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
        <!-- NAVBAR -->
        <?php
        require_once("includes/navbar.php");?>
        <!-- NAVBAR -->
        <header id="main-header" class="p-3 bg-dark text-light">
            <div class="container">
                <div class="row">
                    <div class="col align-self-center" id="header-div">
                        <?php
                        global $ConnectingDb;
                        $LessonPostIdFromURL=$_GET["lesson"];
                         $sql="SELECT title FROM lesson WHERE title='$LessonPostIdFromURL'";
                        $stmt=$ConnectingDb->query($sql);
                        $DataRows=$stmt->fetch();

                        
                            
                        


                        
                        if ($LessonPostIdFromURL==null) {
                            $_SESSION["ErrorMessage"]="This page isn't available. Sorry about that.!!";
    Redirect_to("subjects.php");

                            # code...
                        }
                        elseif ($DataRows==null) {
                             $_SESSION["ErrorMessage"]="This page isn't available. Sorry about that.!!";
    Redirect_to("subjects.php");
                            # code...
                        }
                       
                        $sql="SELECT * FROM lesson WHERE title='$LessonPostIdFromURL'";
                        $stmt=$ConnectingDb->query($sql);

                        while ($DataRows=$stmt->fetch()) {
                # code...
                            $PostId=$DataRows["id"];
                            $DateTime=$DataRows["datetime"];
                            $Lesson=$DataRows["title"];
                            $Subject=$DataRows["subject"];
                            $Admin=$DataRows["author"];
                            $Image=$DataRows["image"];
                            $PostDescription=$DataRows["post"];
                        }


                        ?>

                        <h4 class="text-light"><i class="fas fa-edit"></i> Lesson / <a href="lessons.php?subject=<?php echo $Subject;?>"><?php echo $Subject;?></a> / <a href="LessonPost.php?lesson=<?php echo $Lesson;?>"><?php echo $Lesson;?></a></h4>
                    </div>
                </div>
            </div>
        </header>

        <section class="section wb">
            <div class="p-3">
                <div class="row">
                     <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12 d-none d-lg-block">
                       <div class="sidebar">


                        <div class="widget"><hr>
                            <h2 class="widget-title">Recent Blog Posts</h2><hr>
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
</script>
                        <div class="widget">
                            <hr><h2 class="widget-title">Popular Blog Categories</h2><hr>
                            <div class="link-widget text-secondary">
                                <ul> <?php
                                global $ConnectingDb;
                                $sql="SELECT * FROM category ORDER BY id desc";
                                $stmt=$ConnectingDb->query($sql);
                                while ($DataRows=$stmt->fetch()) {
  # code...
                                  $CategoryId=$DataRows["id"];
                                  $CategoryName=$DataRows["title"];


                                  ?>
                                  <a href="blog.php?category=<?php echo $CategoryName;?>"><li><?php echo $CategoryName; ?></li></a>
                              <?php } ?>
                          </ul>
                      </div><!-- end link-widget -->
                  </div><!-- end widget -->
              </div><!-- end sidebar -->
          </div><!-- end col -->
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12"><div class="alert alert-warning alert-dismissible fade show">
        <strong>Note!</strong> In case of any mistake in content or have any queries feel free to Contact us !!
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
                        <div class="page-wrapper">
                            <div class="blog-list clearfix">
                                <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- short highted ads -->
<ins class="adsbygoogle"
     style="display:inline-block;width:100%;height:90px"
     data-ad-client="ca-pub-8192321483115878"
     data-ad-slot="2267039333"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>

                             <?php
                             global $ConnectingDb;
                             $LessonPostIdFromURL=$_GET["lesson"];
                             $sql="SELECT * FROM lesson WHERE title='$LessonPostIdFromURL'";
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



                                ?>
                                <div class="blog-box row">
                                    <div class="col-md-12">


                                        <h3>Notes on <?php echo $PostTitle;?></h3>
                                        <small><a href="#" title="" class="text-muted"><i class="fa fa-eye"></i>
                                        <?php echo $PostViews?></a></small> <span> / </span>
                                        <small><a href="#" title="" class="text-muted">
                                            <?php echo $DateTime;?></a><span class="text-muted"> By- </span></small>
                                            <small><a href="#" title="" class="text-muted"><?php echo $Admin;?></a></small>
                                            <span> / </span>
                                            <?php
                                        if ($Image==null) {
                                            echo '';
    # code...
                                        }
                                        else{
                                            ?>
                                            <div class="post-media">
                                                <img class="img-fluid" src="uploads/<?php echo $Image;?>" />


                                            </div><!-- end media --><?php } ?>

                                        </div><!-- end col -->

                                        <div class="blog-meta big-meta col-md-12">

                                            <p><?php
                                            echo $PostDescription; ?></p>
                                            

                                        </div><!-- end meta -->
                                    </div><!-- end blog-box -->
                                    <div class="fb-comments" data-href="https://onlinelearnal.com/FullPost.php?lesson=<?php echo $LessonPostIdFromURL ?>" data-numposts="10" data-width=""></div>

                                <?php }?>
                                
                                <hr class="invis">
                                


                            </div>
                        </div>
                        <hr class="invis">


                    </div><!-- end col -->
<div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                        <div class="page-wrapper make-me-sticky">
                            <div class="blog-list clearfix">
                                <div class="list-group ">
                                    <h4 class="bg-secondary text-light text-center p-2">Lessons in <?php echo $Subject;?></h4>


                                    <?php
                                    global $ConnectingDb;
                                    $LessonPostIdFromURL=$_GET["lesson"];
                                    $sql="SELECT * FROM lesson WHERE subject='$Subject'";
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



                                        ?>
                                        <?php
                                        if ($PostTitle==$LessonPostIdFromURL) {?>
                                             <a href="LessonPost.php?lesson=<?php echo $PostTitle?>" class="list-group-item bg-success text-light list-group-item-action">
                                            <?php echo $PostTitle;?>
                                        </a><?php

                                         } 
                                         else{
                                            ?>
                                        <a href="LessonPost.php?lesson=<?php echo $PostTitle?>" class="list-group-item list-group-item-action">
                                            <?php echo $PostTitle;?>
                                        </a><?php }?>
                                    <?php }?>
                                </div>
                                <div class="list-group">
                                    <h4 class="bg-secondary text-light text-center p-2">Grab this courses</h4>


                                    <?php
                                    global $ConnectingDb;
                                    $LessonPostIdFromURL=$_GET["lesson"];
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
                                <!-- <div class="blog-box row">
                                    <div class="col-md-12">
                                        <a href="blog.php?category=<?php echo $Category;?>" class="bg-dark text-light p-1" title=""><?php echo $Category;?></a>

                                        <h3><?php echo $PostTitle;?></h3>
                                        <small><a href="#" title="" class="text-muted"><i class="fa fa-eye"></i>
                                        1887</a></small> <span> / </span>
                                        <small><a href="#" title="" class="text-muted">
                                            <?php echo $DateTime;?></a><span class="text-muted"> By- </span></small>
                                            <small><a href="#" title="" class="text-muted"><?php echo $Admin;?></a></small>
                                            <span> / </span>
                                            <div class="post-media">
                                                <img class="img-fluid" src="uploads/<?php echo $Image;?>" />


                                            </div> 

                                        </div> 

                                        <div class="blog-meta big-meta col-md-12">

                                            <p><?php
                                            echo $PostDescription; ?></p>

                                        </div> 
                                    </div>
                                    <div class="fb-comments" data-href="https://onlinelearnal.com/index.php" data-numposts="10" data-width=""></div>

                                
                                -->
                                <hr class="invis">
                                


                            </div>
                        </div>
                        <hr class="invis">


                    </div><!-- end col -->

                   
      </div><!-- end row -->
  </div><!-- end container -->
</section>

<?php
require_once("includes/footer.php");?><? ob_flush(); ?>

