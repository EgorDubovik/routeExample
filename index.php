<?php
	ini_set("display_errors", 1);
	error_reporting(E_ALL);

	set_time_limit(60);

	define('ROOT', dirname(__FILE__));

	require_once ROOT.'/components/Router.php';
	require_once ROOT.'/components/DB.php';

	// $db = DB::getConection();

	Router::run();

?>