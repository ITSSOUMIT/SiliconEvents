<?php
    session_start();
    include('config.php');
    include('functions.php');
    if(isset($_POST['eventid'])){
        $eventid = $_POST['eventid'];
        $query = "SELECT * FROM events WHERE eventid = '$eventid'";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $departmentid = $row['departmentid'];
?>
<div class="modal-header">
    <h4 class="modal-title">Event Details</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <?php
        if(isSuperAdmin()==12){
    ?>
    <b>Department</b> : <?php echo getDeptName($row['departmentid']); ?><br>
    <?php
        }
    ?>
    <b>Event Name</b> : <?php echo $row['name']; ?><br>

    <div class="row">
        <div class="col-6">
            <b>From</b> : <br>
            <b>Date</b> : <?php echo changeDateFormat($row['fromDate']); ?><br>
            <b>Time</b> : <?php echo $row['fromTime']; ?><br>
        </div>
        <div class="col-6">
            <b>To</b> : <br>
            <b>Date</b> : <?php echo changeDateFormat($row['toDate']); ?><br>
            <b>Time</b> : <?php echo $row['toTime']; ?><br>
        </div>
    </div>
    <br>
    <b>Venue</b> : <br><?php echo $row['venue']; ?><br><br>
    <b>Audience</b> : <br><?php echo $row['audience']; ?><br><br>
    <b>Description</b> : <br><?php echo $row['description']; ?><br><br>
    <b>Infographic / Poster</b> : <a href="<?php echo $row['infographic']; ?>" target="_blank">View Infographic / Poster</a><br><br>
    <b>Report ID</b> : 
    <?php
        if($row['reportid']==NULL){
            echo "<i>No Report Assigned</i>";
        }else{
            echo $row['reportid'];
        }
    ?>
</div>
<div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-danger" onclick="deleteEvent('<?php echo $eventid; ?>')">Delete Event</button>
    <?php
        if($row['reportid']==NULL){
            if($row['departmentid'] == $_SESSION['department']){
                date_default_timezone_set('Asia/Kolkata');
                $currDate = date("Y-m-d");
                $toDate = $row['toDate'];
                
                if($currDate > $toDate){
                    echo '<button type="button" onclick="addReport()" class="btn btn-success">Submit Report</button>';
                }

                if($currDate == $toDate){
                    if(date('H') >= 17){
                        echo '<button type="button" onclick="addReport()" class="btn btn-success">Submit Report</button>';
                    }
                }
            }
        }
    ?>
</div>

<script>
    function deleteEvent(eventid){
        if(confirm('Do you really want to delete this event ?')){
            $.ajax({
                url: 'deleteEventAjax.php',
                type: 'POST',
                data: {eventid: eventid},
                success: function(data){
                    if(data=='success'){
                        alert('Event deleted successfully');
                        location.reload();
                    }else{
                        alert('Error in deleting event');
                    }
                }
            });
        }
    }
</script>

<script>
    function addReport(){
        if(confirm('Once a report ID is linked, it cannot be unlinked, and you will need to contact support team, for any link changes. Please proceed with care')){
            var reportid = prompt('Enter Report ID');
            if(reportid!=''){
                $.ajax({
                    url: 'checkIfReportExistAjax.php',
                    type: 'post',
                    data: {
                        reportid: reportid,
                        departmentid: '<?php echo $departmentid; ?>'
                    },
                    success: function(response) {
                        if(response==200){
                            $.ajax({
                                url: 'linkEventReportAjax.php',
                                type: 'post',
                                data: {
                                    reportid: reportid,
                                    eventid: '<?php echo $eventid; ?>',
                                    departmentid: '<?php echo $departmentid; ?>'
                                },
                                success: function(response) {
                                    window.location.href='newEvent';
                                }
                            });
                        }else{
                            alert('Please enter a valid report ID');
                        }
                    }
                });
            }else{
                alert('Report ID Field cannot be left blank');
            }
        }
    }
</script>
<?php
    }
?>
