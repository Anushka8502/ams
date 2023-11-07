<!DOCTYPE html>
<html>
<head>
  <?php include'com/head.php'; 
  require_once('class/dbconnect.php');
  require_once('class/fetchip.php');
  $sql = "INSERT INTO USER_LOG (USERNAME, MODULE,ACTION, CREATE_DATE, USERIP)
	VALUES ('USER', 'LOGIN PAGE','VISIT', NOW(), '$ipaddress')";
	if ($conn->query($sql) === TRUE) {
  echo "";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
  ?>
  <script type="text/javascript">
  function validate(){
    if(Number(document.getElementById('first').value)+Number(document.getElementById('second').value)==Number(document.getElementById('sum').value)){
          return true;
    }else{
          document.getElementById('error').innerHTML="*** Invalid Captcha ***";
          return false;
    }
  }
  </script>
  <style>
body{
    background-image: url("image/background.png");
    background-color: #cccccc;
  height: 100%; /* You must set a specified height */
  width: 100%;
  background-position: center; /* Center the image */
  background-repeat: no-repeat; /* Do not repeat the image */
  background-size: cover;
  -webkit-transition:none;-o-transition:none;transition:none;
  overflow-y: hidden;
}

#logo {
  width: 150px;
  height: 150px;
}
</style>
</head>

<body class="hold-transition">
<div class="login-box">
  <div class="login-logo">
  <img src="com/logo.png" class="img-circle" alt="User Image" id="logo">
<br><b style="color: #CF0A2C;">Attendance Management System</br>  </div>
  <div class="login-box-body">
    <p class="login-box-msg"><b>Login</b></p>
    <form onsubmit="return validate(this);" action="query/validatelogin.php" method="post" enctype='multipart/form-data' >
      <div class="form-group has-feedback">
        <input type="text" name='attuser' class="form-control" placeholder="Username" required />
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name='attpwd'  class="form-control" placeholder="Password" required />
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <?php
				$first=rand(1,99);
				$second=rand(1,9);
				?>
         <div class="form-group col-sm-3">
							<b>Captcha</b>
					</div>
					<div class="form-group col-sm-1">
							<b><?php echo $first; ?></b><input type="hidden" name="first" id="first" value='<?php echo $first; ?>' class="form-control" />
					</div>
					<div class="form-group col-sm-1">
							<b>+</b>
					</div>
					<div class="form-group col-sm-1">
							<b><?php echo $second; ?></b><input type="hidden" name="second" id="second" value='<?php echo $second; ?>' class="form-control" />
					</div>
					<div class="form-group col-sm-1">
							<b>=</b>
					</div>
					<div class="form-group col-sm-3">
							  <input type="text" name='sum' id='sum' class="form-control" />
					</div>
          <div class="row col-xs-12 text-red" id='error'></div>
      <div class="row">
        <div class="col-xs-8"><a href="#"></a>
        </div>
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
        </div>
      </div>
    </form>
  </div>
</div>
</body>
</html>