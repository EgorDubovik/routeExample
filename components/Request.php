<?php
/**
 * 
 */
class Request
{
	public $method;

	public $url;
	
	function __construct()
	{
		$this->init();
	}

	public function init(){
		$this->setUrl();
		$this->setMethod();
	}

	public function setUrl(){
		$this->url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	}

	public function setMethod(){
		$this->method = $_SERVER['REQUEST_METHOD'];
	}

}