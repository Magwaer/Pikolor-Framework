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

class custom_field_radio extends Custom_field{
	
	public $has_multilang = false;
	
	public function get_html()
	{
		$this->data['options'] = explode("\r\n" , $this->data['options']['options']);
		
		echo  $this->getTemplate("radio.twig", $this->data);
	}
	
	public function save_data($data, $node_id)
	{
		$field_data = $this->get_data();
		
		$arr = array("node_id" => $node_id, "field_id" => $field_data['id'], "label" => $field_data['label'] , "lang" => "", "value" => $data);
		$this->db->replace("p_node_fields" , $arr);
	
	}
}


