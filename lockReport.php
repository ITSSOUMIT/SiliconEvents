<?php
    include('config.php');
    include('mailerFunction.php');
    include('functions.php');
    if($_POST['reportid']){
        $reportid = $_POST['reportid'];
        $query = "UPDATE report SET revision=0, notify=0, isLocked=1 WHERE reportid='$reportid'";
        $result = $conn->query($query);

        $to = getAdminId($reportid);
        $subject = "Report Locked !!!";
        $message = "Report ID ; <b>".$reportid."</b> has been locked and is no more available for editing purposes.</b>.<br><br>Regards,<br>Silicon Report Portal";
        mailsomeone($to, $subject, $message);
        echo $reportid;
    }
?>