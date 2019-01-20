<?php
    require_once "config.php";

    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $contract_id = $_GET['contract_id'];

    $remark = $app_id = "";

    // To select the current remark of a contract record
    $sql_contract_remark = "SELECT * FROM contract WHERE contract_id = $contract_id";
    $result_contract_remark = mysqli_query($link, $sql_contract_remark);
    if(mysqli_num_rows($result_contract_remark) > 0){
        while($row_contract_remark = mysqli_fetch_assoc($result_contract_remark)){
            $remark = $row_contract_remark['remark'];
            $app_id = $row_contract_remark['app_id'];
        }
    }

    // Setting the start and end date
    $sql_set_date = "UPDATE contract SET start_date = '$start_date', end_date = '$end_date' WHERE contract_id = $contract_id";
    if(mysqli_query($link, $sql_set_date)){

            // Automation to occupy only Approved stall; 1
            $sql_applied_stall_1 = "SELECT * FROM applied_stall_details WHERE app_id = $app_id LIMIT 0,1";
            if(!empty($result_applied_stall_1 = mysqli_query($link, $sql_applied_stall_1))){
                $stall_id_1 = $remark_1 = "";

                while($row_applied_stall_1 = mysqli_fetch_assoc($result_applied_stall_1)){
                    $stall_id_1 = $row_applied_stall_1['stall_id'];
                    $remark_1 = $row_applied_stall_1['stall_application_status'];
                }

                    if($remark_1 == 'Approved'){
                        $sql_occupy_stall_1 = "UPDATE occupied_stalls SET contract_id = $contract_id 
                        WHERE stall_id = $stall_id_1 AND contract_id IS NULL";
                        mysqli_query($link, $sql_occupy_stall_1);
                    }
            }else{
                echo "It failed. Error Message: " . mysqli_error($link) . "<br />";
            }
            

            // Automation to occupy only Approved stall; 2
            $sql_applied_stall_2 = "SELECT * FROM applied_stall_details WHERE app_id = $app_id LIMIT 1,1";
            if(!empty($result_applied_stall_2 = mysqli_query($link, $sql_applied_stall_2))){
                $stall_id_2 = $remark_2 = "";

                while($row_applied_stall_2 = mysqli_fetch_assoc($result_applied_stall_2)){
                    $stall_id_2 = $row_applied_stall_2['stall_id'];
                    $remark_2 = $row_applied_stall_2['stall_application_status'];
                }

                    if($remark_2 == 'Approved'){
                        $sql_occupy_stall_2 = "UPDATE occupied_stalls SET contract_id = $contract_id 
                        WHERE stall_id = $stall_id_2 AND contract_id IS NULL";
                        mysqli_query($link, $sql_occupy_stall_2);
                    }
            }else{
                echo "It failed. Error Message: " . mysqli_error($link) . "<br />";
            } 
            
            // Automation to occupy only Approved stall; 3
            $sql_applied_stall_3 = "SELECT * FROM applied_stall_details WHERE app_id = $app_id LIMIT 2,1";
            if(!empty($result_applied_stall_3 = mysqli_query($link, $sql_applied_stall_3))){
                $stall_id_3 = $remark_3 = "";

                while($row_applied_stall_3 = mysqli_fetch_assoc($result_applied_stall_3)){
                    $stall_id_3 = $row_applied_stall_3['stall_id'];
                    $remark_3 = $row_applied_stall_3['stall_application_status'];
                }

                    if($remark_3 == 'Approved'){
                        $sql_occupy_stall_3 = "UPDATE occupied_stalls SET contract_id = $contract_id 
                        WHERE stall_id = $stall_id_3 AND contract_id IS NULL";
                        mysqli_query($link, $sql_occupy_stall_3);
                    }
            }else{
                echo "It failed. Error Message: " . mysqli_error($link) . "<br />";
            }

            // Automation to occupy only Approved stall; 4
            $sql_applied_stall_4 = "SELECT * FROM applied_stall_details WHERE app_id = $app_id LIMIT 3,1";
            if(!empty($result_applied_stall_4 = mysqli_query($link, $sql_applied_stall_4))){
                $stall_id_4 = $remark_4 = "";

                while($row_applied_stall_4 = mysqli_fetch_assoc($result_applied_stall_4)){
                    $stall_id_4 = $row_applied_stall_4['stall_id'];
                    $remark_4 = $row_applied_stall_4['stall_application_status'];
                }

                    if($remark_4 == 'Approved'){
                        $sql_occupy_stall_4 = "UPDATE occupied_stalls SET contract_id = $contract_id 
                        WHERE stall_id = $stall_id_4 AND contract_id IS NULL";
                        mysqli_query($link, $sql_occupy_stall_4);
                    }
            }else{
                echo "It failed. Error Message: " . mysqli_error($link) . "<br />";
            }

            // Automation to occupy only Approved stall; 5
            $sql_applied_stall_5 = "SELECT * FROM applied_stall_details WHERE app_id = $app_id LIMIT 4,1";
            if(!empty($result_applied_stall_5 = mysqli_query($link, $sql_applied_stall_5))){
                $stall_id_5 = $remark_5 = "";

                while($row_applied_stall_5 = mysqli_fetch_assoc($result_applied_stall_5)){
                    $stall_id_5 = $row_applied_stall_5['stall_id'];
                    $remark_5 = $row_applied_stall_5['stall_application_status'];
                }

                    if($remark_5 == 'Approved'){
                        $sql_occupy_stall_5 = "UPDATE occupied_stalls SET contract_id = $contract_id 
                        WHERE stall_id = $stall_id_5 AND contract_id IS NULL";
                        mysqli_query($link, $sql_occupy_stall_5);
                    }
            }else{
                echo "It failed. Error Message: " . mysqli_error($link) . "<br />";
            }

        // Notification if it was successful
        echo "Date has been set successfully! <br />";

        // If the contract has been lapsed, then we add back the previous remark
        if($remark == 'Lapsed'){
            $sql_update_remark = "UPDATE contract SET remark = 'Confirmed' WHERE remark = 'Lapsed'";
            mysqli_query($link, $sql_update_remark);
        }

        // Redirect
        // header("Refresh: 2; url = ../admin-view-contract-details.php?contract_id=$contract_id");
    }else{
        echo "Date set attempt failed. <br />Error Message: " . mysqli_error($link) . "<br />";
    }

    mysqli_close($link);