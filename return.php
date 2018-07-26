<?php
session_start();
if(!isset($_SESSION['username']) || $_SESSION['sts']==0)
{header('Location:home.php');
exit;}
$_SESSION["admin"]=2;
include("dbconnection.php");
include("head2.php");
?>
<html>
<head>
<title>Library</title>
<meta name="viewport" content="width=device-width, initial-scale=0.5">
<link href="design.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript">
		 function date(id)
		 {
			 diff=0;
			var dat=id.value;
			var dat1=document.getElementById("isd").value;
			var cr=new Date(dat);
			var cr1=new Date(dat1);
			var diff=parseInt((cr-cr1)/(1000*60*60*24));
			dff=diff;
			if(diff<=15)
			{
				document.getElementById("alrt").innerHTML="Period : 15 days. Over Due amount Rs. 1/- per day.";
				document.getElementById("alrt1").innerHTML="";
			}
			else
			{
				dff=dff-15;
				document.getElementById("alrt").innerHTML="Over Due : " + diff + " Days";
				document.getElementById("alrt1").innerHTML="Fine Amount : <big>Rs. " + dff + "/-";
			}
		 }
		</script>
</head>
<body>
<div class="sea" style="top:510px;left:calc(50% - 0px);padding-left:100px;width:1200;height:650px">
<p class="newbook" style="top:-16px;left: calc(50% - 520px)">Return Book's</p>
<form action="" method="post">
<br>Enter USN      <input type="text" value="" title="Ex:1DS16CS433" name="sid" id="usn" pattern="1[D|d][s|S][1-9][1-9][A-Za-z][a-zA-Z][0-9][0-9][0-9]"  maxlength="10"  placeholder="Enter USN"/>   <button type="submit" class="find" name="find"/></button>					Select Book  <?php   echo"<select name='book' id='bn'> ";
		echo"<option value=''>Select Book to Return</option>";
		$sid=$_POST["sid"];
		$result= mysql_query("SELECT * FROM std where stdid = '$sid'");
				$row = mysql_fetch_array($result);
				$book=$row[5];
		$result= mysql_query("SELECT * FROM std where stdid = '$sid' and bid!='$book'");
				$row = mysql_fetch_array($result);
					$book1=$row[5];
		$result= mysql_query("SELECT name,author FROM books where bid='$book' or bid='$book1'");
		while ($row = mysql_fetch_array($result))
			{
			echo '<option value='.$row["name"].'>   '.$row["name"].'	( '.$row["author"].' )</option>';
			}
			echo '</SELECT>   <button type="submit" class="find" name="find"/></button><br>';
?>


Name             <input type="text"  id="name" readonly/>						Book Name  <input type="text"  id="book" readonly /><br/><br/>
Branch	      <input type="text"  id="b" readonly/>						 Book ID       <input type="text" name="bid"   id="bid" readonly/></br></br>
Semister	      <input type="text"  id="s" readonly/>						 Edition	    <input type="text"  id="edit" readonly/><br/><br/>
No. Book's     <input type="text" name="d" id="no" readonly>						Author	    <input type="text"   id="atr" readonly/><br/><br/>
<hr style="margIn-right:100px;COLOR:BLACK;border:1px solid black;">
Issued Date   <input type="text"  name="d" id="isd" readonly>						Return Date <input type="date" class="date" onchange="date(this)" name="rdate"/><br/><br/>
									  
									  
									  
								
								
									  <input type="submit" value="Submit" name="sbm" />	<br>	
<p id="alrt" style="color:yellow;font-weight:bold;position:absolute;top:480;left:150">Period : 15 days. Over Due amount Rs. 1/- per day.</p><p id="alrt1" style="color:yellow;font-weight:bold;position:absolute;top:480;left:850"></p></div>
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
					echo "<script type='text/javascript'>window.location='return.php';</script>";
				}
				$sname=$row[1];
				$branch=$row[2];
				$sem=$row[3];
				$result= mysql_query("SELECT count(stdid) FROM std where stdid = '$sid' and bid!='0'");
				$row = mysql_fetch_array($result);
				$c=$row[0];
			print '<script type="text/javascript">
			function sync()
			{
				n1="'.$usn.'";
				n2="'.$sname.'";
				n3="'.$branch.'";
				n4="'.$sem.'";
				n5="'.$c.'";
				document.getElementById("usn").value=n1;
				document.getElementById("name").value=n2;
				document.getElementById("b").value=n3;
				document.getElementById("s").value=n4;
				document.getElementById("no").value=n5;
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
			$result= mysql_query("SELECT * FROM std where stdid = '$sid' and bid = '$id'");
				$row = mysql_fetch_array($result);
				$dat=$row[6];
			print '<script type="text/javascript">
			function book()
			{
				n1="'.$name.'";
				n2="'.$id.'";
				n3="'.$edit.'";
				n4="'.$author.'";
				n5="'.$dat.'";
				document.getElementById("bn").value=n1;
				document.getElementById("book").value=n1;
				document.getElementById("bid").value=n2;
				document.getElementById("edit").value=n3;
				document.getElementById("atr").value=n4;
				document.getElementById("isd").value=n5;

			}
					
			 book();
			 </script>';
		}	
if(isset($_POST["sbm"]))
{	
	$dat=$_POST["d"];
	$sid=$_POST["sid"];
	$bid=$_POST["bid"];
		if($_POST["d"]=='' && $_POST["d"]==0)
			echo "<script type='text/javascript'>alert('Enter All Fields')</script>";
		else
		{
			$query=mysql_query("UPDATE books SET sts ='0' WHERE bid = '$bid'");
			$result= mysql_query("SELECT * FROM std where stdid = '$sid' and bid='$bid' ");
			$row = mysql_fetch_array($result);
			$sts=$row[8];
			if($sts==1)
			{
				$result= mysql_query("Delete FROM std where stdid = '$sid' and bid='$bid' and sts='1'");
				echo "<script type='text/javascript'>alert('Book Details Updated')</script>";
				echo "<script type='text/javascript'>window.location='return.php';</script>";
			}
			else
			{
				$result=mysql_query("UPDATE std SET bid ='0', doi ='---' WHERE stdid = '$sid' and sts=0");
				echo "<script type='text/javascript'>alert('Book Details Updated')</script>";
				echo "<script type='text/javascript'>window.location='return.php';</script>";
			}
			
		}
}
?>









		