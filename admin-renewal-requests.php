<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Renewal Requests</title>

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
        <br><h1>Renewal Requests</h1><br>
        <div class="row">
            <table class="table table-bordered table-striped table-sm">
                <thead align="center">
                    <th>#</th>
                    <th>Contract ID</th>
                    <th>Client</th>
                    <th>Date Applied for Renewal</th>
                    <th>Renewal Term</th>
                    <th>Remark</th>
                    <th>Action</th>
                </thead>
                <?php
                    require_once "api/config.php";

                    $sql_renewal = "SELECT r.renewal_id AS 'renewal_id', cl.fname AS 'fname', cl.lname AS 'lname',
                    r.contract_id AS 'contract_id', r.date_applied_renewal AS 'date_applied_renewal', r.renewal_status AS 'renewal_status',
                    r.renewal_term AS 'renewal_term'
                    FROM renewal r
                    INNER JOIN client cl ON r.client_id = cl.client_id
                    ";

                    $result_renewal = mysqli_query($link, $sql_renewal);
                    if(mysqli_num_rows($result_renewal) > 0 ){
                        while($row_renewal = mysqli_fetch_assoc($result_renewal)){
                            echo "<tr align='center'>";
                                $renewal_id = $row_renewal['renewal_id'];
                                echo "<td>" . $row_renewal['renewal_id'] . "</td>";
                                echo "<td>" . $row_renewal['contract_id'] . "</td>";
                                $contract_id = $row_renewal['contract_id']; 
                                echo "<td>" . $row_renewal['fname'] . " " . $row_renewal['lname'] . "</td>";
                                $old_date = strtotime($row_renewal['date_applied_renewal']);
                                $new_date = date('Y-m-d', $old_date);
                                echo "<td>" . $new_date . "</td>";
                                echo "<td>" . $row_renewal['renewal_term'] . "</td>";
                                $renewal_term = $row_renewal['renewal_term'];
                                if($row_renewal['renewal_status'] == 'Approved'){
                                    echo "<td style='color: green; font-weight: 800; font-style: italic;'>" . $row_renewal['renewal_status'] . "</td>";
                                }else{
                                    echo "<td style='color: orange; font-weight: 800; font-style: italic;'>" . $row_renewal['renewal_status'] . "</td>";
                                }
                                echo "<td>";
                                    echo "<a href='admin-view-renewal-details.php?renewal_id=$renewal_id' class='btn btn-primary btn-sm' style='font-size: 11px; margin: 1px;'>View</a>";
                                    echo "<a href='api/admin-approve-renewal.php?renewal_id=$renewal_id&renewal_term=$renewal_term&contract_id=$contract_id' class='btn btn-success btn-sm' style='font-size: 11px; margin: 1px;'>Approve</a>";
                                echo "</td>";
                            echo "</tr>";
                        }
                    }else{
                        echo '<tr>';
                            echo '<td colspan="7" style="font-style: italic;" align="center">No records found.</td>';
                        echo '</tr>';
                    }
                ?>
            </table>
        </div>
    </div>
</body>
</html>