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
	include("db_connect.php");
	/*
	$testArray=array("first item"=>array("1"=>"one"), "second item"=>array("2"=>"two"));
	echo $testArray["first item"]["1"];
	echo $testArray["second item"]["2"];
	*/
	echo "<p><span style=\"color:red\"><b>Recommended Food:</B></span><br/>";
	include("header.php");
  		/*
  		foreach ($restaurants as $key=>$value){
  		//echo "<h1>this is a test:</h1>";
  		//echo $key;
   		//echo $tempVal["type"];
  		if ($value["type"]=="Fast Food"){
  			echo "<a href='".$value["website"]."'target='_blank'>".$key."</a><br>";
  		}
  		}
		*/
		
		$query="select * from restaurants where type='Fast Food'";
                $results=mysqli_query($db,$query);
                echo"Fast Food Restaurants:<br>";
                while($row=mysqli_fetch_array($results)){
                        /*if ($row['website']!=NULL){
                                echo "<a href='".$row['website']."' target='_blank'>".$row['name']."</a><br>";
                        }else{
                                echo "<font color='white'>".$row['name']."</font>"."<br>";
                        }*/
                        echo "<a href='ResProfile.php?id=".$row['resID']."'>".$row['name']."</a><br>";
                }

	?>
	</div>	
	
    <?php include("projectSideBar.php"); ?>
	<?php include("footer.html");?>
</div>
</div>
</body>
</html>
