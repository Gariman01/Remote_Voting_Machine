<!doctype html>
<html>
<style>

body{
padding-left:20px;
padding-right:20px;
text-align:center;
background-color:#87CEFA;
}

.item{
display:grid;
grid-template-columns:0.3fr 0.7fr;
grid-template-areas: "p1 v1"
	"p2 v2"
	"p3 v3"
	"p4 v4"
	"p5 v5" ;

font-size:24px;
}

.item1{grid-area:p1;text-align:left;background-color:#f88379;margin:10px;padding:10px;}
.item2{grid-area:v1;text-align:left;margin:10px;padding:10px; } 
.item3{grid-area:p2;text-align:left;background-color:#f88379;margin:10px;padding:10px;}
.item4{grid-area:v2;text-align:left;margin:10px;padding:10px;} 
.item5{grid-area:p3;text-align:left;background-color:#f88379;margin:10px;padding:10px;}
.item6{grid-area:v3;text-align:left;margin:10px;padding:10px;} 
.item7{grid-area:p4;text-align:left;background-color:#f88379;margin:10px;padding:10px;}
.item8{grid-area:v4;text-align:left;margin:10px;padding:10px;} 
.item9{grid-area:p5;text-align:left;background-color:#f88379;margin:10px;padding:10px;}
.item10{grid-area:v5;text-align:left;margin:10px;padding:10px;} 

.skills{color:white;
padding-right:10px;
text-align:right;
font-size:30px;
}

.con{
background-color:blue;}
.bjp{
background-color:orange;}
.aap{
background-color:red;}
.bsp{
background-color:green;}
.nota{
background-color:gray;}

input[type=submit] {
     background: #00FF00;
     color: #fff;
     border: 1px solid #eee;
     border-radius: 20px;
     box-shadow: 5px 5px 5px #eee;
     text-shadow:none;
}
input[type=submit]:hover {
     background: #228B22;
     color: #fff;
     border: 1px solid #eee;
     border-radius: 20px;
     box-shadow: 5px 5px 5px #eee;
     text-shadow:none;
}

</style>

<body>

<form method='POST' action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
<div style="float:left;"><input type='submit' name="submit" value='Reset' ></div>
</form>
	
<div style="float:right;"><A href="signout.php">signout</A></div>
<h1>Voting results</h1>
<h2>(as of now)</h2>

<?php

session_start();
include("connection.php");

$id=$_SESSION['id'];
if(!isset($id))
{
	header("Location:login.php");
}

if(isset($_POST['submit']))
{
	$sql="UPDATE votetable set vote=0";
	mysqli_query($con,$sql);	
	$sql="UPDATE logintable set status=0";
	mysqli_query($con,$sql);	
}

$sql="SELECT * FROM votetable WHERE party='con' ";
$row=mysqli_fetch_array(mysqli_query($con,$sql));
$conv=$row['vote'];
$sql="SELECT * FROM votetable WHERE party='bjp' ";
$row=mysqli_fetch_array(mysqli_query($con,$sql));
$bjpv=$row['vote'];
$sql="SELECT * FROM votetable WHERE party='aap' ";
$row=mysqli_fetch_array(mysqli_query($con,$sql));
$aapv=$row['vote'];
$sql="SELECT * FROM votetable WHERE party='bsp' ";
$row=mysqli_fetch_array(mysqli_query($con,$sql));
$bspv=$row['vote'];
$sql="SELECT * FROM votetable WHERE party='nota' ";
$row=mysqli_fetch_array(mysqli_query($con,$sql));
$notav=$row['vote'];

?>

<div class="item">
<div class="item1" ><strong>Congress</strong></div>
<div class="item2" ><div class="skills con" style="width:<?php echo $conv?>0%;"><?php echo $conv?></div></div>
<div class="item3" ><strong>Bhartiya Janta Party</strong></div>
<div class="item4" ><div class="skills bjp" style="width:<?php echo $bjpv?>0%;"><?php echo $bjpv?></div></div>
<div class="item5" ><strong>Aam Aadmi Party</strong></div>
<div class="item6" ><div class="skills aap" style="width:<?php echo $aapv?>0%;"><?php echo $aapv?></div></div>
<div class="item7" ><strong>Bahujan Samaj Party</strong></div>
<div class="item8" ><div class="skills bsp" style="width:<?php echo $bspv?>0%;"><?php echo $bspv?></div></div>
<div class="item9" ><strong>None of the above</strong></div>
<div class="item10"><div class="skills nota" style="width:<?php echo $notav?>0%;"><?php echo $notav?></div></div>
</div>

</body>
</html>
