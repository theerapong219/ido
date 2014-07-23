<?php		
/* :: http://localhost/ido :: */
//	$dbhost = 'localhost';
//	$dbuser = 'root';
//	$dbpass = 'root';
//	$dbname = 'ido';

/* :: http://www.testdebug.com/ido :: */
	$dbhost = 'localhost';
	$dbuser = 'testdebug_ido';
	$dbpass = 'jE46hCV9';
	$dbname = 'testdebug_ido';

	$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
	@mysql_query("SET NAMES utf8");
  @mysql_query("SET character_set_results=utf8");
  @mysql_query("SET character_set_client=utf8");
  @mysql_query("SET character_set_connection=utf8");
	mysql_select_db($dbname);
?>
