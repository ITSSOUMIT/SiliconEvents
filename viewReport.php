<?php
    include('config.php');
    include('const/check.php');
    include('functions.php');

    if(isset($_POST['reportid'])){
        $reportid = $_POST['reportid'];
        $query = "SELECT * FROM report WHERE reportid='$reportid'";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        if(isset($_GET['user'])){
            if(strcmp($_GET['user'], 'Admin')==0){
?>
<div class="modal-header">
    <h4 class="modal-title">Report</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body viewDesc">
    <div class="row">
        <div class="col-12">
            <b>Title : </b><?php echo $row['title']; ?>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-4">
            <b>Description : </b><br><?php if(strlen($row['description'])){ echo $row['description']; } ?>
        </div>
        <div class="col-lg-4">
            <b>Objective : </b><br><?php if(strlen($row['objective'])){ echo $row['objective']; } ?>
        </div>
        <div class="col-lg-4">
            <b>Ressource Person(s) : </b><br><?php if(strlen($row['resource'])){ echo $row['resource']; }else{ echo 'N/A'; } ?>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-4">
            <b>Starting Date : </b><br><?php if(strlen($row['sdate'])){ echo $row['sdate']; } ?>
        </div>
        <div class="col-lg-4">
            <b>Ending Date : </b><br><?php if(strlen($row['edate'])){ echo $row['edate']; } ?>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-4">
            <b>Mode of Conduct : </b><br><?php if(strlen($row['mode'])){ echo $row['mode']; } ?>
        </div>
        <div class="col-lg-4">
            <b>No. of attendees : </b><br><?php if(strlen($row['attendee'])){ echo $row['attendee']; } ?>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-12">
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
</div>
<div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary" onclick="location.href = 'printReport?reportid=<?php echo $reportid; ?>'"><i class="fas fa-download" style="margin-right: 10px;"></i>Download
        PDF</button>
</div>
<?php                
            }
        }else{
?>

    <div class="row">
        <div class="col-12">
            <b>Title : </b><?php echo $row['title']; ?>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-4">
            <b>Description : </b><br><?php if(strlen($row['description'])){ echo $row['description']; } ?>
        </div>
        <div class="col-lg-4">
            <b>Objective : </b><br><?php if(strlen($row['objective'])){ echo $row['objective']; } ?>
        </div>
        <div class="col-lg-4">
            <b>Ressource Person(s) : </b><br><?php if(strlen($row['resource'])){ echo $row['resource']; }else{ echo 'N/A'; } ?>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-4">
            <b>Starting Date : </b><br><?php if(strlen($row['sdate'])){ echo $row['sdate']; } ?>
        </div>
        <div class="col-lg-4">
            <b>Ending Date : </b><br><?php if(strlen($row['edate'])){ echo $row['edate']; } ?>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-4">
            <b>Mode of Conduct : </b><br><?php if(strlen($row['mode'])){ echo $row['mode']; } ?>
        </div>
        <div class="col-lg-4">
            <b>No. of attendees : </b><br><?php if(strlen($row['attendee'])){ echo $row['attendee']; } ?>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-12">
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

<?php
        }
    }
?>