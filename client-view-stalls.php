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
                        <li class="nav-item disabled">
                            <a class="nav-link" href="old-user.php?client_id=<?php echo $_GET['client_id'];?>">Home</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="client-contracts.php?client_id=<?php echo $_GET['client_id'];?>">My Contracts</a>
                        </li>
                        <li class="nav-item disabled">
                            <a class="nav-link" href="client-renewal.php?client_id=<?php echo $_GET['client_id'];?>">Renewal</a>
                        </li>
                        <li class="nav-item disabled">
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
                <br /><h1 class="float-left">Contract Details</h1><br/>
                <button onclick="goBack()" class="btn btn-danger btn-sm float-right">Back</button>
                <script>
                function goBack() {
                window.history.back();
                }
                </script>
            </div>
            
            <br /><br />
            <div class="row">
                <div class="col-4">
                    <table class="table table-bordered table-striped table-sm">
                        <tr align="center">
                            <td><strong>Floor No.</strong></td>
                            <td><strong>Block No.</strong></td>
                            <td><strong>Block Dimensions</strong></td>
                            <td><strong>Stall Price</strong></td>
                        </tr>
                        <?php 
                            require_once "api/config.php";
                            $contract_id = $_GET['contract_id'];

                            $sql_stalls = "SELECT s.floor_no AS 'floor_no', s.block_no AS 'block_no', s.block_dimension AS 'block_dimension', 
                            os.stall_id AS 'stall_id', s.stall_price AS 'stall_price' 
                            FROM occupied_stalls os
                            INNER JOIN stalls s ON os.stall_id = s.stall_id
                            WHERE contract_id = $contract_id";

                            $result_stalls = mysqli_query($link,$sql_stalls);
                            if (mysqli_num_rows($result_stalls) > 0) {
                                while($row_stalls = mysqli_fetch_assoc($result_stalls)) {
                                    echo "<tr align='center'>";
                                        echo "<td>" . $row_stalls['floor_no'] . "</td>";
                                        echo "<td>" . $row_stalls['block_no'] . "</td>";
                                         echo "<td>" . $row_stalls['block_dimension'] . "</td>";
                                        echo "<td>" . $row_stalls['stall_price'] . "</td>";
                                    echo "</tr>";
                                }
                             }
                        ?>
                    </table>
                </div>
                <div class="col-8">
                    <table class="table table-bordered table-striped table-sm">
                        <tr align="center">
                                <td><strong>Contract ID</strong></td>
                                <td><strong>Business Name</strong></td>
                                <td><strong>Category</strong></td>
                                <td><strong>Start Date</strong></td>
                                <td><strong>End Date</strong></td>
                                <td><strong>Term</strong></td>
                                <td><strong>Remark</strong></td>
                            </tr>
                            <?php
                                $client_id = "";				
                                $sql_contract = "SELECT c.contract_id AS 'contract_id', c.app_id AS 'app_id',
                                c.client_id AS 'client_id', c.category_id AS 'category_id', c.business_name AS 'business_name',
                                c.start_date AS 'start_date', c.end_date AS 'end_date', c.date_approved AS 'date_approved',
                                c.remark AS 'remark', bc.category_name AS 'category_name', c.contract_term AS 'contract_term'
                                FROM contract c
                                INNER JOIN business_classification bc ON c.category_id = bc.category_id 
                                WHERE contract_id = $contract_id";
                                $result_contract = mysqli_query($link,$sql_contract);
                                if (mysqli_num_rows($result_contract) > 0) {
                                    while($row_contract = mysqli_fetch_assoc($result_contract)) {
                                        echo "<tr align='center'>";
                                            $client_id = $row_contract['client_id'];
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
                                        echo "</tr>";
                                    }
                                }
                            ?>
                    </table>
                </div>
            </div>
        </div>
        <!-- Renewal Content -->
    </body>
    </html>