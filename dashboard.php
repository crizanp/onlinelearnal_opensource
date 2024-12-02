<? ob_start(); ?><?php
require_once("includes/Db.php");
require_once("includes/Functions.php");
require_once("includes/Sessions.php");
require_once("includes/DateTime.php");
ConfirmLogin(); 
if(isset($_POST["submit"])){
    $imgName=$_POST["name"];
  $docsLink=$imgName.($_FILES["linkdocs"]["name"]);  
    $Target="uploads/docs/".basename($imgName.($_FILES["linkdocs"]["name"]));
    $Admin= $_SESSION["UserName"];
// insert query
    $sql="INSERT INTO image(name,datetime,author,image)";
    $sql .="VALUES(:imageName,:datetime,:adminName,:Image)";
    $stmt=$ConnectingDb->prepare($sql);
    $stmt->bindValue(':imageName',$imgName);
    $stmt->bindValue(':Image',$docsLink);
    $stmt->bindValue(':adminName',$Admin);
    $stmt->bindValue(':datetime',$DateTime);
    $Execute=$stmt->execute();
        move_uploaded_file(($_FILES["linkdocs"]["tmp_name"]),$Target);  
    if ($Execute) {
     $_SESSION["SuccessMessage"]="Docs Added Successfully ";
     Redirect_to("dashboard.php");
   }
   else
   {
     $_SESSION["ErrorMessage"]="Something Went Wrong";
     Redirect_to("dashboard.php");
   }
}
  ?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
  integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!-- Local CSS -->
  <!-- <link rel="stylesheet" href="css/style.css"> -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/all.css"
  integrity="sha384-rtJEYb85SiYWgfpCr0jn174XgJTn4rptSOQsMroFBPQSGLdOC5IbubP6lJ35qoM9" crossorigin="anonymous" />
  <link rel="shortcut icon" type="images/png" href="img/logo/ol.png">
  <title>DashBoard</title>
</head>
<body>

  <!-- NAVBAR -->
  <?php
  require_once("includes/Admin/navbar.php");?>
  <div class="p-1 bg-primary"></div>
  <!-- NAVBAR END -->



  <!-- HEADER -->
  <header id="main-header" class="py-2 bg-dark text-white">
    <div class="container">
      <div class="row">
        <div class="col align-self-center" id="header-div">
          <h3><i class="fas fa-cog"></i> Dashboard</h3>
        </div>
      </div>
    </div>
  </header>
  <!-- HEADER END -->



  <!-- UPPER CONTENT -->
  <div class="container">
    <section id="search" class="py-4">
      <div class="container">
        <div class="row">
          <div class="col-md-6 ml-auto">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search Posts...">
              <div class="input-group-append">
                <button class="btn bg-primary" id="searchPostBtn">Search</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <div class="row">
      <div class="card text-center bg-primary m-3 col-sm">
        <div class="card-body">
          <h3>Posts</h3>
          <h4 class="display-4">
            <i class="fas fa-pencil-alt"></i>
            <span id="postCount">
              <?php
              global $ConnectingDb;
              $sql="SELECT COUNT(*) FROM posts";
              $stmt=$ConnectingDb->query($sql);
              $TotalRows =$stmt->fetch();
              $TotalPosts=array_shift($TotalRows);
              echo $TotalPosts;

              ?>
            </span> /
             <span id="postCount">
              <?php
              global $ConnectingDb;
              $sql="SELECT COUNT(*) FROM lesson";
              $stmt=$ConnectingDb->query($sql);
              $TotalRows =$stmt->fetch();
              $TotalPosts=array_shift($TotalRows);
              echo $TotalPosts;

              ?>
            </span>
          </h4>
          <a href="posts.php" class="btn btn-outline-light btn-sm">Add / Edit</a>
        </div>

      </div>
      <div class="card text-center bg-primary m-3 col-sm">
        <div class="card-body">
          <h3>Role</h3>
          <h4 class="display-4">
            <i class="fas fa-users"></i>
            <span id="categoryCount"></span>
          </h4>
             <div class="btn btn-outline-light btn-sm"><?php echo $_SESSION["Role"];?></div>

        </div>
      </div>
      <div class="card text-center bg-primary m-3 col-sm">
        <div class="card-body">
          <h3>Category</h3>
          <h4 class="display-4">
