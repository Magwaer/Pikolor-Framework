<?php

class APP_Controller {
	private $is_init = false;
	private $error = "";
	public $db ;
	public $config;
	public $is_debugger = false;
	public $template;
	public $request;
	public $route;
	public $logs = array();
	public $user = array();
	public $access ;
	
	function __construct()
	{
		
	}
	
	function init()
	{
		if (!$this->is_init)
		{
			$this->is_init = true;
			
			$this->request = new pikolor_request();
			
			$this->init_db();
			
			$this->access = new pikolor_access($this->config);
			
			$this->template = new pikolor_template();
			$this->template->config = $this->config;
			
			$this->route = new pikolor_route();
			$this->route->parse();
			
			$this->template->route = $this->route;
			
			$this->clear_debug_cache();
			$this->clear_flash();
		}
	}
	
	public function init_db()
	{
		$this->db = new MysqliDb ($this->config['db']['host'],  $this->config['db']['user'], $this->config['db']['password'], $this->config['db']['name']);
	}
	
	function set_config($config = array())
	{
		$this->config = $config;
	}
		
	public function to_template($key , $val = "")
	{
		$this->template->set_var($key , $val);
	}
			
	public function renderTemplate($template)
	{
		$this->template->renderTemplate($template);
	}
		
	public function log($key , $val = "")
	{
		if (is_array($key))
		{
			foreach($key as $k=>$v)
			{
				$this->logs[$k] = $v;
			}
		}	
		elseif ($val)
		{
			$this->logs[$key] = $val;
		}
		else
		{
			$this->logs[] = $key;
		}
	}
	
	public function flash($key , $val = "")
	{
		if (is_array($key))
		{
			foreach($key as $k=>$v)
			{
				$_SESSION['flash'][$k] = $v;
			}
		}	
		elseif ($val)
		{
			if (isset($_SESSION['flash'][$key]) && !is_array($_SESSION['flash'][$key]))
				$_SESSION['flash'][$key] = array($_SESSION['flash'][$key]);
			elseif (isset($_SESSION[$key]))
				$_SESSION['flash'][$key][] = $val;
			else
				$_SESSION['flash'][$key] = $val;
		}
		else
		{
			$_SESSION['flash'][] = $key;
		}
	}
	
	public function read_flash($key_concat = "\r\n" , $concat = "\r\n")
	{
		$st = "";
		if ($this->is_flash())
		{
			if (isset($_SESSION['flash'][$key_concat]))
			{
				if (is_array($_SESSION['flash'][$key_concat]))
				{
					$st = implode($concat , $_SESSION['flash'][$key_concat]);
				}
				else
					$st = $_SESSION['flash'][$key_concat];
			}
			elseif (is_array($_SESSION['flash']))
				$st = implode($key_concat , $_SESSION['flash']);
		}
		
		return $st;
	}
	
	public function is_flash()
	{
		if (isset($_SESSION['flash']))
		{
			return true;
		}
		else	
			return false;
	}
	
	function __destruct()
	{
		if ($this->config['general']['debugger'] && !$this->is_debugger)
		{
			$exec_time = microtime(true) - $_SESSION['time_start_script'];
			$exec_time = round($exec_time *1000 ) ;
			
			$debug_arr = array();
			$debug_arr['exec_time'] = $exec_time;
			$debug_arr['template_vars'] = $this->template->vars;
			$debug_arr['logs'] = $this->logs;
			
			$debug_id = rand(1,99) . chr(rand(65 , 90)) . chr(rand(65 , 90)) . rand(1,99);
			$debug_string = serialize($debug_arr);
			
			$fp = fopen( ENGINE_PATH . "cache" . DS . "debugger" . DS . $debug_id . '.log', 'w');
			fwrite($fp, $debug_string);
			fclose($fp);
			
			echo "
			<script>
			var debug_id = '" . $debug_id . "';
			var head= document.getElementsByTagName('head')[0];
			var script= document.createElement('script');
			script.type= 'text/javascript';
			script.src= '" . ADR . "/engine/web/js/debug.js';
			head.appendChild(script);
			</script>
			";
		}
	}
	
	private function clear_debug_cache()
	{
		$log_path = ENGINE_PATH . "cache" . DS . "debugger" . DS;
		
		if ($handle = opendir( $log_path )) {
			while (false !== ($entry = readdir($handle))) {
				if ($entry != "." && $entry != ".."  ) {
					$name = str_replace(".log" , "" , $entry);
					if ($name != $entry)
					{
						$t = filemtime($log_path . $entry);
						if ($t <= time() - 600)
							@unlink($log_path . $entry);
					}
				}
			}
			closedir($handle);
		}
	}
	private function clear_flash()
	{
		unset($_SESSION['flash']);
	}
}


