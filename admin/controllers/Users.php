<?php
require_once("Admin.php");

class Users extends Admin{
	
	public $fields = array();
	
	public function init()
	{
		parent::init();
		$this->load("models", "Users_Model", true);
	}
	
	public function show_users()
	{
		$users = $this->get_users();
		$this->to_template("users", $users);
		
		$this->to_template("page", "users" );
		$this->to_template("tab", "users");
		$this->to_template("page_title", "Users");
		$this->renderTemplate("pages/users.twig");
	}
	
	public function user_roles()
	{
		$roles = $this->get_user_roles();
		$this->to_template("roles", $roles);
		
		$this->to_template("page", "user_roles" );
		$this->to_template("tab", "users");
		$this->to_template("page_title", "User roles");
		$this->renderTemplate("pages/user_roles.twig");
	}
	
	public function user_edit($id)
	{
		$user = $this->users_model->get_by_id($id);
		if (!$user['id'])
			$this->route->go("error_500");
		
		if ($this->request->post('ac') == "save")
		{
			$res = array();
			$data = $this->request->post("data");
			if (strlen(trim($data['name'])) < 2)
				$res['error'] = "Too short name";
			elseif (strlen(trim($data['email'])) < 6)
				$res['error'] = "Too short email";
			else
			{
				$exists = $this->users_model->get_user_by_email($data['email']);
				if (isset($exists['id']) && $exists['id'] != $id)
					$res['error'] = "This email is allready exists";
				else
				{
					$this->users_model->update_user($data, $id);
					$res = array();
					$res['success'] = "Node was saved";	
					echo json_encode($res);
					die();
				}
			}
			
			echo json_encode($res);
			die();
		}
		
		$roles = $this->get_user_roles();
		$this->to_template("roles", $roles);
		
		$this->to_template("user", $user);
		$this->to_template("page_title", "Edit user");
		$this->to_template("tab", "users");
		$this->to_template("page", "users");
		$this->renderTemplate("pages/user_edit.twig");
	}
	
	public function role_edit($id)
	{
		$role = $this->users_model->get_role_by_id($id);
		if (!$role['id'])
			$this->route->go("error_500");
		
		if ($this->request->post('ac') == "edit")
		{
			$res = array();
			$data = $this->request->post("data");
			if (strlen(trim($data['role'])) < 2)
				$res['error'] = "Too short role name";
			else
			{
				$exists = $this->users_model->get_role_by_name($data['role']);
				if (isset($exists['id']) && $exists['id'] != $id)
					$res['error'] = "This role allready exists";
				else
				{
					$channel_id = $this->users_model->update_role($data, $id);
					$res['location'] = $this->route->generate("user_roles");
				}
			}
			
			echo json_encode($res);
			die();
		}
		
		$this->to_template("role", $role);
		$this->to_template("page_title", "Edit role");
		$this->to_template("form_action", $this->route->generate('role_edit', array("id" => $id)));
		$this->to_template("action", "edit");
		$this->renderTemplate("ajax/role.twig");
	}
	
	public function role_add()
	{
		if ($this->request->post('ac') == "add")
		{
			$res = array();
			$data = $this->request->post("data");
			if (strlen(trim($data['role'])) < 2)
				$res['error'] = "Too short role name";
			else
			{
				$exists = $this->users_model->get_role_by_name($data['role']);
				if (isset($exists['id']))
					$res['error'] = "This role allready exists";
				else
				{
					$channel_id = $this->users_model->create_role($data);
					$res['location'] = $this->route->generate("user_roles");
				}
			}
			
			echo json_encode($res);
			die();
		}
		
		$this->to_template("page_title", "Add new role");
		$this->to_template("form_action", $this->route->generate('role_add'));
		$this->to_template("action", "add");
		$this->renderTemplate("ajax/role.twig");
	}
	
	public function role_delete($id)
	{
		$role = $this->users_model->get_role_by_id($id);
		if (!$role['id'])
			$this->route->go("error_500");
		
		$roles = $this->users_model->delete_role($id);
		$this->route->go("user_roles");
	}
	
	public function get_users()
	{
		$users = $this->users_model->get_all();
		return $users;
	}
	
	public function get_user_roles()
	{
		$roles = $this->users_model->get_user_roles();
		return $roles;
	}
	
}