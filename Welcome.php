<!DOCTYPE html>
<html>
<head>
<?php require('com/head.php'); ?>
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

function GetDetail(mobile){
//alert(mobile);	
		var mobile=document.getElementById('mobileno').value;
		if (window.XMLHttpRequest) {
		xmlhttp=new XMLHttpRequest();
		//alert(empcode);
		}
		else
		{
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		//alert('1');
		xmlhttp.onreadystatechange=function() {
			//alert('4');
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				//alert('5');
				//alert(JSON.parse(xmlhttp.responseText));
			var a = JSON.parse(xmlhttp.responseText);
				//alert(a);
			document.getElementById("name").value=a.A;
			document.getElementById("address").value=a.B;
			document.getElementById("employee_name").value=a.C;
			document.getElementById("department_name").value=a.D;
			document.getElementById("purpose").value=a.E;
			
			   if (a.gender == "Male") {
        document.getElementById("gender1").checked = true;
      } else if (a.gender =="Female") {
        document.getElementById("gender2").checked = true;
      } else  if(a.gender == "Other") {
        document.getElementById("gender3").checked = true;
      }
	  
	 if (a.visitortype == "Employee of WCL") {
        document.getElementById("visitortype1").checked = true;
      } else if (a.visitortype == "Employee of CIL (Other than WCL)") {
        document.getElementById("visitortype2").checked = true;
      } else  if(a.visitortype == "Non-Employee") {
        document.getElementById("visitortype3").checked = true;
      }
		
       document.getElementById("idnumber").value=a.F;
		 document.getElementById("eisNumber").value=a.G;
		 document.getElementById("idType").value=a.H;
			}
		}
		//alert('2');
		xmlhttp.open("GET","query/fetchvisitor.php?q="+mobile,true);
		xmlhttp.send();
		//alert('3');

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
<?php require('com/topMenu.php');
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
              <h3 class="box-title">VISITOR ENTRY</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form id="visitor_form"  role="form" action="query/visitorentry.php" method="post" enctype='multipart/form-data'>
              <table class="table table-bordered table-striped box-body">
                <tbody>
                <!--<tr>
                  <td>Mobile number</td>
                  <td>
                     <input type="numeric" class="form-control" name='mobileno' id="mobileno"  required  maxlength='10' minlength='10'>
                  <div class="col-sm-2">
                    <input type="button"  class="form-control" name="fetchmn" id="fetchmn" value='Check' onClick='fetchVisitorData()'   />
                  </div>
				  <div id='fetchdatares1' class="box-footer">
                
              </div>
			  
				  </td>                 
                </tr>-->
	 <div>
    <label for="mobileno">Mobile number:</label>
    <div class="input-group">
      <input type="number" class="form-control" name="mobileno" id="mobileno" required placeholder="Enter mobile number">
      <span class="input-group-btn">
        <button class="btn btn-primary" type="button" id="sendOtpButton" onclick="sendOTP()">Send OTP</button>
      </span>
    </div>

    <div id="otpField" style="display: none;">
      <label for="otp">Enter OTP:</label>
      <input type="text" class="form-control" name="otp" id="otp" required placeholder="Enter OTP">
      <span id="otpError" style="color: red; display: none;">Please check the OTP again.</span>
      <input type="hidden" id="savedOTP" name="savedOTP">
      <button class="btn btn-primary" type="button" id="verifyButton" onclick="verifyOTP()">Verify</button>
    </div>
  </div>

  <script>
    function toggleOtpField() {
      var otpField = document.getElementById("otpField");
      otpField.style.display = "block";
    }

    function verifyOTP() {
      var enteredOTP = document.getElementById("otp").value;
      var savedOTP = document.getElementById("savedOTP").value;

      if (enteredOTP === savedOTP) {
        document.getElementById("otpError").style.display = "none";
        alert("Correct"); // OTP is verified
      } else {
        document.getElementById("otpError").style.display = "inline";
      }
    }

    function saveOTPToDatabase(mobileNumber, otp) {
      // Save OTP to database logic
    }

    function GetDetail(str) {
      // Fetch data logic
    }

    function sendOTP() {
      var mobileNumber = document.getElementById("mobileno").value;
      var xhr = new XMLHttpRequest();
      var url = "send_otp.php";
      var params = "mobileno=" + mobileNumber;
      xhr.open("POST", url, true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
          var response = JSON.parse(xhr.responseText);
          if (response.success) {
            document.getElementById("savedOTP").value = response.otp;
            toggleOtpField();
          }
        }
      };
      xhr.send(params);
    }
  </script>

                <tr>
                  <td>Visitor Type</td>
                  <td>
