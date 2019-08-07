<?php
/**
 * Response class
 */
class Response
{
	const VIEW = '/views/'; // folder with views
	const E404 = '404.html'; //error 404 file

	public static function View($view){
		include_once ROOT.self::VIEW.$view;
	}

	public static function e404(){
		include_once ROOT.self::VIEW.'404.html';
	}

}