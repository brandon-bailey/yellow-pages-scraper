<?php
# Type="MYSQL"
# HTTP="true"
$hostname_DB = "example.com";
$database_DB = "your_dbname";
$username_DB = "username_fordb";
$password_DB = "Password";
$DB = mysql_connect($hostname_DB, $username_DB, $password_DB) or trigger_error(mysql_error(),E_USER_ERROR); 
?>