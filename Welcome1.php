
<!DOCTYPE html>
<html>
<head>
<?php require('com/head.php'); 


?>
<?php require('com/topMenu.php');



//$stmt=$fetchdata->fetch_data("insert into HRD_USER_LOG(USERNAME,MODULE,ACTION,CREATE_DATE)values('".$_SESSION['LOGIN_ID']."','VISIT','DASHBOARD',SYSDATE)");
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
function fetchdata(){
	
	var unid=document.getElementById("uniqueid").value;
	//alert(unid);
	$.ajax({
		type:"POST",
		url:"query/fetchdata.php",
		data:'unid='+encodeURIComponent(unid),
		success:function(data){
		$("#fetchdatares").html(data);
		}
	});
}

		
		
		function GetDetail(value) {
    var mobileNo = '';
    var eisNo = '';

    // Determine if the input is a mobile number or an EIS number
    if (value.length === 10 && /^\d+$/.test(value)) {
        mobileNo = value;
    } else if (value.length === 8 && /^\d+$/.test(value)) {
        eisNo = value;
    } else {
        return; // Exit the function if the input is invalid
    }

    var xmlhttp;
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var a = JSON.parse(xmlhttp.responseText);
            document.getElementById("name").value = a.A;
            document.getElementById("address").value = a.B;
            document.getElementById("employee_name").value = a.C;
            document.getElementById("department_name").value = a.D;
            document.getElementById("purpose").value = a.E;

            if (a.gender == "Male") {
                document.getElementById("gender1").checked = true;
            } else if (a.gender == "Female") {
                document.getElementById("gender2").checked = true;
            } else if (a.gender == "Other") {
                document.getElementById("gender3").checked = true;
            }

            if (a.visitortype == "Employee of WCL") {
                document.getElementById("visitortype1").checked = true;
            } else if (a.visitortype == "Employee of CIL (Other than WCL)") {
                document.getElementById("visitortype2").checked = true;
            } else if (a.visitortype == "Non-Employee") {
                document.getElementById("visitortype3").checked = true;
            }

            document.getElementById("idnumber").value = a.F;
            document.getElementById("eisNumber").value = a.G;
            document.getElementById("idType").value = a.H;
			 document.getElementById("mobileno").value = a.I;
        }
    }

    var url = "query/fetchvisitor.php";
    if (mobileNo) {
        url += "?q=" + mobileNo;
    } else if (eisNo) {
        url += "?r=" + eisNo;
    }

    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}


</script>

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

</style>

<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

<div class="content-wrapper" style="min-height: 945.875px;">

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
	  
          <div class="box box-primary">
	  
            <div class="box-header with-border">
              <h3 class="box-title">VISITOR ENTRY</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form id="visitor_form"  role="form" action="query/visitorentry.php" method="post" enctype='multipart/form-data'>
              <table class="table table-bordered table-striped box-body">
                <tbody>
               
				<tr>
    <td>Visitor Type</td>
    <td>
        <div class="radio">
            <label>
                <input type="radio" name="visitortype" id="visitortype2" value="student" required>
                Student
            </label>
        </div>
        <div class="radio">
            <label>
                <input type="radio" name="visitortype" id="visitortype3" value="faculty" required>
                Faculty
            </label>
        </div>
    </td>
</tr>
	<tr>
    <td>Id</td>
    <td>
        <input type="numeric" class="form-control" name="eisNumber" id="eisNumber" required minlength='11' maxlength='11' onBlur="GetDetail(this.value)" value="">
    </td>
</tr>

<tr>
    <td>Batch Year</td>
    <td>
        <input type="numeric" class="form-control" name="address" id="address" disabled>
    </td>
</tr>

<script>
   
		
		
  // Get the radio buttons and EIS number input element
  var radioButtons = document.getElementsByName("visitortype");
  var address = document.getElementById("address");

  // Add event listeners to the radio buttons
  radioButtons.forEach(function(radioButton) {
    radioButton.addEventListener("change", function() {
      // Check the selected option
      if ( radioButton.value === "faculty") {
        // Disable the EIS number input for "Employee of CIL (Other than WCL)" and "Non-Employee"
        address.disabled = true;
		address.value = "";
      } else {
        // Enable the EIS number input for "Employee of WCL"
        address.disabled = false;
      }
    });
  });
