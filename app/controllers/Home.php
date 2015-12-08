<?php
require_once("App.php");

class Home extends APP{
	
	public function init()
	{
		parent::init();
	}
	
	public function index()
	{
		if ($this->access->is_logged())
			$this->route->go("dashboard");
		else
			$this->route->go("login");
	}
	
	public function login()
	{
		if ($this->access->is_logged())
			$this->route->go("dashboard");
		
		if (isset($_POST['ac']) && $_POST['ac'] == "login")
			$this->try_login();
		
		$this->to_template("page_title" , "Login");
		$this->renderTemplate("pages/login.twig");
	}
	
	public function logout()
	{
		$this->access->logout();
		$this->route->go("login");
	}
	
	private function try_login()
	{
		$final = array();
		$data = $_POST['data'];
		
		$result = $this->access->login($data['email'], $data['password'], 1);
		if ($result)
			$final = array("location" => $this->route->generate("dashboard"));
		else
			$final = array("error" => "Wrong username or password");
		
		die(json_encode($final));
	}
	
	public function dashboard()
	{
		$this->to_template("page" , "dashboard");
		$this->to_template("page_title" , "My dashboard");
		$this->renderTemplate("pages/home.twig");
	}
}

