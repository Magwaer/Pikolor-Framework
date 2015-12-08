<?php

class users_model extends Model{
	
	/**
	* @check if user exists, then set user data in session or/and in cookies
	* @param string $login
	* @param string $password
	* @param int $remember
	* @return void
	*/
	public function get_all_users()
	{
		$this->db->join("p_user_companies UC", "UC.user_id=U.id", "LEFT");
		$this->db->join("p_companies C", "UC.company_id=C.id", "LEFT");
		
		$this->db->join("p_user_roles UR", "UR.user_id=U.id", "LEFT");
		$this->db->join("p_roles R", "UR.role_id=R.id", "LEFT");
		
		$users = $this->db->get("p_users U", null, " U.* , C.company as company_name, C.id as company_id, R.role");
		return $users;
	}
	
	/**
	* @check if user exists, then set user data in session or/and in cookies
	* @param string $login
	* @param string $password
	* @param int $remember
	* @return void
	*/
	public function get_all_developers()
	{
		$this->db->where("UR.role_id" , 2);
		$this->db->join("p_user_roles UR", "UR.user_id=U.id", "LEFT");
		
		$users = $this->db->get("p_users U", null, " U.*");
		return $users;
	}

	/**
	* @check if user exists, then set user data in session or/and in cookies
	* @param string $login
	* @param string $password
	* @param int $remember
	* @return void
	*/
	public function get_one_users($id)
	{
		$this->db->join("p_user_companies UC", "UC.user_id=U.id", "LEFT");
		$this->db->join("p_companies C", "UC.company_id=C.id", "LEFT");
		
		$this->db->join("p_user_roles UR", "UR.user_id=U.id", "LEFT");
		$this->db->join("p_roles R", "UR.role_id=R.id", "LEFT");
		
		return $this->db->where("U.id", $id)->getOne("p_users U", " U.* , C.company as company_name, C.id as company_id, R.role, R.id as role_id");
	}
	
	/**
	* @check if user exists, then set user data in session or/and in cookies
	* @param string $login
	* @param string $password
	* @param int $remember
	* @return void
	*/
	public function insert($data)
	{
		$user_id = $this->db->insert("p_users", array("email" => $data['email'], "name" => $data['name'], "password" => $data['password']));
		$this->db->insert("p_user_roles", array("user_id" => $user_id, "role_id" => $data['role']));
		if ($data['role'] == "3" && $data['company'])
			$this->db->insert("p_user_companies", array("user_id" => $user_id, "company_id" => $data['company']));
	}
	
	/**
	* @check if user exists, then set user data in session or/and in cookies
	* @param string $login
	* @param string $password
	* @param int $remember
	* @return void
	*/
	public function update($data, $old_user)
	{
		$this->db->where('id', $old_user['id'])->update("p_users", array("email" => $data['email'], "name" => $data['name']));
		$this->db->where('user_id', $old_user['id'])->update("p_user_roles", array("role_id" => $data['role']));
		if ($data['role'] == "3" && $data['company'])
		{
			if ($old_user['company_id'])
				$this->db->update("p_user_companies", array("company_id" => $data['company']));
			else
				$this->db->insert("p_user_companies", array("user_id" => $old_user['id'], "company_id" => $data['company']));
		}
		else
			$this->db->where("user_id", $old_user['id'])->delete("p_user_companies");
			
	}

}