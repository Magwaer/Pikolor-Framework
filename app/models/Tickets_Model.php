<?php

class nodes_model extends Model{
	
	/**
	* @get one node
	* @param int $id
	* @return array
	*/
	public function get_node($id)
	{
		$node = $this->db->where("id", $id)->getOne("p_nodes");
		return $node;
	}

	/**
	* @get all nodes by channel_id
	* @param int $id
	* @return array
	*/
	public function get_nodes_by_channel($channel_id)
	{
		$nodes = $this->db->where("channel_id", $channel_id)->get("p_nodes");
		return $nodes;
	}
}