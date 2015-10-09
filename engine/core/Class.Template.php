<?php
/*
* @ Version : 0.305
* @ Force update : 0
*/

class pikolor_template extends APP_Controller{
	public $vars = array();
	public $template;
	public $template_path;
	public $config = array();
	public $route ;
	private $twig;
	
	function __construct()
	{
		$this->twig = new Twig();
	}
	
	function pikolor_template(){
		$this->template_path = APP_PATH .  "Views" . DS;
	}
	
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
	
	function setPath($path)
	{
		$this->template_path = $path;
	}
	
	function renderTemplate($template)
	{
		$page = $this->twig->render($template , $this->vars );
		echo $page;
	}
	
	function __destruct()
	{
	
	}
}