<?php

class APP extends APP_Controller{
	
	var $me = array();
	
	public function init()
	{
		parent::init();
		
		$this->load("models", "Companies_Model", true);
		
		if (!$this->access->is_logged() && $this->request->location(1) != "login")
			$this->route->go("login");
		
		if ($this->access->is_logged())
		{
			$me = $_SESSION['access_user'];
			if (!isset($me['company']) && $me['role'] == "client")
			{
				$me['company'] = $this->companies_model->get_company_by_userid($me['id']);
			}
			$_SESSION['access_user'] = $me;
			$this->me = $me;
			$this->to_template("me" , $me);
		}
		
		$this->to_template("asset_path" , "/app/assets/");
		$this->to_template("site_title" , "Pikolor");
	}

	public function error_500()
	{
		$this->renderTemplate("500.twig");
		die();
	}
	
	function i_have_role($role)
	{
		return in_array($role , $_SESSION['access_user']['roles']);
	}
}

