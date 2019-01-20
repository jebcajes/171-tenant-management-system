<?php
    require_once "config.php";

    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $contract_id = $_GET['contract_id'];

    $remark = "";

    // To select the current remark of a contract record
    $sql_contract_remark = "SELECT * FROM contract WHERE contract_id = $contract_id";
    $result_contract_remark = mysqli_query($link, $sql_contract_remark);
    if(mysqli_num_rows($result_contract_remark) > 0){
        while($row_contract_remark = mysqli_fetch_assoc($result_contract_remark)){
            $remark = $row_contract_remark['remark'];
        }
    }

    // Setting the start and end date
    $sql_set_date = "UPDATE contract SET start_date = '$start_date', end_date = '$end_date' WHERE contract_id = $contract_id";
    if(mysqli_query($link, $sql_set_date)){
        echo "Date has been set successfully! <br />";

        // If the contract has been lapsed, then we add back the previous remark
        if($remark == 'Lapsed'){
            $sql_update_remark = "UPDATE contract SET remark = 'Confirmed' WHERE remark = 'Lapsed'";
            mysqli_query($link, $sql_update_remark);
        }
        header("Refresh: 2; url = ../admin-view-contract-details.php?contract_id=$contract_id");
    }else{
        echo "Date set attempt failed. <br />Error Message: " . mysqli_error($link) . "<br />";
    }

    mysqli_close($link);