<?php
require_once(LIB_PATH.DS.'object-database.php');
require_once(LIB_PATH.DS.'class-list.php');
class Application {
	
	public $applicationid;
	public $taskid;
	public $agentid; 
	public $clientid;
	public $epoch;
	public $status;

	public $agentid_str;
	protected static $key = "applicationid";
	protected static $table="application";
	protected static $db_fields = array('applicationid', 'taskid', 'agentid', 'clientid', 'epoch', 'status');
	//no primary key
	public static $db_defaults = array('taskid'=>0, 'agentid'=>0, 'clientid'=>0, 'epoch'=>0, 'status'=>'pending');

//	protected static $db_fields = array('gadgetit', 'agentid', 'name', 'description', 'cost', 'epoch');

	
	public static function instantiate($record) 
	{
		$object = new Application;
		foreach($record as $attribute=>$value)
		{
		  if($object->has_attribute($attribute)) 
		  {
		    $object->$attribute = $value;
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
    	return self::find_by_sql("SELECT * FROM ".self::$table." WHERE {$attribute} = {$value} ");
	}	
  
	public static function find_by_attribute_and_listvalue($attribute="", $value="") 
	{
    	return self::find_by_sql("SELECT * FROM ".self::$table." WHERE {$attribute} LIKE %{$value}% ");
	}	
  
	public static function find_by_id($id=0) 
	{
    	$result_array = self::find_by_sql("SELECT * FROM ".self::$table." WHERE ".self::$key."={$id} LIMIT 1 ");
		return !empty($result_array) ? array_shift($result_array) : false;
	}
  
	public static function find_attribute_by_id($id=0, $attribute="") 
	{
    	$result_array = self::find_by_sql("SELECT {$attribute} FROM ".self::$table." WHERE ".self::$key."={$id} LIMIT 1 ");
		$object = !empty($result_array) ? array_shift($result_array) : false;
		return $object->$attribute;
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
}?>