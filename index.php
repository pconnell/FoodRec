<?php 
session_start();
if(!isset($_SESSION['username']))
{
		header("Location: login.php");
} 

include ("db_connect.php");
?>

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
//code for restaurant recommendation
//this calculates slope one deviations
include("db_connect.php");
$resQuery = "select * from restaurants;";
$resResults=mysqli_query($db,$resQuery);
while($resRow1=mysqli_fetch_array($resResults)){
    $res2Query= "select * from restaurants;";
    $res2Results=mysqli_query($db,$resQuery);
	//echo "in first while ";
    while($resRow2=mysqli_fetch_array($res2Results)){
		$numerator = 0;
		$denominator = 0;
		//echo "in second while ";
        if($resRow1['resID']!=$resRow2['resID']){
			$entered_if = 1;
			//echo "resrow1: ".$resRow1['resID']."  ";
			//echo "resrow2: ".$resRow2['resID']."  ";
			$resRow1calc = $resRow1['resID'];
			$resRow2calc = $resRow2['resID'];
			$query = "SELECT resA.userID, resA.resID, resB.resID, resA.userRating as resArating, resB.userRating 		
				as resBrating from user_res as resA join user_res as resB where resA.resID=$resRow1calc and 		
				resB.resID=$resRow2calc and resA.userID=resB.userID;";

			$results = mysqli_query($db,$query);
			$denominator = mysqli_num_rows($results);
			//if ($denominator != 0){
				//echo "denominator: ".$denominator."\n";}
			while ($row = mysqli_fetch_array($results)){
				$numerator += $row['resArating'] - $row['resBrating'];
				//echo "resArating: ".$results;
			}
			/*if ($denominator != 0){
				echo "resAID: ".$resRow1calc."  ";
				echo "resBID: ".$resRow2calc."  ";
				echo "denominator:".$denominator."  ";
				echo "numerator: ".$numerator."  ";}*/
			if ($denominator > 0){
				$deviation = $numerator/$denominator;
				//echo "deviation: ".$deviation." ";
				//$res_resQuery="select * from res_res where res1ID=resRow1['resID'] and res2ID=resRow2['resID'];";
				//$res_num = mysqli_num_rows($res_resQuery);
				//echo "res_num: ".$res_num."  ";
				$res_num = 0;
				if($res_num == 0){
					//echo "in second nested if\n";
					$insert_query="INSERT INTO res_res (res1ID,res2ID,deviations,numerator,denominator)
					values($resRow1calc,$resRow2calc,$deviation,$numerator,$denominator);";
					$notNeeded=mysqli_query($db,$insert_query);
    	    	}else{
					$query="UPDATE 'res_res' set 
					'deviations' = $deviation, 
					'numerator' = $numerator,
					'denominator' = $denominator
					where res_res.res1ID = resRow1['resID'] and res_res.res2ID = 'resRow2['resID'];";
    	    	}
			}
	    }else{
			//echo "herp derp\n";
    	    	//make no changes, no result to insert
	    }
    }
}
?>
	<?php
	/*
	$testArray=array("first item"=>array("1"=>"one"), "second item"=>array("2"=>"two"));
	echo $testArray["first item"]["1"];
	echo $testArray["second item"]["2"];
	*/
	//<Initial Array>

	//""=>array("type"=>"", "price"=>"", "rating"=>, "website"=>"http://"),
	//</Initial Array>
	echo "<p><span style=\"color:red\"><b>Recommended Food:</B></span><br/>";
	include("header.php");
	//include("db_connect.php");
	//echo "userid= ".$_SESSION['userid'];
	//echo "username= ".$_SESSION['username'];
	/*
	$query="select * from restaurants";
	$results=mysqli_query($db,$query);
	echo"<h1>Names:";
	while ($row=mysqli_fetch_array($results)){
		echo $row['name']."<br>";
	}
  	echo "</h1>";
	*/

	?>
	<!--
	<table bgcolor=grey>
	<tr>
		<td><image src="image.gif" alt="tgif image" height=100 width=200></image></td>
		<td><font color=black><b>This is a test food place picture! Eat here!</b></font></td>
	</tr>
	</table>
	-->
	</div>	
	
    <?php include("projectSideBar.php"); ?>
	<?php include("footer.html");?>
</div>
</div>
</body>
</html>
