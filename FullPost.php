<? ob_start(); ?><?php
require_once("includes/Db.php");
require_once("includes/Functions.php");
require_once("includes/Sessions.php");
require_once("includes/DateTime.php");
?>
<?php
global $ConnectingDb;


    $PostIdFromURL=$_GET["id"];
    if (!isset($PostIdFromURL)) {
        $_SESSION["ErrorMessage"]="This page isn't available. Sorry about that.!!";
        Redirect_to("blog.php");
                             
    }
   if(isset($_POST["submit"])){
    $Name=$_POST['CommenterName'];
    $Email=$_POST['CommenterEmail'];
    $Comment=$_POST['CommenterThought'];
    if (empty($Name)||empty($Email)||empty($Comment)) {
                              # code...
      $_SESSION["ErrorMessage"]="All field must be filled compulsory";
      Redirect_to("FullPost.php?id=$PostIdFromURL");
      
  }
  elseif (strlen($Comment)>1000) {

    $_SESSION["ErrorMessage"]="Comment should be at less than 500 characters";
    Redirect_to("FullPost.php?id=$PostIdFromURL");
    
    
}

else{
                            // insert query
  $sql="INSERT INTO comments(datetime,name,email,comment,approvedby,unapprovedby,status,post_id)";
  $sql .="VALUES(:datetime,:name,:email,:comment,'Pending','pending','OFF',:postIdFromURL)";
  $stmt=$ConnectingDb->prepare($sql);
  $stmt->bindValue(':datetime',$DateTime);
  $stmt->bindValue(':name',$Name);
  $stmt->bindValue(':email',$Email);
  $stmt->bindValue(':comment',$Comment);
  $stmt->bindValue(':postIdFromURL',$PostIdFromURL);

  $Execute=$stmt->execute();
  if ($Execute) {
   $_SESSION["SuccessMessage"]="Your comment has sent and required for approval ";
   Redirect_to("FullPost.php?id=$PostIdFromURL");

}
else
{
   $_SESSION["ErrorMessage"]="Sorry, can't post your comment right now";
   Redirect_to("FullPost.php?id=$PostIdFromURL");

}
}
}

 $sql="SELECT * FROM posts WHERE id='$PostIdFromURL'";
    $stmt=$ConnectingDb->query($sql);

while ($DataRows=$stmt->fetch()) {
                # code...
    $PostId=$DataRows["id"];
    $DateTime=$DataRows["datetime"];
    $PostTitle=$DataRows["title"];
    $Category=$DataRows["category"];
    $Admin=$DataRows["author"];
    $Image=$DataRows["image"];
    $PostDescription=$DataRows["post"];
    $PostTag=$DataRows["tag"];
    $PostDescription=$DataRows["description"];
}
$SearchQueryParameter=$_GET["id"];
if ($SearchQueryParameter!==$PostId) {
   $_SESSION["ErrorMessage"]="This page isn't available. Sorry about that.";
   Redirect_to("blog.php");
    # code...
}

?>

<!DOCTYPE html lang="en">
<!-- Basic -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Site Metas -->
<title>Blog | <?php echo $Category; ?> | <?php echo $PostTitle; ?> | Onlinelearnal</title>
<meta name="keywords" content="<?php echo $PostTag;?>">
<meta name="description" content="<?php echo $PostDescription; ?>">
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

