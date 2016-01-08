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
	
	private $id_admin = false;
	
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
	function renderTemplate($template)
	{
		$page = $this->twig->render($template , $this->vars );
		echo $page;
	}
	
	function __destruct()
	{
	
	}
}