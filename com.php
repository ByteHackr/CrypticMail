<?php
session_start();
$id=$_SESSION['sid'];
include_once('connection.php');

if(isset($_POST['com'])) 
{
foreach($_POST['ch'] as $v)
{

$sql=mysql_query("SELECT * FROM draft where uid='$id' and id='$v'");
while($dd=mysql_fetch_array($sql))
	{
	
	$sen=$dd['uid'];
	$sub=$dd['sub'];
	$msg=$dd['msg'];
	$att=$dd['fill'];
	
	//store into usermail table
	mysql_query("insert into usermail (rec_id,sen_id,sub,msg,attachment,date) values('','$sen','$sub','$msg','$att','')");
	
	//delete form draft
	
	mysql_query("delete from draft where uid='$id' and id='$v'");

	}
	
}
echo "<script>alert('msg send');
window.location='HomePage.php?chk=draft'</script>";
}
?>
