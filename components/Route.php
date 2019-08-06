<?php
/**
 * 
 */
class Route
{
	private $methods;
	private $action;
	private $route;
	public function __construct($methods,$route,$action)
	{
		$this->methods = $methods;
		$this->route = $route;
		$this->action = $action;
	}

	public function getAction(){
		return $this->action;
	}
	public function getMethod(){
		return $this->methods;
	}

}