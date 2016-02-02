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

require_once("Admin.php");

class Channels extends Admin{
	
	public function init()
	{
		parent::init();
		$this->load("models", "Nodes_Model", true);
		$this->load("models", "Channels_Model", true);
		$this->load("models", "Fields_Model", true);
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
		$this->to_template("page_title", $channel['name']);
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
		foreach($nodes as &$node)
		{
			$tmp = explode(DS , $node['template']);
			$node['template_name'] = $tmp[count($tmp) - 1];
		}
		return $nodes;
	}
	
	public function manage_channels()
	{
		$channels = $this->channels_model->get_channels();
		$this->to_template("channels", $channels);
		
		$this->to_template("page", "channels");
		$this->to_template("tab", "templates");
		$this->to_template("page_title", "Manage channels");
		$this->renderTemplate("pages/manage_channels.twig");
	}
	
	public function add_channel(){
		if ($this->request->post('ac') == "add")
		{
			$res = array();
			$data = $this->request->post("data");
			if (strlen(trim($data['name'])) < 2)
				$res['error'] = "Too short channel name";
			else
			{
				$exists = $this->channels_model->get_by_name($data['name']);
				if (isset($exists['id']))
					$res['error'] = "This channel allready exists";
				else
				{
					$channel_id = $this->channels_model->create_channel($data);
					$res['location'] = $this->route->generate("manage_channels");
				}
			}
			
			echo json_encode($res);
			die();
		}
		
		$groups = $this->fields_model->get_groups();
		$this->to_template("groups", $groups);
		$this->to_template("form_action", $this->route->generate('add_channel'));
		$this->to_template("action", "add");
		$this->to_template("page_title", "Add Channel");
		$this->renderTemplate("ajax/channel.twig");
	}
	
	public function edit_channel($id){
		$channel = $this->channels_model->get_channel($id);
		if (!isset($channel['id']))
			$this->route->go("error_500");
		
		if ($this->request->post('ac') == "edit")
		{
			$res = array();
			$data = $this->request->post("data");
			if (strlen(trim($data['name'])) < 2)
				$res['error'] = "Too short channel name";
			else
			{
				$exists = $this->channels_model->get_by_name($data['name']);
				if (isset($exists['id']) && $exists['id'] != $id)
					$res['error'] = "This channel allready exists";
				else
				{
					$channel_id = $this->channels_model->update_channel($data, $id);
					$res['location'] = $this->route->generate("manage_channels");
				}
			}
			
			echo json_encode($res);
			die();
		}
		
		$groups = $this->fields_model->get_groups();
		$this->to_template("groups", $groups);
		$this->to_template("channel", $channel);
		$this->to_template("form_action", $this->route->generate('edit_channel', array("id" => $id)));
		$this->to_template("action", "edit");
		$this->to_template("page_title", "Add Channel");
		$this->renderTemplate("ajax/channel.twig");
	}
	
	public function delete_channel($id){
		$channel = $this->channels_model->get_channel($id);
		if (!isset($channel['id']))
			$this->route->go("error_500");
		
		$nodes = $this->nodes_model->get_nodes_by_channel($id);
		foreach($nodes as $node)
		{
			$fields = $this->fields_model->get_node_fields($node['id']);
			foreach($fields as $field)
			{
				$field_id = $field->get_data("id");
				$field->delete_field_value($field_id, $node['id']);
			}
			$this->nodes_model->delete_node($node['id']);
		}
		$this->channels_model->delete_channel($id);
		$this->route->go("manage_channels");
	}

}

