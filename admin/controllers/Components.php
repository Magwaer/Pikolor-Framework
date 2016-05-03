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

class Components extends Admin{
	
	public function init()
	{
		parent::init();
		
		$this->load("models", "Nodes_Model", true);
		$this->load("models", "Channels_Model", true);
		$this->load("models", "Fields_Model", true);
		$this->load("models", "Components_Model", true);
	}
	
	public function show_components()
	{
		$components = $this->get_components();
		
		$this->to_template("components", $components);
		
		$this->to_template("page", "components" );
		$this->to_template("page_title", "Components");
		$this->renderTemplate("pages/components.twig");
	}
	
	public function install_component($component)
	{
		
	}
	
	public function install_uncomponent($component)
	{
		
	}
	
	private function get_components()
	{
		$components = array();
		$dir = ROOT . DS . "components" . DS ;
		if (is_dir($dir)) {
			if ($dh = opendir($dir)) {
				while (($file = readdir($dh)) !== false ) {
					if ($file != "." && $file != "..")
					{
						if (filetype($dir . $file) == "dir")
							$components[$file] = array("title" => $file);
					}
				}
				closedir($dh);
			}
		}
		
		$db_components = $this->components_model->get_all();
		foreach($db_components as $c)
		{
			$components[$c['label']]['status'] = "installed";
			$components[$c['label']]['title'] = $c['title'];
			$components[$c['label']]['desc'] = $c['desc'];
		}
		return $components;
	}
	
	public function component_action($component, $class, $action)
	{
		$instance = new $class;
		$instance->label = $component;
		$instance->set_config($this->config);
		$instance->init_db($this->db);
		$instance->init_template($this->template); 
		$instance->set_components($this->components);
		$instance->init(); 
				
		call_user_func_array(array($instance, $action), array());
		$this->template->vars = array_merge($instance->template->vars, $this->template->vars);
		if (!isset($this->template->vars['no_render_main']) or !$this->template->vars['no_render_main'])
			$this->renderTemplate("pages/component.twig");
		else
			echo $this->template->vars['component_content'];
	}
	

}

