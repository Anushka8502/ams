<!DOCTYPE html>
<html>
<head>
<?php require('com/head.php'); ?>

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
<?php require('com/topMenu.php');
require_once('class/fetchip.php');
//$stmt=$fetchdata->fetch_data("insert into HRD_USER_LOG(USERNAME,MODULE,ACTION,CREATE_DATE)values('".$_SESSION['LOGIN_ID']."','VISIT','DASHBOARD',SYSDATE)");
?>
<div class="content-wrapper" style="min-height: 945.875px;">

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
	  
          <div class="box box-primary">
	  
            <div class="box-header with-border">
              <h3 class="box-title">REPORT</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="POST" action="">
			<div class="box-body">
                
				
				<div class="form-group">
        <label for="fromDate" >From Date:</label>
        <input type="date" id="fromDate" name="fromDate" required >
    </div>
    <div class="form-group">
        <label for="toDate" >To Date:</label>
        <input type="date" id="toDate" name="toDate" required >
    </div>
 <div class="form-group">
        <label for="employeeName">Employee Name:</label>
        <input type="text" id="employeeName" name="employeeName">
    </div>
     <div class="form-group">
        <label for="departmentName">Department:</label>
        <select class="form-control select2" id="departmentName" name="departmentName">
            <option value="">- Select -</option>
            <?php
            require_once('class/dbconnect.php');

                    $sql1 = "SELECT * FROM department_name order by 1";
                    $result = $conn->query($sql1);
                    while ($row = $result->fetch_assoc()) {
					echo"<option value='".$row['department_name']." (".$row['floor'].")' >".$row['department_name']." (".$row['floor'].")</option>";
					}
            ?>
        </select>
				
				
				<div class="btn-group ">
    <button type="submit" class="btn btn-primary pull-right">Search</button>
</div>

				
               
				</div>
            </form>
          </div>
        </div>
		
		  
