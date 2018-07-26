<?php
session_start();
include("dbconnection.php");
include("head.php");
?>
<html>
<head>
<title>Library</title>
<meta name="viewport" content="width=device-width, initial-scale=0.5">
<link href="design.css" rel="stylesheet" type="text/css"/><pre>
</head>
<body>
<div class="sea">
<div class="image">
	<img class="mystyle" src="IMG/44.jpg" width="900px" height="500px"/>
	<img class="mystyle" src="IMG/22.jpg" width="900px" height="500px"/>
	<img class="mystyle" src="IMG/33.jpg" width="900px" height="500px"/>
	<img class="mystyle" src="IMG/55.png" width="900px" height="500px"/>
</div></div>


<script>
var myid=0;
car();
function car()
{
	var i;
	var x=document.getElementsByClassName("mystyle");
	for(i=0;i<x.length;i++)
	{
		x[i].style.display="none";
	}
	myid++;
	if(myid>x.length)
	{
	myid=1}
	x[myid-1].style.display="block";
	setTimeout(car,2000);
}
</script>
</body>
</html>
