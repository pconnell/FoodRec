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
		$restaurants=array("TGI Fridays"=>array("type"=>"Casual Dining", "price"=>"", "rating"=>"", "website"=>"http://www.tgifridays.com","alcohol"=>""),
					   "McDonalds"=>array("type"=>"Fast Food", "price"=>"2", "rating"=>"", "website"=>"http://www.mcdonalds.com","alcohol"=>""),
					   "Burger King"=>array("type"=>"Fast Food", "price"=>"2", "rating"=>"", "website"=>"http://www.bk.com","alcohol"=>""),
					   "Pizza Hut"=>array("type"=>"Casual Dining", "price"=>"3", "rating"=>"", "website"=>"http://www.pizzahut.com","alcohol"=>""),
					   "Subway"=>array("type"=>"Fast Food", "price"=>"3", "rating"=>"", "website"=>"http://www.subway.com","alcohol"=>""),
					   "Applebees"=>array("type"=>"Casual Dining", "price"=>"4", "rating"=>"", "website"=>"http://www.applebees.com","alcohol"=>""),
					   "Chili's"=>array("type"=>"Casual Dining", "price"=>"4", "rating"=>"", "website"=>"http://www.chilis.com","alcohol"=>""),
					   "Taco Bell"=>array("type"=>"Fast Food", "price"=>"2", "rating"=>"", "website"=>"http://www.tacobell.com","alcohol"=>""),
					   "IHOP"=>array("type"=>"Casual Dining", "price"=>"3", "rating"=>"", "website"=>"http://www.ihop.com","alcohol"=>""),
					   "Dave and Buster's"=>array("type"=>"Casual Dining", "price"=>"4", "rating"=>"", "website"=>"http://daveandbusters.com","alcohol"=>""),
					   "Buffalo Wild Wings"=>array("type"=>"Casual Dining", "price"=>"4", "rating"=>"", "website"=>"http://buffalowildwings.com","alcohol"=>""),
					   "Five Guys"=>array("type"=>"Fast Food", "price"=>"3", "rating"=>"", "website"=>"http://fiveguys.com","alcohol"=>""),
					   "Asia Bistro"=>array("type"=>"Casual Dining", "price"=>"3", "rating"=>"", "website"=>"","alcohol"=>""),
					   "Panera Bread"=>array("type"=>"Cafe", "price"=>"2", "rating"=>"", "website"=>"http://www.panerabread.com","alcohol"=>""),
					   "Kentucky Fried Chicken"=>array("type"=>"Fast Food", "price"=>"2", "rating"=>"", "website"=>"http://kfc.com","alcohol"=>""),
					   "Chipotle"=>array("type"=>"Fast Food", "price"=>"3", "rating"=>"", "website"=>"http://chipotle.com","alcohol"=>""),
					   "Domino's"=>array("type"=>"Fast Food", "price"=>"3", "rating"=>"", "website"=>"http://dominos.com","alcohol"=>""),
					   "Little Caesar's"=>array("type"=>"Fast Food", "price"=>"2", "rating"=>"", "website"=>"http://littlecaesars.com","alcohol"=>""),
					   "Papa John's"=>array("type"=>"Fast Food", "price"=>"3", "rating"=>"", "website"=>"http://papajohns.com","alcohol"=>""),
					   "Sheetz"=>array("type"=>"Fast Food", "price"=>"2", "rating"=>"", "website"=>"http://www.sheetz.com","alcohol"=>""),
					   "WaWa"=>array("type"=>"Fast Food", "price"=>"2", "rating"=>"", "website"=>"http://www.wawa.com","alcohol"=>""),
					   "Dunkin' Donuts"=>array("type"=>"Fast Food", "price"=>"2", "rating"=>"", "website"=>"http://www.dunkindonuts.com","alcohol"=>""),
					   "Starbucks"=>array("type"=>"Cafe", "price"=>"2", "rating"=>"", "website"=>"http://www.starbucks.com","alcohol"=>""),
					   "Allman's Barbecue"=>array("type"=>"Fast Food", "price"=>"2", "rating"=>"", "website"=>"http://www.allmansbarbecue.com","alcohol"=>""),
					   "Wendy's"=>array("type"=>"Fast Food", "price"=>"2", "rating"=>"", "website"=>"http://www.wendys.com","alcohol"=>""),
					   "Outback Steakhouse"=>array("type"=>"Casual Dining", "price"=>"5", "rating"=>"", "website"=>"http://www.outback.com","alcohol"=>""),
					   "Olive Garden"=>array("type"=>"Casual Dining", "price"=>"5", "rating"=>"", "website"=>"http://olivegarden.com","alcohol"=>""),
					   "The Melting Pot"=>array("type"=>"Fine Dining", "price"=>"5","rating"=>"","website"=>"http://www.meltingpot.com","alchohol"=>""),
					   "CiCi's"=>array("type"=>"Family Dining", "price"=>"2","rating"=>"","website"=>"http://cicis.com","alchohol"=>"")
					   );
	/*
	$testArray=array("first item"=>array("1"=>"one"), "second item"=>array("2"=>"two"));
	echo $testArray["first item"]["1"];
	echo $testArray["second item"]["2"];
	*/
	echo "<p><span style=\"color:red\"><b>Recommended Food:</B></span><br/>";
	include("header.php");
  	
  		foreach ($restaurants as $key=>$value){
  		//echo "<h1>this is a test:</h1>";
  		//echo $key;
   		//echo $tempVal["type"];
  		if ($value["type"]=="Family Dining"){
  			echo "<a href='".$value["website"]."'target='_blank'>".$key."</a><br>";
  		}
  		}
	?>
	</div>	
	
    <?php include("projectSideBar.php"); ?>
	<?php include("footer.html");?>
</div>
</div>
</body>
</html>
