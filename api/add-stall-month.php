<?php
    require_once("config.php");
    $rentp_id = $_GET['rentp_id'];
    $stall_id = $_GET['stall_id'];
    $contract_id = $_GET['contract_id'];

    $sql_add = "INSERT INTO rental_payment_details (rentp_id, stall_id) VALUES ($rentp_id, $stall_id)";
    
    if(mysqli_query($link, $sql_add)){
        echo "New record added! <br>";
        header("Refresh:1;url=../admin-pay-stall.php?contract_id=$contract_id&stall_id=$stall_id");
    }