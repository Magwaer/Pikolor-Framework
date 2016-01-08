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

require_once("Admin.php");

class Custom_fields extends Admin{
	
	public function init()
	{
		parent::init();
		$this->load("models", "Nodes_Model", true);
		$this->load("models", "Channels_Model", true);
		$this->load("models", "Fields_Model", true);
	}

	public function show_groups()
	{
		$groups = $this->get_grops();
		$this->to_template("groups", $groups);
		
		$this->to_template("page", "custom_fields" );
		$this->to_template("tab", "templates");
		$this->to_template("page_title", "Custom fields groups");
		$this->renderTemplate("pages/fields_groups.twig");
	}
	
	public function show_fields($group_id)
	{
		$group = $this->fields_model->get_group_by_id($group_id);
		if (!$group['id'])
			$this->route->go("error_500");
		
		$fields = $this->fields_model->get_fields_by_group($group_id);
		
		$this->to_template("fields", $fields);
		$this->to_template("group", $group);
		
		$this->to_template("page", "custom_fields" );
		$this->to_template("tab", "templates");
		$this->to_template("page_title", $group['name'] . " - custom fields");
		$this->renderTemplate("pages/custom_fields.twig");
	}
	
	public function add_group()
	{
		if ($this->request->post('ac') == "add")
		{
			$res = array();
			$data = $this->request->post("data");
			if (strlen(trim($data['name'])) < 2)
				$res['error'] = "Too short goup name";
			else
			{
				$exists = $this->fields_model->get_group_by_name($data['name']);
				if ($exists['id'])
					$res['error'] = "This group allready exists";
				else
				{
					$group_id = $this->fields_model->create_group($data);
					$res['location'] = $this->route->generate("custom_fields", array("id" => $group_id));
				}
			}
			
			echo json_encode($res);
			die();
		}
		$this->to_template("form_action", $this->route->generate('add_field_groups'));
		$this->to_template("action", "add");
		$this->to_template("page", "custom_fields" );
		$this->to_template("tab", "templates");
		$this->to_template("page_title", "Add custom fields group");
		$this->renderTemplate("ajax/field_group.twig");
	}
	
	public function edit_group($id)
	{
		$group = $this->fields_model->get_group_by_id($id);
		if (!$group['id'])
			$this->route->go("error_500");
		
		if ($this->request->post('ac') == "edit")
		{
			$res = array();
			$data = $this->request->post("data");
			if (strlen(trim($data['name'])) < 2)
				$res['error'] = "Too short goup name";
			else
			{
				$db_res = $this->fields_model->update_group($data , $id);
				if (!$db_res)
					$res['error'] = "Ups... Something went wrong";
				else
					$res['location'] = $this->route->generate("fields_groups");
			}
			
			echo json_encode($res);
			die();
		}
		$this->to_template("group", $group);
		$this->to_template("form_action", $this->route->generate('edit_field_group', array("id" => $id)));
		$this->to_template("action", "edit");
		$this->to_template("page_title", "Edit custom fields group");
		$this->renderTemplate("ajax/field_group.twig");
	}
	
	public function add_custom_field($group_id)
	{
		$group = $this->fields_model->get_group_by_id($group_id);
		if (!$group['id'])
			$this->route->go("error_500");
		
		if ($this->request->post("ac") == "add")
		{
			$data = $this->request->post('data');
			$data['group_id'] = $group_id;
			$this->try_add_custom_field($data);
		}
		$field_types = $this->fields_model->get_field_types();
		
		$max_order = $this->fields_model->get_max_order_of_field($group_id);
		$this->to_template("field_types", $field_types);
		$this->to_template("max_order", $max_order + 1);
		$this->to_template("group", $group);
		$this->to_template("page", "custom_fields" );
		$this->to_template("tab", "templates");
		$this->to_template("page_title", "Add custom field");
		$this->renderTemplate("pages/add_custom_field.twig");
	}
	
	public function edit_custom_field($id)
	{
		$field = $this->fields_model->get_field_by_id($id);
		if (!isset($field['id']))
			$this->route->go("error_500");
		
		if ($this->request->post("ac") == "edit")
		{
			$data = $this->request->post('data');
			$this->try_edit_custom_field($data);
		}
		$field_types = $this->fields_model->get_field_types();
		$this->to_template("field_types", $field_types);
		$this->to_template("field", $field);
		$this->to_template("page", "custom_fields" );
		$this->to_template("tab", "templates");
		$this->to_template("page_title", "Edit custom field");
		$this->renderTemplate("pages/edit_custom_field.twig");
	}
	
	private function get_grops()
	{
		$channel = $this->fields_model->get_groups();
		return $channel;
	}
	
	private function try_add_custom_field($data)
	{
		$res = array();
		if (strlen(trim($data['name'])) < 2)
			$res['error'] = "Too short name";
		elseif (strlen(trim($data['label'])) < 2)
			$res['error'] = "Too short label";
		{
			$exists = $this->fields_model->get_field_by_label($data['label']);
			if (isset($exists['id']) && $exists['id'])
				$res['error'] = "This label allready exists. Please choose another one";
			else
			{
				$data['options'] = json_encode($data['options'][$data['type']]);
				$field_id = $this->fields_model->create_field($data);
				$res['location'] = $this->route->generate("custom_fields", array("id" => $data['group_id']));
			}
		}
		
		echo json_encode($res);
		die();
	}
	
	private function try_edit_custom_field($data)
	{
		$res = array();
		if (strlen(trim($data['name'])) < 2)
			$res['error'] = "Too short name";
		elseif (strlen(trim($data['label'])) < 2)
			$res['error'] = "Too short label";
		{
			$exists = $this->fields_model->get_field_by_label($data['label']);
			if (isset($exists['id']) && $exists['id'] != $data['id'])
				$res['error'] = "This label allready exists. Please choose another one";
			else
			{
				$data['options'] = json_encode($data['options'][$data['type']]);
				$field_id = $this->fields_model->update_field($data,$data['id']);
				//$res['location'] = $this->route->generate("custom_fields", array("id" => $data['group_id']));
				$res['success'] = "Field was saved";
			}
		}
		
		echo json_encode($res);
		die();
	}
}