<link href="css/blog.css" rel="stylesheet">

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css">
<link rel="shortcut icon" type="images/png" href="img/logo/ol.png">
<script src="https://kit.fontawesome.com/85a5fdd30e.js" async></script>

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
                        <h4 class="text-light"><i class="fas fa-edit"></i> blog / <a href="blog.php?category=<?php echo $Category;?>"><?php echo $Category;?></a></h4>
                    </div>
                </div>
            </div>
        </header>

        <section class="section wb">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
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
                                else{
                                    $PostIdFromURL=$_GET["id"];
                                    if (!isset($PostIdFromURL)) {
                                        $_SESSION["ErrorMessage"]="sorry you can't go to this section!!";
                                        Redirect_to("blog.php");
                                # code...
                                    }
                                    $sql="SELECT * FROM posts WHERE id='$PostIdFromURL'";
                                    $stmt=$ConnectingDb->query($sql);
                                    $sqlviews="UPDATE posts SET views = views+1 WHERE id ='$PostIdFromURL'";
                                    $ConnectingDb->query($sqlviews);

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
                                     $PostViews=$DataRows["views"];


                                    ?>
                                    <div class="blog-box row">
                                        <div class="col-md-12">
                                            <a href="blog.php?category=<?php echo $Category;?>" class="bg-dark text-light p-1 pl-2 pr-2" title=""><?php echo $Category;?></a>

                                            <h3><?php echo $PostTitle;?></h3>
                                            <small><a href="#" title="" class="text-muted"><i class="fa fa-eye"></i>
                                             <?php echo $PostViews; ?> </a></small> <span> / </span>
                                            <small><a href="#" title="" class="text-muted">
                                                <?php echo $DateTime;?></a><span class="text-muted"> By- </span></small>
                                                <small><a href="#" title="" class="text-muted"><?php echo $Admin;?></a></small>
                                                <span> / </span>
                                                <div class="post-media">
                                                    <?php if ($Image==null) {
                                                        echo '';
                                                        # code...
                                                    }
                                                    else{?>
                                                        <img class="img-fluid" src="uploads/<?php echo $Image;?>" />
                                                    <?php } ?>


                                                </div><!-- end media -->
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

                                            </div><!-- end col -->

                                            <div class="blog-meta big-meta col-md-12">

                                                <p><?php
                                                echo $PostDescription; ?></p>

                                            </div><!-- end meta -->
                                        </div><!-- end blog-box -->
                                        <div class="be-comment-block">
                                            <h1 class="comments-title">Leave Your View</h1>
                                            <form method="post"action="FullPost.php?id=<?php echo $SearchQueryParameter;?>">
                                                <div class="form-group">
                                                    <label for="exampleFormControlInput2">Name</label>
                                                    <input name="CommenterName" type="name" class="form-control" id="exampleFormControlInput1" placeholder="your name">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleFormControlInput1">Email address</label>
                                                    <input name="CommenterEmail" type="email" class="form-control" id="exampleFormControlInput2" placeholder="name@example.com">
                                                </div>




                                                <div class="form-group">
                                                    <label for="exampleFormControlTextarea1">Example textarea</label>
                                                    <textarea name="CommenterThought"class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                </div>
                                                <button type="submit"name="submit" class="btn btn-primary mb-2">Publish</button>
                                            </form>

                                            <h1 class="comments-title">Comments</h1>


                                            <!-- Comment area -->
                                            <!-- Fetching existing comments -->
                                            <?php 
                                            global $ConnectingDb;
                                            $sql ="SELECT * FROM comments 
                                            WHERE post_id='$PostIdFromURL' AND status='ON'";
                                            $stmt=$ConnectingDb->query($sql);
                                            while ($DataRows=$stmt->fetch()) 
                                            {
                                                $CommentDate=$DataRows['datetime'];
                                                $CommenterName=$DataRows['name'];
                                                $CommentContent=$DataRows['comment'];

    # code...

                                                ?>

                                                <div class="be-comment">
                                                    <div class="be-img-comment">

                                                        <img src="img/avatar.png" alt=""
                                                        class="be-ava-comment">

                                                    </div>
                                                    <div class="be-comment-content">

                                                        <span class="be-comment-name">
                                                            <a href="blog-detail-2.html"><?php echo $CommenterName;?></a>
                                                        </span>
                                                        <span class="be-comment-time">
                                                            <i class="fa fa-clock-o"></i>
                                                            <?php echo $CommentDate;?>
                                                        </span>

                                                        <p class="be-comment-text">
                                                            <?php echo $CommentContent;?>
                                                        </p>
                                                    </div>
                                                </div>
                                            <?php }?>
                                <!-- <div class="be-comment">
                                    <div class="be-img-comment">
                                        <a href="blog-detail-2.html">
                                            <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt=""
                                                class="be-ava-comment">
                                        </a>
                                    </div>
                                    <div class="be-comment-content">
                                        <span class="be-comment-name">
                                            <a href="blog-detail-2.html">Phoenix, the Creative Studio</a>
                                        </span>
                                        <span class="be-comment-time">
                                            <i class="fa fa-clock-o"></i>
                                            May 27, 2015 at 3:14am
                                        </span>
                                        <p class="be-comment-text">
                                            Nunc ornare sed dolor sed mattis. In scelerisque dui a arcu mattis, at
                                            maximus eros commodo. Cras magna nunc, cursus lobortis luctus at,
                                            sollicitudin vel neque. Duis eleifend lorem non ant. Proin ut ornare lectus,
                                            vel eleifend est. Fusce hendrerit dui in turpis tristique blandit.
                                        </p>
                                    </div>
                                </div> -->
                                <!-- <div class="be-comment">
                                    <div class="be-img-comment">
                                        <a href="blog-detail-2.html">
                                            <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt=""
                                                class="be-ava-comment">
                                        </a>
                                    </div>
                                    <div class="be-comment-content">
                                        <span class="be-comment-name">
                                            <a href="blog-detail-2.html">Cüneyt ŞEN</a>
                                        </span>
                                        <span class="be-comment-time">
                                            <i class="fa fa-clock-o"></i>
                                            May 27, 2015 at 3:14am
                                        </span>
                                        <p class="be-comment-text">
                                            Cras magna nunc, cursus lobortis luctus at, sollicitudin vel neque. Duis
                                            eleifend lorem non ant
                                        </p>
                                    </div>
                                </div> -->

                            </div>
                            <hr class="invis">
                        <?php } ?>


                    </div>
                </div>
                <hr class="invis">


            </div><!-- end col -->

            <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
             <div class="sidebar">


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
            </div>
        </div><!-- end sidebar -->
    </div><!-- end col -->
</div><!-- end row -->
</div><!-- end container -->
</section>

<?php
require_once("includes/footer.php");?><? ob_flush(); ?>
