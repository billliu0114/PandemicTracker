<?php
function OpenCon(){
    $dbhost = "pandemic-tracker-aws.clykyqmaokyo.ca-central-1.rds.amazonaws.com";
    $dbuser = "admin";
    $dbpass = "Cpsc304ubc";
    $db = "pandemictracker";

    // $dbhost = "localhost";
    // $dbuser = "root";
    // $dbpass = "root";
    // $db = "pandamic_tracker";

    $conn = new mysqli($dbhost, $dbuser, 
    $dbpass,$db) or die("Connect failed: %s\n". 
    $conn -> error);
    return $conn;
}
function CloseCon($conn){
    $conn -> close();
}
function confirm_db_connect($conn) {
    if($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
  }
?>