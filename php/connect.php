<?php
    $server_name="localhost";
    $username="root";
    $password="";
    $dbname="hotel_management";
    $conn = new mysqli($server_name,$username,$password,$dbname);

    if ($conn->connect_error) {
        die("连接失败: " . $conn->connect_error);
    } 
?>