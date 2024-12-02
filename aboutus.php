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
<title>Onlinelearnal - the best online learning platform</title>
 <meta name="robots" content="INDEX,FOLLOW"/>
<meta name="keywords" content="Nepal's online education, onlinelearnal, notes of physics, notes on chemostry,online learning platform, educational blog">
<meta name="description" content="Onlinelearnal.com uplift the education system of the country to be redefined through active engagement, discussions, important content, questions from various topics.">
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
<link rel="shortcut icon" type="images/png" href="img/logo/ol.png">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css">
<script src="https://kit.fontawesome.com/85a5fdd30e.js" async></script>

<style type="text/css">
 
    <style>
    .row,


    .row {
        margin-left: -15px;
        margin-right: -15px;
    }

    #content img {
        max-width: 100%;
        height: auto;
    }

    img {
        vertical-align: middle;
    }

    .team-img img {
        border-radius: 17px;
        border-color: black;
    }

    .list-unstyled {
        padding-left: 0;
        list-style: none;
    }

    .row,

    .row {
        margin-left: -15px;
        margin-right: -15px;
    }

    .team-member {
        text-align: center;
        background-color: #F9F9F9;
        padding-bottom: 15px;
    }

    #content {
        background-color: silver;
        border-radius: 10px;
    }

    .container {
        padding-top: 40px;
    }

    p {
        font-size: 17px;
    }

    .list-unstyled li {
        margin-bottom: 10px;
    }

    h3 {
        margin-bottom: 15px;
    }

    .heading-color {
        color: brown
    }

    marquee {
        width: 100%;
        padding: 10px 0;
        background-color: black;
        color: white;
        border-radius: 6px;
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
        <!-- NAVBAR -->
        <?php
        require_once("includes/navbar.php");?>
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v8.0" nonce="EEQC8stW"></script> 
        
        <!-- section -->
        <section id="content">
            <div class="container">
                <div class="about">
                    <!--<marquee direction="scroll" behavior="alternate" onmouseover="this.stop();" onmouseout="this.start();">-->
                    <!--    Join our team and be part with us. Kindly contact through <a-->
                    <!--    href="http://www.facebook.com/onlinelearnal">facebook.com/onlinelearnal</a>.</marquee>-->
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="heading-color">What is OnlineLearnal? </h3>
                                <p><b>OnlineLearnal is a web platform, where you can learn various topic related to school
                                    courses and college courses. Also we would add various other program that can help you
                                    to enhance your knowledge and ideas. We not only provides you useful notes but also
                                    interact your doubt questions. We will frequently update more courses and content in
                                    future and hopefully you will get enough from this site. The content of this site are
                                    fully guided by a great professor Mr Rudra Prasad Pokhrel and Krrish Xetri. From our
                                    team we would thank to them and we have got our full support from Nxtechhosting.com
                                Thanks to all and from our team, we wish for great uplift.</b> </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="heading-color">Why Choose Us?</h3>
                                <ul class="list-unstyled">
                                    <li><i class="fa fa-arrow-circle-right pr-10 colored"></i> Complete Syllabus courses</li>
                                    <li><i class="fa fa-arrow-circle-right pr-10 colored"></i> Important question are provided
                                    </li>
                                    <li><i class="fa fa-arrow-circle-right pr-10 colored"></i> Any difficulties can queries
                                    their questions </li>
                                    <li><i class="fa fa-arrow-circle-right pr-10 colored"></i> Fully researched content</li>
                                    <li><i class="fa fa-arrow-circle-right pr-10 colored"></i> Can contact us as friend</li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <div class="block-heading-two">
                                    <h3 class="heading-color"><span>Our Expertise</span></h3>
                                </div>
                                <h6>Web Development</h6>
                                <div class="progress pb-sm">
                                    <div class="progress-bar progress-bar-red" role="progressbar" aria-valuenow="40"
                                    aria-valuemin="0" aria-valuemax="100" style="width: 40%"> <span class="sr-only">40%
                                    Complete (success)</span> </div>
                                </div>
                                <h6>Designing</h6>
                                <div class="progress pb-sm">
                                    <div class="progress-bar progress-bar-green" role="progressbar" aria-valuenow="60"
                                    aria-valuemin="0" aria-valuemax="100" style="width: 30%"> <span class="sr-only">30%
                                    Complete (success)</span> </div>
                                </div>
                                <h6>Content Writing</h6>
                                <div class="progress pb-sm">
                                    <div class="progress-bar progress-bar-lblue" role="progressbar" aria-valuenow="80"
                                    aria-valuemin="0" aria-valuemax="100" style="width: 80%"> <span class="sr-only">40%
                                    Complete (success)</span> </div>
                                </div>
                                <h6>Development</h6>
                                <div class="progress pb-sm">
                                    <div class="progress-bar progress-bar-yellow" role="progressbar" aria-valuenow="30"
                                    aria-valuemin="0" aria-valuemax="100" style="width: 30%"> <span class="sr-only">40%
                                    Complete (success)</span> </div>
                                </div>
                            </div>
                        </div> <br>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="block-heading-two">
                                    <h3 class="heading-color"><span>What we say?</span></h3>
                                </div>
                                <p>Onlinelearnal.com uplift the education system of the country to be redefined through active
                                    engagement, discussions, important content, questions from various topics and by bringing
                                    the right information to your fingertips. We, the management teams will look forward your
                                    necessities and update other incomplete task. So in case of any problem arise or incase of
                                    incomplete contents, we are sorry from our team and we will solve it as soon as possible.
                                </p>
                            </div>
                            <div class="col-md-4">
                                <div class="block-heading-two">
                                    <h3 class="heading-color"><span>Recent Update Content</span></h3>
                                </div>
                                <ul type="none">
                                    <?php 
                                    global $ConnectingDb;
                                    $sql="SELECT title FROM lesson ORDER BY id asc LIMIT 0,10";
                                    $stmt =$ConnectingDb->query($sql);
                                    while($DataRows=$stmt->fetch()){
                                        $Title=$DataRows['title'];
                                        ?>

                                        
                                        <li><a href="LessonPost.php?lesson=<?php echo $Title;?>">
                                            <font size="4px"><?php echo $Title;?></font>
                                        </a></li>
                                    <?php }?>
                                    
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <div class="block-heading-two">
                                    <h3 class="heading-color"><span>Get More Recent Update</span></h3>
                                </div>
                                <div class="fb-page" data-href="https://www.facebook.com/onlinelearnal/" data-tabs="timeline"
                                data-width="300" data-height="375" data-small-header="false"
                                data-adapt-container-width="false" data-hide-cover="false" data-show-facepile="false">
                                <blockquote cite="https://www.facebook.com/onlinelearnal/" class="fb-xfbml-parse-ignore"><a
                                    href="https://www.facebook.com/onlinelearnal/">>Online Learnal</a></blockquote>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!--<h3 class="heading-color">Our Teams</h3>-->
                    <!--<div class="row">-->
                    <!--    <div class="team-img col-md-6"> <img src="img/teams/sujan.jpg" alt="">-->
                    <!--        <center>-->
                    <!--            <font size="5"><b>Sujan Niraula</b> </font><br>-->
                    <!--            <font size="3" color="brown"><b>Execution and Management</b><br> </font><br>-->
                    <!--        </center>-->
                    <!--    </div> <!-- <div class="team-img col-md-2"> -->-->
                            <!-- </div> -->
                    <!--        <div class="team-img col-md-6"> <img src="img/teams/srijan.jpg" alt="">-->
                    <!--            <center>-->
                    <!--                <font size="5"><b>Srijan Pokhrel</b> </font><br>-->
                    <!--                <font size="3" color="brown"><b>Designing and Directive</b> <br></font>-->
                    <!--            </center>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                </section>
                <?php
                require "includes/footer.php"; ?><? ob_flush(); ?>
