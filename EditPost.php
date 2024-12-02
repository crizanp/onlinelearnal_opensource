<? ob_start(); ?><?php
require_once("includes/Db.php");
require_once("includes/Functions.php");
require_once("includes/Sessions.php");
require_once("includes/DateTime.php");
if ($_SESSION["Role"]==null) {
  # code...
    $_SESSION["ErrorMessage"]="Login required";

  Redirect_to("login.php");
}
else if($_SESSION["Role"]=="admin"){
  ConfirmLogin();
  }
 // else if($_SESSION["Role"]=="Editor"){
 //  if{
    // $_SESSION["ErrorMessage"]="You have no authority to edit the post";
    // Redirect_to("dashboard.php");
  // }
// }
$SearchQueryParameter=$_GET['id'];
if(isset($_POST["submit"])){
  $PostTitle=$_POST["PostTitle"];
  $Category=$_POST["Category"];
  $Image=$_FILES["Image"]["name"];
  $Target="uploads/".basename($_FILES["Image"]["name"]);
  $PostText=$_POST["editor1"];
  $PostTag=$_POST["tags"];
  $PostDescription=$_POST["description"];
        $PostSummary=$_POST["summary"];

  $Admin="srijan";
  if (empty($PostTitle)) {
  # code...
    $_SESSION["ErrorMessage"]="You can't make your post title blank";
    Redirect_to("EditPost.php?id=$SearchQueryParameter");

  }
  elseif (strlen($PostTitle)<2) {

    $_SESSION["ErrorMessage"]="Title should be at least 2 characters";
    Redirect_to("EditPost.php?id=$SearchQueryParameter");


  }
  elseif (strlen($PostText)>9999) {

    $_SESSION["ErrorMessage"]="Post description shouldn't be more then 1000 characters";
    Redirect_to("EditPost.php?id=$SearchQueryParameter");


  }
  else{
// insert query
    global $ConnectingDb;
    if (!empty($_FILES["Image"]["name"])) {
      $sql="UPDATE posts 
      SET title='$PostTitle',category='$Category', image='$Image',post='$PostText',tag='$PostTag',description='$PostDescription',summary='$PostSummary'
      WHERE id='$SearchQueryParameter'";
        # code...
    }
    else {
      $sql="UPDATE posts 
      SET title='$PostTitle',category='$Category',post='$PostText',tag='$PostTag',description='$PostDescription',summary='$PostSummary'
      WHERE id='$SearchQueryParameter'";
    }
    
    $Execute=$ConnectingDb->query($sql);
    move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);   
    
    if ($Execute) {
     $_SESSION["SuccessMessage"]="Posts Updated Successfully ";
     Redirect_to("EditPost.php?id=$SearchQueryParameter");

   }
   else
   {
     $_SESSION["ErrorMessage"]="Something Went Wrong";
     Redirect_to("EditPost.php?id=$SearchQueryParameter");

   }
 }
}
// else {

//         $PostIdFromURL=$_GET["id"];
//         if (!isset($PostIdFromURL)) {
//             $_SESSION["ErrorMessage"]="Bad Request!!";
//             Redirect_to("dashboard.php");
//             # code...

