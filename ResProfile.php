<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>FoodRec | Restaurant Profile</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
<div id="wrap">
   	<div id="main">
  
	<?php
	include("header.php");
	include("db_connect.php");
	//$band_link = "bandprofile.php?id=$bandID";
	//$bandID = $_GET['id'];
	$resID=$_GET['id'];
	
	$query="select * from restaurants where resID=$resID";
	$results=mysqli_query($db,$query);
	while ($row=mysqli_fetch_array($results)){
		echo "<h2>Viewing ".$row['name']."'s Profile:</h2><br>";
		echo "<table width=500 border=1 style=\"color:red\">";
		echo "	<tr>";
		echo "		<td>";
		echo "			<table width=250 style=\"color:red\">";
		echo "				<tr>";
		echo "					<td>";
		echo $row['name']."'s Pic Here<br><hr>";
		echo "					</td>";
		echo "				</tr>";
		echo "				<tr>";
                echo "                                  <td>";
		if ($row['rating']==NULL){
		echo $row['name']." Has yet to be rated!";
		}else{
		echo $row['name']."'s Rating is: ".$row['rating'];;
		}
                echo "                                  </td>";
		echo "				</tr>";
		echo "			</table>";
		echo "		</td>";
		echo "		<td>";
		echo $row['name']." is a <font color=yellow><br>".$row['type']." Restaurant</font><hr width=120 color=darkred>";
		if($row['']!=NULL){
		   echo "Price Rating (1-5):<font color=yellow> ".$row['price']."</font><hr width=120 color=darkred>";
		}else{
		   echo "Price Rating (1-5); <font color=yellow>Not Rated!</font><hr width=120 color=darkred>";
		}
		echo "Do they serve Alchohol?:";
		if($row['alcohol']==1){
		   echo"<font color=yellow> Yes.</font><hr width=120 color=darkred>";
		}else{
		   echo"<font color=yellow> No.</font><hr width=120 color=darkred>";
		}
		echo "Click <a href='".$row['website']."'target='_blank'>here</a> to visit ".$row['name']."'s website";
		echo "		</td>";
		echo "	</tr>";
		echo "</table>";
	}

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
