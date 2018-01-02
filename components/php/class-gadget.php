<?php
require_once(LIB_PATH.DS.'object-database.php');
require_once(LIB_PATH.DS.'class-list.php');
class Gadget {
	
	public $gadgetid;
	public $agentid;
	public $name;
	public $description;
	public $cost;
	public $ext;
	public $status;
	public $epoch;

	protected static $key = "gadgetid";
	protected static $table="gadget";
	protected static $db_fields = array('gadgetid', 'agentid', 'name', 'description', 'cost', 'ext', 'status', 'epoch');
	//no primary key
	public static $db_defaults = array('agentid'=>0, 'name'=>'no name', 'description'=>'no description', 'cost'=>0, 'ext'=>'jpg', 'status'=>'new', 'epoch'=>0);


	
	public static function instantiate($record) 
	{
		$object = new Gadget;
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
	public static function find_sorted_with_limit($sort="", $n=0) 
	{
	  	$sql = "SELECT * FROM ".self::$table;
		$sql .= " ORDER BY {$sort}";
		if ($n>-1)
			$sql .= " LIMIT ".$n;
		return self::find_by_sql($sql);
	}
	public static function find_sorted_by_attribute_and_value($attribute="", $value="", $sort="") 
	{
    	return self::find_by_sql("SELECT * FROM ".self::$table." WHERE {$attribute} = '{$value}' ORDER BY {$sort} ");
	}	

	public static function find_by_attribute_and_value($attribute="", $value="") 
	{
    	return self::find_by_sql("SELECT * FROM ".self::$table." WHERE {$attribute} = '{$value}' ");
	}	

	public static function paging_attribute_and_value($attribute="", $value="", $pages=0){
		$n=10;
		self::numbered_paging_attribute_and_value($attribute, $value, $pages, $n);
	}

	public static function numbered_paging_attribute_and_value($attribute="", $value="", $pages=0, $n=0) 
	{
		$offset = $pages * $n;
    	return self::find_by_sql("SELECT * FROM ".self::$table." WHERE {$attribute} = '{$value}' LIMIT 10 OFFSET {$offset}");
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
	  $sql = "DELETE FROM ".self::$table;
	  $sql .= " WHERE agentid=". $database->escape_value($this->agentid);
	  $sql .= " LIMIT 1";
	  $database->query($sql);
	  return ($database->affected_rows() == 1) ? true : false;
	}

	//---------------unique----------------//	
}?>