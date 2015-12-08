<?php

class projects_model extends Model{
	
	/**
	* @get one channel
	* @param int $id
	* @return array
	*/
	public function get_all_projects($id, $status)
	{
		if ($id > 0)
			$this->db->where("P.company_id" , $id);
		if ($status)
			$this->db->where("P.status" , $id);
		
		$this->db->join("p_companies C", "P.company_id=C.id", "LEFT");
		$this->db->join("p_tasks T", "T.project_id=P.id", "LEFT");
		$this->db->join("p_hours H", "H.task_id=T.id", "LEFT");
		$this->db->groupBy("P.id");
		$projects = $this->db->get("p_projects P", null, " P.* , C.company as company_name, C.id as company_id, SUM(H.hours) as total_hours");
		
		return $projects;
	}
	
	/**
	* @check if user exists, then set user data in session or/and in cookies
	* @param string $login
	* @param string $password
	* @param int $remember
	* @return void
	*/
	public function insert($data)
	{
		return $this->db->insert("p_projects", $data);
	}
	
	/**
	* @check if user exists, then set user data in session or/and in cookies
	* @param string $login
	* @param string $password
	* @param int $remember
	* @return void
	*/
	public function get_one_project($id)
	{
		$this->db->join("p_companies C", "P.company_id=C.id", "LEFT");
		
		return $this->db->where("P.id", $id)->getOne("p_projects P", " P.* , C.company as company_name, C.id as company_id");
	}
	
	/**
	* @check if user exists, then set user data in session or/and in cookies
	* @param string $login
	* @param string $password
	* @param int $remember
	* @return void
	*/
	public function update($data, $old_project)
	{
		return $this->db->where('id', $old_project['id'])->update("p_projects", $data);
	}
	
	///
	/// Task secion
	///
		
	/**
	* @check if user exists, then set user data in session or/and in cookies
	* @param string $login
	* @param string $password
	* @param int $remember
	* @return void
	*/
	public function get_tasks($project_id)
	{
		$this->db->join("p_hours H", "H.task_id=T.id", "LEFT");
		$this->db->join("p_users U", "U.id=T.developer_id", "LEFT");
		$this->db->groupBy("T.id");
		return $this->db->where('T.project_id', $project_id)->get("p_tasks T", null, "T.*, U.name as developer, SUM(H.hours) as total_hours");
	}
	
	/**
	* @check if user exists, then set user data in session or/and in cookies
	* @param string $login
	* @param string $password
	* @param int $remember
	* @return void
	*/
	public function insert_task($data)
	{
		return $this->db->insert("p_tasks", $data);
	}
	
	/**
	* @check if user exists, then set user data in session or/and in cookies
	* @param string $login
	* @param string $password
	* @param int $remember
	* @return void
	*/
	public function get_one_task($id)
	{
		$this->db->join("p_projects P", "T.project_id=P.id", "LEFT");
		
		return $this->db->where("T.id", $id)->getOne("p_tasks T", " T.* , P.name as project_name, P.id as project_id");
	}
	
	/**
	* @check if user exists, then set user data in session or/and in cookies
	* @param string $login
	* @param string $password
	* @param int $remember
	* @return void
	*/
	public function update_task($data, $old_task)
	{
		return $this->db->where('id', $old_task['id'])->update("p_tasks", $data);
	}
	
	/**
	* @check if user exists, then set user data in session or/and in cookies
	* @param string $login
	* @param string $password
	* @param int $remember
	* @return void
	*/
	public function get_task_hours($task_id)
	{
		$this->db->orderBy("date","desc");
		$this->db->join("p_users U", "U.id=H.developer_id", "LEFT");
		return $this->db->where('H.task_id', $task_id)->get("p_hours  H", null, "H.*, U.name as developer");
	}
	
	/**
	* @check if user exists, then set user data in session or/and in cookies
	* @param string $login
	* @param string $password
	* @param int $remember
	* @return void
	*/
	public function insert_hour($data)
	{
		return $this->db->insert("p_hours", $data);
	}
	
}