<? ob_start(); ?><?php
require_once("includes/Db.php");
require_once("includes/Functions.php");
require_once("includes/Sessions.php");
require_once("includes/DateTime.php"); ?>
<?php ConfirmLogin(); ?>
<?php 
if(isset($_POST["submit"])){
  $PostTitle=$_POST["PostTitle"];
  $Category=$_POST["Category"];
  $Image=$_FILES["Image"]["name"];
  $Target="uploads/".basename($_FILES["Image"]["name"]);
  $PostText=$_POST["editor1"];
  $Admin=$_SESSION["UserName"];
  $PostTag=$_POST["tags"];
  $TagDescription=$_POST["description"];
  $PostSummary=$_POST["summary"];

  if (empty($PostTitle)) {
  # code...
    $_SESSION["ErrorMessage"]="You can't make your post title blank";
    Redirect_to("posts.php");

  }
  elseif (strlen($PostTitle)<2) {

    $_SESSION["ErrorMessage"]="Title should be at least 2 characters";
    Redirect_to("posts.php");


  }
  elseif (strlen($PostText)>99999) {

    $_SESSION["ErrorMessage"]="Post description shouldn't be more then 100000 characters";
    Redirect_to("posts.php");


  }
  else{
// insert query
    global $ConnectingDb;
    $sql="INSERT INTO posts(datetime,title,category,author,image,post,tag,description,summary,views)";
    $sql .="VALUES(:dateTime,:postTitle,:categoryName,:adminName,:imageName,:postDescription,:Tag,:tagDescription,:postSummary,:postViews)";
    $stmt=$ConnectingDb->prepare($sql);
    $stmt->bindValue(':dateTime',$DateTime);
    $stmt->bindValue(':postTitle',$PostTitle);
    $stmt->bindValue(':categoryName',$Category);
    $stmt->bindValue(':adminName',$Admin);
    $stmt->bindValue(':imageName',$Image);
    $stmt->bindValue(':postDescription',$PostText);
    $stmt->bindValue(':Tag',$PostTag);
    $stmt->bindValue(':tagDescription',$TagDescription);
    $stmt->bindValue(':postSummary',$PostSummary);
    $stmt->bindValue(':postViews','0');


    $Execute=$stmt->execute();
    move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);    
    if ($Execute) {
     $_SESSION["SuccessMessage"]=$ConnectingDb->lastInsertId()." id's " ."Posts Added Successfully ";
     Redirect_to("dashboard.php");

   }
   else
   {
     $_SESSION["ErrorMessage"]="Something Went Wrong";
     Redirect_to("posts.php");

   }
 }
}

