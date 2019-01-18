<?php 
    require_once "config.php";

    $renewal_term = $_POST['contract_term'];
    $contract_id = $_POST['contract_id'];
    $client_id = $_GET['client_id'];

    $sql_renewal = "INSERT INTO renewal (client_id, contract_id, renewal_term) VALUES ($client_id, $contract_id, '$renewal_term')";
    if(mysqli_query($link,$sql_renewal)){
        echo "Successfully.<br>";

        $sql_update_contract = "UPDATE contract SET renewal_status = 'Sent' WHERE contract_id = $contract_id";
        if(mysqli_query($link,$sql_update_contract)){
            echo "Updated successfully.<br>";

            header("location: ../client-renewal.php?client_id=$client_id");
        }else{
            echo "Update failed.<br>";
        }
        
    }else{
        echo "It failed.<br>" . mysqli_error($link);
    }

    
    