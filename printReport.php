<?php
    include('config.php');
    include('const/check.php');
    include('functions.php');

    if(isset($_GET['reportid'])){
        $reportid = $_GET['reportid'];
        $query = "SELECT * FROM report WHERE reportid='$reportid'";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Print Report Sheet</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body>
    <div class="wrapper">
        <!-- Main content -->
        <section class="invoice">
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-lg-12">
                    <b>Report ID : </b><?php echo $reportid; ?>
                </div>
            </div>
            <br>
            <div class="row invoice-info">
                <div class="col-lg-12">
                    <b>Department : </b><?php echo getDeptName($row['departmentid']); ?>
                </div>
            </div>
            <br>
            <div class="row invoice-info">
                <div class="col-lg-12">
                    <b>User : </b><?php echo getUserName($row['adminid']); ?>
                </div>
            </div>
            <br>
            <hr>
            <br>
            <div class="row invoice-info">
                <div class="col-lg-12">
                    <b>Title : </b><?php echo $row['title']; ?>
                </div>
            </div>
            <br>
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    <b>Description :</b><br><?php echo $row['description']; ?>
                </div>
                <div class="col-sm-4 invoice-col">
                    <b>Objective :</b><br><?php echo $row['objective']; ?>
                </div>
                <div class="col-sm-4 invoice-col">
                    <b>Resource Person(s)
                        :</b><br><?php if(strlen($row['resource'])!=0){ echo $row['resource']; }else{ echo 'N/A'; } ?>
                </div>
            </div>
            <br>
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    <b>Starting Date :</b><br><?php echo $row['sdate']; ?>
                </div>
                <div class="col-sm-4 invoice-col">
                    <b>Ending Date :</b><br><?php echo $row['edate']; ?>
                </div>
            </div>
            <br>
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    <b>Mode of Conduct :</b><br><?php echo $row['mode']; ?>
                </div>
                <div class="col-sm-4 invoice-col">
                    <b>No. of attendees :</b><br><?php echo $row['attendee']; ?>
                </div>
            </div>
            <br>
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    <b>Images :</b><br>
                    <?php
                        $query = "SELECT * FROM imagefiles WHERE reportid='$reportid'";
                        $result = $conn->query($query);
                        while($row = $result->fetch_assoc()){
                            echo "<a href='".$row['fileLocation']."' target='_blank'>".substr($row['fileLocation'], 12)."</a><br>";
                        }
                    ?>
                </div>
            </div>


        </section>
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->
    <!-- Page specific script -->
    <script>
    window.addEventListener("load", window.print());
    </script>
</body>

</html>
<?php } ?>