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

    function create_health($health_detail){
        global $conn;
        $sql_query = "insert into Input_Health_Status
                    values ('".$health_detail['Date']."', '".$health_detail['Rid']."', 
                           '".$health_detail['Temperature']."', '".$health_detail['ifFlu']."')";
        $result = mysqli_query($conn, $sql_query);
        if ($result){
            return true;
        } else {
            echo mysqli_error($conn);
            CloseCon($conn);
            exit;
        }
    }

    function create_risk($risk_detail){
        global $conn;
        $sql_query = "insert into Input_Risk_Status
                    values ('".$risk_detail['Date']."', '".$risk_detail['Rid']."', 
                           '".$risk_detail['ifExp']."', '".$risk_detail['ifNeigh']."', '".$risk_detail['ifClose']."')";
        $result = mysqli_query($conn, $sql_query);
        if ($result){
            return true;
        } else {
            echo mysqli_error($conn);
            CloseCon($conn);
            exit;
        }
    }
    
    function check_quarantine($date, $Rid){
        global $conn;
        date_default_timezone_set("America/Vancouver");
        // Get fever status and risk level
        $sql_query = "select F.Fever_Status as FeverStatus, L.RiskLevel as RiskLevel
                    from Input_Health_Status H, Input_Risk_Status R, Fever_Logic F, Risk_Level L
                    where H.Date = R.Date and H.Rid = R.Rid and H.Temperature = F.Temperature
                            and R.ExposureToConfirmedCase = L.ExposureToConfirmedCase 
                            and R.ConfirmedCaseInNeighbourhood = L.ConfirmedCaseInNeighbourhood 
                            and R.CloseContactHasFlu_likeSymptom = L.CloseContactHasFlu_likeSymptom
                            and H.Date = '".$date."' and H.Rid = '".$Rid."'";
        $result = mysqli_query($conn,$sql_query);
        $row = mysqli_fetch_assoc($result);
        $FeverStatus = $row['FeverStatus'];
        $RiskLevel = $row['RiskLevel'];
        // find the latest endDate on the quarantine table
        $sql_query_qua = "select EndDate as quarantineEnd
                        from Resident_Quarantine_Status
                        where Rid ='".$Rid."'";
        $result_qua = mysqli_query($conn,$sql_query_qua);
        $latestEndDate = 0;
        while($row = mysqli_fetch_assoc($result_qua)){
            $quarantineEnd = $row['quarantineEnd'];
            if ($quarantineEnd > $latestEndDate){
                $latestEndDate = $quarantineEnd;
            }
        }
        // if latestEndDate >= date: in quarantine (today - latestEndDate)
        // else: check Fever Status and Risk Level to decide if is needed
        if ($latestEndDate >= $date){
            create_quarantine($date, $latestEndDate, '1', $Rid);
        }else{
            if ($FeverStatus == "Fever" || $FeverStatus == "High Fever" || $RiskLevel == "High"){
                create_quarantine($date, date('Y-m-d', strtotime($date. ' + 14 days')), '1', $Rid);
            } else{
                create_quarantine($date, $date, '0', $Rid);
            }
        }
        return true; 
    }

    function create_quarantine($date, $EndDate, $status, $Rid){
        global $conn;
        $sql_query = "insert into Resident_Quarantine_Status
                    values ('".$date."', '".$EndDate."', '".$status."', '".$Rid."')";
        $result = mysqli_query($conn, $sql_query);
        if (!$result){
            echo mysqli_error($conn);
            CloseCon($conn);
            exit;
        }
    }
?>