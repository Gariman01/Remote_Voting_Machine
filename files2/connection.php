<?php
$host="localhost";
$user="root";
$password="";
$dbname="login";

$con=mysqli_connect($host,$user,$password,$dbname);
if(mysqli_connect_errno())
{
die("Failed to connect with MySql:".mysqli_connect_error());
}
?>