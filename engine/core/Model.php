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
	
	function __construct($db, $config)
	{
		$this->db = $db;
		$this->config = $config;
		
		if (is_array($this->config['general']['langs']))
			$this->is_multilang = true;
	}
}


