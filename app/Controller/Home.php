<?php

class Home extends APP_Controller{
	
	public function index()
	{
		if (!$_SESSION['user_id'])
			$this->route->go("login");
		
		$me = $this->db->where("id" , $_SESSION['user_id'])->getOne("users");
		
		$this->to_template("me" , $me);
		$this->to_template("page_title" , "Welcome");
		$this->renderTemplate("pages/home.twig");
	}
	
	public function login()
	{
		if ($_SESSION['user_id'])
			$this->route->go("home");
		
		if ($_POST['ac'] == "login")
			$this->try_login();
		
		if ($_POST['ac'] == "register")
			$this->try_register();
		
		$this->to_template("page_title" , "Intrare sau Inregistrare");
		$this->renderTemplate("pages/login.twig");
	}
	
	public function logout()
	{
		unset($_SESSION['user_id']);
		$this->route->go("login");
	}
	
	private function try_login()
	{
		$phone_number = $_POST['phone_number'];
		$password = $_POST['password'];
		
		if (strlen($phone_number) != 9)
			$final = array("wrong" => "Numar de telefon incorect. Numarul treb sa inceapa cu 0 (zero)");
		elseif (strlen($password) < 4)
			$final = array("wrong" => "Parola este prea scurta. Minim 4 caractere");
		else
		{
			$user = $this->db->where("phone_number" , $phone_number)->where("password" , $password)->getOne("users");
			if ($user['id'])
			{
				$_SESSION['user_id'] = $user['id'];
				$final = array("login" => 1);
			}
			else
			{
				$user = $this->db->where("phone_number" , $phone_number)->getOne("users");
				if ($user['id'])
				{
					$final = array("wrong" => "Parola este incorecta");
				}
				else
					$final = array("register" => 1);
			}
		}
		echo json_encode($final);
		die();
	}
	
	private function try_register()
	{
		$phone_number = $_POST['phone_number'];
		$password = $_POST['password'];
		$user_name = $_POST['user_name'];
		
		if (strlen($phone_number) != 9)
			$final = array("wrong" => "Numar de telefon incorect. Numarul treb sa inceapa cu 0 (zero)");
		elseif (strlen($password) < 4)
			$final = array("wrong" => "Parola este prea scurta. Minim 4 caractere");
		elseif (strlen($user_name) < 4)
			$final = array("wrong" => "Numele este pre scurt. Minim 3 caractere");
		else
		{
			$user_id = $this->db->insert("users" , array("phone_number" => $phone_number, "password" => $password, "name" => $user_name));
			$_SESSION['user_id'] = $user['id'];
			$final = array("login" => 1);
		}
		echo json_encode($final);
		die();
	}
}

