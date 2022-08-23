<?php
    include('config.php');
    if(isset($_POST['reportid'])){
        $reportid = $_POST['reportid'];
        $eventid = $_POST['eventid'];
        $departmentid = $_POST['departmentid'];
        $query = "UPDATE events SET reportid = '$reportid' WHERE eventid = '$eventid'";
        $result = $conn->query($query);
    }
?>
