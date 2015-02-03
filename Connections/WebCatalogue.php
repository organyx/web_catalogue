<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_WebCatalogue = "localhost";
$database_WebCatalogue = "web_catalogue";
$username_WebCatalogue = "root";
$password_WebCatalogue = "";
$WebCatalogue = mysql_pconnect($hostname_WebCatalogue, $username_WebCatalogue, $password_WebCatalogue) or trigger_error(mysql_error(),E_USER_ERROR); 
?>