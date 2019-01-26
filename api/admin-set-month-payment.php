<?php
    require_once "config.php";

    $rentp_id = $_POST['rentp_id'];
    $contract_id = $_GET['contract_id'];

    if(!empty($_POST['rent_month'])){
        $rent_month = $_POST['rent_month'];

        $sql_set_month = "UPDATE rental_payment SET rent_month = '$rent_month' WHERE rentp_id = $rentp_id";
        if(mysqli_query($link, $sql_set_month)){
            echo "Rent month updated successfully. <br />";
            header("Refresh: 1; url=../admin-view-contract-details.php?contract_id=$contract_id");
        }else{
            echo "Error, can't update. ERROR MSG (" . mysqli_error($link) . ") <br />";
        }
    }else{
        echo 'Rent Month is empty. Please select a month.<br />';
        echo "<a href='../admin-view-contract-details.php?contract_id=$contract_id'>Go back</a>";
    }

    if(!empty($_POST['amount_paid'])){
        $amount_paid = $_POST['amount_paid'];
        $timezone = date_default_timezone_get();

        $sql_pay = "UPDATE rental_payment SET amount_paid = amount_paid + $amount_paid, 
        balance = balance - $amount_paid, date_paid = NOW() WHERE rentp_id = $rentp_id";
        if(mysqli_query($link, $sql_pay)){
            echo "yay";
        }else{
            echo "nay";
        }

    }

    // header("Refresh: 1; url=../admin-view-contract-details.php?contract_id=$contract_id");

