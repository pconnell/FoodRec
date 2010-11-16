<?php 
session_start();
include("db_connect.php");
$username = $_POST["username"];
$password = $_POST["password"];
echo $username;
echo $password;
$query = "SELECT * from users WHERE username='".$username."' AND password='".($password)."'";
$result = mysqli_query($db, $query) or die(mysql_error());
$count = mysqli_num_rows($result);
if ($count == 1)
{
	$query2 = "SELECT userid from users WHERE username='".$username."'";
	$result = mysqli_query($db, $query2) or die(mysql_error());
	$row = mysqli_fetch_array($result);
	$userid = $row['userid'];
	$_SESSION['username'] = $username;
	$_SESSION['userid'] = $userid;
	header( 'Location: index.php' ) ;
	exit();
}
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
	echo "<p><span style=\"color:red\"><b>Login:</B></span><br/>";
	?>
		<FORM name="login" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
			<tr>
				<td><font color=red>Username: </font></td>
				<td><input type="text" name="username" value=""><br></td>
			</tr>
			<tr>
				<td><font color=red>Password: </font></td>
				<td><input type="password" name="password" value=""><br></td>
			</tr>
			</table>
		<br>
		<input type="submit" value=" Login " name="submit">
		</FORM>
	
	</div>	
	
    <?php include("projectSideBar.php"); ?>
	<?php include("footer.html");?>
</div>
</div>
</body>
</html>
