<?php
    if(isset($_GET['reportid'])){
        $reportid = $_GET['reportid'];
?>
<?php
    include('config.php');
    include('const/check.php');
    include('functions.php');

    $reportquery = "SELECT * FROM report WHERE reportid='$reportid'";
    $reportquery = $conn->query($reportquery);
    $reprow = $reportquery->fetch_assoc();
    if($reprow['isLocked']==0){
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
                            <h1 class="m-0">Edit Report</h1>
                            Report ID : <b><?php echo $reportid; ?></b>
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
                            <div class="card card-primary card-outline">
                                <!-- form start -->
                                <form action="dataHandler" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="intent" value="editReport">
                                    <input type="hidden" name="reportid" value="<?php echo $reportid; ?>">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-4 col-sm-12">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Department ID</label>
                                                    <input type="text" class="form-control" name="departmentid"
                                                        value="<?php echo $_SESSION['department']; ?>" readonly required>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-sm-12">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Department Name</label>
                                                    <input type="text" class="form-control" name="departmentname"
                                                        value="<?php echo getDeptName($_SESSION['department']); ?>" readonly required>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-sm-12">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">User ID</label>
                                                    <input type="text" class="form-control" name="adminid"
                                                        value="<?php echo $_SESSION['adminid']; ?>" readonly required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Title</label>
                                            <input type="text" class="form-control" name="title"
                                                placeholder="Enter title (max 256 characters)" value="<?php echo $reprow['title']; ?>" required>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-sm-12">
                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <textarea class="form-control" rows="5"
                                                        placeholder="Enter Description" name="description"
                                                        required><?php echo $reprow['description']; ?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-sm-12">
                                                <div class="form-group">
                                                    <label>Objective</label>
                                                    <textarea class="form-control" rows="5"
                                                        placeholder="Enter Objective" name="objective"
                                                        required><?php echo $reprow['objective']; ?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-sm-12">
                                                <div class="form-group">
                                                    <label>Resource Person(s) (optional)</label>
                                                    <textarea class="form-control" rows="5"
                                                        placeholder="Enter Resource Person(s) Name, Organization & Designation" name="resource"><?php echo $reprow['resource']; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Starting Date</label>
                                                    <input type="date" class="form-control" name="sdate" value="<?php echo $reprow['sdate']; ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Ending Date</label>
                                                    <input type="date" class="form-control" name="edate" value="<?php echo $reprow['edate']; ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Mode Of Conduct</label>
                                                    <select class="form-control" name="mode" required>
                                                        <option value="online" <?php if(strcmp($reprow['mode'], "online")==0){ echo "selected"; } ?> >Online</option>
                                                        <option value="offline" <?php if(strcmp($reprow['mode'], "offline")==0){ echo "selected"; } ?> >Offline</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">No. of attendees</label>
                                                    <input type="number" class="form-control" name="attendee"
                                                        placeholder="Enter no. of attendees" value="<?php echo $reprow['attendee']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
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
<?php
        }else{
            header('Location: dashboard');    
        }
    }else{
        header('Location: dashboard');
    }
?>