// }

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
  <!-- Local CSS -->
  <!-- <link rel="stylesheet" href="css/style.css"> -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/all.css"
  integrity="sha384-rtJEYb85SiYWgfpCr0jn174XgJTn4rptSOQsMroFBPQSGLdOC5IbubP6lJ35qoM9" crossorigin="anonymous" />
  <title>Admin penal</title>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha256-OFRAJNoaD8L3Br5lglV7VyLRf0itmoBzWUoM+Sji4/8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js" integrity="sha512-VvWznBcyBJK71YKEKDMpZ0pCVxjNuKwApp4zLF3ul+CiflQi6aIJR+aZCP/qWsoFBA28avL5T5HA+RE+zrGQYg==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput-angular.min.js" integrity="sha512-KT0oYlhnDf0XQfjuCS/QIw4sjTHdkefv8rOJY5HHdNEZ6AmOh1DW/ZdSqpipe+2AEXym5D0khNu95Mtmw9VNKg==" crossorigin="anonymous"></script>
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
          <h3 class="text-light"><i class="fas fa-edit"></i> Edit Post</h3>
        </div>
      </div>
    </div>
  </header>
  <!-- HEADER END -->


  <!-- SEARCH -->
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
  <!-- SEARCH END -->


  <!-- main section of adding post -->
  <section class="container p-2">
    <?php 
    echo SuccessMessage();
    echo ErrorMessage();
    global $ConnectingDb;
    $sql="SELECT * FROM posts WHERE id=$SearchQueryParameter";
    $stmt=$ConnectingDb->query($sql);
    while ($DataRows=$stmt->fetch()) {
          # code...
      $TitleToBeUpdated=$DataRows['title'];
      $CategoryToBeUpdated=$DataRows['category'];
      $ImageToBeUpdated=$DataRows['image'];
      $PostToBeUpdated=$DataRows['post'];
$TagToBeUpdated=$DataRows['tag'];
$DescriptionToBeUpdated=$DataRows['description'];
$PostSummaryToBeUpdated=$DataRows['summary'];

    }
    ?>
    <div class="">
      <form class="p-2" action="EditPost.php?id=<?php echo $SearchQueryParameter;?>" method="post"
        enctype="multipart/form-data">
        <div class="form-row">
          <div class="col-lg">
            <div class="category-section-text bg-primary text-light p-3"><i class="fas fa-plus"></i> Edit
            Your Existing Post</div>
            <div class="p-2">
              <div class="form-group">
                <label for="title" class="font-weight-bold">
                  <h4>Update Title</h4>
                </label>
                <input value="<?php echo $TitleToBeUpdated;?>" type="text" class="form-control"
                name="PostTitle">
              </div>
              <div class="form-group">
                <span>Existing Category:<b> <?php echo $CategoryToBeUpdated;?></b></span><br>
                <label for="category" class="font-weight-bold">
                  <h4>Update Category</h4>
                </label>
                <select class="form-control" id="CategoryTitle" name="Category">
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
                <span>Existing Image:</span><br><img src="uploads/<?php echo $ImageToBeUpdated;?>"
                width="170px" ;height="70px" ;></b></span><br>

                <label for="image" class="font-weight-bold">
                  <h4>Update Image</h4>
                </label>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" name="Image">
                  <label for="image" class="custom-file-label">Choose File</label>
                  <small class="form-text text-muted">Max Size 3Mb</small>
                </div>
                <div class="form-group">
                  <label for="body">
                    <h4>Update Body</h4>
                  </label>
                  <textarea name="editor1" class="form-control"
                  id="postBody"><?php echo $PostToBeUpdated;?></textarea>
                </div>
                <div class="form-group">
                  <label for="body">
                    <h4>Update Description</h4>
                  </label>
                  <textarea name="description" class="form-control"
                  id="postBody"><?php echo $DescriptionToBeUpdated;?></textarea>
                </div>
                <div class="form-group">
                  <span>Existing Tag: </span><b><?php echo $TagToBeUpdated;?></b><br>
                  <label for="body">
                    <h4>Update tag</h4>
                  </label>
                  <input type="text" data-role="tagsinput" name="tags" class="form-control"style="width: 100%;">

                </div>
                <div class="form-group">
                  <label for="body">
                    <h4>Update Summary</h4>
                  </label>
                  <textarea name="summary" class="form-control"
                  id="postBody"><?php echo $PostSummaryToBeUpdated;?></textarea>
                </div>

              </div>
            </div>
          </div>
        </div>
        <button class="btn btn-primary font-weight-bold" type="submit" name="submit">Publish</button>
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
<!-- POSTS -->
<section id="posts" class="p-3">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header text-center">
          <h4 class="display-5 mb-0">Latest Posts</h4>
        </div>
        <table class="table table-striped">
          <thead class="bg-dark text-center text-light">
            <tr>
              <th>SN.</th>
              <th>Title</th>
              <th>Category</th>

              <th>Live</th>

            </tr>
          </thead>
          <?php
          global $ConnectingDb;
          $Sr=0;
          $sql="SELECT * FROM posts";
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
            $Sr++;

            ?>
            <tbody class="text-center">
              <tr>
                <td><?php echo $Sr; ?></td>
                <td><?php
                echo $PostTitle; ?></td>
                <td><?php
                echo  $Category; ?></td>


                <td><a href="FullPost.php?id=<?php echo $Id ;?>" target="blank"><span
                  class="btn btn-success">See Live</span></a></td>

                </tr>
              <?php }?>
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>
</section>


<!-- END POST -->


<!-- FOOTER -->
<footer id="main-footer" class="bg-dark p-2 text-light">
  <div class="container">
    <div class="row">
      <div class="col">
        <p class="lead text-center">
          Copyright &copy; <span id="year"></span>
          Srijan Pokharel
        </p>
      </div>
    </div>
  </div>
</footer>
<!-- END FOOTER -->


<script src="https://code.jquery.com/jquery-3.4.1.min.js"
integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
<script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
<script>
    // Get the current year for the copyright
    $('#year').text(new Date().getFullYear());

    CKEDITOR.replace('editor1');
  </script>
</script>
<script src="./js/app.js"></script>
</body>

</html><? ob_flush(); ?>
