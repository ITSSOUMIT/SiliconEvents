<?php
    include('config.php');
    if(isset($_POST['reportid'])){
        $reportid = $_POST['reportid'];
        $departmentid = $_POST['departmentid'];
        $query = "SELECT * FROM report WHERE reportid = '$reportid' AND departmentid = '$departmentid'";
        $result = $conn->query($query);
        if($result->num_rows==1){
            echo '200';
        }else{
            echo '404';
        }
    }
?>
