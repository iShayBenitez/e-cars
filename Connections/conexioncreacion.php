<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_conexioncreacion = "localhost";
$database_conexioncreacion = "creacionbd";
$username_conexioncreacion = "root";
$password_conexioncreacion = "";
$conexioncreacion = mysql_pconnect($hostname_conexioncreacion, $username_conexioncreacion, $password_conexioncreacion) or trigger_error(mysql_error(),E_USER_ERROR); 
?>