<i class="fas fa-search"></i>                        <span id="categoryCount">
                                        <?php
              global $ConnectingDb;
              $sql="SELECT COUNT(*) FROM category";
              $stmt=$ConnectingDb->query($sql);
              $TotalRows =$stmt->fetch();
              $TotalCategory=array_shift($TotalRows);
              echo $TotalCategory;

              ?> / <span id="commentCount">
                                        <?php
              global $ConnectingDb;
              $sql="SELECT COUNT(*) FROM subjects";
              $stmt=$ConnectingDb->query($sql);
              $TotalRows =$stmt->fetch();
              $TotalComments=array_shift($TotalRows);
              echo $TotalComments;

              ?>
                        </span>
                        </span>
          </h4>
          <a href="categories.php" class="btn btn-outline-light btn-sm">Add / Edit</a>
        </div>

      </div>
      
      
    </div>
    <?php 
    if (($_SESSION["Role"])=="Admin") { ?>
        <div class="row">
      <div class="card text-center bg-primary m-3 col-sm">
        <div class="card-body">
          <h3>Comments</h3>
          <h4 class="display-4">
            <i class="fas fa-check"></i> 
             <span id="commentCount">
                                        <?php
              global $ConnectingDb;
              $sql="SELECT COUNT(*) FROM comments";
              $stmt=$ConnectingDb->query($sql);
              $TotalRows =$stmt->fetch();
              $TotalComments=array_shift($TotalRows);
              echo $TotalComments;

              ?>
                        </span>
          </h4>
          <a href="comments.php" class="btn btn-outline-light btn-sm">Add / Edit</a>
        </div>

      </div>
      <div class="card text-center bg-primary m-3 col-sm">
        <div class="card-body">
          <h3>Users</h3>
          <h4 class="display-4">
            <i class="fas fa-users"></i> 
             <span id="adminCount">
                                        <?php
              global $ConnectingDb;
              $sql="SELECT COUNT(*) FROM admins";
              $stmt=$ConnectingDb->query($sql);
              $TotalRows =$stmt->fetch();
              $TotalAdmin=array_shift($TotalRows);
              echo $TotalAdmin;

              ?>
                        </span>
          </h4>
          <a href="users.php" class="btn btn-outline-light btn-sm">Add / Edit</a>
        </div>

      </div>
      


    </div>
      <?php 
         }
  
    echo SuccessMessage();
    echo ErrorMessage();
    ?>
  </div>
  <!-- UPPER CONTENT END -->

 <form class="p-4" action="dashboard.php"method="post"enctype="multipart/form-data">
<div class="form-group">
  <div class="container">
    <input type="text" name="name" placeholder="Image Name"><br>
                <label for="image"class="font-weight-bold">Upload Image for Link</label>
                <div class="custom-file">
                  <input type="file" class="custom-file-input"name="linkdocs">
                  <label for="image" class="custom-file-label">Choose File</label>
                  <small class="form-text text-muted">Max Size 3Mb</small>
                                        <button class="btn btn-primary" type="submit"name="submit">Publish</button>

                </div>
