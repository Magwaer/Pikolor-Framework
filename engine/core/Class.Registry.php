<?php
/*
* @ Version : 0.305
* @ Force update : 0
*/

Class pikolor_registry {

	/*
	* @the vars array
	* @access private
	*/
	var $vars = array();


	/**
	*
	* @set undefined vars
	*
	* @param string $index
	*
	* @param mixed $value
	*
	* @return void
	*
	*/
	public function __set($index, $value)
	{
		$this->vars[$index] = $value;
	}

	/**
	*
	* @get variables
	*
	* @param mixed $index
	*
	* @return mixed
	*
	*/
	public function __get($index)
	{
		return $this->vars[$index];
	}

}
