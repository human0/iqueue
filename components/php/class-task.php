<?php
require_once(LIB_PATH.DS.'object-database.php');
require_once(LIB_PATH.DS.'class-list.php');
class Task {
	
	public $taskid;
	public $clientid;
	public $agentlist;// all working agents
	public $title;
	public $description;// (and instructions)
	public $weight;// (task weight)
	public $completiontime;
	public $epoch;
	public $status;
	public $privacy;

	public $agentid_array=array();
	public $agent_array=array();
	
	protected static $key = "taskid";
	protected static $table="task";
	protected static $db_fields = array('taskid', 'privacy', 'clientid', 'agentlist', 'title', 'description', 'weight', 'completiontime', 'epoch', 'status');
	//no primary key
	public static $db_defaults = array('clientid'=>0, 'privacy'=>'public', 'agentlist'=>' ', 'title'=>'null', 'description'=>'null', 'weight'=>0, 'completiontime'=>0, 'epoch'=>0, 'status'=>'queued');

//	protected static $db_fields = array('gadgetit', 'agentid', 'name', 'description', 'cost', 'epoch');
//	protected static $db_fields = array('applicationid', 'taskid', 'agentid', 'epoch', 'status');

	
	public static function instantiate($record) 
	{
		$object = new Task;
		foreach($record as $attribute=>$value)
		{
		  if($object->has_attribute($attribute)) 
		  {
		    $object->$attribute = $value;
			if($attribute == "agentlist")
			{	
				$object->agentid_array=explode(',', $value);
			}
		  }
		}
		return $object;
	}

//---------Generic ----------//	
	public static function find_with_limit($n=0) 
	{
	  	$sql = "SELECT * FROM ".self::$table;
		if ($n>-1)
			$sql .= " LIMIT ".$n;
		return self::find_by_sql($sql);
	}

	public static function find_by_multiarray_page_and_number($multi_search="", $page=-1, $n=-1) 
	{
		$offset = $page * $n;
		$sql = "SELECT * FROM ".self::$table;
		$first = true;		
		foreach ($multi_search as $search)
		{
			$sql .= ($first)? " WHERE ( " :	 " OR ( ";
			$first = false;
			$f = true;
			foreach ($search as $att => $val)
			{	
				if (strpos($att, 'list') )
				{
					$sql .= $f? "{$att} LIKE '%{$val}%' " : "AND {$att} LIKE '%{$val}%' " ;
				}
				else
				{
					$sql .= $f? "{$att} = '{$val}' " : "AND {$att} = '{$val}' " ;	
				}
				$f=false;
			}
			$sql .= ")";
		}
		if ($n > -1) $sql .= " LIMIT {$n} "; 
		if ($page > -1) $sql .= " OFFSET {$offset}";
		return self::find_by_sql($sql);
	}

	
	public static function find_by_multi_array($multi_search)
	{	
		$sql = "SELECT * FROM ".self::$table;
		$first = true;
		
		foreach ($multi_search as $search)
		{
			$sql .= ($first)? " WHERE ( " :	 " OR ( ";
			$first = false;
			$f = true;
			foreach ($search as $att => $val)
			{	
				$sql .= $f? "{$att} = '{$val}' " : "AND {$att} = '{$val}' " ;	
				$f=false;
			}
			$sql .= ")";
		}
		return self::find_by_sql($sql);
	}
	
	public static function find_by_inclusive_array($search)
	{	
		$sql = "SELECT * FROM ".self::$table;
		$first = true;
		foreach ($search as $att => $val)
		{	
			if ($first)
				$sql .= " WHERE {$att} = '{$val}' ";	
			else
				$sql .= "AND {$att} = '{$val}' ";	
			$first=false;
		}
		return self::find_by_sql($sql);
	}
	
		public static function find_by_exclusive_array($search)
	{	
		$sql = "SELECT * FROM ".self::$table;
		$first= true;
		foreach ($search as $att => $val)
		{	
			if ($first)
				$sql .= " WHERE {$att} = '{$val}' ";	
			else
				$sql .= "OR {$att} = '{$val}' ";	
			$first=false;
		}
		return self::find_by_sql($sql);
	}

	public static function find_by_attribute_and_value($attribute="", $value="") 
	{
    	return self::find_by_sql("SELECT * FROM ".self::$table." WHERE {$attribute} = '{$value}' ");
	}	
  
