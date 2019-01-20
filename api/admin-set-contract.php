<?php
    require_once "config.php";

    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $contract_id = $_GET['contract_id'];

    $sql_set_date = "UPDATE contract SET start_date = '$start_date', end_date = '$end_date' WHERE contract_id = $contract_id";
    if(mysqli_query($link, $sql_set_date)){
        echo "Date has been set successfully! <br />";
        header("Refresh: 2; url = ../admin-view-contract-details.php?contract_id=$contract_id");
    }else{
        echo "Date set attempt failed. <br />Error Message: " . mysqli_error($link) . "<br />";
    }

    mysqli_close($link);