</div></div></form>
  <!-- POSTS -->
  <section id="posts"class="p-3">
    <div class="row">
      <div class="col-lg-12">
        <div class="card" >
          <div class="card-header text-center">
            <h4 class="display-5 mb-0">Latest Posts</h4>
          </div>
          <div class="table-responsive">
          <table class="table table-striped">
            <thead class="bg-dark text-center text-light">
              <tr>
                <th>SN.</th>
                <th>Title</th>
                <th>Category</th>
                <th>Date</th>
                <th>Author</th>
                <th>Banner</th>
                <th>Action</th>
                <th>Live</th>

              </tr>
            </thead>
            <?php
            global $ConnectingDb;
            $Sr=0;
            $sql="SELECT * FROM posts ORDER BY id desc";
            $stmt=$ConnectingDb->query($sql);
            while ($DataRows=$stmt->fetch()) {
  # code...
              $Id=$DataRows["id"];
              $DateTime=$DataRows["datetime"];
              $PostTitle=$DataRows["title"];
              $Category=$DataRows["category"];
              $Admin=$DataRows["author"];
              $Image=$DataRows["image"];
              $PostText=$DataRows["post"];
                                          $Viewer=$DataRows["views"];

              $Sr++;

              ?>
              <tbody class="text-center">
                <tr>
                  <td><?php echo $Sr; ?></td>
                  <td><?php
                  if (strlen($PostTitle)>25) {
                   # code...
                    $PostTitle=substr($PostTitle, 0,23).'....';
                  } echo $PostTitle; ?></td>
                  <td><?php
                  if (strlen($Category)>8) {
                   # code...
                    $Category=substr($Category, 0,7).'....';
                  } echo  $Category; ?></td>
                  <td><?php 
                  if (strlen($DateTime)>10) {
                   # code...
                    $DateTime=substr($DateTime, 0,10).'....';
                  } echo $DateTime; ?></td>
                  <td><?php
                  if (strlen($Admin)>5) {
                   # code...
                    $Admin=substr($Admin, 0,5).'....';
                  } echo  $Admin; ?></td>
                  <td><img src="uploads/<?php echo $Image; ?>"width="100px;"</td>
                  <td><a href="EditPost.php?id=<?php echo $Id ;?>"><span class="btn btn-warning">Edit</span></a>
                    <a href="DeletePost.php?id=<?php echo $Id ;?>"><span class="btn btn-danger">Delete</span></a></td>
                    <td><a href="FullPost.php?id=<?php echo $Id ;?>"target="blank"><span class="btn btn-success">Live <?php echo $Viewer; ?></span></a></td>

                  </tr>
                <?php }?>
              </tbody>
            </table>
            </div>
          </div>
        </div>

      </div>
  </section>
  <section id="posts"class="p-3">
    <div class="row">
      <div class="col-lg-12">
        <div class="card" >
          <div class="card-header text-center">
            <h4 class="display-5 mb-0">Latest Lesson</h4>
          </div>
          <div class="table-responsive">
          <table class="table table-striped">
            <thead class="bg-dark text-center text-light">
              <tr>
                <th>SN.</th>
                <th>Lesson</th>
                <th>Subject</th>
                <th>Date</th>
                <th>Author</th>
                <th>Banner</th>
                <th>Action</th>
                <th>Live</th>

              </tr>
            </thead>
            <?php
            global $ConnectingDb;
            $Sr=0;
            $sql="SELECT * FROM lesson ORDER BY id desc";
            $stmt=$ConnectingDb->query($sql);
            while ($DataRows=$stmt->fetch()) {
  # code...
              $Id=$DataRows["id"];
              $DateTime=$DataRows["datetime"];
              $LessonTitle=$DataRows["title"];
              $Subject=$DataRows["subject"];
              $Admin=$DataRows["author"];
              $Image=$DataRows["image"];
              $LessonPostText=$DataRows["post"];
                            $SubjectLevel=$DataRows["level"];
                            $Viewer=$DataRows["views"];

              $Sr++;

              ?>
              <tbody class="text-center">
                <tr>
                  <td><?php echo $Sr; ?></td>
                  <td><?php
                  if (strlen($LessonTitle)>25) {
                   # code...
                    $LessonTitle=substr($LessonTitle, 0,23).'....';
                  } echo $LessonTitle; ?></td>
                  <td><?php
                  if (strlen($Subject)>8) {
                   # code...
                    $Subject=substr($Subject, 0,7).'....';
                  } echo  $Subject; ?></td>
                  <td><?php 
                  if (strlen($DateTime)>10) {
                   # code...
                    $DateTime=substr($DateTime, 0,10).'....';
                  } echo $DateTime; ?></td>
                  <td><?php
                  if (strlen($Admin)>15) {
                   # code...
                    $Admin=substr($Admin, 0,14).'....';
                  } echo  $Admin; ?></td>
                  <td><img src="uploads/<?php echo $Image; ?>"width="100px;"alt="File missing"></td>
                  <td><a href="EditLesson.php?id=<?php echo $Id ;?>"><span class="btn btn-warning">Edit</span></a>
                    <a href="DeleteLesson.php?id=<?php echo $Id ;?>"><span class="btn btn-danger">Delete</span></a></td>
                    <td><a href="LessonPost.php?lesson=<?php echo $LessonTitle ;?>"target="blank"><span class="btn btn-success">Live<?php echo $Viewer; ?></span></a></td>

                  </tr>
                <?php }?>
              </tbody>
            </table>
            </div>
          </div>
        </div>

      </div>
  </section>
  </section>
  <section id="posts"class="p-3">
    <div class="row">
      <div class="col-lg-12">
        <div class="card" >
          <div class="card-header text-center">
            <h4 class="display-5 mb-0">All Images</h4>
          </div>
          <div class="table-responsive">
          <table class="table table-striped">
            <thead class="bg-dark text-center text-light">
              <tr>
                <th>SN.</th>
                <th>Date</th>
                <th>Author</th>
                <th>Images</th>
                <th>Img name</th>
                <th>Given name</th>

              </tr>
            </thead>
            <?php
            global $ConnectingDb;
            $Sr=0;
            $sql="SELECT * FROM image ORDER BY id desc LIMIT 0,10";
            $stmt=$ConnectingDb->query($sql);
            while ($DataRows=$stmt->fetch()) {
  # code...
              $Id=$DataRows["id"];
              $DateTime=$DataRows["datetime"];
              $Admin=$DataRows["author"];
              $Image=$DataRows["image"];
              $GivenName=$DataRows["name"];

              $Sr++;

              ?>
              <tbody class="text-center">
                <tr>
                  <td><?php echo $Sr; ?></td>
                  <td><?php
                 echo $DateTime; ?></td>
                  <td><?php
                 echo  $Admin; ?></td>
                                   <td><img src="uploads/docs/<?php echo $Image; ?>"width="100px;"alt="File missing"></td>

                 <td><?php
                 echo  $Image; ?></td>

                  <td><?php 
                  echo $GivenName; ?></td>
                  

                  </tr>
                <?php }?>
              </tbody>
            </table>
            </div>
          </div>
        </div>

      </div>
  </section>
  <!-- POSTS END -->


  <!-- FOOTER -->
  <footer id="main-footer" class="bg-dark p-2">
    <div class="container">
      <div class="row">
        <div class="col">
          <p class="lead text-center text-white">
            Copyright &copy; <span id="year"></span>
            Onlinelearnal | <small>
              Designed by Srijan Pokhrel
          </small>
          </p>
          
        </div>
      </div>
    </div>
  </footer>
  <!-- MODALS -->

  <!-- ADD USER MODAL -->
  <!-- <div class="modal fade" id="addUserModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title">Add User</h5>
          <button class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body bg-light">
          <form>
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control">
            </div>
            <div class="form-group">
              <label for="password2">Confirm Password</label>
              <input type="password" class="form-control">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button class="btn bg-primary" data-dismiss="modal">Save Changes</button>
        </div>
      </div>
    </div>
  </div> -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
  integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
  crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
  integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
  crossorigin="anonymous"></script>
  <!-- WYSWYG Editor -->
  <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
  <script>
    // Get the current year for the copyright
    $('#year').text(new Date().getFullYear());
    // Modal Editor
    CKEDITOR.replace('editor1');
  </script>
  <script src="./js/app.js"></script>
</body>
</html><? ob_flush(); ?>
