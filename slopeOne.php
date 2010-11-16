<?php
//code for restaurant recommendation
//this calculates slope one deviations
include("db_connect.php");
$resQuery = select * from restaurants
$resResults=mysqli_query($db,$resQuery);
while($resRow1=mysqli_fetch_array($resResults)){
    $res2Query=select * from restaurants;
    $res2Results=mysqli_query($db,resQuery);
    while($resRow2=mysqli_fetch_array($res2Results)){
        if($resRow1['resID']!=$resRow2['resID']){
		
	    $query = SELECT resA.userID, resA.resID, resB.resID, resA.userRating as resArating, resB.userRating 		
		as resBrating from user_res as resA join user_res as resB where resA.resID=resRow1['resID'] and 		
		resB.resID=resRow2['resID'] and resA.userID=resB.userID;

	    $results = mysqli_query($db,$query);
	    $denominator = mysql_num_rows($results);
	    while ($row = mysqli_fetch_array($results)){
   		$numerator += $row['resArating'] - $row['resBrating'];
	    }

	    if (denominator > 0){
    		$deviation = $numerator/$denominator;
		$res_resQuery="select * from res_res where res1ID=resRow1['resID'] and res2ID=resRow2['resID'];";
		$res_num = mysql_num_rows(mysqli_query($res_resQuery));
    		if($res_num == 0){
		    $insert_query="
    		    INSERT INTO 'res_res' (res1ID,res2ID,deviations,numerator,denominator)
 			values(resRow1['resID'],resRow2['resID'],$deviation,$numerator,$denominator);";
		     $notNeeded=mysqli_query($db,$insert_query);
    	    	}else{
		    $query="UPDATE 'res_res' set 
		    'deviations' = $deviation, 
		    'numerator' = $numerator,
		    'denominator' = $denominator
		    where res_res.res1ID = resRow1['resID'] and res_res.res2ID = 'resRow2['resID'];";
    	    	}
	    }else{
    	    	//make no changes, no result to insert
	    }
    }
}

//slope one recommendations
//pick a user (typically will already be logged in)
//find all restaurants a user has not rated 
$query1 = "SELECT * FROM restaurants WHERE resID not in (SELECT resID FROM user_res WHERE userID = $current_user;";
$results1 = mysqli_query($db,$query);
while($row1 = mysqli_fetch_array($results1)){
	//unrated restaurant = x
	$first_res = $row['resID'];
	//for each restaurant user has rated
	$query2 = "SELECT resID FROM user_res WHERE userID = $current_user;";
	$results2 = mysqli_query($db,$query2);
	while($row2 = mysqli_fetch_array($results2)){
		//rated restaurant = y
		$second_res = $row2['resID'];
		//get the entry from res_res for x,y
		$res_res_query = "SELECT * FROM res_res WHERE res1ID = $first_res AND res2ID = $second_res;";
		$res_res_results = mysqli_query($res_res_query);
		//get the entry from user_res for user,y
		$user_res_query = "SELECT * FROM user_res WHERE resID = $second_res;";
		$user_res_results = mysqli_query($user_res_query);
		$num_people_query = "SELECT resA.userID, resA.resID, resb.resID, resA.userRating as resArating, resB.userRating
		as resBrating from user_res as resA join user_res as resB where resA.resID=x and 				
		resB.resID=y and resA.userID=resB.userID;";
		$num_people_results = mysqli_query($num_people_query);
		$c = mysql_num_rows($num_people_results);
		$numerator += ($res_res_results['deviations'] + $user_res_results['userRating']) * $c;
		$denominator += $c;
	//predicted rating for user = numerator / denominator;
	$predictedUserRating = 
}
?>