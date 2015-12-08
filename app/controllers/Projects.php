<?php
require_once("App.php");

class Projects extends APP{
	
	public function init()
	{
		parent::init();
		
		$this->load("models", "Users_Model", true);
		$this->load("models", "Projects_Model", true);
		$this->load("models", "Companies_Model", true);
	}
	
	public function view_all()
	{
		if ($this->me['role'] == "client")
			$company_id = $this->me['company']['id'];
		else
			$company_id = 0;
		
		if ($this->me['role'] == "admin")
			$status = "";
		else
			$status = "open";
		
		$projects = $this->projects_model->get_all_projects($company_id, $status);
		
		$this->to_template("projects", $projects);
		
		$this->to_template("page", "projects" );
		$this->to_template("page_title", "Projects");
		$this->renderTemplate("pages/projects.twig");
	}
	
	public function add_project()
	{
		if (isset($_POST['action']) && $_POST['action'] == "add")
		{
			$data = $_POST['data'];
			$this->projects_model->insert($data);
			die();
		}	
		$companies = $this->companies_model->get_companies();
		$this->to_template("companies", $companies);
		$this->to_template("action", "add");
		$this->to_template("form_action", $this->route->generate("project_add"));
		$this->to_template("page_title", "Add project");
		$this->renderTemplate("pages/project_add.twig");
	}
	
	public function edit_project($id)
	{
		if (!$id)
			$this->error_500();
		
		$project = $this->projects_model->get_one_project($id);
		if (!$project['id'])
			$this->error_500();
		
		if (isset($_POST['action']) && $_POST['action'] == "edit")
		{
			$data = $_POST['data'];
			$this->projects_model->update($data, $project);
			die();
		}	
		
		$this->to_template("project", $project);
		
		$companies = $this->companies_model->get_companies();
		$this->to_template("companies", $companies);
		$this->to_template("action", "edit");
		$this->to_template("form_action", $this->route->generate("project_edit", array("id" => $id)));
		$this->to_template("page_title", "Edit project");
		$this->renderTemplate("pages/project_add.twig");
	}	
	
	public function delete_project($id)
	{
		if (!$id)
			$this->error_500();
		
		$project = $this->projects_model->get_one_project($id);
		if (!$project['id'] || $this->me['role'] != "admin")
			$this->error_500();
		
		$this->projects_model->update(array("status" => "closed"), $project);
		$this->route->go("projects");
	}
	
	public function view_one($id)
	{
		if (!$id)
			$this->error_500();
		
		$project = $this->projects_model->get_one_project($id);
		if (!$project['id'])
			$this->error_500();
		
		$tasks = $this->projects_model->get_tasks($id);
		
		$this->to_template("tasks", $tasks);
		$this->to_template("project", $project);
		$this->to_template("page", "projects" );
		$this->to_template("page_title", $project['name']);
		$this->renderTemplate("pages/project_view.twig");
	}
	
	///
	/// Task section
	///
	
	public function task_add($project_id)
	{
		if (isset($_POST['action']) && $_POST['action'] == "add")
		{
			$data = $_POST['data'];
			$data['project_id'] = $project_id;
			$this->projects_model->insert_task($data);
			$this->route->go("project_view", array("id" => $project_id));
		}	
		
		$developers = $this->users_model->get_all_developers();
		$project = $this->projects_model->get_one_project($project_id);
		
		$this->to_template("project", $project);
		$this->to_template("developers", $developers);
		$this->to_template("action", "add");
		$this->to_template("form_action", $this->route->generate("task_add", array("id" => $project_id)));
		$this->to_template("page", "projects" );
		$this->to_template("page_title", "Add Task");
		$this->renderTemplate("pages/task_add.twig");
	}
	
	public function task_edit($id)
	{
		if (!$id)
			$this->error_500();
		
		$task = $this->projects_model->get_one_task($id);
		if (!$task['id'])
			$this->error_500();
		
		if (isset($_POST['action']) && $_POST['action'] == "edit")
		{
			$data = $_POST['data'];
			$this->projects_model->update_task($data, $task);
			$this->route->go("project_view", array("id" => $task['project_id']));
		}	
		$developers = $this->users_model->get_all_developers();
		$project = $this->projects_model->get_one_project($task['project_id']);
		
		$this->to_template("project", $project);
		$this->to_template("developers", $developers);
		$this->to_template("task", $task);
		$this->to_template("action", "edit");
		$this->to_template("form_action", $this->route->generate("task_edit", array("id" => $id)));
		$this->to_template("page", "projects" );
		$this->to_template("page_title", "Edit task");
		$this->renderTemplate("pages/task_add.twig");
	}	
	
	public function task_delete($id)
	{
		if (!$id)
			$this->error_500();
		
		$task = $this->projects_model->get_one_task($id);
		if (!$task['id'] || $this->me['role'] != "admin")
			$this->error_500();
		
		$this->projects_model->update_task(array("status" => "deleted"), $task);
		$this->route->go("project_view", array("id" => $task['project_id']));
	}	
	
	public function task_view($id)
	{
		if (!$id)
			$this->error_500();
		
		$task = $this->projects_model->get_one_task($id);
		if (!$task['id'] || $this->me['role'] != "admin")
			$this->error_500();
		
		$hours = $this->projects_model->get_task_hours($id);
		$project = $this->projects_model->get_one_project($task['project_id']);
		
		
		$this->to_template("project", $project);
		$this->to_template("hours", $hours);
		$this->to_template("task", $task);
		$this->to_template("page_title", $task['name']);
		$this->to_template("page", "projects" );
		$this->renderTemplate("pages/task_view.twig");
	}

	public function log_time($task_id)
	{
		if (isset($_POST['action']) && $_POST['action'] == "add")
		{
			$data = $_POST['data'];
			$data['developer_id'] = $this->me['id'];
			$data['task_id'] = $task_id;
			$data['added'] = date('Y-m-d H:i:s');
			
			$this->projects_model->insert_hour($data);
			die();
			//$this->route->go("task_view", array("id" => $task_id));
		}	
		
		$this->to_template("today", date('Y-m-d'));
		$this->to_template("action", "add");
		$this->to_template("form_action", $this->route->generate("log_time", array("id" => $task_id)));
		$this->to_template("page_title", "Log yout work time");
		$this->renderTemplate("pages/log_time.twig");
	}
}

