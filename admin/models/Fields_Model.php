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
	
	/**
	* @get all fields type, and their instances
	* @return array
	*/
	public function get_field_types()
	{
		$types = $this->db->get("p_field_types");
		foreach($types as &$type)
		{
			$type['path'] = realpath(ADMIN_PATH . $type['path'] . "custom_field_" . $type['label'] . ".php");
			if (file_exists($type['path']))
			{
				require_once($type['path']);
				$class = 'custom_field_' . $type['label'];
				$instance = new $class;
				$instance->path = dirname($type['path']);
				$instance->set_config($this->config);
				$instance->init();
				$instance	->set_data($type);
				$type['obj'] = $instance;
			}
		}
		return $types;
	}
	
	/**
	* @get all the fields, and their instances, that are related to a channel, searched by channel id
	* @param int $channel_id
	* @return array
	*/
	public function get_channel_fields($channel_id)
	{
		$this->db->orderBy("f.order","asc");
		$this->db->join("p_field_types t", "t.label=f.type", "LEFT");
		$this->db->join("p_channels c", "c.group_id=f.group_id ", "LEFT");
		$fields = $this->db->where("c.id", $channel_id )->get("p_fields f", null, "f.*, t.name as type_name, t.path");
		
		foreach($fields as &$field)
		{
			$field['options'] = json_decode($field['options'], true);
			$field['path'] = realpath(ADMIN_PATH . $field['path'] . "custom_field_" . $field['type'] . ".php");
			if (file_exists($field['path']))
			{
				require_once($field['path']);
				$class = 'custom_field_' . $field['type'];
				$instance = new $class;
				$instance->path = dirname($field['path']);
				$instance->set_config($this->config);
				$instance->init();
				$instance	->set_data($field);
				$field = $instance;
			}
		}
		return $fields;
	}
	
	/**
	* @get all the fields, field options, their instances, and ALL their values, searched by node id
	* @param int $node_id
	* @return array
	*/
	public function get_node_fields($node_id)
	{
		$node = $this->db->where("id", $node_id)->getOne("p_nodes");
		
		$this->db->orderBy("f.order","asc");
		$this->db->join("p_field_types t", "t.label=f.type", "LEFT");
		$this->db->join("p_channels c", "c.group_id=f.group_id ", "LEFT");
		$fields = $this->db->where("c.id", $node['channel_id'] )->get("p_fields f", null, "f.*, t.name as type_name, t.path");
		
		$fields_values = $this->db->where("node_id", $node_id)->get("p_node_fields");
		foreach($fields_values as $v)
		{
			foreach($fields as &$field)
			{
				if ($field['id'] == $v['field_id'])
				{
					if (!isset($field['value']) || !is_array($field['value']))
						$field['value'] = array();
					if ($this->is_multilang && $field['multilang'] == 1)
					{
						foreach($this->config['general']['langs'] as $k=>$l)
						{
							if ($k == $v['lang'])
								$field['value'][$k] = $v['value'];
						}
					}
					else
					{
						$field['value'] = $v['value'];
					}
				}
			}
		}
		
		foreach($fields as &$field)
		{
			$field['options'] = json_decode($field['options'], true);
			$field['path'] = realpath(ADMIN_PATH . $field['path'] . "custom_field_" . $field['type'] . ".php");
			if (file_exists($field['path']))
			{
				require_once($field['path']);
				$class = 'custom_field_' . $field['type'];
				$instance = new $class;
				$instance->path = dirname($field['path']);
				$instance->set_config($this->config);
				$instance->init();
				$instance	->set_data($field);
				$field = $instance;
			}
		}
		return $fields;
	}
	
	/**
	* @get all custom fields groups
	* @return array
	*/
	public function get_groups()
	{
		$groups = $this->db->get("p_fields_groups");
		return $groups;
	}
	
	/**
	* @Create new custom field group
	* @param array $data
	* @return int
	*/
	public function create_group($data)
	{
		$id = $this->db->insert("p_fields_groups", $data);
		return $id;
	}
	
	/**
	* @get one group by name
	* @param string $name
	* @return array
	*/
	public function get_group_by_name($name)
	{
		$group = $this->db->where("name", $name)->getOne("p_fields_groups");
		return $group;
	}
	
	/**
	* @get one group by id
	* @param int $id
	* @return array
	*/
	public function get_group_by_id($id)
	{
		$group = $this->db->where("id", $id)->getOne("p_fields_groups");
		return $group;
	}
	
	/**
	* @update one group by id
	* @param array $data
	* @param int $id
	* @return bool
	*/
	public function update_group($data, $id)
	{
		$res = $this->db->where("id", $id)->update("p_fields_groups", $data);
		return $res;
	}
	
	/**
	* @get all field by group_id
	* @param int $id
	* @return array
	*/
	public function get_fields_by_group($id)
	{
		$this->db->join("p_field_types t", "t.label=f.type", "LEFT");
		$fields = $this->db->where("f.group_id", $id)->get("p_fields f", null, "f.*, t.name as type_name, t.label, t.path");
		return $fields;
	}
	
	/**
	* @get one field by label
	* @param string $label
	* @return array
	*/
	public function get_field_by_label($label)
	{
		$field = $this->db->where("label", $label)->get("p_fields");
		if (isset($field['options']))
			$field['options'] = array($field['type'] => json_decode($field['options'], true));
		return $field;
	}
	
	/**
	* @get one field by id
	* @param int $id
	* @return array
	*/
	public function get_field_by_id($id)
	{
		$this->db->join("p_field_types t", "t.label=f.type", "LEFT");
		$field = $this->db->where("f.id", $id)->getOne("p_fields f" , "f.*, t.path");
		if (isset($field['options']))
			$field['options'] = array($field['type'] => json_decode($field['options'], true));
		return $field;
	}
	
	/**
	* @get next order number, of coustom fields, in one group
	* @param int $group_id
	* @return array
	*/
	public function get_max_order_of_field($group_id)
	{
		$arr = $this->db->where("group_id", $group_id)->getOne("p_fields", "max(`order`) as max_order");
		return $arr['max_order'];
	}
	
	/**
	* @insert new custom field
	* @param array $data
	* @return int
	*/
	public function create_field($data)
	{
		$id = $this->db->insert("p_fields", $data);
		return $id;
	}
	
	/**
	* @update one field by id
	* @param array $data
	* @param int $id
	* @return int
	*/
	public function update_field($data, $id)
	{
		$id = $this->db->where("id", $id)->update("p_fields", $data);
		return $id;
	}
	
	/**
	* @delete one field by id, and all the its values
	* @param int $id
	* @return int
	*/
	public function delete_field($field_id)
	{
		//$this->db->where("field_id", $field_id)->delete("p_node_fields");
		$this->db->where("id", $field_id)->delete("p_fields");
	}
	
	/**
	* @delete one field by id, and all the its values
	* @param int $id
	* @return int
	*/
	public function delete_field_value($field_id, $node_id)
	{
		$this->db->where("field_id", $field_id)->where("node_id", $field_id)->delete("p_node_fields");
	}
	
	/**
	* @delete one group by id, and all the its fields, and all their values
	* @param int $id
	* @return int
	*/
	public function delete_group($group_id)
	{
		$this->db->where("id", $group_id)->delete("p_fields_groups");
	}
}