<? ob_start(); ?><?php
require_once("includes/Db.php");
require_once("includes/Functions.php");
require_once("includes/Sessions.php");
require_once("includes/DateTime.php");
ConfirmLogin(); 

if(isset($_POST["submit"])){
  $Category=$_POST["categoryTitle"];
  $Admin= $_SESSION["UserName"];
  if (empty($Category)) {
  # code...
    $_SESSION["ErrorMessage"]="You can't make your category blank";
    Redirect_to("categories.php");

  }
  elseif (strlen($Category)<2) {

    $_SESSION["ErrorMessage"]="Character should be at least 2 characters";
    Redirect_to("categories.php");


  }
  elseif (strlen($Category)>49) {

    $_SESSION["ErrorMessage"]="Character shouldn't be more then 50 characters";
    Redirect_to("categories.php");


  }
  else{
// insert query
    $sql="INSERT INTO category(title,author,datetime)";
    $sql .="VALUES(:categoryName,:adminName,:datetime)";
    $stmt=$ConnectingDb->prepare($sql);
    $stmt->bindValue(':categoryName',$Category);
    $stmt->bindValue(':adminName',$Admin);
    $stmt->bindValue(':datetime',$DateTime);
    $Execute=$stmt->execute();
    if ($Execute) {
     $_SESSION["SuccessMessage"]=$ConnectingDb->lastInsertId()." id's " ."Category Added Successfully ";
     Redirect_to("categories.php");

   }
   else
   {
     $_SESSION["ErrorMessage"]="Something Went Wrong";
     Redirect_to("categories.php");

   }
 }
}

