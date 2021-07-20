<!doctype html>
<html>
<style>

body{
text-align:center;
background-color:#00BFFF;
background-repeat:no-repeat;
background-size:cover;
}

.item2_1{grid-area:p1;height:40px;width:40px;background:url("congress.png");background-repeat:no-repeat;background-size:contain;}
.item2_2{grid-area:n1;height:40px;background-color:#F5ADAD;}
.item2_3{grid-area:p2;height:40px;width:40px;background:url("bjp.png");background-repeat:no-repeat;background-size:contain;}
.item2_4{grid-area:n2;height:40px;background-color:#F5ADAD;}
.item2_5{grid-area:p3;height:40px;width:40px;background:url("aap.jpg");background-repeat:no-repeat;background-size:contain;}
.item2_6{grid-area:n3;height:40px;background-color:#F5ADAD;}
.item2_7{grid-area:p4;height:40px;width:40px;background:url("bsp.png");background-repeat:no-repeat;background-size:contain;}
.item2_8{grid-area:n4;height:40px;background-color:#F5ADAD;}
.item2_11{grid-area:p5;height:40px;width:40px;background:url("nota.jpg");background-repeat:no-repeat;background-size:contain;}
.item2_10{grid-area:n5;height:40px;background-color:#F5ADAD;}
.item2_9{grid-area:s;font-size:24px; border-radius:10px;background-color:#E44B5A;}


.item{
display:flex;
flex-direction:rows;
padding-left:10%;
padding-right:10%;
justify-content:space-between;
}

.item1{
width:35%;
display:flex;
flex-direction:column;
justify-content:centre;
background-color:white;
padding-top:20px;
padding-left:10px;
padding-right:10px;
border:2px solid gray;
}

.item2{
display:grid;
border:2px solid gray;
grid-template-columns:0.5fr 1.5fr;
grid-template-areas:" p1 n1 "
	"p2 n2"
	"p3 n3"
	"p4 n4"
	"p5 n5"
	"s s";
align-items:center;
background-color:white;
padding:5%;
padding-top:2%;
padding-bottom:2%;
font-size:24px;
}

img{
height:40%;
width:40%;
margin-left:auto;
margin-right:auto;
border: 2px solid black;
border-radius:5px;
}

.sign{
float:right;
font-size:20px;
}

p{
font-size:20px;
}

</style>
<body>

<?php 
session_start();
include("connection.php");

$id=$_SESSION['id'];

if(!isset($id))
{
	header("Location:login.php");
}

$sql="SELECT * FROM logintable where password='$id' ";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_array($result);
$name=$row['username'];
$num=$row['mobile_num'];
$add=$row['address'];
$sex=$row['sex'];
$img=$row['filename'];

if(isset($_POST['submit']))
{
	if(isset($_POST['ra']))
	{
		$vote=$_POST['ra'];
	}
	else
	{
		$vote="";
	}
if($vote!="")
{
$sql="UPDATE votetable SET vote=vote+1 where party='$vote' ";
mysqli_query($con,$sql);
$sql="UPDATE logintable SET status=1 where password='$id' ";
mysqli_query($con,$sql);

header("refresh:5;url=login.php");
echo('<h3>Successfully voted. You will be redirected to the login page.</h3>');
echo '<embed src="sound.mp3" hidden="true" volume="10"/>' ;
}
else
{
	echo ('<script>alert("No candidate is chosen");</script>');
}

mysqli_close($con);
}
?>

<div class="sign"><A href="signout.php">signout</A></div>
<h1>Voting-time</h1>

<div class="item">

<div class="item1">

<img align="middle" src="<?php echo("img/".$img);?>">
<p style="background-color:#F5ADAD;"><strong>Name:</strong><i><?php echo " ".$name;?></i></p>
<p style="background-color:#F5ADAD;"><strong>Voter-Id:<i><?php echo " ".$id;?></i></strong></p>
<p style="background-color:#F5ADAD;"><strong>Mobile-number:</strong><?php echo " ".$num;?></p>
<p style="background-color:#F5ADAD;"><strong>Address:</strong><?php echo " ".$add;?></p>
<p style="background-color:#F5ADAD;"><strong>Gender:</strong><?php echo " ".$sex;?></p>

</div>

<form method="POST" class="item2" action="<?php echo(htmlspecialchars($_SERVER['PHP_SELF']))?>">

<div class="item2_1"></div>
<div class="item2_3"></div>
<div class="item2_5"></div>
<div class="item2_7"></div>
<div class="item2_11"></div>

<div class="item2_2" style="text-align:right;">Congress<input type="radio" name="ra" value="con" ></div>
<div class="item2_4" style="text-align:right;">Bhartiya Janta Party<input type="radio" name="ra" value="bjp" ></div>
<div class="item2_6" style="text-align:right;">Aam Aadmi Party<input type="radio" name="ra" value="aap"></div>
<div class="item2_8" style="text-align:right;">Bahujan Samaj Party<input type="radio" name="ra" value="bsp"></div>
<div class="item2_10" style="text-align:right;">None of the above<input type="radio" name="ra" value="nota"></div>
<input class="item2_9" type="submit" name="submit" value="Vote">

</form>

</div>

</body>
</html>
