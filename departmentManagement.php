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
                        class="fas fa-plus" style="margin-right: 10px;"></i>Add New Department</button>
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
                            <h1 class="m-0">Department Management</h1>
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
                                                <th>Department Name</th>
                                                <th>Department Code</th>
                                                <th>Department Color</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $repquery = "SELECT * FROM department WHERE status=1 ORDER BY departmentname";
                                                $represult = $conn->query($repquery);
                                                $count = 1;
                                                while($row = $represult->fetch_assoc()){
                                            ?>
                                            <tr>
                                                <td><?php echo $count; ?></td>
                                                <td><?php echo $row['departmentname']; ?></td>
                                                <td><?php echo $row['departmentcode']; ?></td>
                                                <td><font color="<?php echo $row['departmentcolor']; ?>"><i class="fas fa-square"></i></font></td>
                                                <td>
                                                    <button type="button" class="btn btn-block btn-danger btn-xs"
                                                        data-id='<?php echo $row['departmentid']; ?>'
                                                        onclick="revokeUser('<?php echo 'revoke'.$count; ?>')"
                                                        id="revoke<?php echo $count; ?>">Revoke Department</button>
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
                                <h4 class="modal-title">Add New Department</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="dataHandler" method="POST">
                                <input type="hidden" name="intent" value="newDepartment">
                                <div class="modal-body">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Department Name</label>
                                            <input type="text" class="form-control" placeholder="Department Name" name="name"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Department Code</label>
                                            <input type="text" class="form-control" placeholder="Department Code" name="code"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label>Department Color</label>

                                            <div class="input-group my-colorpicker2">
                                                <input type="text" class="form-control" name="deptColor" required>

                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="fas fa-square"></i></span>
                                                </div>
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Add Department</button>
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
    var element = document.getElementById("sideDepartment");
    element.classList.add("active");
    </script>

    <script>
        $('.my-colorpicker2').colorpicker()

        $('.my-colorpicker2').on('colorpickerChange', function(event) {
        $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
        })
    </script>


    <script>
    var btnid;

    function revokeUser(btnid) {
        var button = document.getElementById(btnid);
        var id = button.getAttribute('data-id');

        $.ajax({
            url: 'revokeDepartmentAjax.php',
            type: 'post',
            data: {
                departmentid: id
            },
            success: function(response) {
                window.location.href='departmentManagement?message=success';
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
