<?php
    include('config.php');
    if(isset($_POST['adminid'])){
        $adminid = $_POST['adminid'];
        $query = "UPDATE adminbase SET status=0 WHERE adminid='$adminid'";
        $result = $conn->query($query);
    }
?>