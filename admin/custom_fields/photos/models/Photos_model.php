<?php
/*
* Pikolor Butik - by Pikolor Lab
*
* @package		Component Pikolor Butik
* @author		Pikolor Lab
* @copyright	Copyright (c) 2008 - 2016, Pikolor Lab
* @link		http://pikolor.com/components/Butik
* @ Version : 1 Beta
* @index
*/

class photos_model extends Model{
	
	public function init()
	{
		
	}
	
	/**
	* @get all fields type, and their instances
	* @return array
	*/
	public function get_by_id($id)
	{
		$photos = $this->db->where("id", $id)->getOne("p_custom_field_photos");
		return $photos;
	}
	
	/**
	* @get all fields type, and their instances
	* @return array
	*/
	public function create($data)
	{
		$photo_id = $this->db->insert("p_custom_field_photos", $data);
		return $photo_id;
	}
	
	/**
	* @get all fields type, and their instances
	* @return array
	*/
	public function update($data, $id)
	{
		$res = $this->db->where("id", $id)->update("p_custom_field_photos", $data);
		return $res;
	}
	
}