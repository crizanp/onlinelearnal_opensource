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
    $_SESSION["ErrorMessage"]="You have no authority to delete the subject";
    Redirect_to("dashboard.php");
  }


if (isset($_GET["id"])) {
    $SearchQueryParameter=$_GET["id"];
    global $ConnectingDb;
    $sql="DELETE FROM subjects WHERE id='$SearchQueryParameter'";

    $Execute=$ConnectingDb->query($sql);
    if ($Execute) {
        $_SESSION["SuccessMessage"]="Subject Deleted Successfully";
        Redirect_to("categories.php");
        # code...
    }
    else {
        $_SESSION["ErrorMessage"]="Oops cant delete Subject";
        Redirect_to("categories.php");
    }
    # code...
}

?>
    <? ob_flush(); ?>
