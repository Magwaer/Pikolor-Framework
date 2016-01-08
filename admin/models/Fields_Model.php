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

class fields_model extends Model{
	
	public function get_field_types()
	{
		$types = $this->db->get("p_field_types");
		return $types;
	}
	
	/**
	* @get one channel
	* @param int $id
	* @return array
	*/
	public function get_groups()
	{
		$groups = $this->db->get("p_fields_groups");
		return $groups;
	}
	
	public function create_group($data)
	{
		$id = $this->db->insert("p_fields_groups", $data);
		return $id;
	}
	
	public function get_group_by_name($name)
	{
		$group = $this->db->where("name", $name)->getOne("p_fields_groups");
		return $group;
	}
	
	public function get_group_by_id($id)
	{
		$group = $this->db->where("id", $id)->getOne("p_fields_groups");
		return $group;
	}
	
	public function update_group($data, $id)
	{
		$group = $this->db->where("id", $id)->update("p_fields_groups", $data);
		return $group;
	}
	
	public function get_fields_by_group($id)
	{
		$this->db->join("p_field_types t", "t.label=f.type", "LEFT");
		$groups = $this->db->where("f.group_id", $id)->get("p_fields f", null, "f.*, t.name as type_name");
		return $groups;
	}
	
	public function get_field_by_label($label)
	{
		$field = $this->db->where("label", $label)->get("p_fields");
		if (isset($field['options']))
			$field['options'] = array($field['type'] => json_decode($field['options'], true));
		return $field;
	}
	
	public function get_field_by_id($id)
	{
		$field = $this->db->where("id", $id)->getOne("p_fields");
		if (isset($field['options']))
			$field['options'] = array($field['type'] => json_decode($field['options'], true));
		return $field;
	}
	
	public function get_max_order_of_field($group_id)
	{
		$arr = $this->db->where("group_id", $group_id)->getOne("p_fields", "max(`order`) as max_order");
		return $arr['max_order'];
	}
	
	public function create_field($data)
	{
		$id = $this->db->insert("p_fields", $data);
		return $id;
	}
	
	public function update_field($data, $id)
	{
		$id = $this->db->where("id", $id)->update("p_fields", $data);
		return $id;
	}
}