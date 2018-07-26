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
<div class="sea"><p class="newbook" style="top:-16px;left: calc(50% - 520px)">Books Details</p>
<pre>       <input type="text1" value="" class="search" name="sea" size="100" placeholder=" Search for Book Name, Book ID" required/>  <input type="submit" value="Search" name="sbm" style="border-radius:50px"/>                        
</div>
</form>
<div class="over"><br><br>
<?php
if(isset($_POST["sbm"]))
{
	$sid=$_POST["sea"];
	$sql = "SELECT * FROM books where name LIKE '%$sid%' or bid ='$sid'";
	$b=0;
		$result= mysql_query($sql);
		while ($row = mysql_fetch_array($result))
		$l=$row[0];
		if($l!=0)
		{
			echo '<table class="tab" border="1px solid black">
			<tr>
			<th>  Book ID</th>
			<th>  Name  </th>
			<th>  Edition  </th>
			<th>  Author  </th>
			<th>  Status  </th>
			</tr>';
			$sql = "SELECT * FROM books where name LIKE '%$sid%' or bid ='$sid'";
			$result= mysql_query($sql);
			while ($row = mysql_fetch_array($result))
			{
				if($row[4]=='0')
					$sts='Available';
				else
					$sts='Unavailable';
				$b++;
				echo"<tr><td>&nbsp{$row[0]}</td>
				<td>&nbsp;&nbsp;{$row[1]}&nbsp;&nbsp;</td>
				<td>{$row[2]}</td>
				<td>{$row[3]}</td>
				<td>{$sts}</td>
				</tr>";
			}
			echo'</table><br><br>';
		}
		if($b == 0)
		echo' <p class="found">Sorry not found!!!!</p></br>';
		else
		echo' <p class="found">--->  '; echo $b; echo' Books Found 			'; 
}
else
{
 $sql = "SELECT * FROM books";
		$result= mysql_query($sql);
		while ($row = mysql_fetch_array($result))
		$l=$row[0];
		if($l!=0)
		{
			echo '<table class="tab" border="1px solid black">
			<tr>
			<th>  Book ID</th>
			<th>  Name  </th>
			<th>  Edition  </th>
			<th>  Author  </th>
			<th>  Status  </th>
			</tr>';
			$sql = "SELECT * FROM books";
			$result= mysql_query($sql);
			while ($row = mysql_fetch_array($result))
			{
				if($row[4]=='0')
					$sts='Available';
				else
					$sts='Unavailable';
				$b++;
				echo"<tr><td>&nbsp{$row[0]}</td>
				<td>&nbsp;&nbsp;{$row[1]}&nbsp;&nbsp;</td>
				<td>{$row[2]}</td>
				<td>{$row[3]}</td>
				<td>{$sts}</td>
				</tr>";
			}
			echo'</table><br><br>';
		}

		echo' <p class="found">--->  '; echo $b; echo' Books				 ';
}	
?>
</div>
</body>
</html>