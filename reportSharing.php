<?php
    include('config.php');
    include('const/check.php');
    include('functions.php');
    if(($_SESSION['accessLevel']==0)){
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

    <style>
        .customHoverClass:hover{
            color: #007bff;
            cursor: pointer;
        }
    </style>
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
                            <h1 class="m-0">Report Sharing</h1>
                            <p style="color:red;">If you cannot find a report ID, first lock the report, upload final Document, then proceed for sharing.</p>
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
                                                <th>Department / Club / Society</th>
                                                <th>Short Link (click to copy)</th>
                                                <th>Password</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $departmentid = $_SESSION['department'];
                                                $repquery = "SELECT * FROM report WHERE finalDocumentAvailable=1 ORDER BY id DESC";
                                                $represult = $conn->query($repquery);
                                                $count = 1;
                                                while($row = $represult->fetch_assoc()){
                                            ?>
                                            <tr>
                                                <td><?php echo $count; ?></td>
                                                <td><?php if($row['publicSharing']==1){ echo "<font color='#00BDFF'><i class='fas fa-share-alt'></i>&nbsp;&nbsp;</font>"; }?><?php echo $row['reportid']; ?></td>
                                                <td><?php echo substr($row['title'], 0, 25); ?></td>
                                                <td><?php echo getDeptName($row['departmentid']); ?></td>
                                                <td><text class="customHoverClass" onclick="copyFunction('<?php echo $row['reportShortLink']; ?>')"><?php echo $row['reportShortLink']; ?></text></td>
                                                <td><?php echo $row['reportpassword']; ?></td>
                                                <td>
                                                    <?php
                                                        if($row['publicSharing']==0){
                                                    ?>
                                                    <button type="button" class="btn btn-block btn-primary btn-xs"
                                                        data-id='<?php echo $row['reportid']; ?>'
                                                        onclick="uploadFinalReport('<?php echo 'view'.$count; ?>')" id="view<?php echo $count; ?>">Share / Edit</button>
                                                    <?php
                                                        }else{
                                                    ?>
                                                    <button type="button" class="btn btn-block btn-danger btn-xs"
                                                        data-id='<?php echo $row['reportid']; ?>'
                                                        onclick="unshare('<?php echo 'unshare'.$count; ?>')" id="unshare<?php echo $count; ?>">Unshare</button>
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
                        <div class="modal-content viewDesc">
                            
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
    var element = document.getElementById("sideReportShare");
    element.classList.add("active");
    </script>


    <script>
        var btnid;

        function uploadFinalReport(btnid) {
            var button = document.getElementById(btnid);
            var id = button.getAttribute('data-id');

            $.ajax({
                url: 'shareUnshareAjax.php',
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

        function unshare(btnid) {
            var button = document.getElementById(btnid);
            var id = button.getAttribute('data-id');

            $.ajax({
                url: 'unshareAjax.php',
                type: 'post',
                data: {reportid: id},
                success: function(response) {
                    console.log(id);
                    // Add response in Modal body
                    window.location.href="reportSharing";
                }
            });
        }

        function copyFunction(text) {
            var cpytext = `events.silicon.ac.in/share/${text}`;
            navigator.clipboard.writeText(cpytext);
            toastr.success('Report Sharing Link Copied to Clipboard !!!');
        }
    </script>
    
</body>

</html>
