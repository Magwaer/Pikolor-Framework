<?php
/*
* Pikolor Engine - by Pikolor Lab
*
* @package		Pikolor Engine
* @author		Pikolor Lab
* @copyright	Copyright (c) 2008 - 2016, Pikolor Lab
* @link		http://pikolor.com
* @ Version : 2 Beta
* @index
*/

class pikolor_template extends APP_Controller{
	public $template;
	public $template_path;
	public $config = array();
	public $route ;
	public $request;
	public $twig;
	public $css_styles = array();
	public $js_scripts = array();
		
	public function init()
	{
		
	}
	
	function __construct()
	{
		$this->load("lib", "Twig", true);

		$this->request = new pikolor_request();
		$loc_1 = $this->request->location(1);
		if ($loc_1 == "admin")
			$this->is_admin = true;
		
		if ($this->is_admin)
		{
			$this->set_var("img_path" , "/admin/web/img/");
			$this->set_var("css_path" , "/admin/web/css/");
			$this->set_var("js_path" , "/admin/web/js/");
			$this->set_var("libs_path" , "/admin/web/libs/");
		}
		else
		{
			$this->set_var("img_path" , "/app/web/img/");
			$this->set_var("css_path" , "/app/web/css/");
			$this->set_var("js_path" , "/app/web/js/");
			$this->set_var("libs_path" , "/app/web/libs/");
		}
		
	}
	
	/**
	* @set a variable to template
	* @param string $key
	* @param mixed $val
	*/
	function set_var($key , $val = ""){
		if (is_array($key))
		{
			foreach($key as $k=>$v)
			{
				$this->vars[$k] = $v;
			}
		}	
		else
		{
			$this->vars[$key] = $val;
		}
	}

	/**
	* @render a specific template
	* @param string $template
	*/
	function renderTemplate($template, $return = false)
	{
		$this->set_var("css_styles" , $this->css_styles);
		$this->set_var("js_scripts" , $this->js_scripts);
		
		$page = $this->twig->render($template , $this->vars );
		if (!$return)
			echo $page;
		else
			return $page;
	}
	
	/**
	* @render a specific template
	* @param string $template
	*/
	function getTemplate($template, $vars = array())
	{
		if (!count($vars))
			$vars = $this->vars ;
		$page = $this->twig->render($template , $vars );
		return $page;
	}
	
	function add_to_css($path, $name)
	{
		if ($name)
			$this->css_styles[$name] = $path;
		else
			array_push($this->css_styles, $path);
	}
	
	function add_to_js($path, $name)
	{
		if ($name)
			$this->js_scripts[$name] = $path;
		else
			array_push($this->js_scripts, $path);
	}
	
	function __destruct()
	{
	
	}
}