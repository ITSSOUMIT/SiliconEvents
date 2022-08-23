<?php
    include('config.php');
    if(isset($_POST['departmentid'])){
        $adminid = $_POST['departmentid'];
        $query = "UPDATE department SET status=0 WHERE departmentid='$adminid'";
        $result = $conn->query($query);

        $userquery = "UPDATE adminbase SET status=0 WHERE department='$adminid'";
        $userresult = $conn->query($userquery);
    }
?>