<?php

session_start();
//$uname = $_COOKIE['id'];
$uname = $_SESSION['id'];
include("connect.php");
mysql_query("create view mybin as select cc,sender,subject,content from myinbox where receiver='$uname'");
$que = mysql_query("select * from mybin");

?>
<!DOCTYPE html>
<html>
<body>
	<form method="post" action="">
		<input type="checkbox" name="selectall"/>&nbsp;&nbsp;<input type="submit" name="deleteall" value="Delete All"/>
	</form>
	<table border="1" rules="all" cellpadding="10px" width="100%" align="center">
		<tr><th></th><th>Cc</th><th>From</th><th>Subject</th><th>Message</th></tr>
<?php
	
while($row = mysql_fetch_array($que))
{
	 echo "<tr><td><input type=\"checkbox\"></td><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td></tr>";
}
echo "</table>";
w
if(isset($_POST['deleteall']))
{	
$uname = $_COOKIE['id'];
$sql1 = mysql_query("DELETE FROM mybin WHERE receiver='$uname'");

}

?>

</body>

</html>