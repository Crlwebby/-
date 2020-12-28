<?php
	session_start();
	unset($_SESSION['userid']);
	unset($_SESSION['pwd']);
	header("location:../login.html");
?>