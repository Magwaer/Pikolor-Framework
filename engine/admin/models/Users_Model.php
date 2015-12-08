<?php

class users_model extends Model{
	
	/**
	* @check if user exists, then set user data in session or/and in cookies
	* @param string $login
	* @param string $password
	* @param int $remember
	* @return void
	*/
	public function test()
	{
		$user = $this->db->where("id", 1)->getOne("p_users");
	}

}