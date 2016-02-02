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
	
	public $has_multilang = false;
	
	public function get_html()
	{
		echo  $this->getTemplate("textarea.twig", $this->data);
	}

}


