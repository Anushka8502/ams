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

  select#departmentName {
    width: 400px; /* Set the desired width */
  }
</style>

<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">
  <?php require('com/topMenu.php');
  require_once('class/fetchip.php');
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
			<form role="form"  method="post" enctype="multipart/form-data">
			 <table class="table table-bordered table-striped box-body">
                <tbody>
               
			
            <form method="POST" action="">
              <div class="box-body">
			  <tr>
			  <td>From Date</td>
			  <td>
                <div class="form-group">
                  <label for="fromDate"></label>
                  <input type="date" id="fromDate" name="fromDate" required>
                </div></td></tr>
				<tr>
				<td>To Date</td>
				<td>
                <div class="form-group">
                  <label for="toDate"></label>
                  <input type="date" id="toDate" name="toDate" required>
                </div></td></tr>
				
				
				
				

				<tr><td></td><td>
                <div class="box-footer">
                  <button type="submit" class="btn btn-primary pull-right">Search</button>
				  </div></td></tr>
              </div>
            </form>
        
	  </tbody>
	  </table>
	  </form>
	  </div>
	    
        </div>
      </div>
<?php
require_once('class/dbconnect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $fromDate = date('Y-m-d 00:00:00', strtotime($_POST['fromDate']));
  $toDate = date('Y-m-d 23:59:59', strtotime($_POST['toDate']));
 

  // Handle Search button action
  $sql = "SELECT * FROM visitor_entry WHERE date_in BETWEEN '$fromDate' AND '$toDate'";

  

  $sql .= " ORDER BY date_in DESC";
  

  // Execute the modified SQL query to retrieve visitor entries
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    echo "<div class='box-body'>
            <div id='example2_wrapper' class='dataTables_wrapper form-inline dt-bootstrap'>
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='table-wrapper'>
                    <table id='example2' class='table table-bordered table-hover dataTable' role='grid' aria-describedby='example2_info'>
                      <thead>
                        <tr>
                          <td>
                            <a href='excel.php?fromDate=$fromDate&toDate=$toDate'>
                              <img src='image/excel.png' width='40' height='40'>
                            </a>
</td></tr>
                                                <tr role='row'>
                                                    <th class='sorting_asc' tabindex='0' aria-controls='example2' rowspan='1' colspan='1' aria-sort='ascending' aria-label='Id: activate to sort column descending'>Id</th>
                                                    <th class='sorting' tabindex='0' aria-controls='example2' rowspan='1' colspan='1' aria-label='Name: activate to sort column ascending'>Name</th>
                                                    
                                                    <th class='sorting' tabindex='0' aria-controls='example2' rowspan='1' colspan='1' aria-label='Visitor Type: activate to sort column ascending'>Visitor Type</th>
                                                    
                                                    
                                                    <th class='sorting' tabindex='0' aria-controls='example2' rowspan='1' colspan='1' aria-label='Address: activate to sort column ascending'>Batch no.</th>
                                                    <th class='sorting' tabindex='0' aria-controls='example2' rowspan='1' colspan='1' aria-label='Employee Name: activate to sort column ascending'>Subject</th>
                                                    <th class='sorting' tabindex='0' aria-controls='example2' rowspan='1' colspan='1' aria-label='Department: activate to sort column ascending'>Department</th>
                                                    
                                                    <th class='sorting' tabindex='0' aria-controls='example2' rowspan='1' colspan='1' aria-label='Image: activate to sort column ascending'>Image</th>
                                                    <th class='sorting' tabindex='0' aria-controls='example2' rowspan='1' colspan='1' aria-label='In Time: activate to sort column ascending'>In Time</th>
                                                    <th class='sorting' tabindex='0' aria-controls='example2' rowspan='1' colspan='1' aria-label='Out Time: activate to sort column ascending'>Out Time</th>
                                                </tr>
                                            </thead>
                                            <tbody>";

                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row['eis_no'] . "</td>
                                <td>" . $row['name'] . "</td>
                               
                                <td>" . $row['visitor_type'] . "</td>
                               
                                
                                <td>" . $row['address'] . "</td>
                                <td>" . $row['employee_name'] . "</td>
                                <td>" . $row['identification_type'] . "</td>
                               
                                <td><img src='" . $row['image'] . "' width='100' height='100'></td>
                                <td>" . $row['date_in'] . "</td>
                                <td>" . $row['date_out'] . "</td>
                            </tr>";
    }

    echo "</tbody>
          </table>
        </div>
      </div>
    </div>
  </div>";
  } else {
    echo "No entries found for the selected dates.";
  }

  $conn->close();
}
?>




    </section>
    <!-- /.content -->
  </div>
  <?php require('com/footer.php'); ?>
</div>
<?php require('com/lowScript.php'); ?>
</body>
</html>

