<?php

    ob_start();
    ini_set('display_errors', 1);
	define('DEBUG', true);
	if ( DEBUG ) {
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
	}
	
    $config = array();
    $config['site_name']  = 'Mobile Device Management';
    $config['BASE_URL']   = '';
    $config['BASE_DIR']   = $_SERVER['DOCUMENT_ROOT'];

    $Config_host = 'localhost';
    $Config_user = 'db139626_madmin';
    $Config_password = 'CapzD3s3rtRun';
    $Config_db = 'db139626_mdm';

    $dbcon = @mysql_pconnect($Config_host, $Config_user, $Config_password) or die(mysql_error());
    mysql_select_db($Config_db) or die(mysql_error());
	mysql_query("SET NAMES 'utf8'");
?>