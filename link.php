<?php

session_start();

if(isset($_GET['filename'])&& !empty($_GET['filename'])){
	$filename = $_GET['filename'];
	$file = $filename;
	header("content-type:application/force-download");
	header("content-disposition:attachment; filename=\"".$file);
	readfile("$file");
}
?>