<?php
    function getQuantSidebar($table){
        include('config.php');
        $query = "SELECT * FROM $table";
        $result = $conn->query($query);
        return $result->num_rows;
    }

    function getDeptName($deptid){
        include('config.php');
        $query = "SELECT * FROM department WHERE departmentid = '$deptid'";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        return $row['departmentname'];
    }

    function getDeptCode($deptid){
        include('config.php');
        $query = "SELECT * FROM department WHERE departmentid = '$deptid'";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        return $row['departmentcode'];
    }

    function getUserName($adminid){
        include('config.php');
        $query = "SELECT * FROM adminbase WHERE adminid = '$adminid'";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        return $row['name'];
    }

    function isSuperAdmin(){
        include('config.php');
        return $_SESSION['accessLevel'];
    }

    function getAdminId($reportid){
        include('config.php');
        $query = "SELECT * FROM report WHERE reportid = '$reportid'";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        return $row['adminid'];
    }

    function changeDateFormat($strDate){
        // Creating timestamp from given date
        $timestamp = strtotime($strDate);
 
        // Creating new date format from that timestamp
        $new_date = date("d-m-Y", $timestamp);
        return $new_date;
    }

    function getDeptColor($deptid){
        include('config.php');
        $query = "SELECT * FROM department WHERE departmentid = '$deptid'";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        return $row['departmentcolor'];
    }
?>
