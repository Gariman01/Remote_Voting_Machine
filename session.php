<?php
session_start();
$_SESSION['id']=$_COOKIE['Pass'];
header("Location:result.php");
?>