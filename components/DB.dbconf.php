<?php
/**
 * PDO DB class
 */
class DB
{
	
	public static function getConection(){
		$db = new PDO("mysql:host=host;dbname=dbname;","login","password");
		$db->exec("SET NAMES utf8");
		return $db;
	}
}