<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tenant Applications</title>
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
        <div class="row">
            <div class="col">
                <div class="float-left">
                    <br />
                    <h1>List of Applications</h1>
                    <br />
                </div>
                <table class="table table-bordered table-striped table-sm"> 
                    <tr align="center">
                        <td><strong>#</strong></td>
                        <td><strong>Client</strong></td>
                        <td><strong>Business Name</strong></td>
                        <td><strong>Applied Term</strong></td>
                        <td><strong>Date Applied</strong></td>
                        <td><strong>Remark</strong></td>
                        <td><strong>Action</strong></td>
                    </tr>
                    <?php
                        require_once "api/config.php";

                        $sql_applied_stalls = "SELECT a.app_id AS 'app_id', a.client_id AS 'client_id',
                        bc.category_name AS 'category_name', a.business_name AS 'business_name', a.date_applied AS 'date_applied',
                        a.application_status AS 'application_status', a.applied_term AS 'applied_term',
                        c.fname AS 'fname', c.lname AS 'lname'
                        FROM applied_stall a
                        INNER JOIN business_classification bc ON a.category_id = bc.category_id
                        INNER JOIN client c ON a.client_id = c.client_id
                        ORDER BY a.app_id ASC
                        ";

                        $result_applied_stalls = (mysqli_query($link, $sql_applied_stalls));
                        if(mysqli_num_rows($result_applied_stalls) > 0){
                            while($row_applied_stalls = mysqli_fetch_assoc($result_applied_stalls)){
                                echo "<tr align='center'>";
                                    $app_id = $row_applied_stalls['app_id'];
                                    echo "<td>" . $row_applied_stalls['app_id'] . "</td>";
                                    echo "<td>" . $row_applied_stalls['fname'] . " " . $row_applied_stalls['lname'] . "</td>";
                                    echo "<td>" . $row_applied_stalls['business_name'] . "</td>";
                                    echo "<td>" . $row_applied_stalls['applied_term'] . "</td>";
                                    echo "<td>" . $row_applied_stalls['date_applied'] . "</td>";
                                    echo "<td>" . $row_applied_stalls['application_status'] . "</td>";
                                    echo "<td>
                                        <a href='admin-view-applied-stall.php?app_id=$app_id' class='btn btn-primary btn-sm' style='margin: 5px;'>View</a>
                                        <a href='api/api-admin-approve-applied-stall.php?app_id=$app_id' class='btn btn-success btn-sm' style='margin: 5px;'>Approve</a>
                                        <a href='api/api-admin-disapprove-applied-stall.php?app_id=$app_id' class='btn btn-danger btn-sm' style='margin: 5px;'>Disapprove</a>
                                    </td>";
                                echo "</tr>";
                            }
                        }

                    ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>