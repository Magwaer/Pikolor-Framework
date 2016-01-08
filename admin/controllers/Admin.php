<?php

class Admin extends APP_Controller{
	
	public function init()
	{
		parent::init();
		
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
}

