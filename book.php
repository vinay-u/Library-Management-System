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
$result= mysql_query("SELECT max(bid) FROM books");
	$co=mysql_fetch_array($result);
	$co=$co[0]+1;
		if($co==1)
			$co=1001;
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
<p class="newbook">New Book</p><pre><b>Book ID	   <input type="text" value="<?php echo$co;?>" name="bid" readonly/><br/><br/>
Name	   <input type="text" value="" name="nm" title="Only Characters" required/><br/><br/>
Edition	   <select name="edit" required>
<option value="" required>Select Edition</option>
<option value="1" required>1</option>
<option value="2" required>2</option>
<option value="3" required>3</option>
<option value="4" required>4</option>
<option value="5" required>5</option>
<option value="6" required>6</option>
<option value="7" required>7</option>
<option value="8" required>8</option>
<option value="9" required>9</option>
</select><br><br>
Author	   <input type="text" value="" title="Only Characters" required/ name="atr"><br/><br/><br/>
<input type="reset" value="Reset" />            <input type="submit" value="Submit" name="sbm" />
</div>
</form>
</body>
</html>

<?php
if(isset($_POST["sbm"]))
{	
	$bid=$_POST["bid"];
	$edit=$_POST["edit"];
	$nm=$_POST["nm"];
	$atr=$_POST["atr"];
		$query=mysql_query("INSERT INTO books (bid,name,Edition,author,sts) values('$bid','$nm','$edit','$atr','0')");
				if($query==1)
				{
					echo "<script type='text/javascript'>alert('Book Added')</script>";
					echo "<script type='text/javascript'>window.location='book.php';</script>";
				}
				else
					echo "<script type='text/javascript'>alert('Book ID Exist')</script>";	
}
?>









		