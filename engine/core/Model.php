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

class Model {
	public $db;
	public $config;
	public $is_multilang;
	public $template ;
	public $components ;
	
	function __construct($db, $config)
	{
		$this->db = $db;
		$this->config = $config;
		
		if (is_array($this->config['general']['langs']))
			$this->is_multilang = true;
		
		$this->init();
	}
	
	function init()
	{
		
	}
		
	/**
	* @init template
	*/
	public function init_template(&$template)
	{
		$this->template = &$template;
	}
	
	
	/**
	* @set components object
	* @param array $config
	*/
	function set_components(&$components)
	{
		$this->components = &$components;
	}
}


