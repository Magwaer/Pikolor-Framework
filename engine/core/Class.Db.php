<?php
/*
* @ Version : 0.305
* @ Force update : 0
*/

class pikolor_db{
	var $tableName;
	var $condition;
	var $orderBy;
	var $order;
	var $limit;
	
	var $last_id ;
	
	var $data = array();
	
	var $join_tables;
	
	var $delim = "'";
	var $secure = false;
	var $query;
	
	var $error;
	
	var $format = true;
	
	
	function pikolor_db(){
		// echo "please init DB class <br />";
	}
	
	// Version 0.1
	// Last modification : 17.11.2014
	function findOneBy($condition = array())
	{
		$this->condition = $condition;
		return $this->selectRow();
	}
	
	// Version 0.1
	// Last modification : 17.11.2014
	function findBy($condition = array())
	{
		$this->condition = $condition;
		return $this->select();
	}
	
	// Version 0.1
	// Last modification : 17.11.2014
	function findAll()
	{
		return $this->select();
	}
	
	
	
    // Function that returns only one value selected from a table from DB

    // Version 0.2
    // Last modification : 26.11.2013
	
	function makeCondition($condition , $delim = "'")
	{
        $final_cond="";

        if (is_array($condition))
        {
			foreach ($condition as $key => $val)
			{
                if ($final_cond) $final_cond.=" AND ";
                $final_cond.=" " . $key . " = " . $this->delim . (!$this->secure ? mysql_real_escape_string($val)  : $val ). $this->delim . " ";
			}
		}
        elseif (!empty($condition))
		{
			$final_cond = $condition;
		}
		
		if ($final_cond)
			return " WHERE ".$final_cond;
	}

    // Function that returns only one value selected from a table from DB

    // Version 0.2
    // Last modification : 03.10.2010

    function selectRow()
	{
		$result = $this->select();
		if (!$this->error && count($result) > 0 )
			return $result[0];
		else
			return array();
	}



    // Function that returns all values selected from a table from DB

    // Version 0.4
    // Last modification : 17.11.2014

    function select()
	{
		$this->delim = "'";
		$final = array();

		$this->query = "SELECT * FROM `".$this->tableName."` ";
		
		$final_cond = "";
		
		if (is_array($this->condition))
			$final_cond = $this->makeCondition($this->condition);
		elseif ($this->condition)
			$final_cond = "WHERE " . $this->condition;

		$this->query .= $final_cond;
		
		$this->order_func();
		
		$result = $this->db_query();
		if ($result)
		{
			$final = $this->parse_result($result);
			
			if ($this->format)
				$final = $this->format($final);
			
			return $final;
		}

	}

    // Version 0.1
    // Last modification : 17.11.2014
	
	function parse_result($result)
	{
		$final = array();
		
		while ($top = mysql_fetch_array($result, MYSQL_ASSOC))
			array_push($final , $top);
		
		return $final;
	}
	
	// Version 0.1
    // Last modification : 17.11.2014
	function format($rows)
	{
		return $rows;
	}
	
	// Version 0.1
    // Last modification : 17.11.2014
	function unformat()
	{
		return $this->data;
	}

    // Function that returns count of all rows selected from a table from DB

    // Version 0.2
    // Last modification : 03.01.2014

    function select_count()
	{
		$this->delim = "'";
		$final = array();

		$this->query = "SELECT count(*) FROM `".$this->tableName."` ";
		
		$final_cond = "";
		
		if (is_array($this->condition))
			$final_cond = $this->makeCondition($this->condition);
		elseif ($this->condition)
			$final_cond = "WHERE " . $this->condition;

		$this->query .= $final_cond;
		
		$result = $this->db_query();
		if ($result)
		{
			$final = mysql_fetch_array($result);

			return $final[0];
		}

	}



    // Function that returns summ of one row selected from a table from DB

    // Version 0.1
    // Last modification : 30.09.2011

    function db_select_summ($table , $field ,$condition = "" )
	{
		$final=array();

		$query="SELECT SUM(`" . $field . "`) FROM `$table` ";

		if (is_array($condition))
			$final_cond = db_makeCondition($condition);
		elseif ($condition)
			$final_cond = "WHERE " . $condition;

		$query .= $final_cond;
		

		$result=db_query($query);
		if ($result)
			{
			$final=mysql_fetch_array($result);

			return $final[0];
			}
		else $error = "Wrong select";

	}



