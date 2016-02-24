<?php

require_once("Custom_field.php");

class Admin extends APP_Controller{
	public $is_multilang = false;
	public $lang_keys = array();
	public $langs = array();
	
	public function init()
	{
		parent::init();
		
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
		
		if ($this->access->is_locked && $this->request->location(2) != "lock")
			$this->route->go("lock_screen");
		
		if (!$this->access->is_logged() && $this->request->location(2) != "login")
			$this->route->go("login");
		
		$this->get_channels();
	}
	
	private function get_channels()
	{
		$channels = $this->db->get("p_channels");
		$this->to_template("channels", $channels);
	}

	public function error_500()
	{
		$this->renderTemplate("500.twig");
	}
	
	public function renderTemplate($path)
	{
		$path = "admin" . DS . "templates" . DS . $path;
		parent::renderTemplate($path);
	}
}

