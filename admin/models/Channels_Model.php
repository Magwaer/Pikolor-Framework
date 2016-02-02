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
	
	public function get_by_name($name)
	{
		$channel = $this->db->where("name", $name)->getOne("p_channels");
		return $channel;
	}
	
	public function get_channels()
	{
		$channels = $this->db->get("p_channels");
		return $channels;
	}
	
	public function create_channel($data)
	{
		$channel_id = $this->db->insert("p_channels", $data);
		return $channel_id;
	}
	
	public function update_channel($data, $id)
	{
		$channel_id = $this->db->where("id", $id)->update("p_channels", $data);
		return $channel_id;
	}
	
	public function delete_channel($id)
	{
		$res = $this->db->where("id", $id)->delete("p_channels");
		return $res;
	}

}