    // Function that returns all values selected from multiple tables from DB

    // Version 0.1
    // Last modification : 9.02.2011

    function select_join()
	{
		$this->delim = "";
		
		$final=array();

		$field_flague = false;
		$table_flague = false;
		
		$final_fields = "";
		$final_tables = "";
		
		foreach ($this->join_tables as $table => $fields)
			{
			foreach($fields as $field)
				{
				if ($field_flague)
					$final_fields .= " , ";
				$final_fields .= " " . $table . "." . $field . " ";

				$field_flague = true;
				}


			if ($table_flague)
					$final_tables .= " , ";
				$final_tables .= " `" . $table . "` ";

			$table_flague = true;
			}

		$this->query = "SELECT " . $final_fields . " FROM " . $final_tables;

		if (is_array($this->condition))
			$final_cond = $this->makeCondition($this->condition , "");
		elseif ($this->condition)
			$final_cond = "WHERE " . $this->condition;

		$this->query .= $final_cond;
		
		$this->order_func();
		
		$result = $this->db_query();
		if ($result)
			{
			while ($top = mysql_fetch_array($result, MYSQL_ASSOC))
				array_push($final , $top);

			return $final;
			}
	}



	// Function that returns all values selected from one row from multiple tables from DB
    // Version 0.1
    // Last modification : 11.02.2011
	function select_joinRow()
	{
		$result = $this->select_join();
		if (!$this->error && count($result) > 0 )
			return $result[0];
		else
			return array();
	}


    // Function that update a table in DB

    // Version 0.2
    // Last modification : 02.12.2013

    function update()
	{
		$i = 0;
		$this->query = "UPDATE `" . $this->tableName . "` set ";
		
		$this->unformat();
			
		if (count($this->data))
		{
			foreach($this->data as $key => $val)
			{
				$i++;
				if ($i>1) 
					$this->query .= ",";
					
				$this->query .= "`". $key ."`='". mysql_real_escape_string($val) ."'";
			}

			$final_cond = $this->makeCondition($this->condition);

			$this->query .= $final_cond;

			$result = $this->db_query();
			return $result;
		}
		else 
			return false;
	}



    // Function that insert data in table in DB

    // Version 0.1
    // Last modification : 25.10.2010

    function insert()
	{

		$this->query = "INSERT INTO `" . $this->tableName ."` (";

		$this->unformat();
		
		if (count($this->data))
		{
			$i=0;
			foreach(array_keys($this->data) as $key)
			{
				$i++;
				if ($i>1) 
					$this->query .= ",";
				
				$this->query .= "`". $key ."`";
			}

			$i=0;
			$this->query .= " ) values (";

			foreach($this->data as $val)
			{
				$val = mysql_real_escape_string($val);

				$i++;
				if ($i>1) 
					$this->query .= ",";
				
				$this->query .= "'". $val ."'";
			}

			$this->query .= ")";

			$result = $this->db_query();
			
			if ($result) 
			{
				return $this->get_last_id();
			}
			else
				return false;
		}
		else
			return false;
	}

	function get_last_id(){
		$this->query = "SELECT LAST_INSERT_ID();";
		$result = $this->db_query();
		if ($result)
		{
			$row = mysql_fetch_array($result);
			$this->last_id = $row[0];
		}
		return $this->last_id;
	}

	function delete()
	{
		$this->query = "DELETE FROM `" . $this->tableName . "` ";

		$final_cond = $this->makeCondition($this->condition);
		$this->query .= $final_cond;
		//$this->order_func();
		
		return $this->db_query();
	}

	function order_func()
	{
		if ($this->orderBy) $this->query .= "order by  `" . $this->orderBy . "` ";
		if ($this->order) $this->query .= " " .  $this->order . " ";

		if ($this->limit) $this->query .= " limit " . $this->limit;
	}		

	function db_query()
	{
		$result = mysql_query($this->query);
		
		if ($result)
		{
			//array_push( $_SESSION['db_query'] , array("type" => 1 , "query" => $this->query));
			return $result;
		}
		else
		{
			$this->error = mysql_errno() . ": " . mysql_error() . "\n";
			//array_push( $_SESSION['db_query'] , array("type" => 2 , "query" => $this->query , "error" => $this->error));
		}
		
	}
}