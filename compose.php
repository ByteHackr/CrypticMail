<?php
session_start();
include_once('connection.php');
@$to=$_POST['to'];
@$sub=$_POST['sub'];
@$msg=$_POST['msg'];
@$file=$_FILES['file']['name'];

$id=@$_SESSION['sid'];
$send = true;


if(@$_REQUEST['send'])
{
	if($to=="" || $sub=="" || $msg=="")
	{
	$err= "fill the related data first";
	}
	
	else
	{
	$d=mysql_query("SELECT * FROM userinfo where user_name='$to'");
	$row=mysql_num_rows($d);
	if($row==1)
		{
		
$file_name = "";
if(isset($_FILES['file'])){
      $errors= array();
      $file_name = $_FILES['file']['name'];
      $file_size =$_FILES['file']['size'];
      $file_tmp =$_FILES['file']['tmp_name'];
      $file_type=$_FILES['file']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['file']['name'])));
      
      $expensions= array("jpeg","jpg","png","pdf","txt","docx");
      
      if(in_array($file_ext,$expensions)== true){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
          

      if($file_size >= 2050505){
         $send = false;
         $errors[]='File size must be excately 2 MB';
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"images/".$file_name);
         echo "Success";
mysql_query("INSERT INTO usermail (rec_id,sen_id,sub,msg,attachement,recDT) values('$to','$id','$sub','$msg','$file_name',sysdate())");
		$err= "message sent...";
      }else{
         foreach($errors as $e){
              echo $e;
          }
      }
   }
		
		}
	else
		{
		$sub=$sub."--"."msg failed";
		mysql_query("INSERT INTO usermail values('','$id','$id','$sub','$msg','',sysdate())");
		$err= "message failed...";

		}	
	}
}	


if(@$_REQUEST['save'])
{
	if($sub=="" || $msg=="")
	{
	$err= "<font color='red'>fill subject and msg first</font>";
	}
	
	else
	{
	$query="INSERT INTO draft (uid,sub,fil,msg,cdate) values('$id','$sub','$file','$msg',sysdate())";
	mysql_query($query);
	$err= "message saved...";
	}
}	



$sql=mysql_query("SELECT * FROM draft where id='$id' ");
while($dd=mysql_fetch_array($sql))
	{
	$rec=$dd['uid'];
	$sen=$dd['sid'];
	$sub=$dd['sub'];
	$msg=$dd['msg'];
	$att=$dd['fill'];
	
	//store into usermail table
	mysql_query("insert into usermail (rec_id,sen_id,sub,msg,attachment,date) values('','$sen','$sub','$msg','$att','')");
	
	//delete form draft
	
	mysql_query("delete from draft where id='$id' and id='$v'");

	}

?>
<html>

	<style>
	input[type=text]
	{
	width:200px;
	height:35px;
	}
	</style>


<body>
<form method="post" enctype="multipart/form-data">
<table width="506" border="0">
  <?php echo @$err; ?>
  <tr>
    <th width="213" height="35" scope="row">To</th>
    <td width="277">
	<input type="text" name="to" class="form-control" />	</td>
  </tr>
  <tr>
    <th height="36" scope="row">Cc</th>
    <td><input type="text" class="form-control" name="cc"/></td>
  </tr>
  <tr>
    <th height="36" scope="row">Subject</th>
    <td><input type="text" class="form-control" name="sub" value="<?php echo $sub; ?>"/></td>
  </tr>
  <tr>
    <th height="70" scope="row">upload your file</th>
    <td><input type="file" class="form-control" name="file" id="file" value="<?php echo $att; ?>"/></td>
  </tr>
  <tr>
    <th height="52" scope="row">Msg</th>
    <td><textarea rows="8" class="form-control" cols="40" name="msg" value="<?php echo $msg ?>"></textarea></td>
  </tr>
  <tr>
    <th height="35" colspan="2" scope="row">
	<input type="submit" name="send" class="btn btn-default" value="Send"/>
	<input type="submit" name="save" class="btn btn-default" value="Save"/>
	<input type="reset" value="Cancel" class="btn btn-default" />	</th>
  </tr>
</table>

</body>
</form>
</html>

