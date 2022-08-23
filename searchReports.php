<?php
    include('config.php');
    include('const/check.php');
    include('functions.php');
    if(($_SESSION['accessLevel']==0)){
        echo"<script>window.location.href='index';</script>";
    }
    if(isset($_GET['reportid'])){
        $reportid = $_GET['reportid'];
        $query = "SELECT * FROM report WHERE reportid='$reportid'";
        $result = $conn->query($query);
        $correct = 0;
        if($result->num_rows!=0){
            $correct = 1;
            $row = $result->fetch_assoc();
        }
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
                            <h1 class="m-0">Search Reports</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="card card-outline card-primary">
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="" method="GET">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Report ID</label>
                                    <input type="text" class="form-control" name="reportid"
                                        placeholder="Enter Report ID" <?php if(isset($_GET['reportid'])){ echo "value='".$reportid."'"; } ?> required >
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </form>
                    </div>
                </div><!-- /.container-fluid -->

            </section>
            <!-- /.content -->

            <?php
                if(isset($_GET['reportid'])){
                    if($correct==1){
            ?>
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
                                                <th>Report ID</th>
                                                <th>Title</th>
                                                <th>Event Date</th>
                                                <th>Department / Club / Society</th>
                                                <th>User</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?php if($row['finalDocumentAvailable']==1){ echo "<font color='#28a745'><i class='fas fa-check-double'></i>&nbsp;&nbsp;</font>"; }?><?php if($row['isLocked']==1){ echo "<font color='red'><i class='fas fa-lock'></i>&nbsp;&nbsp;</font>"; }?><?php echo $row['reportid']; ?><br><?php if($row['revision']==1){ echo "<font color='#3399FF'><i class='fas fa-hourglass-start'></i>&nbsp;&nbsp;<b>Sent for revision</b></font>"; }?><?php if($row['notify']==1){ echo "<font color='red'><i class='fas fa-flag-checkered'></i>&nbsp;&nbsp;<b>Report has been edited</b></font>"; }?>
                                                </td>
                                                <td><?php echo substr($row['title'], 0, 25); ?></td>
                                                <td><?php echo "<b>".changeDateFormat($row['sdate'])." </b>to<b> ".changeDateFormat($row['edate'])."</b>"; ?>
                                                </td>
                                                <td><?php echo getDeptName($row['departmentid']); ?></td>
                                                <td><?php echo getUserName($row['adminid']); ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-block btn-primary btn-xs"
                                                        data-id='<?php echo $row['reportid']; ?>'
                                                        onclick="viewDescription('<?php echo 'view1'; ?>')"
                                                        id="view1">View Details</button>
                                                    <?php
                                                        if($row['isLocked']==0){
                                                        if($row['revision']==0){
                                                    ?>
                                                    <button type="button" class="btn btn-block btn-warning btn-xs"
                                                        data-id='<?php echo $row['reportid']; ?>'
                                                        onclick="sendRevision('<?php echo 'revise1'; ?>')"
                                                        id="revise1">Send for revision</button>
                                                    <?php } ?>
                                                    <button type="button" class="btn btn-block btn-danger btn-xs"
                                                        data-id='<?php echo $row['reportid']; ?>'
                                                        onclick="lockReport('<?php echo 'lock1'; ?>')"
                                                        id="lock1">Lock Document</button>
                                                    <?php } ?>
                                                    <?php
                                                        if($row['isLocked']==1){
                                                    ?>
                                                    <button type="button" class="btn btn-block btn-success btn-xs"
                                                        data-id='<?php echo $row['reportid']; ?>'
                                                        onclick="uploadFinalReport('<?php echo 'final1'; ?>')"
                                                        id="final1">Upload Final Report</button>
                                                    <?php
                                                        }
                                                    ?>
                                                    <?php
                                                        if($row['finalDocumentAvailable']==1){
                                                    ?>
                                                    <button type="button"
                                                        class="btn btn-block btn-outline-success btn-xs"
                                                        onclick="openTab('<?php echo $row['finalDocument']; ?>')">View
                                                        Final Report</button>
                                                    <?php
                                                        }
                                                    ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->

                <div class="modal fade" id="modalViewDetails">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content viewDesc">
                            
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
            </section>
            <!-- /.content -->
            <?php
                }}
            ?>
        </div>
        <!-- /.content-wrapper -->
        <?php include('const/footer.php'); ?>

    </div>
    <!-- ./wrapper -->

    <?php include('const/js.php'); ?>

    <script>
    var element = document.getElementById("sideSearchReport");
    element.classList.add("active");
    </script>

    <?php
        if(isset($_GET['reportid'])){
            if($result->num_rows==0){
                echo "<script>toastr.error('Report ID Not Found');</script>";
            }
        }
    ?>


    <script>
        var btnid;
        function viewDescription(btnid) {
            var button = document.getElementById(btnid);
            var id = button.getAttribute('data-id');

            $.ajax({
                url: 'viewReport.php?user=Admin',
                type: 'post',
                data: {reportid: id},
                success: function(response) {
                    console.log(id);
                    // Add response in Modal body
                    $('.viewDesc').html(response);

                    // Display Modal
                    $('#modalViewDetails').modal('show');
                }
            });
        }

        function uploadFinalReport(btnid) {
            var button = document.getElementById(btnid);
            var id = button.getAttribute('data-id');

            $.ajax({
                url: 'uploadFinalReport.php',
                type: 'post',
                data: {reportid: id},
                success: function(response) {
                    console.log(id);
                    // Add response in Modal body
                    $('.viewDesc').html(response);

                    // Display Modal
                    $('#modalViewDetails').modal('show');
                }
            });
        }

        function lockReport(btnid) {
            var button = document.getElementById(btnid);
            var id = button.getAttribute('data-id');

            if(confirm("Are you sure, you want to lock this Report ? This action cannot be undone.")){
                $.ajax({
                    url: 'lockReport.php',
                    type: 'post',
                    data: {reportid: id},
                    success: function(response) {
                        console.log(response);
                        window.location.href = "allReports";
                    }
                });
            }
        }

        function sendRevision(btnid) {
            var button = document.getElementById(btnid);
            var id = button.getAttribute('data-id');

            if(confirm("Are you sure, you want to send this report for revision ?")){
                $.ajax({
                    url: 'reviseReport.php',
                    type: 'post',
                    data: {reportid: id},
                    success: function(response) {
                        console.log(response);
                        window.location.href = "allReports";
                    }
                });
            }
        }

        function openTab(url) {
            window.open(url, '_blank').focus();
        }
    </script>


</body>

</html>
