<?php   
    require_once "config.php";
    
    $renewal_id = $_GET['renewal_id'];
    $renewal_term = $_GET['renewal_term'];
    $contract_id = $_GET['contract_id'];

    $sql_approve = "UPDATE renewal SET renewal_status = 'Approved' WHERE renewal_id = $renewal_id";
    if(mysqli_query($link, $sql_approve)){
        echo "Renewal has been approved! <br />";

        $sql_update_term = "UPDATE contract SET contract_term = '$renewal_term' WHERE contract_id = $contract_id";
        mysqli_query($link, $sql_update_term);

        header("Refresh: 2; url= ../admin-renewal-requests.php");
    }else{
        echo mysqli_error($link);
    }
