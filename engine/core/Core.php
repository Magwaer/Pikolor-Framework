<?php
/*
* Pikolor Engine - by Pikolor
*
* @package		Pikolor Custom CMS
* @author		Buzco Stanislav
* @copyright	Copyright (c) 2008 - 2015, Pikolor
* @link		http://pikolor.com
* @ Version : 2
* @index
*/

if (!defined('CORE_PATH'))
{
	define('CORE_PATH', ENGINE_PATH . 'core' . DS );
}
if (!defined('LIB_PATH'))
{
	define('LIB_PATH', ENGINE_PATH . 'lib' . DS );
}

require_once("Request.php");
require_once("Route.php");
require_once("APP_Controller.php");
require_once("Model.php");

class pikolor_core {
	protected $config = array();
	public $request;
	public $route;
	
	/*
	* @the vars array
	* @access private
	*/
	public $vars = array();
	
	/**
	* @set undefined vars
	* @param string $index
	* @param mixed $value
	* @return void
	*/
	public function __set($index, $value)
	{
		$this->vars[$index] = $value;
	}
	
	/**
	* @get variables
	* @param mixed $index
	* @return mixed
	*/
	public function __get($index)
	{
		if (isset($this->vars[$index]))
			return $this->vars[$index];
		else
			return ;
	}
	
	/**
	* @load a specific file
	* @param string $type
	* @param string $file
	* @return void
	*/
	public function load($type , $file , $init = false)
	{
		if (file_exists(ENGINE_PATH . $type . DS . $file . ".php"))
		{
			$adr = ENGINE_PATH . $type . DS . $file . ".php";
		}	
		elseif (file_exists(APP_PATH . $type . DS . $file . ".php"))
		{
			$adr = APP_PATH . $type . DS . $file . ".php";
		}	
		
		if ($adr)
		{
			require_once($adr);
			if ($init)
			{
				$s_file = strtolower($file);
			
				if ($type == "models")
					$this->$s_file = new $file($this->db);
				else
					$this->$s_file = new $file();
			}
			
		}
		else
			return false;
	}
	
	/**
	* @Just init CORE
	*/
	public function init_core(){
		removeMagicQuotes();
		
		$this->load("lib", "Spyc", true);
		
		$this->init_config("db");
		$this->init_config("general");
		$this->set_errors();
		$this->request = new pikolor_request();
		
		$loc_1 = $this->request->location(1);
		if ($loc_1 == "admin")
			define('APP_PATH', ENGINE_PATH . 'admin' . DS );
		else
			define('APP_PATH', ROOT . DS . 'app' . DS );
		
		$this->set_lang();
		
		$this->route = new pikolor_route();
		$this->route->parse();
		
		$this->init_app();
	}
	
	/**
	* @Just init Application
	*/
	function init_app(){
		$this->route->find_route();
		
		if ($this->route->action)
		{
			$app_class = $this->route->class_name;
			$app_method = $this->route->method_name;
			
			require_once(APP_PATH . "controllers" . DS . $app_class . ".php");
			
			if (class_exists($app_class))
			{
				if (method_exists($app_class , $app_method))
				{
					$instance = new $app_class;
					$instance->set_config($this->config);
					$instance->init(); 
					call_user_func_array(array($instance, $app_method), $this->route->vars);
				}
				else
				{
					$obj = new $app_class();
					$obj->set_config($this->config);
					$obj->init(); 
				}
			}
		}
	}
	
	/**
	* @load config file
	* @param string $file
	*/
	function init_config($file) {
		$this->config[$file] = $this->spyc->YAMLLoad( ROOT . DS . "app" . DS . "config" . DS . $file . ".yml");
	}
	
	/**
	* @read error level from config and set in php settings
	*/
	function set_errors()
	{
		if ($this->config['general']['errors'] == true)
		{
			error_reporting(E_ALL);
			ini_set("display_errors", 1);
		}
		else
		{
			error_reporting(E_ALL & ~E_NOTICE);
			
			$error_path = ENGINE_PATH . "cache" . DS . "error.log";
			ini_set('display_errors','Off');
			ini_set('log_errors', 'On');
			ini_set('error_log', $error_path);
		}
	}
	
	function __destruct()
	{  
		
	}

	/**
	* @init multilang script
	*/
	function set_lang()
	{
		$lang_arr = $this->config['general']['langs'];
		if ($lang_arr)
		{
			$_SESSION['langs'] = $lang_arr;
			
			if (empty($_SESSION['lang']) && isset($_COOKIE['lang']))
			{
				$_SESSION['lang'] = $_COOKIE['lang'];
			}
			if (empty($_SESSION['lang']) || !in_array($_SESSION['lang'] , array_keys($lang_arr)))
			{
				reset($lang_arr);
				$_SESSION['lang'] = key($lang_arr);
			}

			$lang = $this->request->location(1);
			if (!empty($lang) && in_array($lang , array_keys($lang_arr)))
			{
				$_SESSION['lang'] = $lang;
			}
			
			define('LANG', $_SESSION['lang']); 
			setcookie("lang", $_SESSION['lang'], time()+3600*24*365, "/");
		}
		else
		{
			$_SESSION['langs'] = null;
			$_SESSION['lang'] = null;
		}
	}
}


/** Check for Magic Quotes and remove them **/
function stripSlashesDeep($value) {
    $value = is_array($value) ? array_map('stripSlashesDeep', $value) : stripslashes($value);
    return $value;
}

function removeMagicQuotes() {
	if ( get_magic_quotes_gpc() )
	{
		$_GET    = stripSlashesDeep($_GET   );
		$_POST   = stripSlashesDeep($_POST  );
		$_COOKIE = stripSlashesDeep($_COOKIE);
	}
}
