<?php
    include('config.php');
    include('const/check.php');
    include('functions.php');
    if(isset($_POST['reportid'])){
        $reportid = $_POST['reportid'];

        $query = "UPDATE report SET publicSharing=0, reportpassword='', reportShortLink='' WHERE reportid='$reportid'";
        $result = $conn->query($query);
    }
?>