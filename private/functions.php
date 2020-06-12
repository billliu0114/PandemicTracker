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
?>