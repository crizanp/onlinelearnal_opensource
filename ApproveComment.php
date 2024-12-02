<? ob_start(); ?><?php
require_once("includes/Db.php");
require_once("includes/Functions.php");
require_once("includes/Sessions.php");
require_once("includes/DateTime.php");
if ($_SESSION["Role"]==null) {
  $_SESSION["ErrorMessage"]="Login Required";

  # code...
  Redirect_to("login.php");
}
else if($_SESSION["Role"]=="admin"){
  ConfirmLogin();
  }
 else if($_SESSION["Role"]=="Editor"){
    Redirect_to("dashboard.php");
      $_SESSION["ErrorMessage"]="sorry you can't go to this section";

  }


if (isset($_GET["id"])) {
   
    $SearchQueryParameter=$_GET["id"];
      global $ConnectingDb;
    $Admin=($_SESSION["UserName"]);
    $sql="UPDATE comments SET status='ON', approvedby='$Admin' WHERE id='$SearchQueryParameter'";

    $Execute=$ConnectingDb->query($sql);
    if ($Execute) {
        $_SESSION["SuccessMessage"]=" Comments approved Successfully";
        Redirect_to("comments.php");
        # code...
    }
    else {
        $_SESSION["ErrorMessage"]="Oops cant approve comment";
        Redirect_to("comments.php");
    }
    # code...
}
?><? ob_flush(); ?>
