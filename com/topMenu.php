<?php
session_start();
if (!isset($_SESSION['LOGIN_ID'])) {
    header('Location: index.php');
} else {
    require_once('class/dbconnect.php'); // Assuming this file establishes the database connection

    $isAdmin = false; // Initialize the variable

    // Fetch the user's role from the login table
    $stmt = $conn->prepare("SELECT role FROM login WHERE username = ?");
    if (!$stmt) {
        die('Error in preparing the query: ' . $conn->error);
    }

    $stmt->bind_param("s", $_SESSION['LOGIN_ID']);
    if (!$stmt->execute()) {
        die('Error in executing the query: ' . $stmt->error);
    }

    $stmt->bind_result($role);
    if (!$stmt->fetch()) {
        die('Error in fetching the result: ' . $stmt->error);
    }

    $stmt->close();

    if ($role === 'ADMIN') {
        $isAdmin = true; // Set $isAdmin to true if the role is "ADMIN"
    }
?>
<header class="main-header">
  <nav class="navbar navbar-static-top">
    <div class="container">
      <div class="navbar-header">
        <b class="navbar-brand">AMS</b>
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
          <i class="fa fa-bars"></i>
        </button>
      </div>
      <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
        <ul class="nav navbar-nav">
          <li class="active"><a href="Welcome1.php">Security Check Point <span class="sr-only">(current)</span></a></li>
          <li class='dropdown'>
            <a href='#' class='dropdown-toggle' data-toggle='dropdown'>Reports <span class='caret'></span></a>
            <ul class='dropdown-menu' role='menu'>
              <li><a href='individual1.php'>Individual</a></li>
              <li><a href='report.php'>Date-wise</a></li>
            </ul>
          </li>
          <?php if ($isAdmin): ?>
            <li class=""><a href="admin.php">Admin <span class="sr-only"></span></a></li>
          <?php endif; ?>
          <!--<li class=""><a href="userlog.php">Log <span class="sr-only"></span></a></li>-->
        </ul>
      </div>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              Log Out <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <img src="com/logo.png" class="img-circle" alt="User Image">
                <p>
                 Attendance Management System
                  
				  <small><?php echo $_SESSION['LOGIN_ID']  ;  ?></small>
                
                  <small><?php echo $_SESSION['ROLE']  ;  ?></small>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="change_pass.php" class="btn btn-default btn-flat">Change Password</a>
                </div>
                <div class="pull-right">
                  <a href="com/logout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>

<?php } ?>
