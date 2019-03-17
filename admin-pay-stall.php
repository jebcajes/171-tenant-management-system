<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Rent Payment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap-4.2.1-dist/css/bootstrap.min.css">
    <!-- Bootstrap CSS -->

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
        <a class="navbar-brand" href="index.php">
            <img src="img/rob.png" width="30" height="30" alt="">
        </a>
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item ">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="admin-contracts.php">Contracts</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="admin-applied-stalls.php">Applications</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin-renewal-requests.php">Renewal Requests</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin-stalls.php">Stalls</a>
                    </li>
                </ul>
                <ul class="navbar-nav float-right">
                    <li class="nav-item">
                        <a href="api/logout.php" class="nav-link">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Navbar -->

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col">
                
            </div>
            <div class="col">
            <br>
                <table class="table table-bordered">
                    <thead>
                        <th>Month</th>
                        <th>Balance</th>
                        <th>Amount Paid</th>
                        <th>Date Paid</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php 
                            require_once "api/config.php";
                            $contract_id = $_GET['contract_id'];
                            
                            $sql_rental = "SELECT * FROM rental_payment WHERE contract_id = $contract_id";
                            
                            $result_sql_rental = mysqli_query($link, $sql_rental);
                            if(mysqli_num_rows($result_sql_rental) > 0 ){
                                while($row_sql_rental = mysqli_fetch_assoc($result_sql_rental)){
                                    echo "<tr>";
                                        $rent_month = $row_sql_rental['rent_month'];
                                        $date_paid = $row_sql_rental['date_paid'];
                                        $old_date_paid = strtotime($date_paid);
                                        $new_date_paid = date('Y-m-d', $old_date_paid);

                                        if($rent_month){

                                        }else{
                                            echo "<td><select type='text' class='form-control form-control-sm'>
                                                <option>January</option>
                                                <option>February</option>
                                                <option>March</option>
                                                <option>April</option>
                                                <option>May</option>
                                                <option>June</option>
                                                <option>July</option>
                                                <option>August</option>
                                                <option>September</option>
                                                <option>October</option>
                                                <option>November</option>
                                                <option>December</option>
                                            </select></td>";
                                        }
                                        echo "<td>" . "</td>";
                                    echo "</tr>";
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>