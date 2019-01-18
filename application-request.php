<?php include_once "api/config.php"; ?>
<html> 
<head>
    <meta charset="UTF-8">
    <title>Application Request</title>
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
                <!-- <ul class="navbar-nav">
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
                </ul> -->
            </div>
        </div>
    </nav>
    <!-- Navbar -->
</head>
<body>
    <div class="container">
        <!-- Form Content -->
        <form action="api/create-application-request.php" method="POST">
            <div>
                <div class="">
                    <br />
                    <h4>Client Application</h4>
                    <label>First Name</label>
                    <input type="text" name="fname" class="form-control col-md-4" required>
                    <label>Last Name</label>
                    <input type="text" name="lname" class="form-control col-md-4" required>
                    <label>Email Address</label>
                    <input type="text" name="email" class="form-control col-md-4" required>
                    <label>Contact Number</label>
                    <input type="text" name="contact" class="form-control col-md-4" required>
                    <label>Address</label>
                    <input type="text" name="address" class="form-control col-md-4" required>

                    <br />
                    <h4>Stall Application</h4>
                    <label>Business Name</label>
                    <input type="text" name="business_name" class="form-control  col-md-4" required>
                    <label>Business Category</label>
                    <select type="text" name="category_id" class="form-control  col-md-4" required>
                        <optgroup label="Category">
                        <option></option>
                        <?php 
                            
                            $sql_category = "SELECT * FROM business_classification";
                            $result_category = mysqli_query($link, $sql_category);
                            if (mysqli_num_rows($result_category) > 0) {
                                while($row_category = mysqli_fetch_assoc($result_category)) {
                                    $category_id = $row_category['category_id'];
                                    echo "<option value='$category_id'>" . $row_category['category_name'] . "</option>";
                                }
                            }
                        ?>
                        </optgroup>
                    </select>
                    <label>Term</label>
                    <select type="text" name="applied_term" class="form-control col-md-4" required>
                        <optgroup label="Terms">
                            <option></option>
                            <option>1 year</option>
                            <option>2 years</option>
                            <option>3 years</option>
                            <option>4 years</option>
                        </optgroup>
                    </select>
                </div>

                <br />
                <h4>Available Stall Spaces</h4>
                <table class="table table-striped table-bordered table-sm">
                    <tr align="center">
                        <th>Floor Number</th>
                        <th>Block Number</th>
                        <th>Block Dimension (Meter)</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    $sql_stalls = "SELECT s.floor_no AS 'floor_no', s.block_no AS 'block_no',
                    s.block_dimension AS 'block_dimension', s.stall_price AS 'stall_price',
                    s.stall_id AS 'stall_id'
                    FROM occupied_stalls os 
                    INNER JOIN stalls s ON os.stall_id = s.stall_id
                    WHERE contract_id IS NULL";
                    $result_stalls = mysqli_query($link, $sql_stalls);
                    if (mysqli_num_rows($result_stalls) > 0) {
                        while($row_stalls = mysqli_fetch_assoc($result_stalls)) {
                            echo "<tr align='center'>";
                                echo "<td>" . $row_stalls['floor_no'] . "</td>";
                                echo "<td>" . $row_stalls['block_no'] . "</td>";
                                echo "<td>" . $row_stalls['block_dimension'] . "</td>";
                                echo "<td>Php " . number_format($row_stalls['stall_price'],2) . "</td>";
                                echo "<td><input type='checkbox' name='stall_id[]' value=".$row_stalls['stall_id']."></td>";                        
                            echo "</tr>";
                        }
                    }
                    ?>
                </table>
                <input type="submit" value="Submit" class="btn btn-danger btn-sm float-right"><br />
            </div>
        </form>
        <!-- Form Conent -->
    </div>
    


    <!-- Bootstrap JavaScript -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script> -->
    <script src="bootstrap-4.2.1-dist/js/bootstrap.min.js"></script>
    <!-- Bootstrap JavaScript -->
</body>
</html>