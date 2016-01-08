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

class Access extends Model{
	
	public $login_by = "email";
	public $error = false;
	public $use_password = true;
	public $is_locked = false;
	
	public function __construct($db)
	{
		$this->check_cookies();
		parent::__construct($db);
	}
	
	/**
	* @check if user exists, then set user data in session or/and in cookies
	* @param string $login
	* @param string $password
	* @param int $remember
	* @return void
	*/
	public function login($login , $password = ""  , $remember = 0)
	{
		$this->error = false;
		$this->db->join("p_user_roles UR", "UR.user_id=U.id", "LEFT");
		$this->db->join("p_roles R", "UR.role_id=R.id", "LEFT");
		if ($this->use_password)
		{
			$pass = $this->encrypt($password);
			$user = $this->db->where($this->login_by, $login)->where("password", $pass)->getOne("p_users U", "U.*, R.role");
		}
		else
		{
			$user = $this->db->where($this->login_by, $login)->getOne("p_users U", "U.*, R.role");
		}
		
		if ($user['id'])
		{
			if ($remember)
			{
				setcookie("username", $login, time()+60*60*24*150);
				if ($this->use_password)
				{
					setcookie("password", $pass, time()+60*60*24*21);
				}
			}
			$_SESSION['access_user'] = $user;
			return true;
		}
		else 
		{
			$this->error = true;
			return false;
		}
	}

	/**
	* @try to register an user account
	* @param array $data
	* @param int $auto_login
	* @param int $remember
	* @return void
	*/	
	public function register($data, $auto_login = 1 , $remember = 1)
	{
		$this->error = false;
		if ($this->use_password)
		{
			$data['password'] = $this->encrypt($data['password']);
		}
		$user_id = $this->db->insert("p_users", $data);
		if ($user_id )
		{
			if ($auto_login)
			{
				$user = $this->db->where("id", $user_id)->getOne("p_users");
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
			$this->error = false;
			return false;
		}
	}
	
	/**
	* @logout an user
	*/
	public function logout(){
		setcookie("username", "", time()+60*60*24*7);
		setcookie("password", "", time()+60*60*24*7);
		$_SESSION['access_user'] = null;
	}
	
	/**
	* @check cookies and automatically login user
	*/
	public function check_cookies()
	{
		$username = isset($_COOKIE['username']) ? $_COOKIE['username'] : "";
		$password = isset($_COOKIE['password']) ? $_COOKIE['password'] : "";
		
		if (strlen($username))
		{
			if ($this->use_password && !strlen($password))
				$this->is_locked = true;
			return;
			
			if ($this->use_password)
			{
				$pass = $this->encrypt($password);
				$user = $this->db->where($this->login_by, $username)->where("password", $pass)->getOne("p_users");
			}
			else
			{
				$user = $this->db->where($this->login_by, $username)->getOne("p_users");
			}
			
			if (isset($user['id']))
			{
				$_SESSION['access_user'] = $user;
			}
		}
	}
	
	/**
	* @encrypt password
	* @param string $str
	* @return string
	*/	
	public function encrypt($str)
	{
		$majorsalt = "";
		$pass = str_split($str);
		foreach ($pass as $hashpass)
			$majorsalt .= bin2hex(md5($hashpass,true));
		
		$pass = bin2hex(md5($majorsalt,true));
		return $pass;
	}

	/**
	* @check if email format is right, and domen exists
	* @param string $mail_address
	* @return void
	*/	
	public function check_email($mail_address) {
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
	
	public function is_logged()
	{
		if (isset($_SESSION['access_user']['id']) && $_SESSION['access_user']['id'] > 0)
			return true;
		else
			return false;
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
	

	function check_if_exists($login) {
		$this->db_user->condition = array($this->login_by => $login);
		$user = $this->db_user->selectRow();
		
		if (isset($user['id']))
			return false;
		else
			return true;
	}

}