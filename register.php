<?php
	include("connect.php");
	if(isset($_POST['submit']) )
	{
		if($_POST['password'] === $_POST['cpassword'])
		{
			$uid = strtolower(htmlentities($_POST['userid']));//userid string convertion to lower case
			$uname = htmlentities($_POST['username']);
			$pass = htmlentities($_POST['password']);
			$cpass = htmlentities($_POST['cpassword']);
			$gen = htmlentities($_POST['gender']);
			$time = date("H:i:s:a",time()+12600);//jugaad for wrong time zone
			$date = date("Y-m-d",time()+12600);
			
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
			
			$sql = mysql_query("select uid from register where uid='$uid'");
			if(mysql_num_rows($sql) != 0)
			{
				echo "<script>alert('UserID Already Exists !')</script>";
			}
			else
			{
			if(!empty($uid) && !empty($uname) && !empty($pass) && !empty($cpass) && !empty($gen))
				{
					$myname = $uid."data";
					mysql_query("create table register(uid varchar(200),uname varchar(200),pass varchar(200),gen varchar(7),time varchar(20),date varchar(20))");
					mysql_query("create table "."$myname"."(type varchar(10),rec varchar(200),send varchar(200),cc varchar(200),bcc varchar(200),subject varchar(500),txt varchar(5000),time varchar(20),date varchar(20),link varchar(300),local varchar(300))");
					mysql_query("insert into register values('$uid','$uname','$pass','$gen','$time','$date')");
					header("Location:thankyou.php");
				}
			else	
				{
					echo "<script>alert('Enter all Fields !')</script>";
				}
			}
		}
		else{
		echo "<script>alert('Password and Confirm Password Doesnt Match')</script>";	
	}
}
	
?>
<!DOCTYPE html>
<html>
<head>
<title>MailBox</title>
<meta charset="utf-8" />
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="stylesheet" type="text/css" href="css/css.css"/>
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
					
				</div>	
				
				<div class="right">
					<br><br>
					<h1>Register</h1>
					<p>or <a href="index.php">login here</p></a>
					<br><br>
					<form method="post" name="form" onSubmit="chk()">
						Create User ID:<input type="text" name="userid" placeholder="Create Your User Id" autocomplete="off"/><br><br>
						Full Name:<input type="text" name="username" placeholder="Enter Your Full Name"/><br><br>
						Password:<input type="password" name="password" placeholder="Password"/><br><br>
						Confirm Password:<input type="password" name="cpassword" placeholder="Confirm Password"/><br><br>
						Gender:&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="gender" value="male" checked="checked">Male</input>&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="radio" name="gender" value="female">Female</input><br><br><br><br>
						<input type="submit" value="Register" name="submit"/>
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
	<script language="javascript">
		function chk(){
			var a = /^[A-Z_a-z.0-9]+@[a-z]+[\.][a-z]+$/;
			var res = document.frm.email.value.match(a);
			if(res==null){
				alert('Error Email');
				return false;
			}
			var b = /^[A-Za-z]+$/;
			var res1 = document.frm.username.value.match(b);
			if(res1==null){
				alert('Error UserName');
				return false;
			}
			var c = /^[A-Z.a-z_0-9@]+$/;
			var res2 = document.frm.password.value.match(c);
			if(res2==null){
				alert('Error Password');
				return false;
			}
			var cp = document.frm.password.value;
			var res3 = document.frm.cpassword.value;
			if(res3!=cp){
				alert('Error ConfirmPassword');
			}
		}
	</script>
</body>
</html>