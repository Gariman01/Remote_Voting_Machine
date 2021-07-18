<!doctype html>
<html>
<body>
<?php 
session_start();
session_destroy();
header("Location:login.php");
?>
</body>
</html>