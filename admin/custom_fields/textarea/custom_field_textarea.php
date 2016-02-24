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

class custom_field_textarea extends Custom_field{
	
	public $has_multilang = true;
	
	public function get_html()
	{
		echo  $this->getTemplate("/admin/custom_fields/textarea/textarea.twig", $this->data);
	}
	
	public function get_field_value()
	{
		$value = parent::get_field_value();
		$options = $this->get_data('options');
		if ($options['formating'] == "br")
			$value = str_replace("\r\n", "<br />", $value);
		if ($options['formating'] == "p")
		{
			$value = explode("\r\n", $value);
			$value = implode("</p><p>", $value);
			$value = "<p>" . $value . "</p>";
		}	
		
		return $value;
	}

}


