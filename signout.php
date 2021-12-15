<!doctype html>
<html>
<body>
<?php 
setcookie( "UserID", "", time()- 60);
setcookie( "Pass", "", time()- 60);
session_start();
session_destroy();
header("Location:login.php");
?>
</body>
</html>