</div>
        <?php
        require_once('class/dbconnect.php');
		

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fromDate = $_POST['fromDate'];
            $toDate = $_POST['toDate'];
			$employeeName = $_POST['employeeName'];
			 $departmentName = isset($_POST['departmentName']) ? $_POST['departmentName'] : '';
			
			$sql = "INSERT INTO USER_LOG (USERNAME, MODULE,ACTION, CREATE_DATE, USERIP)
		VALUES ('".$_SESSION['LOGIN_ID']."', 'DATE WISE REPORT','$fromDate to $toDate', NOW(), '$ipaddress')";	
		if ($conn->query($sql) === TRUE) {
			echo "";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
			

            // Retrieve the visitor entries between the selected dates
            //$sql = "SELECT * FROM visitor_entry WHERE DATE(date_in) BETWEEN '$fromDate' AND '$toDate' ORDER BY uniqueid DESC";
			 // Construct the SQL query with the date and employee name filters
                        $sql = "SELECT * FROM visitor_entry WHERE DATE(date_in) BETWEEN '$fromDate' AND '$toDate'";

    // Add the employee name filter if it is provided
    if (!empty($employeeName)) {
        $sql .= " AND employee_name LIKE '%$employeeName%'";
    }

    // Add the department name filter if it is provided
    if (!empty($departmentName)) {
        $sql .= " AND department_name = '$departmentName'";
    }

    $sql .= " ORDER BY uniqueid DESC";
    
    // Execute the modified SQL query to retrieve visitor entries
    $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<div class='box-body'>
                        <div id='example2_wrapper' class='dataTables_wrapper form-inline dt-bootstrap'>
                            <div class='row'>
                                <div class='col-sm-12'>
                                    <table id='example2' class='table table-bordered table-hover dataTable' role='grid' aria-describedby='example2_info'>
                                        <thead>
										<tr><td>
										<a href='excel.php?fromDate=$fromDate&toDate=$toDate'><img src='image/excel.png' width='40' height='40'></a>
                                        

										
										</td></tr>
                                            <tr role='row'>
                                                <th class='sorting_asc' tabindex='0' aria-controls='example2' rowspan='1' colspan='1' aria-sort='ascending' aria-label='Id: activate to sort column descending'>Id</th>
                                                <th class='sorting' tabindex='0' aria-controls='example2' rowspan='1' colspan='1' aria-label='Name: activate to sort column ascending'>Name</th>
                                                <th class='sorting' tabindex='0' aria-controls='example2' rowspan='1' colspan='1' aria-label='Mobile Number: activate to sort column ascending'>Mobile Number</th>
												<th class='sorting' tabindex='0' aria-controls='example2' rowspan='1' colspan='1' aria-label='Email: activate to sort column ascending'>Email</th>
                                                <th class='sorting' tabindex='0' aria-controls='example2' rowspan='1' colspan='1' aria-label='Visitor Type: activate to sort column ascending'>Visitor Type</th>
                                                <th class='sorting' tabindex='0' aria-controls='example2' rowspan='1' colspan='1' aria-label='EIS Number: activate to sort column ascending'>EIS Number</th>
                                                <th class='sorting' tabindex='0' aria-controls='example2' rowspan='1' colspan='1' aria-label='Identification Type: activate to sort column ascending'>Identification Type</th>
                                                <th class='sorting' tabindex='0' aria-controls='example2' rowspan='1' colspan='1' aria-label='Identification Number: activate to sort column ascending'>Identification Number</th>
                                                <th class='sorting' tabindex='0' aria-controls='example2' rowspan='1' colspan='1' aria-label='Address: activate to sort column ascending'>Address</th>
                                                <th class='sorting' tabindex='0' aria-controls='example2' rowspan='1' colspan='1' aria-label='Employee Name: activate to sort column ascending'>Employee Name</th>
                                                <th class='sorting' tabindex='0' aria-controls='example2' rowspan='1' colspan='1' aria-label='Department: activate to sort column ascending'>Department</th>
                                                <th class='sorting' tabindex='0' aria-controls='example2' rowspan='1' colspan='1' aria-label='Purpose: activate to sort column ascending'>Purpose</th>
                                                <th class='sorting' tabindex='0' aria-controls='example2' rowspan='1' colspan='1' aria-label='Image: activate to sort column ascending'>Image</th>
                                                <th class='sorting' tabindex='0' aria-controls='example2' rowspan='1' colspan='1' aria-label='In Time: activate to sort column ascending'>In Time</th>
                                                <th class='sorting' tabindex='0' aria-controls='example2' rowspan='1' colspan='1' aria-label='Out Time: activate to sort column ascending'>Out Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row['uniqueid'] . "</td>
                            <td>" . $row['name'] . "</td>
                            <td>" . $row['mobile_no'] . "</td>
							<td>" . $row['email'] . "</td>
                            <td>" . $row['visitor_type'] . "</td>
                            <td>" . $row['eis_no'] . "</td>
                            <td>" . $row['identification_type'] . "</td>
                            <td>" . $row['identification_no'] . "</td>
                            <td>" . $row['address'] . "</td>
                            <td>" . $row['employee_name'] . "</td>
                            <td>" . $row['department_name'] . "</td>
                            <td>" . $row['purpose'] . "</td>
                            <td><img src='" . $row['image'] . "' width='100' height='100'></td>
                            <td>" . $row['date_in'] . "</td>
                            <td>" . $row['date_out'] . "</td>
                        </tr>";
                }

                echo "</tbody>
                    </table>
                </div>
                </div>
                </div>";
            } else {
                echo "No entries found for the selected dates.";
            }

            $conn->close();
        }
		
		
       ?>
      <!-- /.row -->
    </section>
    <!-- /.content -->
	
  </div>
<?php require('com/footer.php'); ?>
</div>
<?php require('com/lowScript.php'); ?>
</body>
</html>