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

require_once("Template.php");

class APP_Controller extends pikolor_core{
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
	
	/**
	* @init application controller
	*/
	function init()
	{
		if (!$this->is_init)
		{
			$this->is_init = true;
			
			$this->request = new pikolor_request();
			
			$this->init_db();
			
			$this->load("lib" , "Access" , false);
			$this->access = new Access($this->db, $this->config);
			
			$this->template = new pikolor_template();
			$this->template->config = $this->config;
			
			$this->route = new pikolor_route();
			$this->route->parse();
			
			$this->template->route = $this->route;
			
			$this->add_to_twig("this" , $this);
		}
	}
	
	/**
	* @init database connection
	*/
	public function init_db()
	{
		$this->load("lib", "MysqliDb", false);
		$this->db = new MysqliDb ($this->config['db']['host'],  $this->config['db']['user'], $this->config['db']['password'], $this->config['db']['name']);
	}
	
	/**
	* @set config params
	* @param array $config
	*/
	function set_config($config = array())
	{
		$this->config = $config;
	}
	
	/**
	* @set a variable to template
	* @param string $key
	* @param mixed $val
	*/
	public function to_template($key , $val = "")
	{
		$this->template->set_var($key , $val);
	}

	/**
	* @render a specific template
	* @param string $template
	*/
	public function renderTemplate($template)
	{
		$this->template->renderTemplate($template);
	}
	
	/**
	* @calculate execution time
	*/
	function __destruct()
	{
		$exec_time = microtime(true) - $_SESSION['time_start_script'];
		$exec_time = round($exec_time *1000 ) ;
	}
}


