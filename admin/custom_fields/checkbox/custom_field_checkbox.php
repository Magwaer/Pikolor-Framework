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

class custom_field_checkbox extends Custom_field{
	
	public $has_multilang = false;
	
	public function get_html()
	{
		$this->data['options'] = explode("\r\n" , $this->data['options']['options']);
		$this->data['value'] = json_decode(isset($this->data['value']) ? $this->data['value'] : "", true);
		
		echo  $this->getTemplate("/admin/custom_fields/checkbox/checkbox.twig", $this->data);
	}
	
	public function get_field_value()
	{
		$value = $this->get_data('value');
		$value = json_decode($value, true);
		if (!is_array($value))
			$value = array();
		
		return $value;
	}
	
	public function prepare_data($data, $node_id)
	{
		return json_encode($data);
	}
}


