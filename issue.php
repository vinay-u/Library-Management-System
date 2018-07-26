<?php
session_start();
if(!isset($_SESSION['username']) || $_SESSION['sts']==0)
{header('Location:home.php');
exit;}
$_SESSION["admin"]=2;
include("dbconnection.php");
include("head2.php");
echo '<script type="text/javascript">
		 function getd()
		 {
			var cr=new Date();
			cr.setDate(cr.getDate()+15);
			var m=cr.getMonth()+1;
			var d=cr.getDate();
			var y=cr.getFullYear();
			var sp="";
			var date=d+sp+m+sp+y;
		 }
		</script>';
?>
<html>
<head>
<title>Library</title>
<meta name="viewport" content="width=device-width, initial-scale=0.5">
<link href="design.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript">
		 function date(id)
		 {
	
			var dat=id.value;
			var cr=new Date(dat);
			cr.setDate(cr.getDate()+15);
			var m=cr.getMonth()+1;
			var d=cr.getDate();
			var y=cr.getFullYear();
			var sp="-";
			var date=d+sp+m+sp+y;
			document.getElementById("alrt").innerHTML="Return date : <big>" + date + "</big> (15 days) <br><br>Over Due Fine Rs. 1/- per day.";
		 }
		</script>
</head>
<body>
<div class="sea" style="top:410px;left:calc(50% - 0px);padding-left:100px;width:1200;height:455px">
<p class="newbook" style="top:-16px;left: calc(50% - 520px)">Student Details</p><p class="newbook" style="top:-16px;left: calc(50% + 100px)">Book Details</p>
<form action="" method="post">
<br>Enter USN      <input type="text" value="" title="Ex:1DS16CS433" name="sid" id="usn" pattern="1[D|d][s|S][1-9][1-9][A-Za-z][a-zA-Z][0-9][0-9][0-9]"  maxlength="10"  placeholder="Enter USN"/>   <button type="submit" class="find" name="find"/></button>					Select Book  <?php   echo"<select name='book' id='bn'> ";
		echo"<option value=''>Select Book</option>";
		$result= mysql_query("SELECT name,author FROM books where sts= '0' order by name");
		while ($row = mysql_fetch_array($result))
			{
			echo '<option value='.$row["name"].'>   '.$row["name"].'	( '.$row["author"].' )</option>';
			}
			echo '</SELECT>   <button type="submit" class="find" name="find"/></button><br>';
?>


Name             <input type="text"  id="name" readonly/>						Book Name  <input type="text"  id="book" readonly /><br/><br/>
Branch	      <input type="text"  id="b" readonly/>						 Book ID       <input type="text" name="bid"   id="bid" readonly/></br></br>
Semister	      <input type="text"  id="s" readonly/>						 Edition	    <input type="text"  id="edit" readonly/><br/><br/>
Issued Date   <input type="date" class="date" onchange="date(this)" name="d">						Author	    <input type="text"   id="atr" readonly/><br/><br/>
									  <input type="submit" value="Submit" name="sbm" />		
<hr width="1px" size="350" class="vr">
<p id="alrt" style="color:yellow;font-weight:bold;position:absolute;top:370;left:50"></p></div>
</form>
</body>
</html>





<?php
	if(isset($_POST["find"]))
			{
				$sid=$_POST["sid"];
				$result= mysql_query("SELECT * FROM std where stdid = '$sid'");
				$row = mysql_fetch_array($result);
				$usn=$row[0];
				if(!$usn)
				{
					echo "<script type='text/javascript'>alert('Incorrect USN')</script>";
					echo "<script type='text/javascript'>window.location='issue.php';</script>";
				}
				$sname=$row[1];
				$branch=$row[2];
				$sem=$row[3];
			print '<script type="text/javascript">
			function sync()
			{
				n1="'.$usn.'";
				n2="'.$sname.'";
				n3="'.$branch.'";
				n4="'.$sem.'";
				document.getElementById("usn").value=n1;
				document.getElementById("name").value=n2;
				document.getElementById("b").value=n3;
				document.getElementById("s").value=n4;
			}
				
				
			 sync();
			 </script>';
			 $bok=$_POST["book"];
				$result= mysql_query("SELECT * FROM books where name = '$bok'");
				$row = mysql_fetch_array($result);
				$id=$row[0];
				$name=$row[1];
				$edit=$row[2];
				$author=$row[3];
			print '<script type="text/javascript">
			function book()
			{
				n1="'.$name.'";
				n2="'.$id.'";
				n3="'.$edit.'";
				n4="'.$author.'";
				document.getElementById("bn").value=n1;
				document.getElementById("book").value=n1;
				document.getElementById("bid").value=n2;
				document.getElementById("edit").value=n3;
				document.getElementById("atr").value=n4;
			}
					
			 book();
			 </script>';
		}	
if(isset($_POST["sbm"]))
{	
			$sid=$_POST["sid"];
			$result= mysql_query("SELECT count(stdid) FROM std where stdid = '$sid' and bid!='0'");
				$row = mysql_fetch_array($result);
				$c=$row[0];
	if($c<'2')
	{
		$dat=$_POST["d"];
		$bid=$_POST["bid"];
		if($_POST["d"]==0)
			echo "<script type='text/javascript'>alert('Select Date of Issue')</script>";
		else
		{
				$result= mysql_query("SELECT * FROM std where stdid = '$sid'");
				$row = mysql_fetch_array($result);
				$nm=$row[1];
				$brc=$row[2];
				$sem=$row[3];
				$mob=$row[4];
				$book=$row[5];
				$issue=$row[6];
				
			if($book == 0 && $issue== '---')
			{
				$result=mysql_query("UPDATE std SET bid ='$bid', doi ='$dat' WHERE stdid = '$sid'");
				$query=mysql_query("UPDATE books SET sts ='1' WHERE bid = '$bid'");
				if($query==1 && $result==1)
				{
					echo "<script type='text/javascript'>alert('Book Details Updated')</script>";
					echo "<script type='text/javascript'>window.location='issue.php';</script>";
				}
				else
					echo "<script type='text/javascript'>alert('USN Exist')</script>";
			}	
			else
			{
				$query=mysql_query("UPDATE books SET sts ='1' WHERE bid = '$bid'");
				$query=mysql_query("INSERT INTO std (stdid,name,branch,sem,mob,bid,doi,rd,sts)  values('$sid','$nm','$brc','$sem','$mob','$bid','$dat','---','1')");
				if($query==1)
				{
					echo "<script type='text/javascript'>alert('Book Details Updated')</script>";
					echo "<script type='text/javascript'>window.location='issue.php';</script>";
				}
			}
		}
	}
	else
	{
		echo "<script type='text/javascript'>alert('Maximum 2 Books per Student')</script>";
	}
}
?>









		