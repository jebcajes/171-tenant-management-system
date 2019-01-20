<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Renewal Details</title>

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
                    <li class="nav-item ">
                        <a class="nav-link" href="admin-contracts.php">Contracts</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="admin-applied-stalls.php">Applications</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="admin-renewal-requests.php">Renewal Requests</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin-rental-requests.php">Rental Payments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin-stalls.php">Stalls</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Navbar -->
</head>
<body>
    <div class="container">
        <br><h1>Renewal Details</h1><br>
        <div class="row">
            <div class="col-md-8">
                <table class="table table-bordered table-striped table-sm">
                    <tr>
                        <th></th>
                    </tr>
                <?php
                    require_once "api/config.php";

                    $renewal_id = $_GET['renewal_id'];
                    
                    $sql_renewal = "SELECT r.renewal_id AS 'renewal_id', cl.fname AS 'fname', cl.lname AS 'lname',
                    r.contract_id AS 'contract_id', r.date_applied_renewal AS 'date_applied_renewal', r.renewal_status AS 'renewal_status',
                    r.renewal_term AS 'renewal_term'
                    FROM renewal r
                    INNER JOIN client cl ON r.client_id = cl.client_id
                    WHERE renewal_id = $renewal_id
                    ";

                    $result_renewal = mysqli_query($link, $sql_renewal);
                    if(mysqli_num_rows($result_renewal) > 0 ){
                        while($row_renewal = mysqli_fetch_assoc($result_renewal)){
                            
                        }
                    }else{
                        echo "<td colspan='7' align='center'>No records found.</td>";
                    }
                ?>
                </table>
            </div>
            <div class="col">

            </div>
        </div>
    </div>
</body>
</html>