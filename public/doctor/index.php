<?php require_once('../../private/initialize.php'); ?>

<?php
// Redirects to Login.html if not logged in
  if($_SESSION['Active'] == false){
    header("location:../../index.php");
	  exit;
  }
  if(isset($_POST['logout'])) {
    logout();
  }
?>

<!DOCTYPE html>
    <head>
            <title>Pandemic Tracker</title>
    </head>
    <body>
        <h1> Doctor Account</h1>
        <div>
            <p>Status: logged in</p>
            <form method="post"> 
              <input type="submit" name="logout" value="Log out"/> 
            </form> 
        </div>
    </body>

</html>

<?php include(PRIVATE_P . '/footer.php'); ?>


