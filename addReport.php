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
̀̀
        <!-- Main Sidebar Container -->
        <?php include('sidebar.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Add New Report</h1>
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
                                    <input type="hidden" name="intent" value="newReport">
                                    <div class="card-body">
                                        <input type="hidden" class="form-control" name="departmentid"
                                            value="<?php echo $_SESSION['department']; ?>" readonly
                                            required>
                                        <input type="hidden" class="form-control" name="adminid"
                                            value="<?php echo $_SESSION['adminid']; ?>" readonly required>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Department Name</label>
                                            <input type="text" class="form-control" name="departmentname"
                                                value="<?php echo getDeptName($_SESSION['department']); ?>" readonly
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Title</label>
                                            <input type="text" class="form-control" name="title"
                                                placeholder="Enter title (max 256 characters)" required>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-sm-12">
                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <textarea class="form-control" rows="5"
                                                        placeholder="Enter Description" name="description" id="summernote1"
                                                        required></textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-sm-12">
                                                <div class="form-group">
                                                    <label>Objective(s)</label>
                                                    <textarea class="form-control" rows="5"
                                                        placeholder="Enter Objective" name="objective" id="summernote2"
                                                        required></textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-sm-12">
                                                <div class="form-group">
                                                    <label>Resource Person(s) (optional)</label>
                                                    <textarea class="form-control" rows="5"
                                                        placeholder="Enter Resource Person(s) Name, Organization & Designation"
                                                        name="resource" id="summernote3"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Start Date</label>
                                                    <input type="datetime-local" class="form-control" name="sdate" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">End Date</label>
                                                    <input type="datetime-local" class="form-control" name="edate" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Mode Of Conduct</label>
                                                    <select class="form-control" name="mode" required>
                                                        <option value="online" selected>Online</option>
                                                        <option value="offline">Offline</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">No. of Attendees</label>
                                                    <input type="number" class="form-control" name="attendee"
                                                        placeholder="Enter no. of attendees">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputFile">Photograph(s)</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="exampleInputFile"
                                                        name="image[]" accept="image/*" multiple required>
                                                    <label class="custom-file-label" for="exampleInputFile">Choose
                                                        file (Max 5)</label>
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

    <script>
    var element = document.getElementById("sideAddReport");
    element.classList.add("active");
    </script>

    <?php
        if(isset($_GET['message'])){
            if(strcmp($_GET['message'], 'dbError')==0){
                ?>
    <script type="text/javascript">
    $(window).on('load', function() {
        toastr.error('Database Error : Contact Administrator')
    });
    </script>
    <?php
            }elseif(strcmp($_GET['message'], 'manyImages')==0){
                ?>
    <script type="text/javascript">
    $(window).on('load', function() {
        toastr.error('Max 5 images can be uploaded')
    });
    </script>
    <?php
            }elseif(strcmp($_GET['message'], 'success')==0){
                ?>
    <script type="text/javascript">
    $(window).on('load', function() {
        toastr.success('Report Submitted Successfully')
    });
    </script>
    <?php
            }
        }
    ?>

    <script>
        $(function () {
            // Summernote
            $('#summernote1').summernote({
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']]
                ]
            });

            $('#summernote2').summernote({
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']]
                ]
            });

            $('#summernote3').summernote({
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']]
                ]
            });
        })
    </script>

</body>

</html>