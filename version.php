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
                            <h1 class="m-0">Version History : <b>Silicon Events</b></h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- The time line -->
                            <div class="timeline">
                                <!-- timeline time label -->
                                <div class="time-label">
                                    <span class="bg-green">17 Feb 2022</span>
                                </div>
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                                <div>
                                    <i class="fas fa-check bg-green"></i>
                                    <div class="timeline-item">
                                        <h3 class="timeline-header"><a href="#">v1.51</a></h3>
                                        <div class="timeline-body">
                                            Features Added :
                                            <li>Switched to PWA</li>
                                            <li>Name Change : <b>Silicon Report Portal</b> to <b>Silicon Events</b></li>
                                            <li>Infographic Upload for upcoming events</li>
                                            <li>Date format change : <b>YYYY-MM-DD</b> to <b>DD-MM-YYYY</b></li>
                                            <li>Submit Report button on View Upcoming Event's Details Modal is set to appear only after 5pm of the end Date</li>
                                            <li>Serially displaying all Departments</li>
                                        </div>
                                    </div>
                                </div>
                                <!-- END timeline item -->
                                <!-- timeline time label -->
                                <div class="time-label">
                                    <span class="bg-green">15 Feb 2022</span>
                                </div>
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                                <div>
                                    <i class="fas fa-check bg-green"></i>
                                    <div class="timeline-item">
                                        <h3 class="timeline-header"><a href="#">v1.5</a></h3>
                                        <div class="timeline-body">
                                            Features Added :
                                            <li>Upcoming Event Listing Module</li>
                                            <li>Version History Module for the website</li>
                                        </div>
                                    </div>
                                </div>
                                <!-- END timeline item -->
                                <!-- timeline time label -->
                                <div class="time-label">
                                    <span class="bg-green">15 Nov 2021</span>
                                </div>
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                                <div>
                                    <i class="fas fa-check bg-green"></i>
                                    <div class="timeline-item">
                                        <h3 class="timeline-header"><a href="#">v1.0</a></h3>
                                        <div class="timeline-body">
                                            Version 1.0 of the product :
                                            <li>Add Report</li>
                                            <li>View Report</li>
                                            <li>Search Report</li>
                                            <li>Report Sharing</li>
                                            <li>User Management</li>
                                            <li>Department Management</li>
                                        </div>
                                    </div>
                                </div>
                                <!-- END timeline item -->
                                <div>
                                    <i class="fas fa-clock bg-gray"></i>
                                </div>
                            </div>
                        </div>
                        <!-- /.col -->
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
    
</body>

</html>
