<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>FoodRec</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
<div id="wrap">
   	<div id="main">
  
	<?php
	/*
	$testArray=array("first item"=>array("1"=>"one"), "second item"=>array("2"=>"two"));
	echo $testArray["first item"]["1"];
	echo $testArray["second item"]["2"];
	*/
	echo "<p><span style=\"color:red\"><b>Recommended Food:</B></span><br/>";
	include("header.php");
  	
	?>
	</div>	
	
    <?php include("projectSideBar.php"); ?>
	<?php include("footer.html");?>
</div>
</div>
</body>
</html>
