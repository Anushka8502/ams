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
                            <h3 class="box-title">CHANGE PASSWORD</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form method="POST" action="">
                            <div class="box-body">
                                <div class="form-group has-feedback">
                                    <label>Enter Existing Password</label>
                                    <input type="password" name="pwd" class="form-control" placeholder="Password"  />
                                </div>
                                <br>
                                <div class="btn-group pull-right">
                                    <button type="submit" class="btn btn-primary pull-right">Verify</button>
                                </div>
                            </div>
                            <?php
                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                $username = $_SESSION['LOGIN_ID'];
                                $password = $_POST['pwd'];

                                // Get the password from the database for the given username
                                $sql = "SELECT password FROM login WHERE username='$username'";
                                $result = mysqli_query($conn, $sql);

                                if (!$result) {
                                    die("Error: " . mysqli_error($conn));
                                }

                                $row = mysqli_fetch_assoc($result);
                                $stored_password = $row['password'];

                                // Verify the password.
                                if ($password === $stored_password) {
                                    // The password is correct.
									
                                    echo "Password verified successfully!";
                                    echo '<div class="box-body">
                                            <div class="form-group has-feedback">
                                                <label>Enter New Password</label>
                                                <input type="password" name="new_password" id="new_password" class="form-control" placeholder="New Password" required />
                                            </div>
                                            <div class="form-group has-feedback">
                                                <label>Confirm Password</label>
                                                <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password" required />
                                            </div>
                                            <div id="confirm_password_error" style="color: red;"></div>
                                            <button type="submit" class="btn btn-primary pull-right" name="save_password">Save New Password</button>
                                        </div>';
                                } else {
                                    // The password is incorrect.
                                    echo "Incorrect password.";
                                }
                            }
							
							$sql = "INSERT INTO USER_LOG (USERNAME, MODULE, ACTION, CREATE_DATE, USERIP)
                        VALUES ('".$_SESSION['LOGIN_ID']."', 'CHANGE PASSWORD ', '$username', NOW(), '$ipaddress')";

                if ($conn->query($sql) === TRUE) {
                    echo "";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
                            ?>
                        </form>
                        <?php
                        if (isset($_POST['save_password'])) {
                            $newPassword = $_POST['new_password'];
                            $confirmPassword = $_POST['confirm_password'];

                            if ($newPassword === $confirmPassword) {
                                // Update the password in the database
                                $updateSql = "UPDATE login SET password='$newPassword' WHERE username='$username'";
                                $updateResult = mysqli_query($conn, $updateSql);

                                if ($updateResult) {
                                    echo "Password updated successfully!";
                                } else {
                                    echo "Failed to update password.";
                                }
                            } else {
                                echo "Passwords do not match.";
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
    var newPasswordInput = document.getElementById("new_password");
    var confirmPasswordInput = document.getElementById("confirm_password");
    var confirmErrorDiv = document.getElementById("confirm_password_error");

    function validatePassword() {
        var newPassword = newPasswordInput.value;
        var confirmPassword = confirmPasswordInput.value;

        if (newPassword !== confirmPassword) {
            confirmErrorDiv.textContent = "Passwords do not match";
        } else {
            confirmErrorDiv.textContent = "";
        }
    }

    newPasswordInput.addEventListener("input", validatePassword);
    confirmPasswordInput.addEventListener("input", validatePassword);
</script>
</body>
</html>

