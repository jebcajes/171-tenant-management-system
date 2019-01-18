<html> 
<head>
    <meta charset="UTF-8">
    <title>Tenant System</title>
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
                        <a class="nav-link" href="old-user.php?client_id=<?php echo $_GET['client_id'];?>">Home</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="client-contracts.php?client_id=<?php echo $_GET['client_id'];?>">My Contracts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="client-renewal.php?client_id=<?php echo $_GET['client_id'];?>">Renewal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="client-application-request.php?client_id=<?php echo $_GET['client_id'];?>">Request</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Navbar -->
</head>
<body>
    
    <!-- renewal Content -->
    <div class="container">
        <div>
            <br /><h1 class="float-left">List of Contracts</h1><br/>
        </div>

        <br /><br />
        <table class="table table-bordered table-striped table-sm">
            <tr align="center">
                <td><strong>Contract ID</strong></td>
                <td><strong>Business Name</strong></td>
                <td><strong>Category</strong></td>
                <td><strong>Start Date</strong></td>
                <td><strong>End Date</strong></td>
                <td><strong>Term</strong></td>
                <td><strong>Remark</strong></td>
                <td><strong>Action</strong></td>
            </tr>
            <?php
                require_once "api/config.php";
                $client_id = $_GET['client_id'];
                $contract_id = "";
                $sql_contract = "SELECT c.contract_id AS 'contract_id', c.app_id AS 'app_id',
                c.client_id AS 'client_id', c.category_id AS 'category_id', c.business_name AS 'business_name',
                c.start_date AS 'start_date', c.end_date AS 'end_date', c.date_approved AS 'date_approved',
                c.remark AS 'remark', bc.category_name AS 'category_name', c.contract_term AS 'contract_term'
                FROM contract c
                INNER JOIN business_classification bc ON c.category_id = bc.category_id 
                WHERE client_id = $client_id";
                $result_contract = mysqli_query($link,$sql_contract);
                if (mysqli_num_rows($result_contract) > 0) {
                    while($row_contract = mysqli_fetch_assoc($result_contract)) {
                        echo "<tr align='center'>";
                            $contract_id = $row_contract['contract_id'];
                            echo "<td>" . $contract_id . "</td>";
                            echo "<td>" . $row_contract['business_name'] . "</td>";
                            echo "<td>" . $row_contract['category_name'] . "</td>";
                            $old_start_date = strtotime($row_contract['start_date']);
                            $new_start_date = date('Y-m-d', $old_start_date); 
                            echo "<td>" . $new_start_date . "</td>";
                            $old_end_date = strtotime($row_contract['end_date']);
                            $new_end_date = date('Y-m-d', $old_end_date); 
                            echo "<td>" . $new_end_date . "</td>";
                            echo "<td>" . $row_contract['contract_term'] . "</td>"; 
                            echo "<td>" . $row_contract['remark'] . "</td>";
                            echo "<td><a href='client-view-stalls.php?contract_id=$contract_id' class='btn btn-sm btn-danger'>View</a></td>";
                        echo "</tr>";
                    }
                }
            ?>
        </table>
    </div>
    <!-- Renewal Content -->
</body>
</html>