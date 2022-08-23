<?php
    include('config.php');
    include('const/check.php');
    include('functions.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>

    <?php include('const/stylesheet.php'); ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php include('sidebar.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Change Password</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="card card-primary">
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="dataHandler" method="POST">
                            <input type="hidden" name="intent" value="_changePassword">
                            <input type="hidden" name="adminid" value="<?php echo $_SESSION['adminid']; ?>">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Old Password</label>
                                    <input type="password" class="form-control" name="cpassword" id="exampleInputEmail1"
                                        placeholder="Enter Old Password">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">New Password</label>
                                    <input type="password" class="form-control" name="npassword" id="newPassword"
                                        placeholder="Enter New Password" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Repeat New Password</label>
                                    <input type="password" class="form-control" id="repeatNewPassword"  onkeyup="enableBtn(this)"
                                        placeholder="Repeat New Password" required>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" id='submitBtn' disabled>Submit</button>
                            </div>
                        </form>
                    </div>
                </div><!-- /.container-fluid -->

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <?php include('const/footer.php'); ?>

    </div>
    <!-- ./wrapper -->

    <?php include('const/js.php'); ?>

    <script>
    var element = document.getElementById("sideChangePassword");
    element.classList.add("active");
    </script>

    <script type="text/javascript">
    function enableBtn(termsCheckBox) {
        if (document.getElementById('newPassword').value == document.getElementById('repeatNewPassword').value) {
            document.getElementById("submitBtn").disabled = false;
        }else{
            document.getElementById("submitBtn").disabled = true;
        }
    }
    </script>

</body>

</html>