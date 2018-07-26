<?php
session_start();
if(!isset($_SESSION['username']) || $_SESSION['sts']==0)
{
	header('Location:home.php');
	exit;
}
$_SESSION["admin"]=2;
include("dbconnection.php");
include("head2.php");
?>
<html>
<head>
<title>Library</title>
<meta name="viewport" content="width=device-width, initial-scale=0.5">
<link href="design.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<form action="" method="post">
<div class="center">
<p class="newbook">New Student</p><br><b>Student USN  <input type="text" value="" title="Ex:1DS16CS433" name="sid" pattern="1[D|d][s|S][1-9][1-9][A-Za-z][a-zA-Z][0-9][0-9][0-9]" required maxlength="10"/><br/></br>
Name	      <input type="text" value="" name="nm" title="Only Characters" required/><br/><br/>
Branch	      <input type="text" value=""  required name="brc"/><br/><br/>
Semister	      <select name="sem" required>
<option value="" required>Select Sem</option>
<option value="1" required>1</option>
<option value="2" required>2</option>
<option value="3" required>3</option>
<option value="4" required>4</option>
<option value="5" required>5</option>
<option value="6" required>6</option>
<option value="7" required>7</option>
<option value="8" required>8</option>
</select><br></br>
Mob No.	      <input type="text" value=""  name="mb" pattern="[0-9]{10}" title="10 Digit numbers" required maxlength="10"/><br/><br/>
<input type="reset" value="Reset" />            <input type="submit" value="Register" name="sbm" />
</div>
</form>
</body>
</html>

<?php
if(isset($_POST["sbm"]))
{	
	$sid=$_POST["sid"];
	$brc=$_POST["brc"];
	$nm=$_POST["nm"];
	$mbn=$_POST["mb"];
	$sem=$_POST["sem"];
			$query=mysql_query("INSERT INTO std (stdid,name,branch,sem,mob,bid,doi,rd)  values('$sid','$nm','$brc','$sem','$mbn','---','---','---')");
				if($query==1)
				{
					echo "<script type='text/javascript'>alert('Registered')</script>";
					echo "<script type='text/javascript'>window.location='std.php';</script>";
				}
				else
					echo "<script type='text/javascript'>alert('USN Exist')</script>";	
}
?>
		