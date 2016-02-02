<?php
/*
* Pikolor Engine - by Pikolor
*
* @package		Pikolor Engine
* @author		Buzco Stanislav
* @copyright	Copyright (c) 2008 - 2016, Pikolor
* @link		http://pikolor.com
* @ Version : 2 Beta
* @index
*/

class Custom_field extends APP_Controller{
	
	public $path = "";
	public $data = array();
	public $is_multilang = false;
	public $has_multilang = false;
	
	public function init()
	{
		parent::init();
		$this->template->twig->loader->addPath($this->path);
		
		if (is_array($this->config['general']['langs']))
			$this->is_multilang = true;
		
		$this->load("models", "Fields_Model", true);
	}
	
	public function getTemplate($path, $data)
	{
		return $this->template->getTemplate($path, $data);
	}
	
	public function get_options($options = array())
	{
		$field_data = $this->get_data();
		echo  $this->getTemplate((isset($field_data['type']) ? $field_data['type'] : $field_data['label']) . "_options.twig", $options);
	}
	
	public function set_data($data)
	{
		$this->data = $data;
	}
	
	public function get_data($key = false)
	{
		if (!$key)
			return $this->data;
		else
			return $this->data[$key];
	}
	
	public function save_data($data, $node_id)
	{
		$field_data = $this->get_data();
		if ($field_data['multilang'])
		{
			foreach($data as $lang => $value)
			{
				$arr = array("node_id" => $node_id, "field_id" => $field_data['id'], "label" => $field_data['label'] , "lang" => $lang, "value" => $value);
				$this->db->replace("p_node_fields" , $arr);
			}
		}
		else
		{
			$arr = array("node_id" => $node_id, "field_id" => $field_data['id'], "label" => $field_data['label'] , "lang" => "", "value" => $data);
			$this->db->replace("p_node_fields" , $arr);
		}
	}
	
	public function delete_field($field_id)
	{
		$this->fields_model->delete_field($field_id);
	}
	
	public function delete_field_value($field_id, $node_id)
	{
		$this->fields_model->delete_field_value($field_id, $node_id);
	}
}


