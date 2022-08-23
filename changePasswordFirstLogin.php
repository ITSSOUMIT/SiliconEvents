<?php
    include('config.php');
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Change Password</title>

    <?php include('const/stylesheet.php'); ?>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="login" class="h1"><b>Silicon Report Portal</b></a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Change Your Password Immediately</p>

                <form action="dataHandler" method="POST">
                    <input type="hidden" name="intent" value="_changePassword">
                    <input type="hidden" name="adminid" value="<?php echo $_SESSION['adminid']; ?>">
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Current Password" name="cpassword" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="New Password" name="npassword" required id="newpassword">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Repeat New Password" name="rnpassword" required id="repeatnewpassword" onkeyup="enableBtn(this)">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block" id="submitBtn" disabled>Change Password</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <?php include('const/js.php'); ?>

    <?php
        if(isset($_GET['message'])){
            if(strcmp($_GET['message'], 'incorrectPassword')==0){
                echo "<script>toastr.error('Incorrect Old Password');</script>";
            }
        }
    ?>


    <script type="text/javascript">
    function enableBtn(termsCheckBox) {
        if (document.getElementById('newpassword').value == document.getElementById('repeatnewpassword').value) {
            document.getElementById("submitBtn").disabled = false;
        }else{
            document.getElementById("submitBtn").disabled = true;
        }
    }
    </script>
</body>

</html>