</script>

			<tr>
                  <td>Name</td>
                  <td>
                     <input type="numeric" class="form-control" name="name" id="name" required>
					 
                  </td>                 
                </tr> 
				
				<tr>
                  <td>Department</td>
                  <td>

			<select class="form-control" name="idtype" id="idType" value="idtype" required>
							  <option value=''>-select-</OPTION>
            <option value='Computer Science'>Computer Science</option>
            <option value='Electronics and Communication'>Electronics and Communication</option>
            <option value='Information Technology'>Information Technology</option>
            <option value='Mechanical'>Mechanical </option>
            <option value='Architecture'>Architecture</option>
            <option value='BBA'>BBA</option>
			</select>                  </td>                 
                </tr>
				
				<tr>
                  <td>Subject</td>
                  <td>
                     <input type="numeric" class="form-control" name="employee_name" id="employee_name" required >
                  </td>                 
                </tr>

<tr>
                  <td colspan='2'>
                <button type="submit" class="btn btn-info pull-right">Submit</button>
							
                  </td>                 
                </tr> 
				



				
				
              </tbody></table>
            </form>
          </div>
        </div>
		

		
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6">
		
		<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">BALANCE SHEET</h3>
    </div>
    <table class="table table-bordered table-striped box-body">
        <tbody>
        <?php
        // Check-in count query
        $checkInQuery = "SELECT COUNT(*) AS entryCount FROM visitor_entry WHERE DATE(date_in) = CURDATE()";
        // Execute the query and fetch the result
        $checkInResult = $conn->query($checkInQuery);
        $checkInCount = $checkInResult->fetch_assoc()['entryCount'];

        // Check-out count query
        $checkOutQuery = "SELECT COUNT(*) AS peopleWithCheckOut FROM visitor_entry WHERE DATE(date_out) = CURDATE() AND date_out != '0000-00-00 00:00:00.000000'";
        // Execute the query and fetch the result
        $checkOutResult = $conn->query($checkOutQuery);
        $checkOutCount = $checkOutResult->fetch_assoc()['peopleWithCheckOut'];

        // Balance count calculation
        $balanceCount = $checkInCount - $checkOutCount;
        ?>
       <tr><td><strong>Check-in Count:</strong> </td>
    <td><?php echo $checkInCount; ?></td>
</tr>
<tr><td><strong>Check-out Count:</strong></td>
    <td> <?php echo $checkOutCount; ?></td>
</tr>
<tr><td><strong>Balance:</strong></td>
    <td> <?php echo $balanceCount; ?></td>
</tr>

        </tbody>
    </table>
    <!-- /.box-body -->
    <!-- /.box-footer -->
</div>
  
</div>

<div class="col-md-6">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">VISITOR OUT</h3>
            </div>
			
			 <form role="form" action="query/visitorout.php" method="post" enctype='multipart/form-data'>
            
			<!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Enter Visitor Id</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="uniqueid" id="uniqueid" placeholder="Enter visitor id number" required>
                  </div>
				  <div class="col-sm-2">
                    <input type="button" class="form-control" name="fetch" id="fetch" value='Fetch' onClick='fetchdata()' />
                  </div>
                </div>
				
              </div>
              <!-- /.box-body -->
              <div id='fetchdatares' class="box-footer">
                
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
		  
		  
		  
          <!-- /.box -->
          <!-- general form elements disabled -->

          <!-- /.box -->
        </div>
		<!----------------------------------------------------->
		<div class="col-md-6">
          <!-- Horizontal Form -->
          
		  <div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">RECENT</h3>    
    </div>
    <form class="form-horizontal">
        <div class="box-body">
            <table class="table table-bordered table-striped box-body">
                <tbody>
                    <?php
                    require_once('class/dbconnect.php');

                    $sql1 = "SELECT * FROM visitor_entry WHERE DATE(date_in) = DATE(SYSDATE()) ORDER BY date_in DESC LIMIT 5";
                    $result = $conn->query($sql1);
                    echo "<tr><td>Id</td><td>Name</td><td>In Time</td><td>Image</td><td>Out Time</td></tr>";
                    while ($row = $result->fetch_assoc()) {
                        $uniqueid = $row['uniqueid']; 
                        echo "<tr>
                            <td>" . $row['uniqueid'] . "</td>
                            <td>" . $row['name'] . "</td>
                            <td>" . $row['date_in'] . "</td>
                            <td><img src='" . $row['image'] . "' width='50' height='50'></td>
                            <td>" . $row['date_out'] . "</td>
							
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </form>
</div>


          <!-- /.box -->
          <!-- general form elements disabled -->

          <!-- /.box -->
        </div>
		<!------------------------------------------------------>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
<?php require('com/footer.php'); ?>
</div>
<?php require('com/lowScript.php'); ?>
</body>
</html>