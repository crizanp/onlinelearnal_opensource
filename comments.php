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
else if($_SESSION["Role"]=="Editor"){
  $_SESSION["ErrorMessage"]="You can't go to comment section";
  Redirect_to("dashboard.php");
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
  <!-- Local CSS -->
  <!-- <link rel="stylesheet" href="css/style.css"> -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/all.css"
  integrity="sha384-rtJEYb85SiYWgfpCr0jn174XgJTn4rptSOQsMroFBPQSGLdOC5IbubP6lJ35qoM9" crossorigin="anonymous" />
  <title>Comments</title>
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
          <h3><i class="fas fa-cog"></i> Comments</h3>
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
              <input type="text" class="form-control" placeholder="Search Comments...">
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
          <h3>Comments</h3>
          <h4 class="display-4">
            <i class="fas fa-check"></i> 
            <?php
            global $ConnectingDb;
            $sql="SELECT COUNT(*) FROM comments";
            $stmt=$ConnectingDb->query($sql);
            $TotalRows =$stmt->fetch();
            $TotalComments=array_shift($TotalRows);
            echo $TotalComments;

            ?>

          </h4>
        </div>
      </div>
      <div class="card text-center bg-success m-3 col-sm">
        <div class="card-body">
          <h3>Approved Comments</h3>
          <h4 class="display-4">
            <i class="fas fa-check"></i> 
            <?php
            global $ConnectingDb;
            $sql="SELECT COUNT(*) FROM comments WHERE status='ON'";
            $stmt=$ConnectingDb->query($sql);
            $TotalRows =$stmt->fetch();
            $TotalComments=array_shift($TotalRows);
            echo $TotalComments;

            ?>

          </h4>
        </div>
      </div></div>
      <div class="card text-center bg-danger col-md-6">
        <div class="card-body">
          <h3>Unapproved Comments</h3>
          <h4 class="display-4">
<i class="fas fa-times-circle"></i>            <?php
            global $ConnectingDb;
            $sql="SELECT COUNT(*) FROM comments WHERE status='OFF'";
            $stmt=$ConnectingDb->query($sql);
            $TotalRows =$stmt->fetch();
            $TotalComments=array_shift($TotalRows);
            echo $TotalComments;

            ?>

          </h4>
        </div>
      </div>

    </div>

    
    <?php 
    echo SuccessMessage();
    echo ErrorMessage();
    ?>
  </div>
  <!-- UPPER CONTENT END -->



  <!-- POSTS -->
  <section id="posts"class="p-3">
    <div class="row">
      <div class="col-lg-12">
        <div class="card" >
          <div class="card-header text-center">
            <h4 class="display-5 mb-0">Unapproved Comments</h4>
          </div>
          <table class="table table-striped">
            <thead class="bg-dark text-center text-light">
              <tr>
                <th>SN.</th>
                <th width="40%">Comments</th>
                <th>Name</th>
                <th>Date</th>
                <th>Action</th>
                <th>See Post</th>

              </tr>
            </thead>
            <?php
            global $ConnectingDb;
            $Sr=0;
            $sql="SELECT * FROM comments WHERE status='OFF' OR status='' ORDER BY id desc";
            $stmt=$ConnectingDb->query($sql);
            while ($DataRows=$stmt->fetch()) {
  # code...
              $Id=$DataRows["id"];
              $DateTime=$DataRows["datetime"];
              $Comment=$DataRows["comment"];
              $Name=$DataRows["name"];
              $Post_Id=$DataRows["post_id"];

              $Sr++;

              ?>
              <tbody class="text-center">
                <tr>
                  <td><?php echo $Sr; ?></td>
                  <td><?php
                  echo $Comment; ?></td>
                  <td><?php
                  if (strlen($Name)>8) {
                   # code...
                    $Name=substr($Name, 0,7).'....';
                  } echo  $Name; ?></td>
                  <td><?php 
                  echo $DateTime; ?></td>
                  
                  <td><a href="ApproveComment.php?id=<?php echo $Id ;?>"><span class="btn btn-warning">Approve</span></a>
                    <a href="DeleteComment.php?id=<?php echo $Id ;?>"><span class="btn btn-danger">Delete</span></a></td>
                    <td><a href="FullPost.php?id=<?php echo $Post_Id ;?>"target="blank"><span class="btn btn-success">See Post</span></a></td>

                  </tr>
                <?php }?>
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- POSTS -->
  <section id="posts"class="p-3">
    <div class="row">
      <div class="col-lg-12">
        <div class="card" >
          <div class="card-header text-center">
            <h4 class="display-5 mb-0">Approved Comments</h4>
          </div>
          <table class="table table-striped">
            <thead class="bg-dark text-center text-light">
              <tr>
                <th width="2%">SN.</th>
                <th width="40%">Comments</th>
                <th width="8%">Name</th>
                <th width="12%">Date</th>
                <th width="28%">Action</th>
                <th>Live</th>

              </tr>
            </thead>
            <?php
            global $ConnectingDb;
            $Sr=0;
            $sql="SELECT * FROM comments WHERE status='ON' ORDER BY id desc";
            $stmt=$ConnectingDb->query($sql);
            while ($DataRows=$stmt->fetch()) {
  # code...
              $Id=$DataRows["id"];
              $DateTime=$DataRows["datetime"];
              $Comment=$DataRows["comment"];
              $Name=$DataRows["name"];
              $Post_Id=$DataRows["post_id"];

              $Sr++;

              ?>
              <tbody class="text-center">
                <tr>
                  <td><?php echo $Sr; ?></td>
                  <td><?php
                  if (strlen($Comment)>40) {
                   # code...
                    $Comment=substr($Comment, 0,80).'....';
                  } 
                  echo $Comment; ?></td>
                  <td><?php
                  if (strlen($Name)>8) {
                   # code...
                    $Name=substr($Name, 0,7).'....';
                  } echo  $Name; ?></td>
                  <td><?php 
                  echo $DateTime; ?></td>
                  
                  
                  <td><a href="UnApproveComment.php?id=<?php echo $Id ;?>"><span class="btn btn-warning">Unapprove</span></a>

                    <a href="DeleteComment.php?id=<?php echo $Id;?>"><span class="btn btn-danger">Delete</span></a></td>
                    <td><a href="FullPost.php?id=<?php echo $Post_Id ;?>"target="blank"><span class="btn btn-success">See Live</span></a></td>

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
            Srijan Pokhrel
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
