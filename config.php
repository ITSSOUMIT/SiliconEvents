<?php
    $servername = "localhost";
    $username = "root";
    //$password = "SOUMITdas@29";
    $password = "";
    $dbname = "report";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
?>
