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

class custom_field_select extends Custom_field{
	
	public $has_multilang = false;
	
	public function get_html()
	{
		$this->data['options'] = explode("\r\n" , $this->data['options']['options']);
		
		echo  $this->getTemplate("/admin/custom_fields/select/select.twig", $this->data);
	}
	
}


