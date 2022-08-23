<?php
    include('config.php');
    include('const/check.php');
    include('functions.php');
    if(($_SESSION['accessLevel']==0) || ($_SESSION['accessLevel']==1)){
        echo"<script>window.location.href='index';</script>";
    }
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
            <ul class="navbar-nav ml-auto">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalNewUser"><i
                        class="fas fa-plus" style="margin-right: 10px;"></i>Add New User</button>
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
                            <h1 class="m-0">User Management</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>User Name</th>
                                                <th>Department</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $departmentid = $_SESSION['department'];
                                                $repquery = "SELECT * FROM adminbase WHERE status=1";
                                                $represult = $conn->query($repquery);
                                                $count = 1;
                                                while($row = $represult->fetch_assoc()){
                                            ?>
                                            <tr>
                                                <td><?php echo $count; ?></td>
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo $row['username']; ?></td>
                                                <td><?php echo getDeptName($row['department']); ?></td>
                                                <td><?php echo $row['email']; ?></td>
                                                <td>
                                                    <?php
                                                        if($row['accessLevel']==12){
                                                            echo "Super Admin";
                                                        }elseif($row['accessLevel']==1){
                                                            echo "News Editor";
                                                        }if($row['accessLevel']==0){
                                                            echo "General User";
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-block btn-success btn-xs"
                                                        data-id='<?php echo $row['adminid']; ?>'
                                                        onclick="changePassword('<?php echo 'chPwd'.$count; ?>')"
                                                        id="chPwd<?php echo $count; ?>">Change Password</button>
                                                    <button type="button" class="btn btn-block btn-warning btn-xs"
                                                        data-id='<?php echo $row['adminid']; ?>'
                                                        onclick="changeAccess('<?php echo 'chAccess'.$count; ?>')"
                                                        id="chAccess<?php echo $count; ?>">Change User Details</button>
                                                    <button type="button" class="btn btn-block btn-danger btn-xs"
                                                        data-id='<?php echo $row['adminid']; ?>'
                                                        onclick="revokeUser('<?php echo 'revoke'.$count; ?>')"
                                                        id="revoke<?php echo $count; ?>">Revoke User</button>
                                                </td>
                                            </tr>
                                            <?php
                                                $count++; }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->

                <div class="modal fade" id="modalViewDetails">
                    <div class="modal-dialog">
                        <div class="modal-content viewDesc">

                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->


                <div class="modal fade" id="modalNewUser">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Add New User</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="dataHandler" method="POST">
                                <input type="hidden" name="intent" value="newUser">
                                <div class="modal-body">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Name</label>
                                            <input type="text" class="form-control" placeholder="Name" name="name"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Username</label>
                                            <input type="text" class="form-control" placeholder="Username"
                                                name="username" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Password</label>
                                            <input type="text" class="form-control" placeholder="Password"
                                                name="password" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email</label>
                                            <input type="email" class="form-control" placeholder="Email" name="email"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label>Department</label>
                                            <select class="form-control" name="department" required>
                                                <?php
                                                    $deptquery = "SELECT * FROM department WHERE status=1";
                                                    $deptresult = $conn->query($deptquery);
                                                    while($deptrow = $deptresult->fetch_assoc()){
                                                ?>
                                                <option value="<?php echo $deptrow['departmentid']; ?>">
                                                    <?php echo $deptrow['departmentname']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Role</label>
                                            <select class="form-control" name="accessLevel" required>
                                                <option value="12">Super Admin</option>
                                                <option value="1">News Editor</option>
                                                <option value="0">General User</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Add User</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <?php include('const/footer.php'); ?>

    </div>
    <!-- ./wrapper -->

    <?php include('const/js.php'); ?>

    <script>
    var element = document.getElementById("sideUserManagement");
    element.classList.add("active");
    </script>


    <script>
    var btnid;

    function changePassword(btnid) {
        var button = document.getElementById(btnid);
        var id = button.getAttribute('data-id');

        $.ajax({
            url: 'changePasswordAjax.php',
            type: 'post',
            data: {
                adminid: id
            },
            success: function(response) {
                console.log(id);
                // Add response in Modal body
                $('.viewDesc').html(response);

                // Display Modal
                $('#modalViewDetails').modal('show');
            }
        });
    }

    function changeAccess(btnid) {
        var button = document.getElementById(btnid);
        var id = button.getAttribute('data-id');

        $.ajax({
            url: 'changeAccessLevelAjax.php',
            type: 'post',
            data: {
                adminid: id
            },
            success: function(response) {
                console.log(id);
                // Add response in Modal body
                $('.viewDesc').html(response);

                // Display Modal
                $('#modalViewDetails').modal('show');
            }
        });
    }
    </script>

    <script>
    function revokeUser(btnid) {
        var button = document.getElementById(btnid);
        var id = button.getAttribute('data-id');

        $.ajax({
            url: 'revokeUserAjax.php',
            type: 'post',
            data: {
                adminid: id
            },
            success: function(response) {
                window.location.href='userManagement?message=success';
            }
        });
    }
    </script>


    <?php
        if(isset($_GET['message'])){
            if(strcmp($_GET['message'], 'success')==0){
                echo "<script>toastr.success('Action Successfull');</script>";
            }
        }
    ?>

</body>

</html>