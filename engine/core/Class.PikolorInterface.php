<?php
use Doctrine\ORM\Query\ResultSetMapping;


class PikolorInterface extends APP_Controller{
	
	public function updateAction()
	{
		$this->is_debugger = true;
		$action = $this->request->get("ac");
		if ($action)
		{
			if (method_exists($this , $action))
				$this->$action();
		}
		$entities = $this->getEntities();
		$this->to_template("entities" , $entities);
		
		$path = ENGINE_PATH . "web" . DS . "templates" . DS ;
		$this->template->setPath($path);
		$this->template->renderTemplate("update");
	}
	
	function createEntity()
	{
		$entity = $this->request->get("entity");
		
		$tool = new \Doctrine\ORM\Tools\SchemaTool($this->em);
		$classes = array(
			$this->em->getClassMetadata($entity),
		);
		$tool->createSchema($classes);
	}
	
	function updateEntity()
	{
		$entities = $this->getEntities();
		$classes = array();
		foreach($entities as $entity => $exists)
		{
			if ($exists)
				$classes[] = $this->em->getClassMetadata($entity);
		}
		$tool = new \Doctrine\ORM\Tools\SchemaTool($this->em);
		
		$tool->updateSchema($classes);
		
		$this->route->go("pikolor_update");
	}
	
	public function configAction()
	{
		$this->is_debugger = true;
		$action = $this->request->post("ac");
		if ($action)
		{
			if (method_exists($this , $action))
				$this->$action();
		}
		
		$path = ENGINE_PATH . "web" . DS . "templates" . DS ;
		$this->template->setPath($path);
		$this->template->renderTemplate("config");
	}
	
	function save_db_config()
	{
		/*
		$fp = fopen('D:\WebServers\home\pikolor\www\engine\config\db.json', 'X');
		echo ENGINE_PATH . "config" . DS . 'db.yml';
		var_dump($fp);
		fwrite($fp, $db_string);
		fclose($fp);
		*/
		$db = $this->request->post("db");
		$db_string = Spyc::YAMLDump($db);
		$fp = fopen( ENGINE_PATH . "config" . DS . 'db.yml', 'w');
		fwrite($fp, $db_string);
		fclose($fp);
	}
	
	function getEntities()
	{
		$final = array();
		$entities_path = APP_PATH . "Entities" ;
		if ($handle = opendir( $entities_path )) {
			while (false !== ($entry = readdir($handle))) {
				if ($entry != "." && $entry != ".."  ) {
					$name = str_replace(".php" , "" , $entry);
					if ($name != $entry)
					{
						$final[$name] = 1;
						$sql = 'SHOW TABLES LIKE \'' . strtolower($name) . '\' ' ;
						$connection = $this->em->getConnection();
						$statement = $connection->prepare( $sql);
						$statement->execute();
						$results = $statement->fetchAll();
						if (!count($results))
							$final[$name] = 0;
					}
				}
			}
			closedir($handle);
		}
		
		return $final;
	}
	
	
	public function getDebuggerAction($debug_id , $action)
	{
		$this->is_debugger = true;
		$path = ENGINE_PATH . "web" . DS . "templates" . DS ;
		$this->template->setPath($path);
		
		//$debug_id = $this->request->location(3);
		//$action = $this->request->get("ac");
		
		$this->to_template("debug_id"  , $debug_id);
		
		$debug_string = file_get_contents( ENGINE_PATH . "cache" . DS . "debugger" . DS . $debug_id . '.log');
		$debug_arr = unserialize($debug_string);
		
		if ($action ==  "get")
		{
			$this->to_template($debug_arr);
			$this->template->renderTemplate("debugger");
		}
		elseif ($action == "view_vars")
		{
			$this->to_template("vars"  , $debug_arr['template_vars']);
			$this->template->renderTemplate("debugger_pop");
		}
		elseif ($action = "view_logs")
		{
			$this->to_template("vars"  , $debug_arr['logs']);
			$this->template->renderTemplate("debugger_pop");
		}
	}
	
}