?>
<?php
if(isset($_POST["subjectsubmit"])){
  $SubjectCategory=$_POST["subjectTitle"];
  $Admin= $_SESSION["UserName"];
  if (empty($SubjectCategory)) {
  # code...
    $_SESSION["ErrorMessage"]="You can't make your subject blank";
    Redirect_to("categories.php");

  }
  elseif (strlen($SubjectCategory)<2) {

    $_SESSION["ErrorMessage"]="Subject should be at least 2 characters";
    Redirect_to("categories.php");


  }
  elseif (strlen($SubjectCategory)>49) {

    $_SESSION["ErrorMessage"]="Subject shouldn't be more then 50 characters";
    Redirect_to("categories.php");


  }
  else{
// insert query
    $sql="INSERT INTO subjects(title,author,datetime)";
    $sql .="VALUES(:subjectName,:adminName,:datetime)";
    $stmt=$ConnectingDb->prepare($sql);
    $stmt->bindValue(':subjectName',$SubjectCategory);
    $stmt->bindValue(':adminName',$Admin);
    $stmt->bindValue(':datetime',$DateTime);
    $Execute=$stmt->execute();
    if ($Execute) {
     $_SESSION["SuccessMessage"]=$ConnectingDb->lastInsertId()." id's " ."Subject Added Successfully ";
     Redirect_to("categories.php");

   }
   else
   {
     $_SESSION["ErrorMessage"]="Something Went Wrong";
     Redirect_to("categories.php");

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
  
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/all.css"
  integrity="sha384-rtJEYb85SiYWgfpCr0jn174XgJTn4rptSOQsMroFBPQSGLdOC5IbubP6lJ35qoM9" crossorigin="anonymous" />
  <title>Blog_Admin</title>
</head>
<body>
  <!-- NAVBAR -->
  <?php
  require_once("includes/Admin/navbar.php");?>
  <!-- NAVBAR -->
  
  <div class="p-1 bg-primary"></div>


  <!-- HEADER -->
  <header id="main-header" class="py-2 bg-dark text-white">
    <div class="container">
      <div class="row">
        <div class="col align-self-center" id="header-div">
          <h3 class="text-light"><i class="fas fa-folder"></i> Categories</h3>
        </div>
      </div>
    </div>
  </header>
  <!-- SEARCH -->
  <section id="search" class="py-4">
    <div class="container">
      <div class="row">
        <div class="col-md-6 ml-auto">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search Categories...">
            <div class="input-group-append">
              <button class="btn background-accent">Search</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  
  <!-- Add Category -->
  <section class="container p-4">
    <?php
    echo ErrorMessage();
    echo SuccessMessage();
    ?> 
    <div class="container category-section">
      <form class="p-4" novalidate method="post">
        <div class="form-row">
          <div class="col-md-4 mb-3">
            <label class="category-section-text"><i class="fas fa-plus"></i> Add New Blog Category</label>
            <input type="text"name="categoryTitle" class="form-control"required>
          </div>
        </div>
        <button class="btn btn-primary" type="submit"name="submit">Publish</button>
      </form>
    </div>
        <div class="container category-section">
      <form class="p-4" novalidate method="post">
        <div class="form-row">
          <div class="col-md-4 mb-3">
            <label class="category-section-text"><i class="fas fa-plus"></i> Add New Course Subject</label>
            <input type="text"name="subjectTitle" class="form-control"required>
          </div>
        </div>
        <button class="btn btn-primary" type="submit"name="subjectsubmit">Publish</button>
      </form>
    </div>
  </section>
  <!-- CATEGORIES -->
  <section id="categories">
    <div class="container">
      <div class="row">
        <div class="col" id="categoryParent">
          <div class="card" id="categoryContainer">
            <div class="card-header text-center">
              <h4>Latest Blog Categories</h4>
            </div>
            <table class="table table-striped" id="categoryTable">
              <thead class="bg-dark text-white">
                <tr>
                  <th>SN.</th>
                  <th>Title</th>
                  <th>Date</th>
                  <th>Author</th>
                  <th>Action</th>
                </tr>
              </thead>
              <?php
              global $ConnectingDb;
              $Sr=0;
              $sql="SELECT * FROM category ORDER BY id desc";
              $stmt=$ConnectingDb->query($sql);
              while ($DataRows=$stmt->fetch()) {
  # code...
                $Id=$DataRows["id"];
                $Category=$DataRows["title"];
                $DateTime=$DataRows["datetime"];
                $Admin=$DataRows["author"];
                $Sr++;

                ?>
                <tbody id="categoryTableBody">
                 <tr>
                  <td><?php 
                  echo $Sr;
                  ?></td>
                  <td><?php 
                  echo $Category;
                  ?></td>
                  <td><?php 
                  echo $DateTime;
                  ?></td>
                  <td><?php 
                  echo $Admin;
                  ?></td>
                  <td>
                    <a href="DeleteCategory.php?id=<?php echo $Id ;?>"><button type="button" class="btn btn-danger">
                      Delete
                    </button></a>

                    <!-- Modal -->
                 <!--    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Are you sure want to delete this category?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            Ones deleted category can't be restore!!
                          </div>
                          <div class="modal-footer">
                            <a href="DeleteCategory.php?id=<?php echo $Id ;?>"> <button type="button" class="btn btn-danger">Delete</button></a>
                          </div>
                        </div>
                      </div>
                    </div> -->
                  </td>
                </tr>
              <?php }?>
            </tbody>
          </table>
        </div>
        <div class="card" id="categoryContainer">
            <div class="card-header text-center">
              <h4>Latest Subjects</h4>
            </div>
            <table class="table table-striped" id="categoryTable">
              <thead class="bg-dark text-white">
                <tr>
                  <th>SN.</th>
                  <th>Title</th>
                  <th>Date</th>
                  <th>Author</th>
                  <th>Action</th>
                </tr>
              </thead>
              <?php
              global $ConnectingDb;
              $Sr=0;
              $sql="SELECT * FROM subjects ORDER BY id desc";
              $stmt=$ConnectingDb->query($sql);
              while ($DataRows=$stmt->fetch()) {
  # code...
                $Id=$DataRows["id"];
                $SubjectCategory=$DataRows["title"];
                $DateTime=$DataRows["datetime"];
                $Admin=$DataRows["author"];
                $Sr++;

                ?>
                <tbody id="categoryTableBody">
                 <tr>
                  <td><?php 
                  echo $Sr;
                  ?></td>
                  <td><?php 
                  echo $SubjectCategory;
                  ?></td>
                  <td><?php 
                  echo $DateTime;
                  ?></td>
                  <td><?php 
                  echo $Admin;
                  ?></td>
                  <td>
                    <a href="DeleteSubject.php?id=<?php echo $Id ;?>"><button type="button" class="btn btn-danger">
                      Delete
                    </button></a>

                    <!-- Modal -->
                 <!--    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Are you sure want to delete this category?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            Ones deleted category can't be restore!!
                          </div>
                          <div class="modal-footer">
                            <a href="DeleteCategory.php?id=<?php echo $Id ;?>"> <button type="button" class="btn btn-danger">Delete</button></a>
                          </div>
                        </div>
                      </div>
                    </div> -->
                  </td>
                </tr>
              <?php }?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FOOTER -->
<footer id="main-footer" class="bg-dark p-2 text-light">
  <div class="container">
    <div class="row">
      <div class="col">
        <p class="lead text-center">
          Copyright &copy; <span id="year"></span>
          Srijan Pokhrel
        </p>
      </div>
    </div>
  </div>
</footer>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"
integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
crossorigin="anonymous"></script>

<script>
    // Get the current year for the copyright
    $('#year').text(new Date().getFullYear());
  </script>
  <script src="./js/app.js"></script>
</body>

</html><? ob_flush(); ?>
