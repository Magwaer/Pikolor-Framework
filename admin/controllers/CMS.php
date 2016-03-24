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

require_once("Admin.php");

class CMS extends Main_trigger{
	
	public $node = array();
	public $fields = array();
	public $rendered = false;
	
	public function init()
	{
		parent::init();
		
		$this->load("models", "Nodes_Model", true);
		$this->load("models", "Fields_Model", true);
		
		$this->init_cms();
	}
	
	public function init_cms()
	{
		$this->find_node();
		
		$this->to_template($this->fields);
		$this->to_template($this->node);
		
		if (isset($this->node['template']))
		{
			$this->renderTemplate($this->node['template']);
			$this->rendered = true;
		}
	}
	
	public function find_node()
	{
		$this->node = $this->get_node_by_uri();
		
		if($this->is_multilang)
			$loc_1 = $this->request->location(2);
		else
			$loc_1 = $this->request->location(1);
		
		if (!isset($this->node['id']) && !$loc_1)
			$this->node = $this->get_home_page();
		
		$this->fields = $this->get_node_fields($this->node);
	}
	
	public function get_node_by_uri()
	{
		$url = $this->request->uri;
		$node = $this->nodes_model->search_by_link($url);
		return $node;
	}
	
	public function get_home_page()
	{
		$node = $this->nodes_model->get_home_page();
		return $node;
	}
	
	public function get_node_fields($node)
	{
		$final = array();
		$fields = $this->fields_model->get_node_fields($node['id']);
		foreach($fields as &$field)
		{
			$value = $field->get_field_value();
			$label = $field->get_data("label");
			$final[$label] = $value;
		}
		return $final;
	}
	
	
	/**
	* @REWRITE parent function , to search file in ADMIN folder
	* @load a specific file
	* @param string $type
	* @param string $file
	* @param bool $init
	* @return void
	*/
	public function load($type , $file , $init = false)
	{
		$APP_PATH = ROOT . DS . "admin" . DS ;
		
		if (file_exists(ENGINE_PATH . $type . DS . $file . ".php"))
		{
			$adr = ENGINE_PATH . $type . DS . $file . ".php";
		}	
		elseif (file_exists($APP_PATH . $type . DS . $file . ".php"))
		{
			$adr = $APP_PATH . $type . DS . $file . ".php";
		}	
		
		if (isset($adr))
		{
			require_once($adr);
			if ($init)
			{
				$s_file = strtolower($file);
			
				if ($type == "models")
				{
					$instance = new $file($this->db, $this->config);
					$instance->init_template($this->template); 
					//$instance->set_components($this->set_components);
					$this->$s_file = $instance;
				}
				else
					$this->$s_file = new $file();
			}
			
		}
		else
			return false;
	}
}