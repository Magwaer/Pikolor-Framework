<?php
require_once("Admin.php");

class Nodes extends Admin{
	
	public function init()
	{
		parent::init();
		$this->load("models", "Nodes_Model", true);
		$this->load("models", "Channels_Model", true);
	}
	
	public function edit_node($id)
	{
		if (!$id || !is_numeric($id))
			$this->route->go("home");
		
		$node = $this->get_node($id);
		if (!$node['id'])
			$this->route->go("error_500");
		
		$channel = $this->get_channel($node['channel_id']);
		
		$templates = $this->get_templates();
		
		$this->to_template("templates", $templates);
		$this->to_template("this_node", $node);
		$this->to_template("this_channel", $channel);
		$this->to_template("page", "channel_" . $channel['id']);
		$this->to_template("tab", "channels");
		$this->to_template("page_title", $node['title']);
		$this->renderTemplate("pages/node_edit.twig");
	}
	
	private function get_node($id)
	{
		$node = $this->nodes_model->get_node($id);
		return $node;
	}

	private function get_channel($id)
	{
		$channel = $this->channels_model->get_channel($id);
		return $channel;
	}

	private function get_templates()
	{
		$dir = ROOT . DS . "app" . DS . "templates" . DS ;

		$templates = $this->parse_dir($dir);
		return $templates;
	}
	
	private function parse_dir($dir)
	{
		$final = array();
		// Open a known directory, and proceed to read its contents
		if (is_dir($dir)) {
			if ($dh = opendir($dir)) {
				while (($file = readdir($dh)) !== false ) {
					if ($file != "." && $file != "..")
					{
						if (filetype($dir . $file) == "dir")
							$final[$file] = $this->parse_dir($dir . $file . DS);
						else
							$final[$file] = substr($file, 0, strrpos($file, "."));
					}
				}
				closedir($dh);
			}
		}
		return $final;
	}
}