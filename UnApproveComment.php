<? ob_start(); ?><?php
require_once("includes/Db.php");
require_once("includes/Functions.php");
require_once("includes/Sessions.php");
require_once("includes/DateTime.php");
if ($_SESSION["Role"]==null) {
  # code...
  Redirect_to("login.php");
    $_SESSION["ErrorMessage"]="Login required";

}
else if($_SESSION["Role"]=="admin"){
  ConfirmLogin();
  }
 else if($_SESSION["Role"]=="Editor"){
    $_SESSION["ErrorMessage"]="You have no authority to delete the admin";
    Redirect_to("dashboard.php");
  }


if (isset($_GET["id"])) {
   
    $SearchQueryParameter=$_GET["id"];
      global $ConnectingDb;
    $Admin=($_SESSION["UserName"]);
    $sql="UPDATE comments SET status='OFF', unapprovedby='$Admin' WHERE id='$SearchQueryParameter'";

    $Execute=$ConnectingDb->query($sql);
    if ($Execute) {
        $_SESSION["SuccessMessage"]=" Comments unapproved Successfully";
        Redirect_to("comments.php");
        # code...
    }
    else {
        $_SESSION["ErrorMessage"]="Oops cant unapprove comment";
        Redirect_to("comments.php");
    }
    # code...
}
?><? ob_flush(); ?>
