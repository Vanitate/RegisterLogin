<?php
error_reporting(E_ALL);

define('DBHOST', 'localhost');          # databazovy server
define('DBNAME', 'mysql');              # jmeno databaze
define('DBUSER', 'root');               # uzivatelske jmeno
define('DBPASS', '');                   # heslo k databazi

@mysql_connect(DBHOST, DBUSER, DBPASS) or die (mysql_error());
@mysql_select_db(DBNAME) or die (mysql_error());
mysql_query("SET NAMES utf8_czech_ci");

@session_start(); # osetreni casoprostorovych anomalii :-)
?>