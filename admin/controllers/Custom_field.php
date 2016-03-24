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
		//$this->template->twig->loader->addPath($this->path);
		
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
		echo  $this->getTemplate("/admin/custom_fields/" . (isset($field_data['type']) ? $field_data['type'] . "/" . $field_data['type'] : $field_data['label'] . "/" . $field_data['label']) . "_options.twig", $options);
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
	
	public function get_field_value()
	{
		$data = $this->get_data();
		if (!isset($data['value']))
			return;
		if ($data['multilang'])
			return $data['value'][$_SESSION['lang']];
		else
			return $data['value'];
	}
	
	public function prepare_data($data, $node_id)
	{
		return $data;
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