?>
<?php
if(isset($_POST["lessonsubmit"])){
  $LessonTitle=$_POST["LessonTitle"];
  $Subject=$_POST["Subject"];
  $Image=$_FILES["LessonImage"]["name"];
  $Target="uploads/".basename($_FILES["LessonImage"]["name"]);
  $LessonPostText=$_POST["editor2"];
  $Admin=$_SESSION["UserName"];
  $Level=$_POST["SubjectLevel"];
  $PostTag=$_POST["tags"];
  $TagDescription=$_POST["description"];

  if (empty($LessonTitle)) {
  # code...
    $_SESSION["ErrorMessage"]="You can't make your lesson title blank";
    Redirect_to("posts.php");

  }
  elseif (strlen($LessonTitle)<2) {

    $_SESSION["ErrorMessage"]="Lesson title should be at least 2 characters";
    Redirect_to("posts.php");


  }
  elseif (strlen($LessonPostText)>99999) {

    $_SESSION["ErrorMessage"]="Lesson post description shouldn't be more then 10000 characters";
    Redirect_to("posts.php");


  }
  else{
// insert query
    global $ConnectingDb;
    $sql="INSERT INTO lesson(datetime,title,subject,author,image,post,level,tag,description,views)";
    $sql .="VALUES(:dateTime,:lessonTitle,:lessonSubject,:adminName,:imageName,:lessonPostDescription,:lessonLevel,:Tag,:tagDescription,:postViews)";
    $stmt=$ConnectingDb->prepare($sql);
    $stmt->bindValue(':dateTime',$DateTime);
    $stmt->bindValue(':lessonTitle',$LessonTitle);
    $stmt->bindValue(':lessonSubject',$Subject);
    $stmt->bindValue(':adminName',$Admin);
    $stmt->bindValue(':imageName',$Image);
    $stmt->bindValue(':lessonPostDescription',$LessonPostText);
        $stmt->bindValue(':lessonLevel',$Level);
        $stmt->bindValue(':Tag',$PostTag);
    $stmt->bindValue(':tagDescription',$TagDescription);
     $stmt->bindValue(':postViews','0');

    $Execute=$stmt->execute();
    move_uploaded_file($_FILES["LessonImage"]["tmp_name"],$Target);    
    if ($Execute) {
     $_SESSION["SuccessMessage"]=$ConnectingDb->lastInsertId()." id's " ."Lessons Added Successfully ";
     Redirect_to("dashboard.php");

   }
   else
   {
     $_SESSION["ErrorMessage"]="Something Went Wrong";
     Redirect_to("posts.php");

   }
 }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
  integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="shortcut icon" type="images/png" href="img/logo/ol.png">
  <!-- Local CSS -->
  <!-- <link rel="stylesheet" href="css/style.css"> -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/all.css"
  integrity="sha384-rtJEYb85SiYWgfpCr0jn174XgJTn4rptSOQsMroFBPQSGLdOC5IbubP6lJ35qoM9" crossorigin="anonymous" />
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha256-OFRAJNoaD8L3Br5lglV7VyLRf0itmoBzWUoM+Sji4/8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js" integrity="sha512-VvWznBcyBJK71YKEKDMpZ0pCVxjNuKwApp4zLF3ul+CiflQi6aIJR+aZCP/qWsoFBA28avL5T5HA+RE+zrGQYg==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput-angular.min.js" integrity="sha512-KT0oYlhnDf0XQfjuCS/QIw4sjTHdkefv8rOJY5HHdNEZ6AmOh1DW/ZdSqpipe+2AEXym5D0khNu95Mtmw9VNKg==" crossorigin="anonymous"></script>
    <style type="text/css">
      .bootstrap-tagsinput {
  background-color: white;
  border: 1px solid #ccc;
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  display: inline-block;
  padding: 4px 6px;
  color: black;
  vertical-align: middle;
  border-radius: 4px;
  max-width: 100%;
  line-height: 22px;
  cursor: text;
}
.bootstrap-tagsinput input {
  border: none;
  box-shadow: none;
  outline: none;
  background-color: transparent;
  padding: 0 6px;
  margin: 0;
  width: auto;
  max-width: inherit;
}
.bootstrap-tagsinput.form-control input::-moz-placeholder {
  color: black;
  opacity: 1;
}
.bootstrap-tagsinput.form-control input:-ms-input-placeholder {
  color: black;
}
.bootstrap-tagsinput.form-control input::-webkit-input-placeholder {
  color: black;
}
.bootstrap-tagsinput input:focus {
  border: none;
  box-shadow: none;
}
.bootstrap-tagsinput .tag {
  margin-right: 2px;
  color: black;
}
.bootstrap-tagsinput .tag [data-role="remove"] {
  margin-left: 8px;
  cursor: pointer;
}
.bootstrap-tagsinput .tag [data-role="remove"]:after {
  content: "x";
  padding: 0px 2px;
}
.bootstrap-tagsinput .tag [data-role="remove"]:hover {
  box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
}
.bootstrap-tagsinput .tag [data-role="remove"]:hover:active {
  box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
}

    </style>
    
  <title>Admin Panel</title>
</head>
<body>
  <!-- NAVBAR -->
  <!-- NAVBAR -->
  <?php
  require_once("includes/Admin/navbar.php");?>
  <div class="p-1 bg-primary"></div>


  <!-- HEADER -->
  <header id="main-header" class="p-3 bg-dark text-light">
    <div class="container">
      <div class="row">
        <div class="col align-self-center" id="header-div">
          <h3><i class="fas fa-pencil-alt"></i> Posts</h3>
        </div>
      </div>
    </div>
  </header>
  <!-- HEADER END -->


  <!-- SEARCH -->
  <!-- <section id="search" class="py-4">
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
  </section> -->
  <!-- SEARCH END -->


  <!-- main section of adding post -->
  <section class="container p-2">
    <?php 
    echo SuccessMessage();
    echo ErrorMessage();
    ?>
    <div class="">
      <form class="p-2" method="post"enctype="multipart/form-data">
        <div class="form-row">
          <div class="col-lg">
            <div class="category-section-text bg-primary p-3"><i class="fas fa-plus"></i> Add New Post</div>
            <div class="p-2">
              <div class="form-group">
                <label for="title"class="font-weight-bold">Title</label>
                <input type="text" class="form-control" name="PostTitle">
              </div>
              <div class="form-group">
                <label for="category"class="font-weight-bold">Category</label>
                <select class="form-control"id="CategoryTitle"name="Category">
                  <?php
                  global $ConnectingDb;
                  $sql="SELECT id,title FROM category";
                  $stmt=$ConnectingDb->query($sql);
                  while ($DataRows=$stmt->fetch()) {
                    $Id=$DataRows["id"];
                    $CategoryName=$DataRows["title"];


                    ?>
                    <option><?php echo $CategoryName; ?></option>
                  <?php }?>
                </select>
              </div>
              <div class="form-group">
                <label for="image"class="font-weight-bold">Upload Image</label>
                <div class="custom-file">
                  <input type="file" class="custom-file-input"name="Image">
                  <label for="image" class="custom-file-label">Choose File</label>
                  <small class="form-text text-muted">Max Size 3Mb</small>
                </div></div>
                <div class="form-group">
                  <label for="body">Body</label>
                  <textarea name="editor1" class="form-control" id="postBody"></textarea>
                </div>  
                <div class="form-group">
                <label for="title"class="font-weight-bold">Tags</label>
                    <input type="text" data-role="tagsinput" name="tags" class="form-control"style="width: 100%;">
                </div> 
                <div class="form-group">
                <label for="title"class="font-weight-bold">Description</label>
                <input type="text" class="form-control" name="description">
              </div>
              <div class="form-group">
                <label for="title"class="font-weight-bold">Summary</label>
                <input type="text" class="form-control" name="summary">
              </div>   
              </div>
            </div>
          </div>
          <button class="btn btn-primary font-weight-bold" type="submit"name="submit">Publish</button>

        </form>
      </div>

<div class="p-1 bg-dark"></div>
      <div class="">
      <form class="p-2" method="post"enctype="multipart/form-data">
        <div class="form-row">
          <div class="col-lg">
            <div class="category-section-text bg-success p-3"><i class="fas fa-plus"></i> Add New Course post</div>
            <div class="p-2">
              <div class="form-group">
                <label for="title"class="font-weight-bold">Lesson Title</label>
                <input type="text" class="form-control" name="LessonTitle">
              </div>
              <div class="form-group">
                <label for="category"class="font-weight-bold">Subject</label>
                <select class="form-control"id="SubjectTitle"name="Subject">
                  <?php
                  global $ConnectingDb;
                  $sql="SELECT id,title FROM subjects";
                  $stmt=$ConnectingDb->query($sql);
                  while ($DataRows=$stmt->fetch()) {
                    $Id=$DataRows["id"];
                    $SubjectName=$DataRows["title"];


                    ?>
                    <option><?php echo $SubjectName; ?></option>
                  <?php }?>
                </select>
              </div>
              <div class="form-group">
                <label for="image"class="font-weight-bold">Upload Image</label>
                <div class="custom-file">
                  <input type="file" class="custom-file-input"name="LessonImage">
                  <label for="image" class="custom-file-label">Choose File</label>
                  <small class="form-text text-muted">Max Size 3Mb</small>
                </div></div>
                <div class="form-group">
                  <label for="body">Body</label>
                  <textarea name="editor2" class="form-control" id="postBody"></textarea>
                </div>  
                <div class="form-group">
                <label for="category"class="font-weight-bold">Level</label>
                <select class="form-control"id="SubjectTitle"name="SubjectLevel">
                 
                    <option>School</option>
                <option>Collage</option>
                </select>
              </div> 
              <div class="form-group">
                <label for="title"class="font-weight-bold">Tags</label>
                    <input type="text" data-role="tagsinput" name="tags" class="form-control"style="width: 100%;">
                </div> 
                <div class="form-group">
                <label for="title"class="font-weight-bold">Description</label>
                <input type="text" class="form-control" name="description">
              </div>          
              </div>
            </div>
          </div>
          <button class="btn btn-success font-weight-bold" type="submit"name="lessonsubmit">Publish</button>

        </form>
      </div>
    </section>
    <!-- MAIN SECTION END -->


<!--  <div class="container">
<div class="modal-dialog modal-lg">

  <div class="modal-content">
    <div class="modal-header bg-primary text-dark">
      <h5 class="modal-title">Add Post</h5>
      <button class="close" data-dismiss="modal">
        <span>&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <form id="postForm">

        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" class="form-control" id="postTitle">
        </div>
        <div class="form-group">
          <label for="category">Category</label>
          <select class="form-control" id="postCategory">
            <option selected="selected">Choose One...</option>
          </select>
        </div>
        <div class="form-group">
          <label for="image">Upload Image</label>
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="image">
            <label for="image" class="custom-file-label">Choose File</label>
            <small class="form-text text-muted">Max Size 3Mb</small>
          </div>
          <div class="form-group">
            <label for="body">Body</label>
            <textarea name="editor1" class="form-control" id="postBody"></textarea>
          </div>
        </div>
      </form>
    </div>
    <div class="modal-footer">
      <button class="btn bg-primary" data-dismiss="modal" id="addPostBtn">Add Post</button>
    </div>
  </div>
</div>
</div> -->
<!-- end main section of post -->


<!-- POSTS -->
<!-- <section id="posts">
  <div class="container">
    <div class="row">
      <div class="col" id="postAllParent">
        <div class="card" id="postAllContainer">
          <div class="card-header text-center">
            <h4>All Posts</h4>
          </div>
          <table class="table table-striped" id="postAllTable">
            <thead class="bg-dark text-light">
              <tr>
                <th>#</th>
                <th>Title</th>
                <th>Category</th>
                <th>Date</th>
                <th>Details</th>
              </tr>
            </thead>
            <tbody id="postAllTableBody">
            </tbody>
          </table> -->
          <!-- PAGINATION -->
          <!-- <nav class="ml-4">
            <ul class="pagination">
              <li class="page-item disabled">
                <a href="#" class="page-link">Previous</a>
              </li>
              <li class="page-item active">
                <a href="#" class="page-link">1</a>
              </li>
              <li class="page-item">
                <a href="#" class="page-link">2</a>
              </li>
              <li class="page-item">
                <a href="#" class="page-link">3</a>
              </li>
              <li class="page-item">
                <a href="#" class="page-link">Next</a>
              </li>
            </ul>
          </nav> -->
        <!-- </div>
      </div>
    </div>
  </div>
</section> -->
<!-- END POST -->


<!-- FOOTER -->
<footer id="main-footer" class="bg-dark p-2 text-light">
  <div class="container">
    <div class="row">
      <div class="col">
        <p class="lead text-center">
          Copyright &copy; <span id="year"></span>
          Onlinelearnal | <small>
            Designed by Srijan Pokhrel
        </small>
        </p>
        
      </div>
    </div>
  </div>
</footer>
<!-- END FOOTER -->


<script src="https://code.jquery.com/jquery-3.4.1.min.js"
integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
crossorigin="anonymous"></script>
<script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
<script>
// Get the current year for the copyright
$('#year').text(new Date().getFullYear());

CKEDITOR.replace('editor1');
CKEDITOR.replace('editor2');

</script>
</script>
<script src="./js/app.js"></script>
</body>
</html><? ob_flush(); ?>
