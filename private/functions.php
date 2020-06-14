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
        $sql = "select CaseNum, EncounterDate, RecoveryStatus, Notes, FirstName, LastName, DOB ";
        $sql .= "from Cases, Resident ";
        $sql .= "where CaseNum = '" . $casenum . "' AND Cases.RID = Resident.Rid;";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            exit("Database query failed.");
        }
        $case_detail = mysqli_fetch_assoc($result);
        return $case_detail;
    }

    function get_case_medication($casenum) {
        global $conn;
        $sql = "select * ";
        $sql .= "from Records ";
        $sql .= "where CaseNum = '" . $casenum . "';";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            exit("Database query failed.");
        }
        $med = mysqli_fetch_assoc($result);
        if(empty($med)){
            $med['Name'] = 'NULL';
            $med['Dosage'] = 'NULL';
        }
        return $med;
    }

    function update_cases_table($case_detail) {
        global $conn;
        $sql = "update Cases SET ";
        $sql .= "EncounterDate='" . $case_detail['EncounterDate'] . "', ";
        $sql .= "RecoveryStatus='" . $case_detail['RecoveryStatus'] . "', ";
        $sql .= "Notes='" . $case_detail['Notes'] . "' ";
        $sql .= "where CaseNum='" . $case_detail['CaseNum'] . "' ";
        $sql .= "limit 1;";
        $result = mysqli_query($conn, $sql);
        if($result) {
            return true;
        } else {
            echo mysqli_error($conn);
            CloseCon($conn);
            exit;
        }
    }

    function create_case($case_detail) {
        global $conn;
        $sql = "INSERT into Cases (EncounterDate, RecoveryStatus, Notes, Did, Rid) ";
        $sql .= "Value ('" . $case_detail['EncounterDate'] . "', '" . $case_detail['RecoveryStatus'] . "', '" . $case_detail['Notes'] . "', '" . $case_detail['Did'] . "', '" . $case_detail['Rid'] . "');";
        $result = mysqli_query($conn, $sql);
        if($result) {
            return true;
        } else {
            echo mysqli_error($conn);
            CloseCon($conn);
            exit;
        }
    }
    function update_medication($case_detail, $case_med, $update_create) {
        global $conn;
        $sql = "INSERT IGNORE into Medication ";
        $sql .= "VALUES('".$case_med['Name']."'), ('".$case_med['Dosage']."');";
        mysqli_query($conn, $sql);
        if ($update_create === "update") {
            return update_case_medication($case_detail, $case_med);
        } elseif ($update_create === "create"){
            return create_case_medication($case_detail, $case_med);
        }

    }

    function update_case_medication($case_detail, $case_med) {
        global $conn;
        $sql = "update Records ";
        $sql .= "SET Name ='".$case_med['Name']."', Dosage = '".$case_med['Dosage']."' ";
        $sql .= "where CaseNum = '".$case_detail['CaseNum']."' ";
        $sql .= "limit 1;";
        $result = mysqli_query($conn, $sql);
        if($result) {
            return true;
        } else {
            echo mysqli_error($conn);
            CloseCon($conn);
            exit;
        }
    }

    function create_case_medication($case_detail, $case_med) {
        global $conn;
        $sql = "insert into Records ";
        $sql .= "VALUES ('".$case_detail['CaseNum']."', '".$case_med['Name']."', '".$case_med['Dosage']."');";
        $result = mysqli_query($conn, $sql);
        if($result) {
            return true;
        } else {
            echo mysqli_error($conn);
            CloseCon($conn);
            exit;
        }
    }

    function delete_case($casenum) {
        global $conn;
        $sql = "DELETE FROM Cases ";
        $sql .= "WHERE CaseNum='" . $casenum . "' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($conn, $sql);
        if(!$result) {
            echo mysqli_error($conn);
            CloseCon($conn);
            exit;
        }
    }

    function get_rinfo_from_carenum($carenum) {
        global $conn;
        $sql = "select Rid, FirstName, LastName, DOB from Resident ";
        $sql .= "where HealthCare_num = '" . $carenum . "' ";
        $sql .= "LIMIT 1;";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            exit("Database query failed.");
        } else {
            $rinfo = mysqli_fetch_assoc($result);
        }
        return $rinfo;
    }
?>