<?php
    session_start();
    if(!isset($_SESSION['adminid']) || !isset($_SESSION['accessLevel'])){
        echo "<script>
        window.location.href= 'index';
        </script>";
    }else{
        $adminid = $_SESSION['adminid'];
        $accessLevel = $_SESSION['accessLevel'];
        $department = $_SESSION['department'];
        $chquery = "SELECT * FROM adminbase WHERE adminid='$adminid' AND accessLevel='$accessLevel' AND status=1";
        $chresult = $conn->query($chquery);
        if($chresult->num_rows != 1){
            echo "<script>window.location.href='index'</script>";
        }
    }
?>
