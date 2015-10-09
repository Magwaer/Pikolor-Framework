<?php

class pikolor_access extends APP_Controller{
	
	private $db_obj;
	public $login_by = "username";
	public $error ;
	public $use_password = true;
	
	
	function __construct($config){
		$this->config = $config;
		$this->init_db();
		$this->db_obj = new db_users();
	}
	
	function __destruct()
	{
	
	}

	public function login($login , $password = ""  , $remember = 0)
	{
		if ($this->use_password)
		{
			$pass = $this->encrypt($password);
			$user = $this->db_obj->findOneBy(array($this->login_by => $login , "password" => $pass));
		}
		else
		{
			$user = $this->db_obj->findOneBy(array($this->login_by => $login ));
		}
		
		if ($user['id'])
		{
			if ($remember)
			{
				setcookie("username", $login, time()+60*60*24*7);
				if ($this->use_password)
				{
					setcookie("password", $pass, time()+60*60*24*7);
				}
			}

			$_SESSION['access_user'] = $user;
			
			return true;
		}
		else 
		{
			$this->error = "<b>Error : </b>Wrong username or password.";
			return false;
		}
	}
		
	function register($data, $auto_login = 1 , $remember = 1)
	{
		if ($this->use_password)
		{
			$data['password'] = $this->encrypt($data['password']);
		}
		
		$this->db_user->data = $data;
		$user_id = $this->db_user->insert();
		
		if ($user_id )
		{
			if ($auto_login)
			{
				$this->db_user->condition = array("id" => $user_id);
				$user = $this->db_user->selectRow();
				if ($remember)
				{
					setcookie("username", $data[$this->login_by], time()+60*60*24*7);
					if ($this->use_password)
					{
						setcookie("password", $data['password'], time()+60*60*24*7);
					}
				}

				$_SESSION['access_user'] = $user;
			}
			return true;
		}
		else 
		{
			$this->error = "<b>Error : </b>Could not create new user.";
			return false;
		}
	}
	
	function logout(){
		setcookie("username", "", time()+60*60*24*7);
		setcookie("password", "", time()+60*60*24*7);
		
		$_SESSION['access_user'] = null;
	}
	
	function has_access($roles)
	{
		$flague = false;
		
		$user_roles = $_SESSION['access_user']['roles'];
		$roles_arr = explode(";" , $user_roles);
		if (is_array($roles))
		{
			foreach($roles_arr as $role)
			{
				foreach($roles as $one_role)
				{
					if ($role == $one_role)
						$flague = true;
				}
			}
		}
		else
		{
			foreach($roles_arr as $role)
			{
				if ($role == $roles)
					$flague = true;
			}
		}
	
		
		return $flague;
	}
	
	function admin_access($role = "ADMIN")
	{
		if (isset($_SESSION['access_user']['id']))
		{
			$flague = $this->has_access($role);
			if (!$flague)
			{
				header('Location: ' . $this->registry->admin_path . 'no_access');
				die();
			}
		}
		elseif (!$this->check_cookies())
		{
			header('Location: ' . $this->registry->admin_path );
			die();
		}
	}
	
	function check_cookies()
	{
		$username = isset($_COOKIE['username']) ? $_COOKIE['username'] : "";
		$password = isset($_COOKIE['password']) ? $_COOKIE['password'] : "";
		
		if (strlen($username) && strlen($password))
		{
			$this->db_user->condition = array($this->login_by => $username , "password" => $password);
			$user = $this->db_user->selectRow();
			
			if (isset($user['id']) )
			{
				$_SESSION['access_user'] = $user;
				return true;
			}
			else
				return false;
		}
		else
			return false;
	}
	
	function encrypt($str)
	{
		$majorsalt = "";
		
		$pass = str_split($str);
		foreach ($pass as $hashpass)
			$majorsalt .= bin2hex(md5($hashpass,true));
		
		$pass = bin2hex(md5($majorsalt,true));
		
		return $pass;
	}


	function check_email($mail_address) {
		$pattern = "/^[\w-]+(\.[\w-]+)*@";
		$pattern .= "([0-9a-z][0-9a-z-]*[0-9a-z]\.)+([a-z]{2,4})$/i";
		if (preg_match($pattern, $mail_address)) 
		{
			$parts = explode("@", $mail_address);
			if (function_exists("checkdnsrr"))
			{
				if (checkdnsrr($parts[1], "MX"))
				{
					return true;
				}
				else 
				{
					return false;
				}
			}
			else 
				return true;
		} 
		else 
		{
			return false;
		}
	}
	
	

	function check_if_exists($login) {
		$this->db_user->condition = array($this->login_by => $login);
		$user = $this->db_user->selectRow();
		
		if (isset($user['id']))
			return false;
		else
			return true;
	}

}