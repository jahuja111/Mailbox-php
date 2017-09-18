<?php

include("function.php");
if(logged() == false)
{
	header("Location:index.php");
	exit();
}
if(isset($_POST['submit']))
{
	$to = strtolower(htmlentities($_POST['to']));
	$offset = 0;//removal of .(dot) from the 'to'
			if( !empty($_POST['to']) )
			{
				while( $str_pos = strpos($to, '.', $offset) )
				{
					$offset = $str_pos;
					$to = substr_replace($to, "", $str_pos, 1);
				}
				$len = strlen($to);//trimming 'to' string before @(at) symbol
				while( $strpos = strpos($to, "@", 0) ){
					$to = substr_replace($to, "", $strpos, $len-$strpos);
				}
			}
			
	$from = htmlentities($_SESSION['id']);
	
	$cc = strtolower(htmlentities($_POST['cc']));
	$offset = 0;//removal of .(dot) from the 'cc'
			if( !empty($_POST['cc']) )
			{
				while( $str_pos = strpos($cc, '.', $offset) )
				{
					$offset = $str_pos;
					$cc = substr_replace($cc, "", $str_pos, 1);
				}
				$len = strlen($cc);//trimming 'cc' string before @(at) symbol
				while( $strpos = strpos($cc, "@", 0) ){
					$cc = substr_replace($cc, "", $strpos, $len-$strpos);
				}
			}
	$bcc = strtolower(htmlentities($_POST['bcc']));
	$offset = 0;//removal of .(dot) from the 'bcc'
			if( !empty($_POST['bcc']) )
			{
				while( $str_pos = strpos($bcc, '.', $offset) )
				{
					$offset = $str_pos;
					$bcc = substr_replace($bcc, "", $str_pos, 1);
				}
				$len = strlen($bcc);//trimming 'bcc' string before @(at) symbol
				while( $strpos = strpos($bcc, "@", 0) ){
					$bcc = substr_replace($bcc, "", $strpos, $len-$strpos);
				}
			}
			
	$subject = htmlentities($_POST['subject']);
	$message = htmlentities($_POST['message']);
	$time = date("H:i:s:a",time()+12600);
	$date = date("Y-m-d",time()+12600);
	$inbox = "$to"."data";
	$sentbox = "$from"."data";
	$incc = "$cc"."data";
	$inbcc = "$bcc"."data";
	$file = $_FILES['upload'];
	$link = $file['name'];
	$tmp = $file['tmp_name'];
	$local = 'upload/'.$link;
	move_uploaded_file($tmp,$local);
	
	mysql_query("create table inbox(rec varchar(200),send varchar(200),cc varchar(200),bcc varchar(200),subject varchar(500),txt varchar(5000),time varchar(20),date varchar(20),link varchar(300),local varchar(300))");
	if(!empty($to)){
		mysql_query("create table "."$inbox"."(type varchar(10),rec varchar(200),send varchar(200),cc varchar(200),bcc varchar(200),subject varchar(500),txt varchar(5000),time varchar(20),date varchar(20),link varchar(300),local varchar(300))");
	}
	else{
		echo "<script>alert('Please enter 'To:' field')</script>";
	}
	mysql_query("create table "."$sentbox"."(type varchar(10),rec varchar(200),send varchar(200),cc varchar(200),bcc varchar(200),subject varchar(500),txt varchar(5000),time varchar(20),date varchar(20),link varchar(300),local varchar(300))");
	if(!empty($cc)){
		mysql_query("create table "."$incc"."(type varchar(10),rec varchar(200),send varchar(200),cc varchar(200),bcc varchar(200),subject varchar(500),txt varchar(5000),time varchar(20),date varchar(20),link varchar(300),local varchar(300))");
		mysql_query("insert into "."$incc"." values('inbox','$cc','$from','$to','','$subject','$message','$time','$date','$link','$local')");
	}
	if(!empty($bcc)){
		mysql_query("create table "."$inbcc"."(type varchar(10),rec varchar(200),send varchar(200),cc varchar(200),bcc varchar(200),subject varchar(500),txt varchar(5000),time varchar(20),date varchar(20),link varchar(300),local varchar(300))");
		mysql_query("insert into "."$inbcc"." values('inbox','$bcc','$from','','','$subject','$message','$time','$date','$link','$local')");
	}
	
	mysql_query("insert into inbox values('$to','$from','$cc','$bcc','$subject','$message','$time','$date','$link','$local')") or die('err0');
	mysql_query("insert into "."$inbox"." values('inbox','$to','$from','$cc','$bcc','$subject','$message','$time','$date','$link','$local')") or die('err1');
	mysql_query("insert into "."$sentbox"." values('sentbox','$to','$from','$cc','$bcc','$subject','$message','$time','$date','$link','$local')") or die('err2');
}	
if(isset($_POST['draft']))
{
	$to = strtolower(htmlentities($_POST['to']));
	$offset = 0;//removal of .(dot) from the 'to'
			if( !empty($_POST['to']) )
			{
				while( $str_pos = strpos($to, '.', $offset) )
				{
					$offset = $str_pos;
					$to = substr_replace($to, "", $str_pos, 1);
				}
				$len = strlen($to);//trimming 'to' string before @(at) symbol
				while( $strpos = strpos($to, "@", 0) ){
					$to = substr_replace($to, "", $strpos, $len-$strpos);
				}
			}
			
	$from = htmlentities($_SESSION['id']);
	
	$cc = strtolower(htmlentities($_POST['cc']));
	$offset = 0;//removal of .(dot) from the 'cc'
			if( !empty($_POST['cc']) )
			{
				while( $str_pos = strpos($cc, '.', $offset) )
				{
					$offset = $str_pos;
					$cc = substr_replace($cc, "", $str_pos, 1);
				}
				$len = strlen($cc);//trimming 'cc' string before @(at) symbol
				while( $strpos = strpos($cc, "@", 0) ){
					$cc = substr_replace($cc, "", $strpos, $len-$strpos);
				}
			}
	$bcc = strtolower(htmlentities($_POST['bcc']));
	$offset = 0;//removal of .(dot) from the 'bcc'
			if( !empty($_POST['bcc']) )
			{
				while( $str_pos = strpos($bcc, '.', $offset) )
				{
			 		$offset = $str_pos;
					$bcc = substr_replace($bcc, "", $str_pos, 1);
				}
				$len = strlen($bcc);//trimming 'bcc' string before @(at) symbol
				while( $strpos = strpos($bcc, "@", 0) ){
					$bcc = substr_replace($bcc, "", $strpos, $len-$strpos);
				}
			}
			
	$subject = htmlentities($_POST['subject']);
	$message = htmlentities($_POST['message']);
	$time = date("H:i:s:a",time()+12600);
	$date = date("Y-m-d",time()+12600);
	$draft = "$from"."data";
	$file = $_FILES['upload'];
	$link = $file['name'];
	$tmp = $file['tmp_name'];
	$local = 'upload/'.$link;
	move_uploaded_file($tmp,$local);
	
	mysql_query("create table draft(rec varchar(200),send varchar(200),cc varchar(200),bcc varchar(200),subject varchar(500),txt varchar(5000),time varchar(20),date varchar(20),link varchar(300),local varchar(300))");
	mysql_query("create table "."$draft"."(type varchar(10),rec varchar(200),send varchar(200),cc varchar(200),bcc varchar(200),subject varchar(500),txt varchar(5000),time varchar(20),date varchar(20),link varchar(300),local varchar(300))");

	mysql_query("insert into draft values('$to','$from','$cc','$bcc','$subject','$message','$time','$date','$link','$local')");
	mysql_query("insert into "."$draft"." values('draft','$to','$from','$cc','$bcc','$subject','$message','$time','$date','$link','$local')");
}

