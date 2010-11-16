<HTML>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title></title>
  <!--<link rel="stylesheet" type="text/css" href="style.css" />-->
</head>
<body link='yellow' alink='yellow' vlink='yellow'>
	<?php
	if(isset($_SESSION['username'])){
		echo "Hello <font color=yellow>".$_SESSION['username']."</font>";
		echo " |(<a href=logout.php>Logout</a>)";
	}
	?>
	<br><a href="index.php">Main Page</a><br>
	<a href="CasualDining.php">Casual Dining</a>
	|
	<a href="FastFood.php">Fast Food</a>
	|
	<a href="FineDining.php">Fine Dining</a>
	|
	<a href="FamilyDining.php">Family Dining</a>
	|
	<a href="http://en.wikipedia.org/wiki/Pearson_product-moment_correlation_coefficient" target="_blank">F***ing Pearson's</a>
	|
	<a href="Cafe.php">Cafe</a>
	|
	<br>
</body>
</html>
