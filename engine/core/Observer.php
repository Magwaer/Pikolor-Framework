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

class Observer extends pikolor_core{
	public $observers = array();
	
	public function append($name, $m)
	{
		$observers = $this->observers;
		if (!isset($observers[$name]))
			$observers[$name] = array();
		$observers[$name][] = $m;
		
		$this->observers = $observers;
	}
	
	public function notify($mt, &$args)
	{
		$observers = $this->observers;
		if (isset($observers[$mt]))
		{
			foreach($observers[$mt] as $f)
			{
				$args = call_user_func_array($f, $args);
			}
		}
	}
}