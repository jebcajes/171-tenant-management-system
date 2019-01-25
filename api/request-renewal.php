<?php 
    require_once "config.php";

    $renewal_term = $_POST['contract_term'];
    $contract_id = $_POST['contract_id'];
    $client_id = $_GET['client_id'];

    $sql_renewal = "INSERT INTO renewal (client_id, contract_id, renewal_term) VALUES ($client_id, $contract_id, '$renewal_term')";
    if(mysqli_query($link,$sql_renewal)){
        echo "Successfully.<br>";
        $renewal_id = mysqli_insert_id($link);

        $select_stalls = "SELECT app_id FROM contract WHERE contract_id = $contract_id";
        if($result_select_stalls = mysqli_query($link, $select_stalls)){
            if(mysqli_num_rows($result_select_stalls) > 0 ){
                $app_id = "";
                while($row_select_stalls = mysqli_fetch_assoc($result_select_stalls)){
                    $app_id = $row_select_stalls['app_id'];
                }
            }

            $select_stalls_2 = "SELECT * FROM applied_stall_details WHERE app_id = $app_id AND stall_application_status = 'Approved'";
            if($result_select_stalls_2 = mysqli_query($link, $select_stalls_2)){
                if(mysqli_num_rows($result_select_stalls_2) > 0 ){
                    while($row = mysqli_fetch_assoc($result_select_stalls_2)){
                        $stall_id = $row['stall_id'];
                        $sql_insert_stall = "INSERT INTO renewal_details (renewal_id, stall_id) VALUES ($renewal_id, $stall_id)";
                        mysqli_query($link, $sql_insert_stall);
                    }
                }
            }
        }

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

    mysqli_close($link);
    
    