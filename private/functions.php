<?php
    require_once('connect.php');

    function logout() {
        // destroy session
        session_destroy();
        // Redirect to login page
        header("location: index.php");
        exit;
    }

    function get_docid($userid) {
        global $conn;
        $sql = "select Did from Link_Doctor_Account ";
        $sql .= "where UserName = '" .$userid. "';";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            exit("Database query failed.");
        }
        $Did = mysqli_fetch_assoc($result)['Did'];
        return $Did;
    }

    function get_existing_cases_table_set($Did) {
        global $conn;
        $sql = "select CaseNum, EncounterDate, FirstName, LastName ";
        $sql .= "from Cases, Resident ";
        $sql .= "where Did = '" . $Did . "' AND Cases.RID = Resident.Rid;";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            exit("Database query failed.");
        }
        return $result;
    }

    function get_case_detail($casenum) {
        global $conn;
        $sql = "select CaseNum, EncounterDate, RecoveryStatus, Notes, FirstName, LastName ";
        $sql .= "from Cases, Resident ";
        $sql .= "where CaseNum = '" . $casenum . "' AND Cases.RID = Resident.Rid;";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            exit("Database query failed.");
        }
        $case_detail = mysqli_fetch_assoc($result);
        return $case_detail;
    }
?>