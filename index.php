<?php
require_once("includes/Db.php");
require_once("includes/Functions.php");
require_once("includes/Sessions.php");
require_once("includes/DateTime.php");
?>
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

?>

<!DOCTYPE html lang="en">
<!-- Basic -->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


<!-- HTML Meta Tags -->
<title>Notes, Syllabus, Questions | Onlinelearnal</title>
<meta name="description" content="Onlinelearnal provides free notes and syllabus courses where you can learn various topic related to school courses and collage courses. Main motive of onlinelearnal is to make understandable notes.">

<!-- Facebook Meta Tags -->
<meta property="og:url" content="https://onlinelearnal.com/">
<meta property="og:type" content="website">
<meta property="og:title" content="Notes, Syllabus, Questions | Onlinelearnal">
<meta property="og:description" content="Onlinelearnal provides free notes and syllabus courses where you can learn various topic related to school courses and collage courses. Main motive of onlinelearnal is to make understandable notes.">
<meta property="og:image" content="https://www.onlinelearnal.com/img/logo/onlinelearnal-logo.png">

<!-- Twitter Meta Tags -->
<meta name="twitter:card" content="summary_large_image">
<meta property="twitter:domain" content="onlinelearnal.com">
<meta property="twitter:url" content="https://onlinelearnal.com/">
<meta name="twitter:title" content="Notes, Syllabus, Questions | Onlinelearnal">
<meta name="twitter:description" content="Onlinelearnal provides free notes and syllabus courses where you can learn various topic related to school courses and collage courses. Main motive of onlinelearnal is to make understandable notes.">
<meta name="twitter:image" content="https://www.onlinelearnal.com/img/logo/onlinelearnal-logo.png">

<!-- Meta Tags Generated via https://www.opengraph.xyz -->
      
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
<link rel="shortcut icon" type="images/png" href="img/logo/ol.png">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css">
<script src="https://kit.fontawesome.com/85a5fdd30e.js" async></script>
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5f3e367bcc6a6a5947ad4ed2/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-172911420-2"></script>
<script>
window.dataLayer = window.dataLayer || [];

function gtag() {
    dataLayer.push(arguments);
}
gtag('js', new Date());

gtag('config', 'UA-172911420-2');
</script>
<script data-ad-client="ca-pub-8192321483115878" async
    src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- end google -->

<style>
    .btn-primary {
        padding: 8px 0px;
        background: #548fdba6;
        color: #000;
        width: 88%;
        font-size: 1nt-weight: bold;
        border-radius: 0px;
        cursor: pointer;
        border: none;
        margin-top: 0px;
    }

    .btn-primary:hover {
        cursor: pointer;
        background-color: #429edb;

    }
    .text-dark:hover{
        text-decoration: none;
    }
    a:hover{
        text-decoration: none;
        
    }

