<?php
    include('config.php');
    include('mailerFunction.php');
    include('functions.php');
    if($_POST['reportid']){
        $reportid = $_POST['reportid'];
        $query = "UPDATE report SET revision=0, notify=1 WHERE reportid='$reportid'";
        $result = $conn->query($query);

        $subject = "Report has been revised";
        $message = "Report ID : <b>".$reportid."</b>.<br>has been revised and re-submitted once again. Please check back in the Report Portal.<br><br>Regards,<br>Silicon Report Portal";
        mailsomeone('all', $subject, $message);
        echo $reportid;
    }
?>