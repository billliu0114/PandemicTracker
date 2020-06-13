<?php require_once('../../private/initialize.php'); ?>

<?php
  if($_SESSION['Active'] == false){
    header("location:../../index.php");
	  exit;
  }
  if(isset($_POST['logout'])) {
    logout();
  }

  $sql_query = "select Rid as ID 
                    from Link_Personal_Account
                    where username='".$_SESSION["uname"]."'";
  $result = mysqli_query($conn,$sql_query);
  $row = mysqli_fetch_assoc($result);
  $Rid = $row['ID'];

  // information needed to present
  $sql_query = "select R.FirstName as fname, R.LastName as lname, R.DOB as dob
                    from Resident R
                    where Rid ='".$Rid."'";
  $result = mysqli_query($conn,$sql_query);
  $row = mysqli_fetch_assoc($result);
  $fname = $row['fname'];
  $lname = $row["lname"];
  $dob = $row["dob"];
  $today = date("Y-m-d");

  $yesterday = date("Y-m-d", strtotime("-1 day"));

  // get the date info of the newest record form Input_Health_Status
  // get the lastest endDate from all Resident_Quarantine_Status records
  $sql_query = "select H.Date as recordDate, EndDate as quarantineEnd
                    from Input_Health_Status H, Resident_Quarantine_Status Q
                    where Q.Rid = H.Rid AND H.Rid ='".$Rid."'";
  $result = mysqli_query($conn,$sql_query);
  $mostRecentRecord= 0;
  $latestEndDate = 0;
  while($row = mysqli_fetch_assoc($result)){
    $recordDate = $row['recordDate'];
    if ($recordDate > $mostRecentRecord){
      $mostRecentRecord = $recordDate;
    }
    $quarantineEnd = $row['quarantineEnd'];
    if ($quarantineEnd > $latestEndDate){
      $latestEndDate = $quarantineEnd;
    }
  }

  // check date : if not = $yesterday or today => expired
  // if not expired: check Quarantine Status and Risk_Level for newest record
  if ($mostRecentRecord == $yesterday || $mostRecentRecord == $today){
    // endDate records > current Date
    if ($latestEndDate >= $today){
      $status = "Stay at Home";
    }else{
      $status = "Healthy";
    }
  } else {
    $status = "Expired";
  }
?>

<!DOCTYPE html>
    <head>
            <title>Pandemic Tracker</title>

            <style>
              .btn{
                text-decoration: none;
                border: 1px solid black;
                padding: 5px 10px;
                border-radius: 5px;
              }
              .logout{
                position: absolute;
                top: 25px;
                right: 25px;
              }
              .status{
                position: absolute;
                bottom:25px;
                left:25px;
              }
            </style>
    </head>
    
    <body>
        <h1> <?php echo "Health Pass For: " . $fname . " " . $lname ?> </h1>
        <h3>Date: <?php echo $today ?><h5>
        <h3>Date of Birth: <?php echo $dob ?> <h5>
        <h2>Status: <?php echo $status?><h4>
        
        <div>
          
            
            <a href="index.php" class="btn">Back</a>

            <form method="post" class="logout"> 
              <input type="submit" name="logout" value="Log Out"/> 
            </form> 

            
              <div class="status">
            <p>Status: <span style="color: green">Logged In<span></p>
              </div>
        </div>
    </body>

</html>

<?php include(PRIVATE_P . '/footer.php'); ?>