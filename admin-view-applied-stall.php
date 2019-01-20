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
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Applications</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Renewal Requests</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Rental Payments</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Navbar -->
</head>
<body>
    <div class="container">
        <br />
        <div class="row">
            <div class="col">
                <h1 class="float-left">List of Stalls Applied</h1>
            </div>
            <div class="col">
                <br/>
                <a href="admin-applied-stalls.php" class="btn btn-danger btn-sm float-right">Back</a>
            </div>
        </div>
        <br /> 
        <div class="row">
            <div class="col-md-6">
            <table class="table table-bordered table-sm">
                <tr class="bg-secondary">
                    <td colspan="2" align="center" style="color: white;"><strong>Application Information</strong></td>
                </tr>
                    <?php
                        require_once "api/config.php";
                        $app_id = $_GET['app_id'];
                        $status_for_button = "";

                        $sql_applied_stalls = "SELECT a.app_id AS 'app_id', a.client_id AS 'client_id',
                        bc.category_name AS 'category_name', a.business_name AS 'business_name', a.date_applied AS 'date_applied',
                        a.application_status AS 'application_status', a.applied_term AS 'applied_term',
                        c.fname AS 'fname', c.lname AS 'lname'
                        FROM applied_stall a
                        INNER JOIN business_classification bc ON a.category_id = bc.category_id
                        INNER JOIN client c ON a.client_id = c.client_id
                        WHERE app_id = $app_id
                        ";

                        // Declaring the variables to fetch data from the while loop
                        $fname = $lname = $business_name = $category_name = $applied_term = $date_applied = $application_status = "";

                        $result_applied_stalls = mysqli_query($link, $sql_applied_stalls);
                        if(mysqli_num_rows($result_applied_stalls) > 0){
                            while($row_applied_stalls = mysqli_fetch_assoc($result_applied_stalls)){
                                $fname = $row_applied_stalls['fname'];
                                $lname = $row_applied_stalls['lname'];
                                $business_name = $row_applied_stalls['business_name'];
                                $category_name = $row_applied_stalls['category_name'];
                                $applied_term = $row_applied_stalls['applied_term'];
                                $date_applied = $row_applied_stalls['date_applied'];
                                $application_status = $row_applied_stalls['application_status'];

                                echo "<tr>";
                                    echo "<td>Client:</td>";
                                    echo "<td style='font-style: italic'>" . $fname . " " . $lname . "</td>";
                                echo "</tr>";
                                echo "<tr>";
                                    echo "<td>Business Name:</td>";
                                    echo "<td style='font-style: italic'>" . $business_name . "</td>";
                                echo "</tr>";
                                echo "<tr>";
                                    echo "<td>Category:</td>";
                                    echo "<td style='font-style: italic'>" . $category_name . "</td>";
                                echo "</tr>";
                                echo "<tr>";
                                    echo "<td>Applied Term:</td>";
                                    echo "<td style='font-style: italic'>" . $applied_term . "</td>";
                                echo "</tr>";
                                echo "<tr>";
                                    echo "<td>Date Applied:</td>";
                                    echo "<td style='font-style: italic'>" . $date_applied . "</td>";
                                echo "</tr>";
                                echo "<tr>";
                                    echo "<td>Application Status:</td>";
                                    echo "<td style='font-style: italic'>" . $application_status . "</td>";
                                echo "</tr>";
                            }
                        }
                    ?>  
                </table>
            </div>
            <div class="col-md-6">            
                <form action="api/admin-verdict-applied-stall-details.php?app_id=<?php echo $_GET['app_id'];?>" method="POST">
                    <table class="table table-bordered table-striped table-sm"> 
                        <tr align="center" style="font-size: 14px;">
                            <td><strong>Stall ID</strong></td>
                            <td><strong>Floor No.</strong></td>
                            <td><strong>Block No.</strong></td>
                            <td><strong>Block Dimensions</strong></td>
                            <td><strong>Stall Price</strong></td>
                            <td><strong>Remark</strong></td>
                            <td><strong>Select</strong></td>
                        </tr>
                        <?php
                            $sql_applied_stall_details = "SELECT ad.app_id AS 'app_id', ad.stall_id AS 'stall_id', 
                            ad.stall_application_status AS 'stall_application_status', s.floor_no AS 'floor_no',
                            s.block_no AS 'block_no', s.block_dimension AS 'block_dimension', s.stall_price AS 'stall_price'
                            FROM applied_stall_details ad
                            INNER JOIN stalls s ON ad.stall_id = s.stall_id
                            WHERE ad.app_id = $app_id
                            ";

                            $result_applied_stall_details = (mysqli_query($link, $sql_applied_stall_details));
                            if(mysqli_num_rows($result_applied_stall_details) > 0){
                                $status_for_button = 1;
                                while($row_applied_stall_details = mysqli_fetch_assoc($result_applied_stall_details)){
                                    echo "<tr align='center'>";
                                        echo "<td><small>" . $row_applied_stall_details['stall_id'] . "</small></td>";
                                        echo "<td><small>" . $row_applied_stall_details['floor_no'] . "</small></td>";
                                        echo "<td><small>" . $row_applied_stall_details['block_no'] . "</small></td>";
                                        echo "<td><small>" . $row_applied_stall_details['block_dimension'] . "</small></td>";
                                        echo "<td><small>Php " . number_format($row_applied_stall_details['stall_price'],2) . "</small></td>";
                                        echo "<td><small>" . $row_applied_stall_details['stall_application_status'] . "</small></td>";
                                        echo "<td><input type='checkbox' name='stall_id[]' value=".$row_applied_stall_details['stall_id']."></td>"; 
                                    echo "</tr>";
                                }
                            }else{
                                echo "<tr>";
                                    echo "<td colspan='7' align='center'><em>No records found.</em></td>";
                                echo "</tr>";
                            }
                        ?>
                    </table>
                    <?php
                        if(($status_for_button) == 1){
                            echo "<input type='submit' name='approved' value='Approve' class='btn btn-primary btn-sm float-right' style='margin: 5px;'>";
                            echo "<input type='submit' name='disapproved' value='Disapprove' class='btn btn-danger btn-sm float-right' style='margin: 5px;'>";
                        }else{
                            echo "<input type='submit' name='approved' value='Approve' class='btn btn-primary btn-sm float-right' style='margin: 5px;' disabled>";
                            echo "<input type='submit' name='disapproved' value='Disapprove' class='btn btn-danger btn-sm float-right' style='margin: 5px;' disabled>";
                        }
                    ?>
                </form>
            </div>
        </div>
    </div>
</body>
</html>