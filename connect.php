<?php

mysql_connect("localhost","root","")or die();
mysql_query("create database mailbox");
mysql_select_db("mailbox")or die();

?>