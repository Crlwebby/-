<?php
    session_start(); 

    //检测是否登录，若没登录则转向登录界面 

    if(!isset($_SESSION['userid'])){ 

        header("Location:../login.html"); 

        exit(); 

    }
    $server_name="localhost";
    $username="root";
    $password="";
    $dbname="hotel_management";
    $conn = new mysqli($server_name,$username,$password,$dbname);

    if ($conn->connect_error) {
        die("连接失败: " . $conn->connect_error);
    } 
?>