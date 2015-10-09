<?php
/*
* @ Version : 1
*/

class pikolor_route {

	public $routes = array();
	public $vars = array();
	public $action = "";
	public $class_name = "";
	public $method_name = "";
	
	function __construct()
	{
		
	}
	
	function parse()
	{
		$arr = Spyc::YAMLLoad(APP_PATH . 'config' . DS .  "route.yml" );
		$arr_engine = Spyc::YAMLLoad(ENGINE_PATH . 'config' . DS .  "engine_route.yml" );
		$final_arr = array_merge($arr , $arr_engine);
		$this->routes = $final_arr;
	}
	
	function find_route()
	{
		$flague = false;
		$requestUrl = $_SERVER['REQUEST_URI'];
		$vars = array();
		$action = "";
		
		require_once("Class.RouteCollection.php");
		require_once("Class.Route_.php");
		
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
	
	function parse_action()
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
	
	function generate($path , $params = array())
	{
		$url = $this->routes[$path]['url'];
		foreach($params as $param => $val)
		{
			$url = str_replace(":" . $param , $val , $url);
		}
		return $url;
	}
	
	function go($path , $params = array())
	{
		$link = $this->generate($path , $params);
		header('Location: ' . $link);
		die();
	}
}