<?php
    include('config.php');
    include('mailerFunction.php');
    include('functions.php');
    if($_POST['reportid']){
        $reportid = $_POST['reportid'];
        $notification = $_POST['notes'];
        $query = "UPDATE report SET revision=1, notify=0 WHERE reportid='$reportid'";
        $result = $conn->query($query);

        $to = getAdminId($reportid);
        $subject = "Report Revision Required !!!";
        $message = "Revision required for Report ID : <b>".$reportid."</b>. <br><br>Notes for the revision:<br>".$notification."<br><br>Please do make the necessary changes for the concerned report in the portal. <br><br>Regards,<br>Silicon Report Portal";
        mailsomeone($to, $subject, $message);
    }
?>