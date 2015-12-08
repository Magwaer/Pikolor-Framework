<?php
require_once("App.php");

class Users extends APP{
	
	public function init()
	{
		parent::init();
		
		if ($this->me['role'] != "admin")
			$this->error_500();
		
		$this->load("models", "Users_Model", true);
		$this->load("models", "Companies_Model", true);
	}
	
	public function view_all()
	{
		$users = $this->users_model->get_all_users();
		
		$this->to_template("users", $users);
		
		$this->to_template("page", "users" );
		$this->to_template("page_title", "Users");
		$this->renderTemplate("pages/users.twig");
	}
	
	public function add_user()
	{
		if (isset($_POST['action']) && $_POST['action'] == "add")
		{
			$data = $_POST['data'];
			$data['password'] = $this->access->encrypt($data['password']);
			$this->users_model->insert($data);
			die();
		}	
		$companies = $this->companies_model->get_companies();
		$this->to_template("companies", $companies);
		$this->to_template("action", "add");
		$this->to_template("form_action", $this->route->generate("user_add"));
		$this->to_template("page_title", "Add user");
		$this->renderTemplate("pages/user_add.twig");
	}
	
	public function edit_user($id)
	{
		if (!$id)
			$this->error_500();
		
		$user = $this->users_model->get_one_users($id);
		if (!$user['id'])
			$this->error_500();
		
		if (isset($_POST['action']) && $_POST['action'] == "edit")
		{
			$data = $_POST['data'];
			$this->users_model->update($data, $user);
			die();
		}	
		
		$this->to_template("user", $user);
		
		$companies = $this->companies_model->get_companies();
		$this->to_template("companies", $companies);
		$this->to_template("action", "edit");
		$this->to_template("form_action", $this->route->generate("user_edit", array("id" => $id)));
		$this->to_template("page_title", "Edit user");
		$this->renderTemplate("pages/user_add.twig");
	}	
	
	public function delete_user($id)
	{
		if (!$id)
			$this->error_500();
		
		$user = $this->users_model->get_one_users($id);
		if (!$user['id'])
			$this->error_500();
		
		if (isset($_POST['action']) && $_POST['action'] == "edit")
		{
			$data = $_POST['data'];
			$this->users_model->update($data, $user);
			die();
		}	
		
		$this->to_template("user", $user);
		
		$companies = $this->companies_model->get_companies();
		$this->to_template("companies", $companies);
		$this->to_template("action", "edit");
		$this->to_template("form_action", $this->route->generate("user_edit", array("id" => $id)));
		$this->to_template("page_title", "Edit user");
		$this->renderTemplate("pages/user_add.twig");
	}
	
	public function view_one($id)
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

