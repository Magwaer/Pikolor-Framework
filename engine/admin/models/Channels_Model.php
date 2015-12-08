<?php

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