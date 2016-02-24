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

class Component extends APP_Controller{
	public $name = "";
	public $label = "";
	
	function init(){
		parent::init();
	}
	
	public function register_menu_block($name, $key)
	{
		global $admin_menu;
		$admin_menu[$key] = array("title" => $name, "items" => array());
	}
	
	
	public function register_menu_item($name, $key, $parent, $class = "", $action = "", $icon = "")
	{
		global $admin_menu;
		
		$data = array("key" => $key, "name" => $name,  "parent" => $parent, "class" => $class, "action" => $action, "icon" => $icon);
		$data['link'] = $this->route->generate("component_action", array("component" => $this->label, "class" => $class, "action" => $action));
		
		array_walk($admin_menu,function(&$value,$s_key, $data){
			if ($data['parent'] == $s_key)
			{
				$value['items'][$data['key']] = array("title" => $data['name'] , "link" => $data['link'], "icon" => $data['icon']);
			}
			
			array_walk($value['items'],function(&$value,$s_key, $data){
				if ($data['parent'] == $s_key)
				{
					$value['items'][$data['key']] = array("title" => $data['name'] , "link" => $data['link'], "icon" => $data['icon']);
				}
			}, $data);
			
		}, $data);
	}
	
	public function renderTemplate($path)
	{
		$path = "components" . DS . $this->label . DS . "templates" . DS . $path;
		$component_content = $this->template->getTemplate($path, $this->template->vars);
		$this->template->set_var("component_content" , $component_content);
	}

}