</style>
<link rel="stylesheet" href="css/style.css">
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
        <!--carousel-->

        <div class="main-container carousel-height">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div>
                        <div class="breadcrumb-home">
                            <h4 class="animate__animated animate__heartBeat">The Best Online Learning Platform</h4>
                        </div>
                    </div>
                <!-- <div class="carousel-item active first-slider"style="background-image: url('img/articles/covid19.jpg');">
                    <img src="img/articles/covid19.jpg">
                    <div class="inside-container">
                        <div class="row">
                            <div class="col-lg-12  ">
                                <div class="carousel-text">
                                    <h1><span class="first">MAKE YOUR </span><span class="second">COURSES</span> MORE
                                        <span class="bs-card"> SIMPLIER</span>
                                    </h1>
                                    <h3>Onlinelearnal provides<br> free notes and syllabus courses where you can learn
                                        various topic<br> related to school courses and collage courses.</h3>
                                    <div class="butns"> <a href="courses.php"><button class="work-btn">OUR
                                                COURSES</button></a> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="carousel-item  active first-slider"style="background-image: linear-gradient( rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7) ),url('img/banner.jpg');">

                    <div class="inside-container">
                        <div class="row">
                            <div class="col-lg-12 ">
                                <div class="carousel-text">
                                    <h1><span class="first">MAKE YOUR </span> <span class="second">COURSES</span> MORE <span
                                        class="bs-card"> SIMPLIER </span></h1>
                                        <h3>Onlinelearnal provides<br> free notes and syllabus courses where you can learn
                                            various topic<br> related to school courses and collage courses.</h3>
                                            <div class="butns">
                                                <a href="blog.php"><button class="work-btn">OUR BLOGS</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- courses we offered -->
            <div class="main-container ">
                <div class="inside-container">
                    <div class="row">
                        <div class="col-12 our-header">
                            <h2> <a href="subjects.php"class="text-secondary">Courses</a> we offered</h2>
                            <div class="text-center">
                                <hr> <i class="far fa-square rotate-45"></i> <i class="far fa-square rotate-45"></i>
                                <hr>
                            </div>
                        </div>
                    </div>
                    <div class="row row-pad">
                        <div class=" col-sm-6 col-md-6 our-spec">
                            <h3 class="our-spec-heading"> Physics</h3>
                            <p>Get Physics syllabus course for free. Here you will get all the topic necessary for your
                            examination point of view. It is still incomplete we are working for it. </p>
                            <div class="rd-btn"> <a href="lessons.php?subject=Physics"><button class="read-more"> Get
                            courses</button></a> </div>
                        </div>
                        <div class=" col-sm-6 col-md-6  our-spec">
                            <h3 class="our-spec-heading"> Chemistry</h3>
                            <p>Get Chemistry syllabus course for free. Here you will get all the topic necessary for your
                            examination point of view. It is still incomplete we are working for it. </p>
                            <div class="rd-btn"> <a href="lessons.php?subject=Chemistry"><button class="read-more"> Get
                            Course</button></a> </div>
                        </div>

                        <div class=" col-sm-6 col-md-6  our-spec">
                            <h3 class="our-spec-heading"> Computer</h3>
                            <p>Get Computer syllabus course for free. Here you will get all the topic necessary for your
                            examination point of view. It is still incomplete we are working for it. </p>
                            <div class="rd-btn"> <a href="lessons.php?subject=Computer"><button class="read-more"> Get Course</button></a>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6  our-spec">
                            <h3 class="our-spec-heading"> Grammer</h3>
                            <p>Get Grammer syllabus course for free. Here you will get all the topic necessary for your
                            examination point of view. It is still incomplete we are working for it. </p>
                            <div class="rd-btn"> <a href="lessons.php?subject=Grammer"><button class="read-more "> Update Soon</button></a>
                            </div>
                        </div>
                    </div>
                    <!-- recent blog -->
                    <!--<div class="container">-->
                        <!--    <div class="row">-->
                            <!--        <div class="col-12 our-header">-->
                                <!--            <h2> Recent <a href="blog.php"class="text-secondary">Blogs</a></h2>-->
                                <!--            <div class="text-center">-->
                                    <!--                <hr> <i class="far fa-square rotate-45"></i> <i class="far fa-square rotate-45"></i>-->
                                    <!--                <hr>-->
                                    <!--            </div>-->
                                    <!--        </div>-->
                                    <!--    </div>-->

                                    <!--    <div class="row mb-2">-->
                                        <!--        <div class="col-lg-6 col-md-12">-->
                                            <!--            <div class="card flex-md-row mb-4 box-shadow">-->
                                                <!--                <div class="card-body d-flex flex-column align-items-start">-->
                                                    <!--                    <h3>-->
                                                        <!--                        <a class="text-dark" href="what-after-see.php">What To Do After SEE?</a>-->
                                                        <!--                    </h3>-->
                                                        <!--                    <div class="mb-1 text-muted">Jul 12</div>-->
                                                        <!--                    <p class="card-text mb-auto">There is always a great confusion arise to all the students, which subject to choose and what-->
                                                            <!--            pathway to follow after SEE examination.</p>-->
                                                            <!--                    <a href="what-after-see.php">Continue reading</a>-->
                                                            <!--                </div>-->
                                                            <!--                <img class="card-img-right flex-auto d-md-block" src="images/articles/aftersee.jpg"-->
                                                            <!--                    style="width: 250px; height: 200px;">-->
                                                            <!--            </div>-->
                                                            <!--        </div>-->

                                                            <!--        <div class="col-lg-6 col-md-12">-->
                                                                <!--            <div class="card flex-md-row mb-4 box-shadow">-->
                                                                    <!--                <div class="card-body d-flex flex-column align-items-start">-->
                                                                        <!--                    <h3>-->
                                                                            <!--                        <a class="text-dark" href="Top-Plus-2-In-KTM.php">Top School In <br>Itahari</a>-->
                                                                            <!--                    </h3>-->
                                                                            <!--                    <div class="mb-1 text-muted">Aug 12</div>-->
                                                                            <!--                    <p class="card-text mb-auto">School is the place where students needs mentally and physically healthy.-->
                                                                                <!--                    So, beside studying-->
                                                                                <!--            extra curriculum activities is also necessary for students.</p>-->
                                                                                <!--                    <a href="Top-Plus-2-In-KTM.php">Continue reading</a>-->
                                                                                <!--                </div>-->
                                                                                <!--                <img class="card-img-right flex-auto d-md-block" src="images/articles/top-scl-itahari1.png"-->
                                                                                <!--                    style="width: 250px; height: 200px;">-->
                                                                                <!--            </div>-->
                                                                                <!--        </div>-->
                                                                                <!--    </div>-->
                                                                                <!--</div>-->
                                                                            </div>
                                                                            <!-- recent blog end -->
                                                                            <!-- top IQ -->

                                                                            <div class="row">
                                                                                <div class="col-12 our-header">
                                                                                    <h2> Recent <a href="blog.php"class="text-secondary">Blogs</a></h2>
                                                                                    <div class="text-center">
                                                                                        <hr> <i class="far fa-square rotate-45"></i> <i class="far fa-square rotate-45"></i>
                                                                                        <hr>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
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
                                                                                  $PostSummary=$DataRows['summary'];



                                                                                    ?>
                                                                                    
                                                                                        <div class="col-lg-4">
                                                                                            <div class="card p-2 text-dark">
                                                                                                <a href="FullPost.php?id=<?php echo $Id;  ?>">
                                                                                                <img src="uploads/<?php echo $Image;?>" height="200px"width="280px"></a>
                                                                                                <h4 class="text-dark"> <?php

                                                                                                if (strlen($Title)>40) {
                   # code...
                                                                                                    $Title=substr($Title, 0,39).'....';
                                                                                                }  echo $Title;?></h4>
                                                                                                <p class="text-dark"><?php

                                                                                                if (strlen($PostSummary)>100) {
                   # code...
                                                                                                    $PostSummary=substr($PostSummary, 0,99).'....';
                                                                                                }  echo $PostSummary;?></p>
                                                                                                <a href="FullPost.php?id=<?php echo $Id;  ?>" class="blue-button">Read More</a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </a>
                                                                                <?php }?>
                                                                            </div>
                                                                        </div>








                                                                        <div class="row">
                                                                            <div class="col-12 our-header">
                                                                                <h2> Recent <a href="subjects.php"class="text-secondary">NOTES</a></h2>
                                                                                <div class="text-center">
                                                                                    <hr> <i class="far fa-square rotate-45"></i> <i class="far fa-square rotate-45"></i>
                                                                                    <hr>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="container">
                                                                            <center>
                                                                              <div class="row">
                                                                               <?php 
                                                                               global $ConnectingDb;
                                                                               $sql="SELECT title FROM lesson ORDER BY id desc LIMIT 0,10";
                                                                               $stmt =$ConnectingDb->query($sql);
                                                                               while($DataRows=$stmt->fetch()){
                                                                                $Title=$DataRows['title'];
                                                                                ?>

                                                                                <div class="col-xs-6 col-sm-6">
                                                                                    <h2><a class="btn btn-primary" href="LessonPost.php?lesson=<?php echo $Title;?>"> <?php echo $Title;?></a> </h2>
                                                                                </div>
                                                                            <?php }?>
                                                                        </div><script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- in homepage -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-8192321483115878"
     data-ad-slot="4949236511"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>

                                                                    </center>
                                                                </div>


                                                                <!-- footer -->
                                                                <?php
                                                                require "includes/footer.php"; ?>
