<?php
    session_start();
    if(isset($_SESSION['id']))
    {
        if($_SESSION['id']=="0000000000")
        {
            header("Location:Final_result.php");
        }
        else
        {
            header("Location:result.php");
        }
    }
    else
    {
        if(isset($_COOKIE['UserID']))
        {
            header("Location:login.html");
        }
    }
?>

<!DOCTYPE html>
<html>
<style>
.error {color: #FF0000;}

.item2{  text-align:center;  padding-top:60px; }
.item4{  text-align:center;  padding-top:30px;}
.item5{  text-align:center; padding-bottom:60px; color:white; }
.item11{ text-align:center; padding-bottom:20px;font-size:24px; }

input{
font-size:20px;
}

img{
width:40px;
padding-right:15px;
}

.hi{display: flex;
flex-direction:column;
border:inset #0000ff 2px;
box-shadow: 10px 10px 5px #20B2AA;
color:black;
background:url("bg2.jpg");
opacity:0.8;
background-repeat:no-repeat;
background-size:cover;
margin-left:28%;
margin-right:28%;
}

body{
background:url("bg4_1.jpg");
background-repeat:no-repeat;
background-size:cover;
padding-bottom:10px;
}

input[type=submit]{
color:#FFFFFF; 
background-color:#000000;
border-radius:20px;
width:100px;
cursor:pointer;
}

</style>
<body style="text-align:center;">


<?php 
// define variables and set to empty values

$u = $p = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (!empty($_POST["user"])) {
    $u = test_input($_POST["user"]);
  }
  
  if (!empty($_POST["pass"])) {
    $p= test_input($_POST["pass"]);
  }

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>

<h1 style="padding:10px;"><img src="vote-logo.png">Voter-login</h1>

<span class="error">* means the field is required</span>
<div class="background">
<form class="hi" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">


 <div class="item2"><input type="text" name="user" value="<?php echo isset($_POST['user'])?htmlspecialchars($_POST['user']):"";?>" placeholder="First Name (case sensitive))" required><span class="error">*</span></div>
 <div class="item4"><input type="password" name="pass" id="myInput"  placeholder="Voter-Id"  required><span class="error">*</span></div>

<div class="item5"><input type="checkbox" onclick="myFunction()">  Show the Voter-Id</div>

<?php
if(!isset($u))
{
	$u="";	
}
if(!isset($p))
{
	$p="";	
}
?>

<script>
function myFunction() {
  var pw_ele = document.getElementById("myInput");
  if (pw_ele.type === "password") {
    pw_ele.type = "text";
  } else {
    pw_ele.type = "password";
  }
}
</script>
 
<div class="item11"><input type="submit" name="submit" value="Login"></div>

</form>

</div>

<br><br>
<div style="font-size:16px">


<?php

if(isset($_POST['submit']))
{
$ad_name="admin";
$ad_pass="0000000000";

include("connection.php");
$username=stripcslashes($u);
$password=stripcslashes($p);

$username=mysqli_real_escape_string($con,$username);
$password=mysqli_real_escape_string($con,$password);

$sql="SELECT * FROM logintable where (username='$username' or username like '{$username} %') and password='$password' ";
$result=mysqli_query($con,$sql);
$count=mysqli_num_rows($result);
$row=mysqli_fetch_array($result);

if($username==$ad_name and $password==$ad_pass)
{	
	$_SESSION['id']=$password;
	header("Location:Final_result.php");
	exit();
}
	
if($count==1)
{
	if(str_word_count($username,0,"_1234567890")!=1)
	{
		echo"<strong>Enter the first name only</strong>";
	}
	else
	{
		if($row['status']==1)
		{
			echo '<strong>This user has already voted</strong>';
		}
		elseif($row['status']==0)
		{
			$firstname=strtok($row["username"]," ");
			if($firstname==$username)
			{
				setcookie("UserID",$username);
                setcookie("Pass",$password);
                header("Location:login.html");
		        exit();
			}
	
			else
			{
				echo "<strong>Username case not matching</strong>";
			}
		}
	}

}
elseif($count!=1 and $password!="")
{
	echo "<strong>Username or password didn't match</strong>";
}


mysqli_close($con);

}

?>
</div>

<br><br>
<div>Don't have an account? <a HREF="signup.php">Signup</a></div>


</body>
</html>