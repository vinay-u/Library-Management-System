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
<div class="sea">
<pre>       <input type="text1" value="" class="search" name="sea" size="100" placeholder=" Search for Book Name, Sem, USN" required/>  <input type="submit" value="Search" name="sbm" style="border-radius:50px"/>                        
</div>
</form>
<div class="over"><br><br>

<?php
if(isset($_POST["sbm"]))
{	$sid=$_POST["sea"];
	$s=0;$st=0;$b=0;$l=0;$a=0;
	if($sid == "1"||$sid==2||$sid==3||$sid==4||$sid==5||$sid==6||$sid==7||$sid==8)
	{
		$sql = "SELECT * FROM std where sem = '$sid'";
		$result= mysql_query($sql);
		while ($row = mysql_fetch_array($result))
		$a=$row[0];	
		if($a!=0)
		{
			echo '<table class="tab" border="1px solid black">
			<tr>
			<th>  USN</th>
			<th>  Name  </th>
			<th>  Branch  </th>
			<th>  Sem  </th>
			<th>  Mob No.  </th>
			<th>  Book ID  </th>
			<th>  Date Of Issue  </th>
			</tr>';
			$sql = "SELECT * FROM std where sem = '$sid' order by stdid";
			$result= mysql_query($sql);
			while ($row = mysql_fetch_array($result))
			{
				$st++;
				echo"<tr><td>{$row[0]}</td>
				<td>{$row[1]}</td>
				<td>{$row[2]}</td>
				<td>{$row[3]}</td>
				<td>{$row[4]}</td>
				<td>{$row[5]}</td>
				<td>{$row[6]}</td>";
				
			}
			echo'</table><br>';
		}
	}	
	else
	{
		
		$sql = "SELECT * FROM books where name LIKE '%$sid%' or bid ='$sid' and sts='0'";
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
			</tr>';
			$sql = "SELECT * FROM books where name LIKE '%$sid%' or bid ='$sid'  and sts='0'";
			$result= mysql_query($sql);
			while ($row = mysql_fetch_array($result))
			{
				$b++;
				echo"<tr><td>{$row[0]}</td>
				<td>{$row[1]}</td>
				<td>{$row[2]}</td>
				<td>{$row[3]}</td>
				</tr>";
			}
			echo'</table><br><br>';
		}
	}
		if($a==0)
			{
			$sql = "SELECT * FROM std where stdid LIKE '%$sid%' order by stdid";
			$result= mysql_query($sql);
			$i=0;
			while ($row = mysql_fetch_array($result))
			{
			$s=$row[0];	
			}
			if($s!=0)
			{
				echo '<table class="tab" border="1px solid black">
				<tr>
				<th>  USN</th>
				<th>  Name  </th>
				<th>  Branch  </th>
				<th>  Sem  </th>
				<th>  Mob No.  </th>
				<th>  Book ID  </th>
				<th>  Date Of Issue  </th>
				</tr>';
				$sql = "SELECT * FROM std where stdid LIKE '%$sid%' order by stdid";
				$result= mysql_query($sql);
				while ($row = mysql_fetch_array($result))
				{
					$st++;
					echo"<tr><td>{$row[0]}</td>
					<td>{$row[1]}</td>
					<td>{$row[2]}</td>
					<td>{$row[3]}</td>
					<td>{$row[4]}</td>
					<td>{$row[5]}</td>
					<td>{$row[6]}</td>";
				}
			echo'</table><br>';
			}
		}
	if($b == 0 && $st==0)
		echo' <p class="found">Sorry not found!!!!</p></br>';
	else
		echo' <p class="found">--->  '; echo $b; echo' Books, ';  echo $st; echo' Student  Found</p></br>';
}
?>
</body>
</html>







		