<div class="radio">
      <label>
        <input type="radio" name="visitortype" id="visitortype1" value="Employee of WCL" required >
        Employee of WCL
      </label>
    </div>
    <div class="radio">
      <label>
        <input type="radio" name="visitortype" id="visitortype2" value=" Employee of CIL (Other than WCL)" required>
        Employee of CIL (Other than WCL)
      </label>
    </div>
    <div class="radio">
      <label>
        <input type="radio" name="visitortype" id="visitortype3" value="Non-Employee" required >
        Non-Employee
      </label>
    </div>                  </td>                 
                </tr>
				
				<tr>
                  <td>EIS Number</td>
                  <td>
                     <input type="numeric" class="form-control" name="eisNumber" id="eisNumber" required minlength='8' maxlength='8'>
                  </td>                 
                </tr>
<script>
  // Get the radio buttons and EIS number input element
  var radioButtons = document.getElementsByName("visitortype");
  var eisNumber = document.getElementById("eisNumber");

  // Add event listeners to the radio buttons
  radioButtons.forEach(function(radioButton) {
    radioButton.addEventListener("change", function() {
      // Check the selected option
      if ( radioButton.value === "Non-Employee") {
        // Disable the EIS number input for "Employee of CIL (Other than WCL)" and "Non-Employee"
        eisNumber.disabled = true;
		eisNumber.value = "";
      } else {
        // Enable the EIS number input for "Employee of WCL"
        eisNumber.disabled = false;
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
                  <td>Gender</td>
                  <td>
<div class="radio">
      <label>
        <input type="radio" name="gender" id="gender1" value="Male" required>
        Male
      </label>
    </div>
    <div class="radio">
      <label>
        <input type="radio" name="gender" id="gender2" value="Female" required>
        Female
      </label>
    </div>
    <div class="radio">
      <label>
        <input type="radio" name="gender" id="gender3" value="Other" required>
        Other
      </label>
    </div>                  </td>                 
                </tr>
				
				<tr>
                  <td>Identification Type</td>
                  <td>
			<select class="form-control" name="idtype" id="idType" required>
            <option value='Aadhar'>Aadhar</option>
            <option value='PAN'>PAN</option>
            <option value='Driving License'>Driving License</option>
            <option value='Voter Id'>Voter Id</option>
            <option value='Official Id'>Official Id card</option>
            <option value='Other'>Other</option>
			</select>                  </td>                 
                </tr>
				<tr>
                  <td>Identification Number</td>
                  <td>
                     <input type="text" class="form-control" name="idnumber"id="idnumber" required>
                  </td>                 
                </tr>
				<tr>
                  <td>Address</td>
                  <td>
                     <input type="numeric" class="form-control" name="address" id="address" required>
                  </td>                 
                </tr>
				
				<tr>
                  <td>Department</td>
                  
                     <td>
					 <select  class="form-control select2" name="department_name"id="department_name" required>
            <?php
			require_once('class/dbconnect.php');

                    $sql1 = "SELECT * FROM department_name order by 1";
                    $result = $conn->query($sql1);
                    while ($row = $result->fetch_assoc()) {
					echo"<option value='".$row['department_name']." (".$row['floor'].")' >".$row['department_name']." (".$row['floor'].")</option>";
					}
			?>
			
			
			
           
          </select>
                  </td> 
					 
                                 
                </tr>
				
<tr>
                  <td>Whom to visit</td>
                  <td>
                     <input type="numeric" class="form-control" name="employee_name" id="employee_name" required >
                  </td>                 
                </tr>
				
				<tr>
                  <td>Purpose of visit</td>
                  <td>
					 <select class="form-control" name="purpose" id="purpose"required>
            <option>Official </option>
            <option>Personal </option>
           
          </select>
                  </td>                 
                </tr>
<!--				<tr>
                  <td>Capture Image</td>
                  <td>
                     <input type="numeric" class="form-control" id="exampleInputEmail1" >
                 
</td>                 
                </tr>-->
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
       <tr>
    <td><strong>Check-in Count:</strong> <?php echo $checkInCount; ?></td>
</tr>
<tr>
    <td><strong>Check-out Count:</strong> <?php echo $checkOutCount; ?></td>
</tr>
<tr>
    <td><strong>Balance:</strong> <?php echo $balanceCount; ?></td>
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
        <h3 class="box-title">LATEST</h3>    
    </div>
    <form class="form-horizontal">
        <div class="box-body">
            <table class="table table-bordered table-striped box-body">
                <tbody>
                    <?php
                    require_once('class/dbconnect.php');

                    $sql1 = "SELECT * FROM visitor_entry WHERE DATE(date_in) = DATE(SYSDATE()) ORDER BY uniqueid DESC LIMIT 5";
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




