<? ob_start(); ?><?php
require_once("includes/Db.php");
require_once("includes/Functions.php");
require_once("includes/Sessions.php");
require_once("includes/DateTime.php");
if ($_SESSION["Role"]==null) {
  $_SESSION["ErrorMessage"]="Login required";

  Redirect_to("login.php");
}
else if($_SESSION["Role"]=="admin"){
  ConfirmLogin();
  }
 else if($_SESSION["Role"]=="Editor"){
    Redirect_to("dashboard.php");
      $_SESSION["ErrorMessage"]="sorry you can't go to this section";

  }


if(isset($_POST["Submit"])){
$UserName=$_POST["UserName"];
$Password=$_POST["Password"];
$Name=$_POST["Name"];
$Role=$_POST["role"];

$ConfirmPassword=$_POST["ConfirmPassword"];
$Admin=$_SESSION["UserName"];
if (empty($UserName)||empty($Password)||empty($ConfirmPassword||empty($Role))) {
  # code...
  $_SESSION["ErrorMessage"]="You can't make your field blank";
  Redirect_to("admin.php");

}
elseif (strlen($Password)<6) {

    $_SESSION["ErrorMessage"]="Password should be at least 6 characters";
      Redirect_to("admin.php");


}


elseif ($Password!==$ConfirmPassword) {

    $_SESSION["ErrorMessage"]="confirm password doesn't match please try again";
      Redirect_to("admin.php");


}
elseif (CheckUserNameExist($UserName)) {

    $_SESSION["ErrorMessage"]="Username exist try another one";
      Redirect_to("admin.php");


}
else{
// insert query
  $sql="INSERT INTO admins(datetime,username,password,aname,addedby,role)";
  $sql .="VALUES(:dateTime,:userName,:password,:aName,:adminName,:aRole)";
  $stmt=$ConnectingDb->prepare($sql);
    $stmt->bindValue(':dateTime',$DateTime);
  $stmt->bindValue(':userName',$UserName);
  $stmt->bindValue(':password',$Password);
  $stmt->bindValue(':aName',$Name);
    $stmt->bindValue(':adminName',$Admin);
        $stmt->bindValue(':aRole',$Role);


  $Execute=$stmt->execute();
  if ($Execute) {
   $_SESSION["SuccessMessage"]="New Admin of name ".$UserName." with role ".$Role." has been added Successfully ";
   Redirect_to("admin.php");

  }
  else
  {
       $_SESSION["ErrorMessage"]="Something Went Wrong";
   Redirect_to("admin.php");

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
  <!-- Local CSS -->
  <!-- <link rel="stylesheet" href="css/style.css"> -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/all.css"
    integrity="sha384-rtJEYb85SiYWgfpCr0jn174XgJTn4rptSOQsMroFBPQSGLdOC5IbubP6lJ35qoM9" crossorigin="anonymous" />
    <link rel="shortcut icon" type="images/png" href="img/logo/ol.png">
  <title>Admin-Page</title>
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
          <h3 class="text-light"><i class="fas fa-user"></i> Admins</h3>
        </div>
      </div>
    </div>
  </header>
  
   
  <!-- Add Category -->
    <section class="container p-4">
      <?php
          echo ErrorMessage();
          echo SuccessMessage();
          ?> 
          <div class="container category-section">
          <header id="main-header" class="py-2 bg-success text-white">
    <div class="container">
      <div class="row">
        <div class="col align-self-center" id="header-div">
          <h3 class="text-light">Add New Admin</h3>
        </div>
      </div>
    </div>
  </header><br>
          <form method="post"action="admin.php">
  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" name="UserName" class="form-control" id="username" aria-describedby="nameHelp" placeholder="Username">
  </div>
  <div class="form-group">
    <label for="name">Name</label>
    <input type="name"name="Name" class="form-control" id="Name" aria-describedby="nameHelp" placeholder="Name">    <small class="text-warning text-muted">Optional</small>

  </div>
    <div class="form-group">
                <label for="category"class="font-weight-bold">Role</label>
                <select class="form-control"id="CategoryTitle"name="role">
                
                    <option>Admin</option>
                    <option>Editor</option>
                </select>
              </div>
  
  <div class="form-group">
    <label for="Password">Password</label>
    <input type="password"name="Password" class="form-control" id="password" placeholder="Password">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword2">Confirm Password</label>
    <input type="password"name="ConfirmPassword" class="form-control" id="Confirmpassword" placeholder="Password">
  </div>
  
  <button type="Submit"name="Submit" class="btn btn-primary">Submit</button>
</form>
</div>
</section>
 <!--  CATEGORIES-->
   <section id="categories">
    <div class="container">
      <div class="row">
        <div class="col" id="categoryParent">
          <div class="card" id="categoryContainer">
            <div class="card-header text-center">
              <h4>ALL ADMINS</h4>
            </div>
            <table class="table table-striped" id="categoryTable">
              <thead class="bg-dark text-white">
                <tr>
                  <th>SN.</th>
                  <th>Username</th>
                  <th>Name</th>
                  <th>Date</th>
                  <th>Role</th>
                  <th>Added By</th>
                  <th>Action</th>
                </tr>
              </thead>
 <?php
global $ConnectingDb;
$Sr=0;
$sql="SELECT * FROM admins ORDER BY id desc";
$stmt=$ConnectingDb->query($sql);
while ($DataRows=$stmt->fetch()) {
  # code...
  $Id=$DataRows["id"];
  $UserName=$DataRows["username"];
  $DateTime=$DataRows["datetime"];
  $AdminName=$DataRows["aname"];

  $AddedByName=$DataRows["addedby"];
   $Role=$DataRows["role"];
  $Sr++;

             ?>
              <tbody id="categoryTableBody">
                 <tr>
                  <td><?php 
                      echo $Sr;
                  ?></td>
                  <td><?php 
                      echo $UserName;
                  ?></td>
                  <td><?php 
                      echo $AdminName;
                  ?></td>
                  <td><?php 
                      echo $DateTime;
                  ?></td>
                  <td>
                    <?php
echo $Role;
                    ?>
                  </td>
                  <td>
                    <?php 
                    echo $AddedByName;
                    ?>
                  </td>
                  

<td>
      <div class="modal-footer">
        <a href="DeleteAdmin.php?id=<?php echo $Id ;?>"> 
          <button type="button" class="btn btn-danger"name="deleteadmin">Delete</button>
</a>
      </div>
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
