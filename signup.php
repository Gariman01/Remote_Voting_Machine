<!DOCTYPE html>
<html>
<style>

.error {color: #FF0000;}

.item1{ grid-area:n1; text-align:right; font-size:24px; padding-top:10px; }
.item2{ grid-area:n2; text-align:left;  padding-left:20px;padding-top:10px;}
.item3{ grid-area:n3; text-align:right; font-size:24px; }
.item4{ grid-area:n4; text-align:left; padding-left:20px; }
.item5{ grid-area:n5; text-align:left;  padding-left:20px;}
.item6{ grid-area:n6; text-align:right; font-size:24px; }
.item7{ grid-area:n7; text-align:left; padding-left:20px; }
.item8{ grid-area:n8; text-align:left; padding-left:20px;}
.item9{ grid-area:n9; text-align:right; font-size:24px; }
.item10{grid-area:n10; text-align:left; font-size:24px; padding-left:20px;padding-right:10px;}
.item11{grid-area:n11; text-align:right;font-size:24px;padding-top:5px;}
.item12{grid-area:n12; text-align:left;padding-left:20px; padding-top:5px;}
.item13{grid-area:n13;text-align:right; font-size:24px;padding-top:5px;}
.item14{grid-area:n14; text-align:left; font-size:20px; padding-left:20px;padding-top:5px;}
.item15{grid-area:n15; text-align:right; font-size:24px;padding-top:5px;padding-bottom:10px;}
.item16{grid-area:n16; text-align:left; font-size:20px;padding-top:5px; padding-left:20px;padding-bottom:10px;}
.item17{grid-area:n; text-align:center; padding-bottom:10px;font-size:20px; }

input{
font-size:14px;
background-color:transparent;
}

img{
width:40px;
padding-right:15px;
}

.hi{display: grid;
border:inset #0000ff 2px;
box-shadow: 10px 10px 5px #20B2AA;
color:gray;
margin-left:25%;
margin-right:25%;
background:url("bg2.jpg");
background-repeat:no-repeat;
background-size:cover;
grid-template-columns:1fr 1fr ;
grid-template-areas:  "n1 n2 "
	"n3 n4 "
	" . n5 "
	" n6 n7 "
	"  . n8 "
	"n9 n10"
	"n11 n12"
	"n13 n14"
	"n15 n16 "
	"n n"
 }

body{
 background:url("bg3.jpg");
background-repeat:no-repeat;
background-size:cover;
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
  
  if (!empty($_POST["pass1"])) {
    $p1= test_input($_POST["pass1"]);
  }

 if (!empty($_POST["pass2"])) {
    $p2= test_input($_POST["pass2"]);
  }

 if (!empty($_POST["num"])) {
    $num= $_POST["num"];
  }

 if (!empty($_POST["address"])) {
    $add= test_input($_POST["address"]);
  }

 if (!empty($_POST["sex"])) {
    $sex= test_input($_POST["sex"]);
  }

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>

<h1><img src="user-logo.png">Voter-signup</h1>

<span class="error">* means the field is required</span>

<form class="hi" method="POST" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>">


<div class="item1"><strong>Enter your name:</strong></div>     
<div class="item2"><input style="background-color:white;border-radius:4px;" type="text" name="user" value="<?php echo isset($_POST['user'])?htmlspecialchars($_POST['user']):"";?>"  required><span class="error">*</span></div>

<div class="item3" ><strong>Enter your voter-id:</strong></div>  
<div class="item4"><input style="background-color:white;border-radius:4px;" type="password" name="pass1" id="myInput" pattern="[0-9]+" required><span class="error">*</span></div>
<div class="item5" style="color:black;"><input type="checkbox" onclick="myFunction()">  Show the Voter-id</div>

<div class="item6" ><strong>Confirm the voter-id:</strong></div>  
<div class="item7"><input style="background-color:white;border-radius:4px;" type="password" name="pass2" id="myInput2" pattern="[0-9]+" required><span class="error">*</span></div>
<div class="item8" style="color:black;"><input type="checkbox" onclick="myFunction2()">  Show the confirmed Voter-Id</div>

<script>
function myFunction() {
  var pw_ele = document.getElementById("myInput");
  if (pw_ele.type === "password") {
    pw_ele.type = "text";
  } else {
    pw_ele.type = "password";
  }
}

function myFunction2() {
  var pw_ele2 = document.getElementById("myInput2");
  if (pw_ele2.type === "password") {
    pw_ele2.type = "text";
  } else {
    pw_ele2.type = "password";
  }
}
</script>

<div class="item9"><strong>Image upload:</strong></div>
<div class="item10"><input type="file" name="upload" value="Choose_image" required><span class="error">*</span></div>

<div class="item11"><strong>Contact-No.:</strong></div>
<div class="item12"><input style="background-color:white;border-radius:4px;" type="number" name="num" value="<?php echo isset($_POST['num'])?htmlspecialchars($_POST['num']):"";?>" ></div>


<div class="item13"><strong>Address:</strong></div>
<div class="item14"><textarea name="address" rows="5" cols="25" value="<?php echo isset($_POST['address'])?htmlspecialchars($_POST['address']):"";?>" ></textarea></div>

<div class="item15"><strong>Gender:</strong></div>
<div class="item16" style="color:white;"><input type="radio" name="sex" value="Male" >Male
		<input type="radio" name="sex" value="Female" >Female
		<input type="radio" name="sex" value="Other" >Other
</div>
 
<div class="item17"><input style="color:#FFFFFF; background-color:#000000;border-radius:20px;" type="submit" name="submit" value="Save"></div>

</form>


<br><br>

<div style="color:red;font-size:20px;">
<?php

if(!isset($u))
{
	$u="";	
}
if(!isset($p1))
{
	$p1="";	
}
if(!isset($p2))
{
	$p2="";	
}
if(!isset($num))
{
	$num="";	
}
if(!isset($add))
{
	$add="";
}
if(!isset($sex))
{
	$sex="";
}

if($p1!=$p2 and $p1!="")
{
	echo "<strong>Voter-ids do not match</strong><br>";
	$p1="";
}

if(!isset($_FILES['upload']))
{
	$_FILES['upload']['tmp_name']="";
}

function valid($num)
{
	$fil_num=str_replace("-","",$num);
	if((strlen($fil_num)>9 and strlen($fil_num)<14) or $fil_num=="" )
	{
		return true;
	}
	else
	{
		return false;
	}
}

if(!(valid($num)) and $p1!="")
{
	echo "<strong>Mobile number invalid</strong>";
	$p1="";
}

function validated($p1)
{
	if(strlen($p1)==10 or $p1=="")
	{
		return true;
	}
	else
	{
		return false;
	}
}

if(!(validated($p1)))
{
	echo "<strong>Voter-Id invalid. Should be 10 digits</strong>";
	$p1="";
}		


if($p1==$p2 and valid($num) and validated($p1) and isset($_POST['submit']))
{
	include("connection.php");
	
	$username=stripcslashes($u);
	$password=stripcslashes($p1);
	$add=stripcslashes($add);
	$sex=stripcslashes($sex);

	$username=mysqli_real_escape_string($con,$username);
	$password=mysqli_real_escape_string($con,$password);
	$add=mysqli_real_escape_string($con,$add);
	$sex=mysqli_real_escape_string($con,$sex);
	
	$filename=strtok($username," ").".jpg";
	$temp=$_FILES['upload']['tmp_name'];
	$folder="img/".$filename;

	if(move_uploaded_file($temp,$folder))
	{
		$sql="SELECT * FROM logintable where password='$password' ";
		$result=mysqli_query($con,$sql);
		if(mysqli_num_rows($result)>0)
		{
			echo "<strong>User with the same voter-id exists</strong>";
			$p1="";
		}
		else
		{
			$sql="INSERT INTO logintable (username, password,mobile_num,address,sex,filename,status) VALUES ('$username','$password','$num','$add','$sex','$filename',0)";
			mysqli_query($con,$sql);
			echo '<script>alert("New Voter added");</script>';
			$p1="";
		}
	}
	else
	{
		echo "<strong>Failed to upload<strong>";
		$p1="";
	}

	mysqli_close($con);	
}

?>
</div>

<div>Already have an account? <A href="login.php">Go to login</A></div>


</body>
</html>





