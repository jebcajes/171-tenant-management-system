<?php
    require_once "config.php";

    $contract_id = $_GET['contract_id'];
    $stall_id_1 = $stall_id_2 = $stall_id_3 = $stall_id_4 = $stall_id_5 = "";
    $total_amount = "";

    $sql_select_stalls = "SELECT * FROM occupied_stalls WHERE contract_id = $contract_id";
    $result_stalls = mysqli_query($link, $sql_select_stalls);
    if(mysqli_num_rows($result_stalls) > 0 ){

        // The first stall, first row
        $sql_select_stalls = "SELECT * FROM occupied_stalls os INNER JOIN stalls s ON os.stall_id = s.stall_id WHERE contract_id = $contract_id LIMIT 0,1";
        $result_stalls = mysqli_query($link, $sql_select_stalls);
        if(mysqli_num_rows($result_stalls) > 0 ){
            while($row_stalls = mysqli_fetch_assoc($result_stalls)){
                $stall_id_1 = $row_stalls['stall_id'];
                $total_amount = $total_amount + $row_stalls['stall_price'];
            }
        }

        // The second stall, second row
        $sql_select_stalls = "SELECT * FROM occupied_stalls os INNER JOIN stalls s ON os.stall_id = s.stall_id WHERE contract_id = $contract_id LIMIT 1,1";
        $result_stalls = mysqli_query($link, $sql_select_stalls);
        if(mysqli_num_rows($result_stalls) > 0 ){
            while($row_stalls = mysqli_fetch_assoc($result_stalls)){
                $stall_id_2 = $row_stalls['stall_id'];
                $total_amount = $total_amount + $row_stalls['stall_price'];
            }
        }

        // The third stall, third row
        $sql_select_stalls = "SELECT * FROM occupied_stalls os INNER JOIN stalls s ON os.stall_id = s.stall_id WHERE contract_id = $contract_id LIMIT 2,1";
        $result_stalls = mysqli_query($link, $sql_select_stalls);
        if(mysqli_num_rows($result_stalls) > 0 ){
            while($row_stalls = mysqli_fetch_assoc($result_stalls)){
                $stall_id_3 = $row_stalls['stall_id'];
                $total_amount = $total_amount + $row_stalls['stall_price'];
            }
        }

        // The fourth stall, fourth row
        $sql_select_stalls = "SELECT * FROM occupied_stalls os INNER JOIN stalls s ON os.stall_id = s.stall_id WHERE contract_id = $contract_id LIMIT 3,1";
        $result_stalls = mysqli_query($link, $sql_select_stalls);
        if(mysqli_num_rows($result_stalls) > 0 ){
            while($row_stalls = mysqli_fetch_assoc($result_stalls)){
                $stall_id_4 = $row_stalls['stall_id'];
                $total_amount = $total_amount + $row_stalls['stall_price'];
            }
        }

        // The fifth stall, fifth row
        $sql_select_stalls = "SELECT * FROM occupied_stalls os INNER JOIN stalls s ON os.stall_id = s.stall_id WHERE contract_id = $contract_id LIMIT 4,1";
        $result_stalls = mysqli_query($link, $sql_select_stalls);
        if(mysqli_num_rows($result_stalls) > 0 ){
            while($row_stalls = mysqli_fetch_assoc($result_stalls)){
                $stall_id_5 = $row_stalls['stall_id'];
                $total_amount = $total_amount + $row_stalls['stall_price'];
            }
        }

    }
    
    $sql_new_payment = "INSERT INTO rental_payment (contract_id, total_amount, balance) VALUES ($contract_id, $total_amount, $total_amount)";
    if(mysqli_query($link, $sql_new_payment)){
        header("Refresh: 1; url= ../admin-view-contract-details.php?contract_id=$contract_id");
    }else{
        echo "Nay";
    }