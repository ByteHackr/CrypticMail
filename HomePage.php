<?php
session_start();
if($_SESSION['sid']=="")
{
header('Location:index.php');
}
$id=$_SESSION['sid'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">


<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Cryptic Mail</title>
<style>
	a{text-decoration:none}
	a:hover{ background-color:#00CC66}
	#atop{margin-left:50}
</style>

<link  sizes="57x57" href="img/favicons/icon.png">
	<link  sizes="60x60" href="img/favicons/icon.png">
	
	<link rel="manifest" href="img/favicons/manifest.json">
	<link rel="shortcut icon" href="img/favicons/icon.png">
	<meta name="msapplication-TileColor" content="#00ff1e">
	<meta name="msapplication-config" content="img/favicons/browserconfig.xml">
	<meta name="theme-color" content="#ffffff">
	<!-- Normalize -->
	<link rel="stylesheet" type="text/css" href="css/normalize.css">
	<!-- Bootstrap -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<!-- Owl -->
	<link rel="stylesheet" type="text/css" href="css/owl.css">
	<!-- Animate.css -->
	<link rel="stylesheet" type="text/css" href="css/animate.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.1.0/css/font-awesome.min.css">
	<!-- Elegant Icons -->
	<link rel="stylesheet" type="text/css" href="fonts/eleganticons/et-icons.css">
	<!-- Main style -->
	<link rel="stylesheet" type="text/css" href="css/cardio.css">
	
</head>



<body>
<header id="intro" style="height:100px;">
		<div class="container">
			<div class="table">
				<div class="header-text">
					<div class="row">
						<div class="col-md-12 text-center">
							<nav class="navbar">
		<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><img src="img/icon.png" data-active-url="img/icon.png" alt=""></a>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right main-nav">
					
		<a style="margin-left:50px"  href="HomePage.php?chk=chngPass">CHANGE PASSWORD</a>
		
		<a style="margin-left:50px" href="HomePage.php?chk=vprofile">EDIT YOUR PROFILE</a>
		
		<a style="margin-left:50px" href="HomePage.php?chk=logout">LOGOUT</a>
				</ul>
			</div>
			<!-- /.navbar-collapse -->
		</div>
		<!-- /.container-fluid -->
	</nav>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
<table width="975" border="0" align="center" style="background-image:url('theme/<?php
		@$conTheme=$_REQUEST['conTheme'];
		if($conTheme)
		{
			$fo=fopen("userImages/$id/theme","w");
			fwrite($fo,$conTheme);
		}
			@$f=fopen("userImages/$id/theme","r");
			@$fr=fread($f, filesize("userImages/$id/theme"));
			echo $fr;
			?>');">
  
  <tr>
    <td height="115" colspan="3" align="center">
	<div  style="float:left;">
	<?php
	include_once('connection.php');
	error_reporting(1);
	
	$chk=$_GET['chk'];
	if($chk=="logout")
	{
	unset($_SESSION['sid']);
	header('Location:index.php');
	}
	$r=mysql_query("select * from userinfo where user_name='{$_SESSION['sid']}'");
	
	$row=mysql_fetch_object($r);
	@$file=$row->image;
	//echo $file;
	
?></div>
	
	 <div style="float:left;margin-left:300px;padding-top:40px;font-size:25px;text-align:center;color:#00CC66"> Welcome <?php  echo @$_SESSION['sid'];?>
	 </div>
 	  </td>
  </tr>

  <tr>
    <td width="158" height="572" valign="top">
	<?php echo "<img alt='image not upload' src='userImages/$id/$file' height='80' width='80'/>"; ?>
	<div style="margin-top:50px"><a href="HomePage.php?chk=compose">COMPOSE</a><br/><br/>
	<a href="HomePage.php?chk=inbox">INBOX</a><br/><br/>
	<a href="HomePage.php?chk=sent">SENT</a><br/><br/>
	<a href="HomePage.php?chk=trash">TRASH</a><br/><br/>
	<a href="HomePage.php?chk=draft">DRAFT</a>
	
	</div>
	</td>
    <td width="660" valign="top">
			
			
		<?php
		@$id=$_SESSION['sid'];
		@$chk=$_REQUEST['chk'];
			if($chk=="vprofile")
			{
			include_once("editProfile.php");
			}
			if($chk=="compose")
			{
			include_once('compose.php');
			}
			if($chk=="sent")
			{
			include_once('sent.php');
			}
			if($chk=="trash")
			{
			include_once('trash.php');
			}
			if($chk=="inbox")
			{
			include_once('inbox.php');
			}
			if($chk=="setting")
			{
			include_once('setting.php');
			}
			if($chk=="chngPass")
			{
			include_once('chngPass.php');
			}
			if($chk=="draft")
			{
			include_once('draft.php');
			}
			if($chk=="updnews")
			{
			include_once('latestupd.php');
			}
			
		?>
		
		<!--inbox -->
		
		<?php
		$id=$_SESSION['sid'];
		@$coninb=$_GET['coninb'];

	//POP3 DOWNLOAD VIEW MAIL FROM SERVER		

			if($coninb)
			{
			$sql="SELECT * FROM usermail where rec_id='$id' and mail_id='$coninb'";
$dd=mysql_query($sql);
			$row=mysql_fetch_object($dd);
			echo "Subject :".$row->sub."<br/>";
			echo "Message :".$row->msg."<br>";
			if($row->attachement != null) {
                echo "<a href='images/".$row->attachement."' download>Download</a>";

}
			}
			
			
	@$cheklist=$_REQUEST['ch'];
	if(isset($_GET['delete']))
	{
		foreach($cheklist as $v)
		{
		
		$d="DELETE from usermail where mail_id='$v'";
		mysql_query($d);
		}
		echo "msg deleted";
	}

	?>
		
		
		
	<!--sent box-->
	<?php
		$id=$_SESSION['sid'];
		@$consent=$_GET['consent'];
			
			if($consent)
			{
			$sql="SELECT * FROM usermail where sen_id='$id' and mail_id='$consent'";
			$dd=mysql_query($sql);
			$row=mysql_fetch_object($dd);
			echo "Subject :".$row->sub."<br/>";
			echo "Message :".$row->msg;
			}
			
			
	@$cheklist=$_REQUEST['ch'];
	if(isset($_GET['delete']))
	{
		foreach($cheklist as $v)
		{
		$d="DELETE from usermail where mail_id='$v'";
		mysql_query($d);
		}
		echo "msg deleted";
	}

	?>	
	
<!----draft---->

	<?php
		$id=$_SESSION['sid'];
		@$condraft=$_GET['condraft'];
			
			if($condraft)
			{
			$sql="SELECT sub,msg from draft where uid='$id'";
			$dd=mysql_query($sql);
			$row=mysql_fetch_object($dd);
			echo "Subject :".$row->sub."<br/>";
			echo "Message :".$row->msg;
			}
			
			
	@$cheklist=$_REQUEST['ch'];
	if(isset($_GET['delete']))
	{
		foreach($cheklist as $v)
		{
		$d="DELETE from draft where uid='$v'";
		mysql_query($d);
		}
		echo "msg deleted";
	}

	@$cheklist=$_REQUEST['ch'];
	if(isset($_GET['com']))
	{
		foreach($cheklsist as $v)
		{
		$d="INSERT from draft where uid='$v'";
		mysql_query($d);
		}
		echo "msg ins";
	}

	
	
			
		?>	
	
	</td>
    <td width="135">&nbsp;</td>
  </tr>
  <tr>
    <td height="47" colspan="3">
	</td>
  </tr>
  
</table>

</body>
</html>

