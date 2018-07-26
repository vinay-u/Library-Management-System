<?php
session_start();
$_SESSION["sts"]=0;
include("dbconnection.php");
include("head.php");
?>
<html>
<head>
<title>Library</title>
<meta name="viewport" content="width=device-width, initial-scale=0.5">
<link href="design.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<form method="post" action="">
<div class="loginform">
<br><strong>USER ID <br>
<input type="text" class="text" name="username" placeholder=" Enter User ID" required size="30"/><br><br>
PASSWORD </strong><br>
<input type="password" class="text" name="password" placeholder=" Enter Password" required size="30"/><br><br>
<input type="submit" name="login" value="  Login  " class="log"/>
<p class="login"><B>Login</B></p>
<img class="admin" src="IMG/admin.png" alt="Admin"/>
<a href="#popup"><p class="login1"><b>Sign Up</p></a>
</div>
</form>
<form action="" method="post">
<div id="popup" class="overlay">
	<h3><pre>   <u>Sign Up</u>    			   		   <a class="close" href="#">&times;</a></pre></h3><br>
	<b>Name	   <input type="text" value="" name="nm" title="Only Characters" placeholder="Enter Name" required/><br/><br>
	User ID	   <input type="text" value="" name="un" placeholder="Enter User ID" required/><br/><br>
	Password	   <input type="password"  name="pwd" placeholder="Enter Password"  size="30" required/><br><br>
	Retype	   <input type="password" name="rpwd" placeholder="Re-Enter Password"  size="30"required/><br><br>
	Dept Name <input type="text" value="" name="ans" placeholder="Enter Dept." required/><br/><br/><br/><br>
	<input type="reset" value="Clear"/>   	<input type="submit" name="sign" value="Submit"/>
</div>
</form>
</body>
</html>


<?php
	if(isset($_POST["login"]))
	{
		$_SESSION["username"]=$_POST["username"];
		$result= mysql_query("SELECT * FROM users WHERE username='$_POST[username]' AND pwd='$_POST[password]'");
		$co=mysql_num_rows($result);
		if($co==1)
		{	
			$result= mysql_query("SELECT * FROM users WHERE username='$_POST[username]' AND pwd='$_POST[password]'");
			$row = mysql_fetch_array($result);
			$_SESSION["nm"]=$row[0];
			$_SESSION["sts"]=1;
			echo "<script type='text/javascript'>window.location='admin.php';</script>";
		}
		else
			echo "<div class='alert'><b>Incorrect User ID Or Password!!</b></div>";
	}
	if(isset($_POST["sign"]))
	{
		if($_POST["pwd"]!=$_POST["rpwd"])
			echo "<script type='text/javascript'>alert('Password Not Matching')</script>";
		else
		{ 
			$query=mysql_query("INSERT INTO users (name,username,pwd,dept) values('$_POST[nm]','$_POST[un]','$_POST[pwd]','$_POST[ans]')");
				if($query==1)	
				echo "<script type='text/javascript'>alert('Account Created')</script>";
			
		}
	}
?>