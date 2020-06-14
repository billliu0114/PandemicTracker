<?php
    require_once('connect.php');

    function logout() {
        echo "hello";
        // destroy session
        session_destroy();
        // Redirect to login page
        header("location: index.php");
        exit;
    }

    function get_rid($username){
        global $conn;
        $sql_query = "select Rid as ID 
                    from Link_Personal_Account
                    where username='".$_SESSION["uname"]."'";
        $result = mysqli_query($conn,$sql_query);
        $row = mysqli_fetch_assoc($result);
        $Rid = $row['ID'];
        return $Rid;
    }
?>