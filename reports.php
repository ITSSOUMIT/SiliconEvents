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
                            <h1 class="m-0">My Reports</h1>
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
                                                <th>Report ID</th>
                                                <th>Title</th>
                                                <th>Event Date</th>
                                                <th>Submit Timestamp</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $departmentid = $_SESSION['department'];
                                                $repquery = "SELECT * FROM report WHERE departmentid='$departmentid' AND adminid='$adminid' ORDER BY id DESC";
                                                $represult = $conn->query($repquery);
                                                $count = 1;
                                                while($row = $represult->fetch_assoc()){
                                            ?>
                                            <tr>
                                                <td><?php echo $count; ?></td>
                                                <td><?php if($row['finalDocumentAvailable']==1){ echo "<font color='#28a745'><i class='fas fa-check-double'></i>&nbsp;&nbsp;</font>"; }?><?php if($row['isLocked']==1){ echo "<font color='red'><i class='fas fa-lock'></i>&nbsp;&nbsp;</font>"; }?><?php echo $row['reportid']; ?><br><?php if($row['revision']==1){ echo "<font color='red'><i class='fas fa-hourglass-start'></i>&nbsp;&nbsp;<b>Need to be revised</b></font>"; }?></td>
                                                <td><?php echo substr($row['title'], 0, 25); ?></td>
                                                <td><?php echo "<b>".changeDateFormat($row['sdate'])." </b>to<b> ".changeDateFormat($row['edate'])."</b>"; ?></td>
                                                <td><?php echo $row['insertDate']; ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-block btn-primary btn-xs"
                                                        data-id='<?php echo $row['reportid']; ?>'
                                                        onclick="viewDescription('<?php echo 'view'.$count; ?>')" id="view<?php echo $count; ?>">View Details</button>
                                                    <?php
                                                        if($row['isLocked']==0){
                                                    ?>
                                                    <button type="button" class="btn btn-block btn-outline-primary btn-xs"
                                                        onclick="redirectImg('<?php echo $row['reportid']; ?>')">Manage Images</button>
                                                    <button type="button" class="btn btn-block btn-warning btn-xs"
                                                        onclick="redirect('<?php echo $row['reportid']; ?>')">Edit Document</button>
                                                    <button type="button" class="btn btn-block btn-success btn-xs"
                                                        data-id='<?php echo $row['reportid']; ?>'
                                                        onclick="completeRevise('<?php echo 'completeRevise'.$count; ?>')" id="completeRevise<?php echo $count; ?>">Mark as Revised</button>
                                                    <?php } ?>
                                                    <?php
                                                        if($row['finalDocumentAvailable']==1){
                                                    ?>
                                                    <button type="button" class="btn btn-block btn-success btn-xs"
                                                        onclick="openTab('<?php echo $row['finalDocument']; ?>')">View Final Report</button>
                                                    <?php
                                                        }
                                                    ?>

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
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Report</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body viewDesc">
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
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
    var element = document.getElementById("sideReport");
    element.classList.add("active");
    </script>


    <script>
        var btnid;
        function viewDescription(btnid) {
            var button = document.getElementById(btnid);
            var id = button.getAttribute('data-id');

            $.ajax({
                url: 'viewReport.php',
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

        function completeRevise(btnid) {
            var button = document.getElementById(btnid);
            var id = button.getAttribute('data-id');

            if(confirm("Are you sure, you want to mark this report as revised ?")){
                $.ajax({
                    url: 'completeReviseAjax.php',
                    type: 'post',
                    data: {reportid: id},
                    success: function(response) {
                        console.log(id);
                        window.location.href = "reports";
                    }
                });
            }
        }

        function openTab(url) {
            window.open(url, '_blank').focus();
        }
    </script>

    <script>
        var id;
        function redirect(id){
            console.log(id);
            window.location.href = 'editReport?reportid='+id;
        }

        function redirectImg(id){
            console.log(id);
            window.location.href = 'manageImage?reportid='+id;
        }
    </script>
    
</body>

</html>
