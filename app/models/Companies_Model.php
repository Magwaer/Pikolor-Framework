<?php

class companies_model extends Model{
	
	/**
	* @get one company
	* @param int $id
	* @return array
	*/
	public function get_company_by_userid($id)
	{
		return  $this->db->join("p_user_companies UC", "US.company_id = C.id", "LEFT")->where("UC.user_id", $id)->getOne("p_companies C", null, "C.*");
	}
	
	/**
	* @get all comanies
	* @return array
	*/
	public function get_companies()
	{
		return  $this->db->get("p_companies");
	}

}