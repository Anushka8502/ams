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
    ?>
    <div class="content-wrapper" style="min-height: 945.875px;">

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- ADMIN section -->
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">ADMIN</h3>
                        </div>
                            <div class="box-body">
                                <table class="table table-bordered table-striped box-body">
                                    <tbody>
<?php
require_once('class/dbconnect.php');

$error = ""; // Initialize the error variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form is submitted
    if (isset($_POST['username1'])) {
        $username = $_POST['username1'];
        $reason = trim($_POST['reason']); // Trim leading/trailing spaces
        
        // Validate if the reason is not blank or only contains spaces
        if (!empty($reason)) {
            // Fetch the current active_flag value from the database
            $sql = "SELECT active_flag FROM login WHERE username = '$username'";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $currentStatus = $row['active_flag'];
                
                echo "<script>
                    function confirmStatusChange() {
                        var confirmStatusChange = confirm('Do you really want to change the status?');
                        
                        if (confirmStatusChange) {
                            var form = document.getElementById('statusChangeForm');
                            form.action = '';  // Specify the appropriate action URL or server-side script
                            form.submit();
                        } else {
                            event.preventDefault();
                        }
                    }
                </script>";

                // Update the active_flag based on the current value
                $newStatus = ($currentStatus == 'ACTIVE') ? 'DEACTIVE' : 'ACTIVE';

                // Update the active_flag, reason, and modify_date in the database
                $updateSql = "UPDATE login SET active_flag = '$newStatus', reason = '$reason', modify_date = NOW() WHERE username = '$username'";
                $conn->query($updateSql);

                $sql = "INSERT INTO USER_LOG (USERNAME, MODULE, ACTION, CREATE_DATE, USERIP)
                        VALUES ('".$_SESSION['LOGIN_ID']."', 'STATUS CHANGE', '$username $newStatus $reason', NOW(), '$ipaddress')";

                if ($conn->query($sql) === TRUE) {
                    echo "";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        } else {
            echo "<p style='color: red; text-align: center;'>Reason cannot be blank or contain only spaces.</p>";
            //$error = "Reason cannot be blank or contain only spaces.";
        }
    }
}

$sql = "SELECT username, active_flag, modify_date FROM login ORDER BY (active_flag = 'ACTIVE') DESC";
$result = $conn->query($sql);

echo "<tr>
          <td>Username</td>
          <td>Status</td>
          <td>Reason</td>
          <td>Action</td>
          <td>Latest</td>
      </tr>";

while ($row = $result->fetch_assoc()) {
    $username = $row['username'];
    $status = $row['active_flag'];
    $latestDate = $row['modify_date'];

    echo "<tr>
              <td>$username</td>
              <td>$status</td>
              <td>
                  <form id='statusChangeForm' method='post' action=''>
                      <input type='hidden' name='username1' value='$username'>
                      <input type='text' name='reason' placeholder='Enter reason' required pattern='[a-zA-Z0-9]{2,}'>
                      <span style='color: red;'><?php echo $error; ?></span>
                      <td><button type='submit' onclick='confirmStatusChange()'>Change Status</button></td>
                      <td>$latestDate</td>
                  </form>
              </td>
          </tr>";
}
?>





                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>

                <!-- ADD NEW USER section -->
                <div class="col-md-6">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">ADD NEW USER</h3>
                        </div>
                        <form role="form" action="" method="post" enctype='multipart/form-data'>
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" name="username" id="username" placeholder="Enter username" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" required>
                                </div>
                                <div class="form-group">
                                    <label for="confirm_password">Confirm Password</label>
                                    <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm password" required oninput="checkPasswordMatch()">
                                    <div id="confirm_password_error" style="color: red;"></div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary pull-right" name="save_user">Save</button>
                            </div>
                        </form>
<?php
if (isset($_POST['save_user'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if the username already exists
    $checkSql = "SELECT COUNT(*) as count FROM login WHERE username = '$username'";
    $checkResult = mysqli_query($conn, $checkSql);
    $row = mysqli_fetch_assoc($checkResult);
    $usernameCount = $row['count'];

    if ($usernameCount > 0) {
        echo "<p style='color: red;'>Username already exists. Please choose a different username.</p>";
    } elseif ($password !== $confirm_password) {
        echo "<p style='color: red;'>Password does not match.</p>";
    } else {
        // Insert the values into the database
        $insertSql = "INSERT INTO login (username, password, active_flag, ROLE) VALUES ('$username', '$password', 'ACTIVE', 'USER')";
        $insertResult = mysqli_query($conn, $insertSql);

        if ($insertResult) {
            $sql = "INSERT INTO USER_LOG (USERNAME, MODULE, ACTION, CREATE_DATE, USERIP)
                        VALUES ('".$_SESSION['LOGIN_ID']."', 'ADD NEW USER', 'ADDED $username', NOW(), '$ipaddress')";

            if ($conn->query($sql) === TRUE) {
                echo "";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            echo "<p>User inserted successfully!</p>";
        } else {
            $sql = "INSERT INTO USER_LOG (USERNAME, MODULE, ACTION, CREATE_DATE, USERIP)
                        VALUES ('".$_SESSION['LOGIN_ID']."', 'ADD NEW USER ', 'FAILED $username ', NOW(), '$ipaddress')";

            if ($conn->query($sql) === TRUE) {
                echo "";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            echo "<p>Failed to insert user.</p>";
        }
    }
}
?>


                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <?php require('com/footer.php'); ?>
</div>
<?php require('com/lowScript.php'); ?>

<script>
function checkPasswordMatch() {
    var password = document.getElementById("password").value;
    var confirm_password = document.getElementById("confirm_password").value;
    var confirm_password_error = document.getElementById("confirm_password_error");

    if (password !== confirm_password) {
        confirm_password_error.textContent = "Password does not match.";
    } else {
        confirm_password_error.textContent = "";
    }
}
</script>

</body>
</html>

