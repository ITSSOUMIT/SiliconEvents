<?php
    include('config.php');
    if(isset($_POST['eventid'])){
        $eventid = $_POST['eventid'];
        $query = "UPDATE events SET status=0 WHERE eventid = '$eventid'";
        $result = $conn->query($query);

        $query = "SELECT * FROM events WHERE eventid = '$eventid'";
        $result = $conn->query($query);

        $row = $result->fetch_assoc();

        unlink($row['infographic']);
        echo "success";
    }
?>
