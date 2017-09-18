<?php

session_start();
session_destroy();
setcookie('uid','',time()-7200);
header("Location:index.php");

?>