<?php
require_once("Admin.php");

class Nodes extends Admin{
	
	public $fields = array();
	
	public function init()
	{
		parent::init();
		$this->load("models", "Nodes_Model", true);
		$this->load("models", "Channels_Model", true);
		$this->load("models", "Fields_Model", true);
	}
	
	public function edit_node($id)
	{
		if (!$id || !is_numeric($id))
			$this->route->go("home");
		
		$node = $this->get_node($id);
		if (!$node['id'])
			$this->route->go("error_500");
		
		$this->fields = $this->get_custom_fields($id);
		//print_r($fields);
		
		if ($this->request->post("ac") == "save")
		{
			$data = $this->request->post("data");
			$options = $this->request->post("option");
			$this->save_node($data, $options, $id);
		}
		
		$this->to_template("fields", $this->fields);
		
		$channel = $this->get_channel($node['channel_id']);
		$this->to_template("this_channel", $channel);
		
		$templates = $this->get_templates();
		$this->to_template("templates", $templates);
		
		$this->to_template("this_node", $node);
		$this->to_template("page", "channel_" . $channel['id']);
		$this->to_template("tab", "channels");
		$this->to_template("page_title", 'Edit page: ' . ($this->is_multilang ? $node['title'][$this->lang_keys[0]] : $node['title']));
		$this->renderTemplate("pages/node_edit.twig");
	}
	
	public function add_node($channel_id)
	{
		if (!$channel_id || !is_numeric($channel_id))
			$this->route->go("home");
		
		$channel = $this->get_channel($channel_id);
		if (!$channel['id'])
			$this->route->go("error_500");
		
		$this->fields = $this->get_channel_custom_fields($channel_id);
		//print_r($fields);
		
		if ($this->request->post("ac") == "save")
		{
			$data = $this->request->post("data");
			$options = $this->request->post("option");
			$this->save_node($data, $options);
		}
		
		$this->to_template("fields", $this->fields);
		
		$this->to_template("this_channel", $channel);
		
		$templates = $this->get_templates();
		$this->to_template("templates", $templates);
		
		$this->to_template("page", "channel_" . $channel['id']);
		$this->to_template("tab", "channels");
		$this->to_template("page_title", 'Add new page');
		$this->renderTemplate("pages/node_add.twig");
	}
	
	public function delete_node($node_id)
	{
		if (!$node_id || !is_numeric($node_id))
			$this->route->go("home");
		
		$node = $this->get_node($node_id);
		if (!isset($node['id']))
			$this->route->go("error_500");
		
		$fields = $this->get_custom_fields($node_id);
		foreach($fields as $field)
		{
			$field_id = $field->get_data("id");
			$field->delete_field_value($field_id, $node_id);
		}
		$this->nodes_model->delete_node($node_id);
		$this->route->go("channel", array('id' => $node['channel_id']));
	}
	
	private function get_node($id)
	{
		$node = $this->nodes_model->get_node($id);
		return $node;
	}

	private function get_channel($id)
	{
		$channel = $this->channels_model->get_channel($id);
		return $channel;
	}

	private function get_templates()
	{
		$dir = ROOT . DS . "app" . DS . "templates" . DS ;
		$templates = $this->parse_dir($dir);
		return $templates;
	}
	
	private function get_custom_fields($node_id)
	{
		$fields = $this->fields_model->get_node_fields($node_id);
		return $fields;
	}
	
	private function get_channel_custom_fields($channel_id)
	{
		$fields = $this->fields_model->get_channel_fields($channel_id);
		return $fields;
	}
	
	private function parse_dir($dir)
	{
		$final = array();
		// Open a known directory, and proceed to read its contents
		if (is_dir($dir)) {
			if ($dh = opendir($dir)) {
				while (($file = readdir($dh)) !== false ) {
					if ($file != "." && $file != "..")
					{
						if (filetype($dir . $file) == "dir")
							$final[$file] = $this->parse_dir($dir . $file . DS);
						else
						{
							$key = $dir . $file;
							$key = str_replace(ROOT , "", $key);
							$final[$key] = substr($file, 0, strrpos($file, "."));
						}
					}
				}
				closedir($dh);
			}
		}
		return $final;
	}
	
	function save_node($data, $options, $id = 0)
	{
		$res = array();
		if (!$id) // add node
		{
			$id = $this->nodes_model->create_node($options);
			$res['location'] = $this->route->generate("node_edit", array("id" => $id));
		}
		
		foreach($this->fields as $field)
		{
			$field_value = $field->prepare_data((isset($data[$field->data['label']]) ? $data[$field->data['label']] : ""), $id);
			
			$field_data = $field->get_data();
			if ($field_data['multilang'])
			{
				foreach($field_value as $lang => $value)
				{
					$arr = array("node_id" => $id, "field_id" => $field_data['id'], "label" => $field_data['label'] , "lang" => $lang, "value" => $value);
					$this->db->replace("p_node_fields" , $arr);
				}
			}
			else
			{
				$arr = array("node_id" => $id, "field_id" => $field_data['id'], "label" => $field_data['label'] , "lang" => "", "value" => $field_value);
				$this->db->replace("p_node_fields" , $arr);
			}
		}
		
		if (!is_array($data['title']))
		{
			$arr = array("node_id" => $id, "label" => "title" , "lang" => "", "value" => $data['title']);
			$this->db->replace("p_node_fields" , $arr);
		}
		else
		{
			foreach($data['title'] as $lang => $value)
			{
				$arr = array("node_id" => $id, "label" => "title" , "lang" => $lang, "value" => $value);
				$this->db->replace("p_node_fields" , $arr);
			}
		}
		$this->nodes_model->update_node($options, $id);
		$res['success'] = "Node was saved";
		
		echo json_encode($res);
		die();
	}
}