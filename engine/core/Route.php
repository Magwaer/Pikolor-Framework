<?php
/*
* Pikolor Engine - by Pikolor
*
* @package		Pikolor Engine
* @author		Buzco Stanislav
* @copyright	Copyright (c) 2008 - 2016, Pikolor
* @link		http://pikolor.com
* @ Version : 2 Beta
* @index
*/

require_once("RouteCollection.php");
require_once("RouteClass.php");

class pikolor_route extends pikolor_core{

	public $routes = array();
	public $vars = array();
	public $action = "";
	public $class_name = "";
	public $method_name = "";
	
	function __construct()
	{
		
	}
	
	public function parse()
	{
		$this->load("lib", "Spyc", true);
		$this->routes = $this->spyc->YAMLLoad(APP_PATH . 'config' . DS .  "route.yml" );
	}
	
	public function find_route()
	{
		$flague = false;
		$requestUrl = $_SERVER['REQUEST_URI'];
		$vars = array();
		$action = "";
		
		$collection = new RouteCollection();
        foreach ($this->routes as $name => $route) {
            $collection->attach(new Route($route['url'], array(
                '_controller' => str_replace('.', ':', $route['action'])
            )));
        }
		
		foreach ($collection->all() as $routes)
		{
			$params = array();
			
			if ($routes->getUrl() != "/")
			{
				// check if request _url matches route regex. if not, return false.
				if (! preg_match("@^".$routes->getRegex()."*$@i", $requestUrl, $matches)) {
					continue;
				}
			
				$params = array();

				if (preg_match_all("/:([\w-%]+)/", $routes->getUrl(), $argument_keys)) {

					// grab array with matches
					$argument_keys = $argument_keys[1];

					// loop trough parameter names, store matching value in $params array
					foreach ($argument_keys as $key => $name) {
						if (isset($matches[$key + 1])) {
							$params[$name] = $matches[$key + 1];
						}
					}

				}
				$this->action = $routes->_config['_controller'];
				$this->vars = $params;
				$found = true;
			}
			elseif($routes->getUrl() == $requestUrl)
			{
				$this->action = $routes->_config['_controller'];
				$found = true;
			}
			else	
				$found = false;
			
			
			if ($found)
			{
				$flague = true;
				break;
			}

		}
		
		if (!$flague)
		{
			$request = new pikolor_request();
			if ($_SESSION['lang'])
			{
				$this->action = $request->location(2);
			}
			else
			{
				$this->action = $request->location(1);
			}
		}
		
		$this->parse_action();
	}
	
	public function parse_action()
	{
		$action = $this->action;
		if ($action)
		{
			$tmp = explode(":" , $action);
			$this->class_name = $tmp[0];
			if (isset($tmp[1]))
				$this->method_name = $tmp[1];
			else
				$this->method_name = "index";
		}
	}
	
	public function generate($path , $params = array())
	{
		$url = $this->routes[$path]['url'];
		foreach($params as $param => $val)
		{
			$url = str_replace(":" . $param , $val , $url);
		}
		return $url;
	}
	
	public function go($path , $params = array())
	{
		$link = $this->generate($path , $params);
		header('Location: ' . $link);
		die();
	}
}