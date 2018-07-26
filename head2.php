<?php
include("dbconnection.php");
$admin=$_SESSION["admin"];
$nm=$_SESSION["nm"];
?>
<html>
<head>
<title>Library</title>
<link rel="icon" href="IMG/dsi.png"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<meta name="viewport" content="width=device-width, initial-scale=0.5">
<link href="design.css" rel="stylesheet" type="text/css"/><pre>
</head>
<body>
<img class="backg" src="IMG/back.jpg"/>
<img class="ims" src="IMG/5.png" alt="Library Management System"/>
<div class="head"><b>
<?php
 if($admin==0)
 {
echo '<a class="h2" style="border:none;padding-left:30px;">Welcome <span>';echo $nm; echo '</span></a><a class="h" href="home.php" style="border:none;padding:0;position:absolute;left:1200px;top:12">Logout</a>';
 }
else
	echo '<a class="h" href="admin.php" style="border:none;padding-left:30px;padding-right:1111px;">Back</a><a class="h" href="home.php" style="border:none;padding:0">Logout</a>';
?>
</div></b>
</body>
</html>