<?php
session_start();
$_SESSION["admin"]=0;
include("dbconnection.php");
include("head2.php");
if(!isset($_SESSION['username']) || $_SESSION['sts']==0)
{
	echo "<script type='text/javascript'>window.location='home.php';</script>";
	exit;
}
?>
<html>
<head>
<title>Library</title>
<meta name="viewport" content="width=device-width, initial-scale=0.5">
<link href="design.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div class="sea" style="top:410px;left:calc(50% - 0px);padding-left:100px;width:1200;height:455px">
<div class="ad">
<div class="s1"><a href="book.php"><img src="IMG/books.png" width="160" height="160"/></a></div>
<div class="s2"><a href="std.php"><img src="IMG/std.png" width="160" height="160"/></a></div>
<div class="s3"><a href="search.php"><img src="IMG/sea1.png" width="160" height="160"/></a></div>
<div class="s4"><a href="issue.php"><img src="IMG/bk3.png" width="160" height="160"/></a></div>
<div class="s5"><a href="return.php"><img src="IMG/bk2.png" width="160" height="160"/></a></div>
<div class="s6"><a href="booklist.php"><img src="IMG/bk1.png" width="160" height="160"/></a></div>
<p class="c1"><b>Add New Book</p>
<p class="c2">Add Student</p>
<p class="c3"> Search</p>
<p class="c4"> Issue Book</p>
<p class="c5"> Return Book</p>
<p class="c6"> Books List</b></p>
</div>
</div>
</body>
</html>