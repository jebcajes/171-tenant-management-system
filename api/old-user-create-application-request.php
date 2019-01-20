<?php 
    require_once "config.php";

    // Client Application
    $client_id = $_POST['client_id'];

    // Stall Application
    $business_name = $_POST['business_name'];
    $category_id = $_POST['category_id'];
    $applied_term = $_POST['applied_term'];

    if(!empty($_POST)){
        $sql_appstall = "INSERT INTO applied_stall (client_id, business_name, category_id, applied_term)
         VALUES ($client_id, '$business_name', $category_id, '$applied_term')";
        if(mysqli_query($link,$sql_appstall)){
            $new_appstall_id = mysqli_insert_id($link);

            echo "<br>" . $business_name;
            echo "<br>" . $category_id;
        }else{
            echo "Data not inserted.<br>";
        }
    }

    // Stall Application Details, Multiple stalls insert
    $stall_id = $_POST['stall_id'];
    if(!empty($stall_id)){
        foreach((array) $stall_id as $sid){
            echo "StallsID array:" . $sid . "<br>";
            $sql_selected_stalls = "INSERT INTO applied_stall_details (app_id, stall_id) 
            VALUES ($new_appstall_id, $sid)";
            mysqli_query($link,$sql_selected_stalls);
        }
    }

    header("location: ../old-user.php?client_id=$client_id");

    mysqli_close($link);

    
