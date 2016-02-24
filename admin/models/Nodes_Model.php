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
		$title = $this->db->where("node_id", $id)->where("label", "title")->get("p_node_fields");
		if ($this->is_multilang)
		{
			$node['title'] = array();
			foreach($title as $t)
			{
				foreach($this->config['general']['langs'] as $k=>$l)
				{
					if ($t['lang'] == $k)
					{
						$node['title'][$k] = $t['value'];
					}
				}
			}
		}
		else
			$node['title'] = $t['value'];
		
		return $node;
	}

	/**
	* @get all nodes by channel_id
	* @param int $id
	* @return array
	*/
	public function get_nodes_by_channel($channel_id)
	{
		if ($this->is_multilang)
		{
			$langs = array_keys($this->config['general']['langs']);
		}
		$this->db->where("n.channel_id", $channel_id);
		$this->db->join("p_node_fields f", "f.node_id=n.id and f.label = 'title' " . ($this->is_multilang ? " and f.lang = '" . $langs[0] ."'": "") , "LEFT");
		$nodes = $this->db->get("p_nodes n", null, "n.* , f.value as title");
		return $nodes;
	}
	
	public function update_node($data, $id)
	{
		if (!isset($data['status']) || $data['status'] != "active")
			$data['status'] = "pending";
		if (isset($data['home_page']) && $data['home_page'] == 1)
		{
			$this->db->where("home_page", 1)->update("p_nodes", array("home_page" => 0));
		}
		$res = $this->db->where("id", $id)->update("p_nodes", $data);
		return $res;
	}
	
	public function create_node($data)
	{
		if (!isset($data['status']) || $data['status'] != "active")
			$data['status'] = "pending";
		$id = $this->db->insert("p_nodes", $data);
		return $id;
	}
	
	public function delete_node($node_id)
	{
		$this->db->where("id", $node_id)->delete("p_nodes");
		//$this->db->where("node_id", $node_id)->delete("p_node_fields");
	}
	
	public function search_by_link($uri)
	{
		if ($this->is_multilang)
		{
			$langs = array_keys($this->config['general']['langs']);
		}
		$this->db->join("p_node_fields f", "f.node_id=n.id and f.label = 'title' " . ($this->is_multilang ? " and f.lang = '" . $langs[0] ."'": "") , "LEFT");
		$node = $this->db->where("uri", $uri)->getOne("p_nodes n", "n.* , f.value as title");
		return $node;
	}
	
	public function get_home_page()
	{
		if ($this->is_multilang)
		{
			$langs = array_keys($this->config['general']['langs']);
		}
		$this->db->join("p_node_fields f", "f.node_id=n.id and f.label = 'title' " . ($this->is_multilang ? " and f.lang = '" . $langs[0] ."'": "") , "LEFT");
		$node = $this->db->where("home_page", 1)->getOne("p_nodes n", "n.* , f.value as title");
		return $node;
	}
}