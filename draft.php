<?php

session_start();
include("connect.php");

$myinbox = $_SESSION['id']."data";
$sql = mysql_query("select * from "."$myinbox"." where type='draft'");

?>
<!DOCTYPE html>
<html>
<body>

<table cellpadding="0px" width="100%" style="border-top:2px solid grey; text-align:left;">
<?php
	
while($row = mysql_fetch_array($sql))
{
	 echo "<tr><th>To: $row[1]</th><th>Cc: $row[3]</th><th>Bcc: $row[4]</th><td style=\"color:#999999; text-align:right;\">$row[7]&nbsp;&nbsp;&nbsp;$row[8]</td></tr>";
	 echo "<tr><td colspan='4' style=\"color:#999999; height:1px; overflow:hidden\"><b>Subject:</b> $row[5]</td></tr>";
	 echo "<tr><td colspan='4' style=\"color:#999999;\"><b>Message:</b> $row[6]</td></tr>";
	 echo "<tr><td colspan='4' style=\"color:#999999; border-bottom:1px solid grey;\"><b>Attachment:</b> <a href=\"link.php?filename=$row[10]\">$row[9]</a></td></tr>";
}
echo "</table>";

?>

</body>
</html>