	public static function find_by_attribute_and_listvalue($attribute="", $value="") 
	{
    	return self::find_by_sql("SELECT * FROM ".self::$table." WHERE {$attribute} LIKE '%{$value}%' ");
	}	

	public static function numbered_paging_attribute_and_value($attribute="", $value="", $page=0, $n=0) 
	{
		$offset = $page * $n;
    	return self::find_by_sql("SELECT * FROM ".self::$table." WHERE {$attribute} = '{$value}' LIMIT '{$n}' OFFSET {$offset}");
	}	
	
	public static function paging_attribute_and_value($attribute="", $value="", $pages=0){
		$n=10;
		self::numbered_paging_attribute_and_value($attribute, $value, $pages, $n);
	}

	public static function find_attribute_by_id($id=0, $attribute="") 
	{
    	$result_array = self::find_by_sql("SELECT {$attribute} FROM ".self::$table." WHERE ".self::$key."={$id} LIMIT 1 ");
		$object = !empty($result_array) ? array_shift($result_array) : false;
		return $object->$attribute;
	}
 
	public static function find_by_id($id=0) 
	{
    	$result_array = self::find_by_sql("SELECT * FROM ".self::$table." WHERE ".self::$key."={$id} LIMIT 1 ");
		return !empty($result_array) ? array_shift($result_array) : false;
	}
    
	public static function find_by_sql($sql="") 
	{
		global $database;
		$result_set = $database->query($sql);
		$object_array = array();
		while ($row = $database->fetch_array($result_set)) {
		  $object_array[] = self::instantiate($row);
		}
		return $object_array;
	}
  	/*
	protected function has_attribute($attribute) {
	  $object_vars = get_object_vars($this);
	  return array_key_exists($attribute, $object_vars);
	}*/
	
	private function has_attribute($attribute) 
	{
	  return array_key_exists($attribute, $this->attributes());
	}

	protected function attributes() { 
		// return an array of attribute names and their values
	  $attributes = array();
	  foreach(self::$db_fields as $field) {
	    if(property_exists($this, $field)) {
	      $attributes[$field] = $this->$field;
	    }
	  }
	  return $attributes;
	}
	
	protected function sanitized_attributes() {
	  global $database;
	  $clean_attributes = array();
	  foreach($this->attributes() as $key => $value){
	    $clean_attributes[$key] = $database->escape_value($value);
	  }
	  return $clean_attributes;
	}
	
	public function save() {
		$key = self::$key;
	  return isset($this->$key) ? $this->update() : $this->create();
	}
	
	public function create() {
		global $database;
		// - INSERT INTO table (key, key) VALUES ('value', 'value')
		$attributes = $this->sanitized_attributes();
	  $sql = "INSERT INTO ".self::$table." (";
		$sql .= join(", ", array_keys($attributes));
	  $sql .= ") VALUES ('";
		$sql .= join("', '", array_values($attributes));
		$sql .= "')";
	  $key = self::$key;
	  if($database->query($sql)) 
	  {
	    $this->$key = $database->insert_id();
	    return true;
	  } 
	  else 
	  {
	    return false;
	  }
	}

	public function update() 
	{
	  global $database;
		// - UPDATE table SET att='value', att='value' WHERE condition
		$attributes = $this->sanitized_attributes();
		$attribute_pairs = array();
		foreach($attributes as $att => $value) 
		{
		  $attribute_pairs[] = "{$att}='{$value}'";
		}
		$sql = "UPDATE ".self::$table." SET ";
		$sql .= join(", ", $attribute_pairs);
		$key = self::$key;
		$sql .= " WHERE ".self::$key."=". $database->escape_value($this->$key);
	  $database->query($sql);
	  return ($database->affected_rows() == 1) ? true : false;
	}

	public function delete() 
	{
		global $database;
		// - DELETE FROM table WHERE condition LIMIT 1
	  $sql = "DELETE FROM ".self::$table_name;
	  $sql .= " WHERE id=". $database->escape_value($this->id);
	  $sql .= " LIMIT 1";
	  $database->query($sql);
	  return ($database->affected_rows() == 1) ? true : false;
	}

	//---------------unique----------------//
	public function count_agents()
	{
		return count($this->agentlist);	  
	}
	
	public function hours_to_go()
	{
		$tt = round(date("U") - $this->epoch);
		$t = ($this->completiontime * 24 * 60 * 60) - $tt;
		return sprintf('%02d:%02d:%02d', ($t/3600),($t/60%60), $t%60);
		//return gmdate("H:i:s", (int)$result['s']);
	}
}?>