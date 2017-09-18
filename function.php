<?php

session_start();
include("connect.php");
function logged()
{
	if(isset($_SESSION['uid']) || isset($_COOKIE['uid']))
	{
		$login = true;
		return $login;
	}
}

?>