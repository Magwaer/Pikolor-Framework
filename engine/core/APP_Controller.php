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
	public $config;
	public $is_debugger = false;
	public $template;
	public $request;
	public $route;
	public $logs = array();
	public $user = array();
	public $access ;
	public $components ;
	
	public $lang_keys = array();
	public $langs = array();
	public $is_multilang = false;
	
	/**
	* @init application controller
	*/
	function init()
	{
		if (!$this->is_init)
		{
			parent::init();
			$this->is_init = true;
			
			$this->request = new pikolor_request();
			
			$this->load("lib" , "Access" , false);
			$this->access = new Access($this->db, $this->config);
			
			$this->route = new pikolor_route();
			$this->route->parse();
			
			$this->template->route = $this->route;
			
			if (is_array($this->config['general']['langs']))
			{
				$this->is_multilang = true;
				$this->lang_keys = array_keys($this->config['general']['langs']);
				$this->langs = $this->config['general']['langs'];
				$this->to_template("langs", $this->langs);
			}
			else
				$this->is_multilang = false;
				
			$this->to_template("is_multilang", $this->is_multilang );
			
			$this->add_to_twig("this" , $this);
			
			if (!isset($this->template->vars['breadcrumb']) || !is_array($this->template->vars['breadcrumb']))
				$this->template->vars['breadcrumb'] = array();
		}
	}
	
	/**
	* @init database connection
	*/
	public function init_db($db)
	{
		$this->db = $db;
	}
	
	/**
	* @init template
	*/
	public function init_template(&$template)
	{
		$this->template = &$template;
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
	* @set components object
	* @param array $config
	*/
	function set_components(&$components)
	{
		$this->components = &$components;
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
	* @set a variable to template
	* @param string $key
	* @param mixed $val
	*/
	public function to_breadcrumb($title , $link)
	{
		array_push($this->template->vars['breadcrumb'] , array("title" => $title, "link" => $link));
	}

	/**
	* @render a specific template
	* @param string $template
	*/
	public function renderTemplate($template)
	{
		global $admin_menu;
		$this->to_template("admin_menu" , $admin_menu);
		$this->template->renderTemplate($template);
	}
	
	public function add_css($path, $name = "")
	{
		$this->template->add_to_css($path, $name);
	}
	
	public function add_js($path, $name = "")
	{
		$this->template->add_to_js($path, $name);
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


