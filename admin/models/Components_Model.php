<?php

class components_model extends Model{
	
	/**
	* @check if user exists, then set user data in session or/and in cookies
	* @param string $login
	* @return void
	*/
	public function get_all()
	{
		return $this->db->get("p_components");
	}
	
	
}