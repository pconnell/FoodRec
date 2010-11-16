<?php 
session_start();
if(!isset($_SESSION['username']))
{
		header("Location: login.php");
} 

include ("db_connect.php");
?>
<?php
include("db_connect.php");
include("session.php");
$resID=$_GET['resID'];
$userID=$_GET['userID'];
//$resID=1;
//$userID=1;
//echo $userID;
/*
$query="select * from restaurants where type='Casual Dining'";
		$results=mysqli_query($db,$query);
		echo"Casual Dinning Restaurants:<br>";
		while($row=mysqli_fetch_array($results)){
			if ($row['website']!=NULL){
				echo "<a href='".$row['website']."' target='_blank'>".$row['name']."</a><br>";
			}else{
				echo "<font color='white'>".$row['name']."</font>"."<br>";
			}
			echo "<a href='ResProfile.php?id=".$row['resID']."'>".$row['name']."</a><br>";
		}
*/

//<date stuff>
$day=date('l');
$day= strtolower($day);
$AMorPM=date('A');
$hour=date('G');
$minute=date('i');

//</date stuff>
//$B_L_D is break lunch or dinner.
//breakfast 0-11
//lunch 12-16
//dinner 17-23
if($hour>0 and $hour<=11){
	$B_L_D='breakfast';
}else if($hour>11 and $hour<=16){
	$B_L_D='lunch';
}else if(($hour>16)or($hour==0)){
	$B_L_D='dinner';
}
/*
if($hour>=1){
	if ($hour<11){
		$B_L_D='breakfast';
	}else if ($hour==11 and $minute==0){
		$B_L_D='breakfast';
	}
}
if($hour==11){
	if ($minute>0){
		$B_L_D='lunch';
	}	
}
if($hour>11 and $hour <17){
	if($hour=16 and $minute<31){
		$B_L_D='lunch';
	}else if($hour<16){
		$B_L_D='lunch';
	}
}
if(((($hour=16 and $minute>30)or ($hour>16)) and ($hour<24 and $minute<60))or $hour==0){
	$B_L_D='dinner';
}
*/

$query="select * from user_res where userID='$userID' and resID='$resID'";
$results=mysqli_query($db,$query);
$row=mysqli_fetch_array($results);
$newBLDCount= $row[$B_L_D] +1;
$newDayCount= $row[$day] +1;
$count=mysqli_num_rows($results);
if ($count==1){
//increment frequency by 1
/*
UPDATE  `FoodRec`.`user_res` SET  `breakfast` =  '1',
`monday` =  '1' WHERE  `user_res`.`userID` =1 AND  `user_res`.`resID` =1;

UPDATE  `FoodRec`.`user_res` SET  `lunch` =  '1',
`sunday` =  '1' WHERE  `user_res`.`userID` =1 AND  `user_res`.`resID` =1;
*/
	$update_Query="UPDATE user_res SET $B_L_D=$newBLDCount, $day=$newDayCount WHERE userID=$userID and resID=$resID; ";
	//echo $update_Query;
	$results=mysqli_query($db,$update_Query) or die(mysql_error()) ;
}else{
//create new entry and add 1 frequency to it
$insert_Query="INSERT INTO user_res (userID,resID,$B_L_D,$day)VALUES ($userID,$resID,1,1);";
echo $insert_Query;
$results=mysqli_query($db,$insert_Query) or die(mysql_error());
}
//echo "<a href='ResProfile.php?id=".$row['resID']."'>".$row['name']."</a><br>";
header( 'Location:ResProfile.php?id='.$resID.'&updated=TRUE');