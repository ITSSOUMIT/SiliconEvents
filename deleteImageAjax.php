<?php
    include('config.php');
    if(isset($_POST['id'])){
        $id = $_POST['id'];

        $query = "SELECT * FROM imagefiles WHERE imageid = '$id'";
        $result = $conn->query($query);

        $row = $result->fetch_assoc();

        unlink($row['fileLocation']);

        $query = "DELETE FROM imagefiles WHERE imageid = '$id'";
        $result = $conn->query($query);

        echo "success";
    }
?>