?>
<!DOCTYPE html>
<html>
<head>
<title>MailBox</title>
<meta charset="utf-8" />
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="stylesheet" type="text/css" href="css/css2.css">
</head>

<body>
	<div id="mainbody">
		
		<div id="wrapper">
			
			<div id="header">
				<div class="logo"><a href="index.php"><img src="images/logo.png"  alt="Logo" id="logop" height="79.2px" width="316.8px"/></a></div>
				<div class="name"><p>Mail Box</p></div>
			</div>
			
			<div id="center">
				<div class="left">
					<div class="compose">
						<span class="comphead">&nbsp;&nbsp;Compose Message</span>
						<br>
						<form action="" method="post" class="form" enctype="multipart/form-data">
						<table>
							<tr><input type="text" name="to" placeholder="To:" autocomplete="off"/></tr>
							<tr><input type="text" name="cc" placeholder="Cc:" autocomplete="off"/></tr>
							<tr><input type="text" name="bcc" placeholder="Bcc:" autocomplete="off"/></tr>
							<tr><input type="text" name="subject" placeholder="Subject:" autocomplete="off"/></tr>
							<tr><input type="text" name="message" class="cont" placeholder="Message Content Here..." autocomplete="off"/></tr>
							<tr>&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="Send" onClick="alert('Message Sent')"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="draft" value="Save As Draft" onClick="alert('Message Saved As Draft !')"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="file" name="upload"/></tr>
						</table>
						</form>
					</div>
				</div>
				
				<div class="right">
					<span class="pro">&nbsp;&nbsp;<img src="images/account.png" height="42px" width="42px"/></span>
					<br>
					<ul>
						<li><a href="inbox.php" target="frame">Inbox</a></li>
						<li><a href="outbox.php" target="frame">Sentbox</a></li>
						<li><a href="draft.php" target="frame">Draft</a></li>
						<li><a href="bin.php" target="frame">Bin</a></li>
						<li><a href="logout.php">Logout</a></li>
					</ul>
					<h3 align="center">Welcome, <?php echo $_SESSION['uname'];?></h3><br>
					<iframe src="inbox.php" name="frame" height="500px" width="620px" style="margin-left:12px"></iframe>
				</div>
			</div>
			
			<div id="footer">
				<br>
				<p style="float:left; margin-left:400px;"><b><span id="copy">&copy;</span></b></p>
				<p style="float:left; margin-top:10px;">&nbsp;&nbsp;&nbsp;Copyright 1996-2016 Its Creative, All Rights Reserved</p>
			</div>
			
		</div>
		
	</div>
</body>

</html>