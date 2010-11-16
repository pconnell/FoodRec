<?php
session_start();
if(!isset($_SESSION['username']))
{
		header("Location: login.php");
} 
?>
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
		//slope one recommendations
		//pick a user (typically will already be logged in)
		//find all restaurants a user has not rated 
		include("db_connect.php");
		$current_user = $_SESSION['userid'];
		//$query1 = "SELECT * FROM restaurants WHERE resID not in (SELECT resID FROM user_res WHERE userID = $current_user);";
		$resID = $_GET['id'];
		//echo "resID: ".$resID."  ";
		$query1 = "SELECT * FROM restaurants WHERE userID = $current_user and resID = $resID;";
		$results1 = mysqli_query($db,$query);
		if ($results1 == NULL){
				//unrated restaurant = x
				$first_res = $resID;
				//for each restaurant user has rated
				$query2 = "SELECT resID FROM user_res WHERE userID = $current_user;";
				$results2 = mysqli_query($db,$query2);
				//echo $results2;
				while($row2 = mysqli_fetch_array($results2)){
					//echo "in nested while ";
					//rated restaurant = y
					$second_res = $row2['resID'];
					//get the entry from res_res for x,y
					$res_res_query = "SELECT * FROM res_res WHERE res1ID = $first_res AND res2ID = $second_res;";
					$res_res_results = mysqli_query($db,$res_res_query);
					//get the entry from user_res for user,y
					$user_res_query = "SELECT * FROM user_res WHERE resID = $second_res;";
					$user_res_results = mysqli_query($db,$user_res_query);
					$num_people_query = "SELECT resA.userID, resA.resID, resB.resID, resA.userRating as resArating, resB.userRating
					as resBrating from user_res as resA join user_res as resB where resA.resID=$first_res and 				
					resB.resID=$second_res and resA.userID=resB.userID;";
					$num_people_results = mysqli_query($db,$num_people_query);
					$c = mysqli_num_rows($num_people_results);
					//echo "c: ".$c."  ";
					
					while ($rowA = mysqli_fetch_array($res_res_results) and $rowB = mysqli_fetch_array($user_res_results)){
						$deviation = $rowA['deviations'];
						//echo "deviation: ".$deviation."  ";
						$userRating = $rowB['userRating'];
						///echo "userRating: ".$userRating."  ";
						$numerator += ($deviation + $userRating) * $c;
						//echo "numerator: ".$numerator."  ";
						$denominator += $c;
						//echo "denominator: ".$denominator."  ";
						$predictedUserRating = $numerator / $denominator;
						//$rating = number_format($predictedUserRating, 2)
					}
				}
				//echo "We think you would rate this restaurant (1-5): ".$predictedUserRating;
		}
	?>
	<?php
	echo "<p><span style=\"color:red\"><b>Restaurant Profile:</B></span><br/>";
	include("header.php");
	include("db_connect.php");
	$loggedin=isset($_SESSION['userid']);
	if ($loggedin){
	$userID=$_SESSION['userid'];
	}else{
	$userID=-1;
	}
	//$band_link = "bandprofile.php?id=$bandID";
	//$bandID = $_GET['id'];
	$resID=$_GET['id'];
	$updated=$_GET['updated'];
	
	$query="select * from restaurants where resID=$resID";
	$user_res_Query="select * from user_res where userID=$userID and resID=$resID";
	$results=mysqli_query($db,$query);
	$user_res_Results=mysqli_query($db,$user_res_Query);
	$usRow=mysqli_fetch_array($user_res_Results);
	while ($row=mysqli_fetch_array($results)){
		$apost=substr($row['name'],strlen($row['name'])-2,strlen($row['name']));
		if($apost=="'s" or $apost=="'S"){
		echo "<h2>Viewing ".$row['name']." Profile:</h2><br>";
			if ($predictedUserRating != NULL)
			{
				echo "<h3>Your predicted rating is: ".$predictedUserRating."<h3><br>";
			}
		}else{
		echo "<h2>Viewing ".$row['name']."'s Profile:</h2><br>";
			if ($predictedUserRating != NULL)
			{
				echo "<h3>Your predicted rating is: ".$predictedUserRating."</h3><br>";
			}
		}
		echo "<table bgcolor='black' width=500 border=1 style=\"color:red\">";
		echo "	<tr>";
		echo "		<td>";
		echo "			<table width=250 style=\"color:red\">";
		echo "				<tr>";
		echo "					<td>";
		if ($row['picture']==NULL){
		echo "Sorry! No picture for <br><h4>".$row['name']."</h4>";	
		}else{
		echo "<img src='ResPics/".$row['picture']."' width=245 alt=\"".$row['name']."'s Logo or Picture\">";
		}
		echo "<hr>";
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
		echo "Click <a href='".$row['website']."'target='_blank'>here</a> to visit ".$row['name']."'s website.<hr width=120 color=darkred>";
		if ($loggedin){
			echo "<form method='post' action='takemehere.php?resID=$resID&userID=$userID'>";
			//echo "<form method='post' action='takemehere.php?resID=$resID&userID=$userID'>";
			echo "<p>";
			
			echo "<p><input style='display:block; margin-left:auto; margin-right:auto;' type='submit' ";
			echo "value=' Take Me Here! ' /></p></form>";
			echo "</p>\n";
			if($updated){
				echo "<fieldset style='border:2px solid red; background-color:lightblue;'>";
				echo "<p style='color:black; font-weight:bold; text-align:center;'>";
				echo "Your Information Has Been Updated!";
				echo "</p></fieldset>";
			}
		}
		echo "		</td>";
		echo "	</tr>";
		echo "</table>";
		if($loggedin){
			$frequency+=$usRow['breakfast'];
			$frequency+=$usRow['lunch'];
			$frequency+=$usRow['dinner'];
			echo "<table bgcolor='black' width=500 border=1 style=\"color:red\">";
			echo "	<tr>";
			echo "		<td>";
			//$usRow
			echo "How many times you've been here: ";
			if($frequency>0){
			echo "<font color=yellow>".$frequency."</font>";
			}else{
			echo "<br><font color=yellow> You have not been here yet.</font>";
			}
			echo "		</td>";
			echo "	</tr>";
			echo "	<tr>";
			echo "		<td>";
			echo "How you've rated this restaurant:";
			if($usRow['userRating']==0){
			echo "<br><font color=yellow>You have not rated this restaurant yet.</font>";
			}else{
			echo"<font color=yellow>".$usRow['userRating']."</font>";
			}
			echo "		</td>";
			echo "	</tr>";
			echo "</table>";
		}
		echo "<center>";
		
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
