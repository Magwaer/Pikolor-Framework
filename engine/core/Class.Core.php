<?php
/*
* @ Version : 1
*/

class pikolor_core {
	protected $config = array();
	public $request;
	public $route;
	
	function pikolor_core(){
		removeMagicQuotes();
		
		$this->init_config("db");
		$this->init_config("general");
		$this->set_errors();
		
		$this->request = new pikolor_request();
		
		$this->set_lang();

		$this->route = new pikolor_route();
		$this->route->parse();
		
		$this->init_app();
	}
	
	function init_app(){
		$this->route->find_route();
		
		if ($this->route->action)
		{
			$app_class = $this->route->class_name;
			$app_method = $this->route->method_name;
			//echo $app_class;
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
	
	function init_config($file) {
		$this->config[$file] = Spyc::YAMLLoad( ROOT . DS . "app" . DS . "config" . DS . $file . ".yml");
	}
	
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
	{ /*
		if ($this->config['general']['debugger'])
		{
			$exec_time = microtime(true) - $_SESSION['time_start_script'];
			$exec_time = round($exec_time , 5);
			echo "<div class='block'><b>Total execution time core : " . $exec_time . "</b></div>";
		} */
	}

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

function __autoload($file ) {
	$error = false;
	
	if (file_exists(ENGINE_PATH . 'lib' . DS . $file . '.php'))
	{
		require_once(ENGINE_PATH . 'lib' . DS .  $file . '.php');
	}
	// Search in Core
	elseif (file_exists(ENGINE_PATH . 'core' . DS .  $file . '.php'))
	{
		require_once(ENGINE_PATH . 'core' . DS .  $file . '.php');
	}
	// Search in Model
	elseif (file_exists(ENGINE_PATH . 'db' . DS .  $file . '.php'))
	{
		require_once(ENGINE_PATH . 'db' . DS .  $file . '.php');
	}
	// Search in Controlers
	elseif (file_exists(APP_PATH . 'Controller' . DS .  $file . '.php'))
	{
		require_once(APP_PATH . 'Controller' . DS .  $file . '.php');
	}
	// Search in Entities
	elseif (file_exists(APP_PATH . 'Db' . DS .  $file . '.php'))
	{
		require_once(APP_PATH . 'Db' . DS .  $file . '.php');
	}
	else {
		if (strstr($file , "pikolor_"))
		{	
			$next = str_replace("pikolor_" , "" , $file);
			$next = ucfirst($next);
			$next = "Class.".$next;
			$error = __autoload($next);
		}
		elseif (strstr($file , "db_"))
		{	
			$next = str_replace("db_" , "" , $file);
			$next = ucfirst($next);
			$next = "Class.Db".$next;
			$error = __autoload($next);
		}
		else
			$error = true;
	}
	
	if ($error && !strstr($file , "Class."))
	{
		$next = "Class.".$file;
		$error = __autoload($next);
	}
	
	if ($error )
	{
		echo "File " . $file . " not found";
	//	die();
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
