<?php
    include('config.php');
    include('const/check.php');
    include('functions.php');

    if(!isset($_GET['reportid'])){
        header("Location: dashboard");
    }else{
        $reportid = $_GET['reportid'];

        $query = "SELECT * FROM report WHERE reportid = '$reportid'";
        $result = $conn->query($query);

        $reprow = $result->fetch_assoc();

        if($reprow['isLocked'] == 1){
            if($accesslevel == 0){
                header("Location: dashboard");
            }
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

            <?php
                $reqquery = "SELECT * FROM spcRequests WHERE reportid='$reportid'";
                $reqresult = $conn->query($reqquery);

                if($reqresult->num_rows > 0){
                    $reqrow = $reqresult->fetch_assoc();

                    if($reqrow['uploaded'] == 0){
                        ?>
                        <ul class="navbar-nav ml-auto">
                            <button type="button" class="btn btn-outline-danger"><i class="fas fa-times" style="margin-right: 10px;"></i>SPC hasn't uploaded photos</button>
                        </ul>

                        <ul class="navbar-nav ml-3">
                            <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#modalRequestSPC"><i class="fas fa-location-arrow" style="margin-right: 10px;"></i>Request photos from SPC</button>
                        </ul>
                        <?php
                    }else{
                        ?>
                        <ul class="navbar-nav ml-auto">
                            <button type="button" class="btn btn-outline-success"><i class="fas fa-check" style="margin-right: 10px;"></i>SPC has uploaded photos</button>
                        </ul>

                        <ul class="navbar-nav ml-3">
                            <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#modalRequestSPC"><i class="fas fa-location-arrow" style="margin-right: 10px;"></i>Request photos from SPC</button>
                        </ul>
                        <?php
                    }
                }else{
                    ?>
                    <ul class="navbar-nav ml-auto">
                        <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#modalRequestSPC"><i class="fas fa-location-arrow" style="margin-right: 10px;"></i>Request photos from SPC</button>
                    </ul>
                    <?php
                }
            ?>


            <ul class="navbar-nav ml-3">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalNewImages"><i
                        class="fas fa-plus" style="margin-right: 10px;"></i>Add Images</button>
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
                            <h1 class="m-0"><b>Image Manager</b></h1>
                            <h6>Report ID : <font color="red"><strong><?php echo $reportid; ?></strong></font></h6>
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
                                                <th>Image</th>
                                                <th>Image Dimensions</th>
                                                <th>Image Type</th>
                                                <th>Image Size</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $query = "SELECT * FROM imagefiles WHERE reportid='$reportid'";
                                                $result = $conn->query($query);
                                                $count = 1;
                                                while($row = $result->fetch_assoc()){
                                            ?>
                                            <tr>
                                                <td><?php echo $count; ?></td>
                                                <td>
                                                    <a href="#" onclick="bigImg('<?php echo $row['fileLocation']; ?>')">
                                                        <img src="<?php echo $row['fileLocation']; ?>" height="50px" width="50px">
                                                    </a>
                                                </td>
                                                <?php
                                                    $imageInfo = getimagesize($row['fileLocation']);
                                                ?>
                                                <td><?php echo $imageInfo['0']; ?>px &nbsp;x&nbsp; <?php echo $imageInfo['1']; ?>px</td>
                                                <td><?php echo $imageInfo['mime']; ?></td>
                                                <td><?php echo number_format(filesize($row['fileLocation']) / 1048576, 2); ?> MB</td>
                                                <td>
                                                    <button type="button" class="btn btn-block btn-danger btn-xs"
                                                        onclick="deleteImg('<?php echo $row['imageid']; ?>')">Delete Image</button>
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


                <div class="modal fade" id="modalViewImage">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><?php echo $reportid; ?></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="loadimg">
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

                <div class="modal fade" id="modalNewImages">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Add New Images</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="dataHandler" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="intent" value="addMoreImages">
                                <div class="modal-body">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Report ID</label>
                                            <input type="text" class="form-control" placeholder="Report ID" name="reportid" value="<?php echo $reportid; ?>"
                                                readonly required>
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

                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Add Images</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

                <div class="modal fade" id="modalRequestSPC">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Request photos from SPC</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="dataHandler" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="intent" value="requestSPC">
                                <input type="hidden" name="reportid" value="<?php echo $reportid; ?>">
                                <div class="modal-body">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Upload URL</label>
                                            <span class="ml-auto"><a href="#" onclick="cpyURL('events.silicon.ac.in/spc/<?php echo $reportid; ?>')"><strong>(Copy)</strong></a></span>
                                            <input type="text" class="form-control" placeholder="Report ID" name="url" value="events.silicon.ac.in/spc/<?php echo $reportid; ?>"
                                                readonly required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Last Date to upload</label>
                                            <input type="date" class="form-control" name="edate" required>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Request</button>
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
        $(function () {
            $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();

                $(this).ekkoLightbox({
                    alwaysShowClose: true
                });
            });
        })
    </script>

    <script>
        function bigImg(img) {
            console.log(img);
            var image = `<center><img src="${img}" width="300px"></center>`;
            $("#loadimg").html(image);
            $("#modalViewImage").modal("show");
        }

        function deleteImg(id) {
            if(confirm("Are you sure you want to delete this image ?")){
                $.ajax({
                    url: "deleteImageAjax.php",
                    type: "POST",
                    data: {
                        id: id
                    },
                    success: function(data){
                        if(data == 'success'){
                            alert('Image deleted successfully');
                            location.reload();
                        }else{
                            alert('Something went wrong! Contact support');
                        }
                    }
                });
            }
        }

        function cpyURL(cpyString){
            console.log(cpyString);
            navigator.clipboard.writeText(cpyString);
            toastr.success('Link Copied to Clipboard !!!');
        }
    </script>
    
</body>

</html>
