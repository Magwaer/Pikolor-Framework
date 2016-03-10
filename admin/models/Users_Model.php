<?php

class users_model extends Model{
	
	/**
	* @check if user exists, then set user data in session or/and in cookies
	* @param string $login
	* @return void
	*/
	public function get_all()
	{
		$this->db->join("p_user_roles UR", "UR.user_id=U.id", "LEFT");
		$this->db->join("p_roles R", "UR.role_id=R.id", "LEFT");
		$users = $this->db->get("p_users  U", null , "U.*, R.role");
		return $users;
	}
	
	/**
	* @check if user exists, then set user data in session or/and in cookies
	* @param string $login
	* @return void
	*/
	public function get_by_role($role)
	{
		if (is_array($role))
			$this->db->where("R.role", $role, "IN");
		else
			$this->db->where("R.role", $role);
		
		$this->db->join("p_user_roles UR", "UR.user_id=U.id", "LEFT");
		$this->db->join("p_roles R", "UR.role_id=R.id", "LEFT");
		$users = $this->db->get("p_users  U", null , "U.*, R.role");
		return $users;
	}
	
	
	/**
	* @check if user exists, then set user data in session or/and in cookies
	* @param string $login
	* @return void
	*/
	public function get_by_id($id)
	{
		$this->db->join("p_user_roles UR", "UR.user_id=U.id", "LEFT");
		$this->db->join("p_roles R", "UR.role_id=R.id", "LEFT");
		$user = $this->db->where("U.id", $id)->getOne("p_users  U", "U.*, R.role");
		return $user;
	}
	
	/**
	* @check if user exists, then set user data in session or/and in cookies
	* @param string $login
	* @return void
	*/
	public function get_user_by_email($email)
	{
		$this->db->join("p_user_roles UR", "UR.user_id=U.id", "LEFT");
		$this->db->join("p_roles R", "UR.role_id=R.id", "LEFT");
		$user = $this->db->where("U.email", $email)->getOne("p_users  U", "U.*, R.role");
		return $user;
	}
	
	
	/**
	* @check if user exists, then set user data in session or/and in cookies
	* @param string $login
	* @return void
	*/
	public function update_user($data, $id)
	{
		if (!isset($data['status']))
			$data['status'] = 0;
		
		if (isset($data['role']))
		{
			$this->db->replace("p_user_roles", array("user_id" => $id , "role_id" => $data['role']));
			unset($data['role']);
		}
		
		$res = $this->db->where("id", $id)->update("p_users", $data);
		return $res;
	}
	
	/**
	* @check if user exists, then set user data in session or/and in cookies
	* @param string $login
	* @return void
	*/
	public function get_user_roles()
	{
		$roles = $this->db->get("p_roles");
		return $roles;
	}	
	
	/**
	* @check if user exists, then set user data in session or/and in cookies
	* @param string $login
	* @return void
	*/
	public function get_user_permissions()
	{
		$permissions = $this->db->get("p_user_permissions");
		return $permissions;
	}
		
	/**
	* @check if user exists, then set user data in session or/and in cookies
	* @param string $login
	* @return void
	*/
	public function get_perm_by_id($id)
	{
		$roles = $this->db->where("id", $id)->getOne("p_user_permissions");
		return $roles;
	}
		
	/**
	* @check if user exists, then set user data in session or/and in cookies
	* @param string $login
	* @return void
	*/
	public function get_perm_by_label($id)
	{
		$roles = $this->db->where("label", $id)->getOne("p_user_permissions");
		return $roles;
	}
	
	/**
	* @check if user exists, then set user data in session or/and in cookies
	* @param string $login
	* @return void
	*/
	public function create_permission($data)
	{
		$res = $this->db->insert("p_user_permissions", $data);
		return $res;
	}
	
	/**
	* @check if user exists, then set user data in session or/and in cookies
	* @param string $login
	* @return void
	*/
	public function update_permission($data, $id)
	{
		$res = $this->db->where("id", $id)->update("p_user_permissions", $data);
		return $res;
	}
	
	/**
	* @check if user exists, then set user data in session or/and in cookies
	* @param string $login
	* @return void
	*/
	public function delete_permission($id)
	{
		$res = $this->db->where("id", $id)->delete("p_user_permissions");
		return $res;
	}
	
	/**
	* @check if user exists, then set user data in session or/and in cookies
	* @param string $login
	* @return void
	*/
	public function get_role_by_id($id)
	{
		$role = $this->db->where("id", $id)->getOne("p_roles");
		$permissions = $this->db->where("role_id", $id)->get("p_role_perm" , null, "perm_id");
		$role['permissions'] = array();
		foreach($permissions as $perm)
		{
			$role['permissions'][] = $perm['perm_id'];
		}
		return $role;
	}
	
	/**
	* @check if user exists, then set user data in session or/and in cookies
	* @param string $login
	* @return void
	*/
	public function get_role_by_name($role)
	{
		$roles = $this->db->where("role", $role)->getOne("p_roles");
		return $roles;
	}
	
	/**
	* @check if user exists, then set user data in session or/and in cookies
	* @param string $login
	* @return void
	*/
	public function update_role($data, $id)
	{
		$permissions = $data['perm'];
		unset($data['perm']);
		
		$res = $this->db->where("id", $id)->update("p_roles", $data);
		if ($res)
		{
			$this->db->where("role_id", $id)->delete("p_role_perm");
			foreach($permissions as $perm)
			{
				$this->db->insert("p_role_perm", array("perm_id" => $perm, "role_id" => $id));
			}
		}
		return $res;
	}
	
	/**
	* @check if user exists, then set user data in session or/and in cookies
	* @param string $login
	* @return void
	*/
	public function delete_role($id)
	{
		$res = $this->db->where("id", $id)->delete("p_roles");
		return $res;
	}
	
	/**
	* @check if user exists, then set user data in session or/and in cookies
	* @param string $login
	* @return void
	*/
	public function create_role($data)
	{
		$res = $this->db->insert("p_roles", $data);
		return $res;
	}
	
	
}