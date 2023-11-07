<!DOCTYPE html>
<html>
<head>
    <?php require('com/head.php'); 
	require_once('class/fetchip.php');?>
</head>
<style>
    .box .form-group {
        margin-bottom: 0px;
    }

    .box-body .row {
        margin-bottom: 0px;
    }

    .box-body .form-group {
        margin-bottom: 0px;
    }

    /* Add horizontal scrolling */
    .table-wrapper {
        overflow-x: auto;
    }
</style>

<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">
    <?php
        require('com/topMenu.php');
        require_once('class/dbconnect.php');

        // Fetch data from user_log table in descending order
        $sql = "SELECT username, module, action, create_date, userip FROM user_log ORDER BY create_date DESC";
        $result = $conn->query($sql);
    ?>
    <div class="content-wrapper" style="min-height: 945.875px;">

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- ADMIN section -->
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">USER LOG</h3>
                        </div>
                        <form method="POST" action="">
                            <div class="box-body table-wrapper">
							
							
							
							<form method="POST" action="">
    <div class="form-group">
        <label for="fromDate">From Date:</label>
        <input type="date" id="fromDate" name="fromDate" required>
    </div>
    <br>
    <div class="form-group">
        <label for="toDate">To Date:</label>
        <input type="date" id="toDate" name="toDate" required>
    </div>
    <br>
    <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username">
    </div>
    <br>
    <div class="btn-group">
        <button type="submit" class="btn btn-primary">User Log</button>
    </div>
</form>

<?php
    require_once('class/dbconnect.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $fromDate = $_POST['fromDate'];
        $toDate = $_POST['toDate'];
        $username = isset($_POST['username']) ? $_POST['username'] : '';

        $sql1 = "SELECT * FROM login WHERE ROLE = 'ADMIN'";
        $result1 = $conn->query($sql1);

        $loggedInUsername = $_SESSION['LOGIN_ID'];
        $loggedInUserRole = '';

        while ($row = $result1->fetch_assoc()) {
            if ($row['username'] == $loggedInUsername) {
                $loggedInUserRole = $row['ROLE'];
                break;
            }
        }

        $sql = "SELECT * FROM user_log WHERE DATE(create_date) BETWEEN '$fromDate' AND '$toDate'";
        
        if ($loggedInUserRole != 'ADMIN') {
            $sql .= " AND username = '$loggedInUsername'";
        }
        
        if (!empty($username)) {
            $sql .= " AND username LIKE '%$username%'";
        }

        $sql .= " ORDER BY create_date DESC";

        // Retrieve the user log entries based on the applied filters
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<div class='box-body'>
                    <div id='example2_wrapper' class='dataTables_wrapper form-inline dt-bootstrap'>
                        <div class='row'>
                            <div class='col-sm-12'>
                                <table id='example2' class='table table-bordered table-hover dataTable' role='grid' aria-describedby='example2_info'>
                                    <thead>
                                        <tr role='row'>
                                            <th class='sorting_asc' tabindex='0' aria-controls='example2' rowspan='1' colspan='1' aria-sort='ascending' aria-label='Username: activate to sort column descending'>Username</th>
                                            <th class='sorting' tabindex='0' aria-controls='example2' rowspan='1' colspan='1' aria-label='Module: activate to sort column ascending'>Module</th>
                                            <th class='sorting' tabindex='0' aria-controls='example2' rowspan='1' colspan='1' aria-label='Action: activate to sort column ascending'>Action</th>
                                            <th class='sorting' tabindex='0' aria-controls='example2' rowspan='1' colspan='1' aria-label='Date: activate to sort column ascending'>Date</th>
                                            <th class='sorting' tabindex='0' aria-controls='example2' rowspan='1' colspan='1' aria-label='User IP: activate to sort column ascending'>User IP</th>
                                        </tr>
                                    </thead>
                                    <tbody>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row['username'] . "</td>
                        <td>" . $row['module'] . "</td>
                        <td>" . $row['action'] . "</td>
                        <td>" . $row['create_date'] . "</td>
                        <td>" . $row['userip'] . "</td>
                    </tr>";
            }

            echo "</tbody>
                </table>
            </div>
            </div>
            </div>";
        } else {
            echo "No entries found for the selected dates and username.";
        }
		
		$sql = "INSERT INTO USER_LOG (USERNAME, MODULE, ACTION, CREATE_DATE, USERIP)
                        VALUES ('".$_SESSION['LOGIN_ID']."', 'USER LOG ', '$username ', NOW(), '$ipaddress')";

                if ($conn->query($sql) === TRUE) {
                    echo "";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }

        $conn->close();
    }
?>

                            </div>
                        </form>
                    </div>
                </div>

                
            </div>
        </section>
        <!-- /.content -->
    </div>
    <?php require('com/footer.php'); ?>
</div>
<?php require('com/lowScript.php'); ?>


</body>
</html>
