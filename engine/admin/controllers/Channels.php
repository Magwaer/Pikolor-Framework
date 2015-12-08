<?php
require_once("Admin.php");

class Channels extends Admin{
	
	public function init()
	{
		parent::init();
		$this->load("models", "Nodes_Model", true);
		$this->load("models", "Channels_Model", true);
	}
	public function list_channel($id)
	{
		if (!$id || !is_numeric($id))
			$this->route->go("home");
		
		$channel = $this->get_channel($id);
		if (!$channel['id'])
			$this->route->go("error_500");
		
		$nodes = $this->get_nodes($id);
		$this->to_template("nodes", $nodes);
		
		$this->to_template("this_channel", $channel);
		$this->to_template("page", "channel_" . $id);
		$this->to_template("tab", "channels");
		$this->to_template("page_title", $channel['title']);
		$this->renderTemplate("pages/channels.twig");
	}
	
	private function get_channel($id)
	{
		$channel = $this->channels_model->get_channel($id);
		return $channel;
	}

	private function get_nodes($channel_id)
	{
		$nodes = $this->nodes_model->get_nodes_by_channel($channel_id);
		return $nodes;
	}

}

