<?php
	include("function.php");
	if(logged()==true)
	{
		header("Location:account.php");
		exit();
	}
	
	if(isset($_POST['submit']))
	{
		if(!empty($_POST['userid']) && !empty($_POST['password']))
		{
			$uid = strtolower(htmlentities($_POST['userid']));//userid string convertion to lower case
			
			$offset = 0;//removal of .(dot) from the userid
			if( !empty($_POST['userid']) )
			{
				while( $str_pos = strpos($uid, '.', $offset) )
				{
					$offset = $str_pos;
					$uid = substr_replace($uid, "", $str_pos, 1);
				}
				$len = strlen($uid);//trimming userid string before @(at) symbol
				while( $strpos = strpos($uid, "@", 0) ){
					$uid = substr_replace($uid, "", $strpos, $len-$strpos);
				}
			}
			
			$pass = htmlentities($_POST['password']);
			
			if( !empty($uid) && !empty($pass) )
			{
				$_SESSION['id'] = $uid;
				$sql = mysql_query("SELECT * FROM register WHERE uid='$uid'");
				while($row = mysql_fetch_assoc($sql))
				{
					$_SESSION['uname'] = $row['uname'];
					$dbpass = $row['pass'];
					if($pass==$dbpass)
					{
						$log = true;
					}
					else	
					{	
						$log = false;
					}
				}
				if($log==true)
				{
					$check = htmlentities($_POST['check']);
					if($check=='check'){
						setcookie("uid",$uid,time()+7200);
					}
					elseif($check=='')
						$_SESSION['uid'] = $uid;
					header("Location:index.php");
					exit();	
				}
				else
					echo "<script>alert('Please enter correct Username and Password')</script>";
			}
		}
		else
			echo "<script>alert('Enter Username and Password !')</script>";
	}
	
?>
<!DOCTYPE html>
<html>
<head>
<title>MailBox</title>
<meta charset="utf-8" />
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="stylesheet" type="text/css" href="css/css.css">
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
					<br><br>
					<p>Take a look at this <u>Example</u> Here...</p><br><br>
					<img src="images/logineg.png" alt="login example" style="opacity:0.5"/>
				</div>
				
				<div class="right">
					<br><br>
					<h1>Login</h1>
					<br><br>
					<form method="post">
						
						User ID:<input type="text" name="userid" placeholder="UserID@jmail.com"/><br><br>
						Password:<input type="password" name="password" placeholder="Password"/><br><br>
						<input type="checkbox" name="check" value="check"/>Remember Me<br><br>
						<input type="submit" value="Login" name="submit"/><br><br>
						<a href="register.php"><p>Don't have account ? Register</p></a>
						
					</form>
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