<html>
<body>
<?php
include('connection.php')?
if(isset($_GET['mail_id']))
{
$id=$_GET['mail_id']?
if(isset($_POST['submit']))
{
$to=$_POST['to']?
$sub=$_POST['subject']?
$att=$_POST['attachment'];
$mess=$_POST['message'];
$query3=mysql_query("update usermail set rec_id='$to',sub='$sub',attachment='$att',msg='$mess' where mail_id='$id'")?
if($query3)
{
header('location:header.php')?
}
}
$query1=mysql_query("select * from usermail where mail_id='$id'")?
$query2=mysql_fetch_array($query1)?
?>
<form method="post" enctype="multipart/form-data">
<table width="506" border="0">
  <?php echo @$err; ?>
  <tr>
    <th width="213" height="35" scope="row">To</th>
    <td width="277">
	<input type="text" name="to" class="form-control" value="<?php echo $query2['to']? ?>" />	</td>
  </tr>
  <tr>
    <th height="36" scope="row">Cc</th>
    <td><input type="text" class="form-control" name="cc"
value="<?php echo $query2['cc']? ?>"/></td>
  </tr>
  <tr>
    <th height="36" scope="row">Subject</th>
    <td><input type="text" class="form-control" name="sub"
value="<?php echo $query2['sub']? ?>" /></td>
  </tr>
  <tr>
    <th height="70" scope="row">upload your file</th>
    <td><input type="file" class="form-control" name="file" 
value="<?php echo $query2['file']? ?>" id="file"/></td>
  </tr>
  <tr>
    <th height="52" scope="row">Msg</th>
    <td><textarea rows="8" class="form-control" cols="40" name="msg" value="<?php echo $query2['msg']? ?>"/></textarea></td>
  </tr>
  <tr>
    <th height="35" colspan="2" scope="row">
	<input type="submit" name="send" class="btn btn-default" value="update"/>
	
  </tr>
</table>
</form>
<?php
}
?>
</body>
</html>
