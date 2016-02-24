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

class pikolor_request {
	private $locations = array();
	public $uri;
	
	function __construct()
	{
		$this->getLocations();
		$this->uri = $_SERVER['REQUEST_URI'];
	}
	
	function get($var)
	{
		if (isset($_GET[$var]))
			return $_GET[$var];
		else
			return "";
	}
	
	function post($var)
	{
		if (isset($_POST[$var]))
			return $_POST[$var];
		else
			return "";
	}
	
	function req($var)
	{
		if (isset($_REQUEST[$var]))
			return $_REQUEST[$var];
		else
			return "";
	}
	
	function getLocations()
	{
		$uri 	= $_SERVER['REQUEST_URI'];
		$uri	= substr_replace($uri, '', 0, strlen(ADR));
		$string = explode('?',$uri);
		$map	= explode("/",$string[0]);
		
		$final = array();
		foreach($map as $location)
		{
			if (strlen($location))
				array_push($final , $location);
		}
		
		$this->locations = $final;
	}
	
	function last_location()
	{
		return $this->locations[count($this->locations)-1];
	}
	
	function total_locations()
	{
		return count($this->locations);
	}
	
	function location($i)
	{
		if (isset($this->locations[$i - 1]))
			return $this->locations[$i - 1];
		else
			return "";
	}
}