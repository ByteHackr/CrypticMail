
<?php
include_once('connection.php');

$id=$_SESSION['sid'];


$sql="SELECT * FROM draft where uid='$id'";
$dd=mysql_query($sql);

echo "<div style='margin-left:10px;width:640px;height:auto;border:0px solid red;'>";

	echo "<table border='0' width='640'>";
	echo "<tr><th>Subject </th><th>Attachement </th><th>Message</th><th>Date</th></tr>";
while(list($did,$u_id,$sub,$file,$msg,$date)=mysql_fetch_array($dd))
{
	echo "<tr>";
echo "<form action='compose.php' method='post'>";


	echo "<td><a href='compose.php'>".$sub."</a></td>";
	echo "<td>".$file."</td>";
	echo "<td>".$msg."</td>";
	echo "<td>".$date."</td>";
	echo "<td><a href='compose.php'>EDIT</a></td>";
	echo "</tr>";	
	}
	echo "</table>";
echo "</div>";
echo "</form>";
echo "</div>";
echo "</form>";

?>
