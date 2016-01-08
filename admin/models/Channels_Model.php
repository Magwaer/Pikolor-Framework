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

class channels_model extends Model{
	
	/**
	* @get one channel
	* @param int $id
	* @return array
	*/
	public function get_channel($id)
	{
		$channel = $this->db->where("id", $id)->getOne("p_channels");
		return $channel;
	}

}