<?php

class Home extends APP_Controller{
	
	public function index()
	{
		echo "this is index";
	}
	
	
	public function dashboard()
	{
		$this->to_template("page" , "dashboard");
		$this->to_template("page_title" , "My dashboard");
		$this->renderTemplate("pages/home.twig");
	}
}

