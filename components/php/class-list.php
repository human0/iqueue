<?php
//table name = name + s
//id = name + ID
//list = name + list
require_once(LIB_PATH.DS.'object-database.php');


class Lists {
	protected static $table="";

/*	public static function find_all() {
		return self::find_by_sql("SELECT * FROM users");
  }*/
  
 public static function array_by_list($array=array(), $listname){
	 // $array = unserialize($array);  // 
	 $array=explode(',',$array);
	  
	 // $table = $listname;
	  $name = substr($listname,0,-4);
	  $table = $name;
	  self::$table = $table;
	  //echo self::$table." ".$table;
	//  print_r($array);
	  $sql= "SELECT * FROM {$table} WHERE {$name}id=0";
	  foreach($array as $arr => $id){
		  $sql .= " OR {$name}id={$id} ";}
		//echo $sql;
	  return self::find_by_sql($sql);
  }
  
/*  public static function find_by_id($id=0) {
    $result_array = self::find_by_sql("SELECT * FROM users WHERE userID={$id} LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
  }*/
  
  public static function find_by_sql($sql="") {
    global $database;
    $result_set = $database->query($sql);
    $object_array = array();
    while ($row = $database->fetch_array($result_set)) {
      $object_array[] = self::instantiate($row);
    }
    return $object_array;
  }
  
  	public static function instantiate($record) {
	//	echo "<div>".self::$table.'</div>';
		$table = self::$table;
		switch ($table){
			case "agent": $object= new AgentList; break;
			case "user": $object= new UserList; break;
			//default: $object= new Skill;
			}
		foreach($record as $attribute=>$value){
		  if($object->has_attribute($attribute)) {
		    $object->$attribute = $value;
		  }
		}
		return $object;
	}
	
	protected function has_attribute($attribute) {
	  $object_vars = get_object_vars($this);
	  return array_key_exists($attribute, $object_vars);
	}

}

class AgentList extends Lists{
	public $agentid;
	public $userid;
	public $firstname;
	public $lastname;
	public $dateofbirth;
	public $idnumber;
	public $gender;
	public $address;
	public $phonenumber;
	public $educationalbackground;
	public $status;
	public $points;
	public $hoursspent;
}

class UserList extends Lists{
	public $userID;
	public $username;
}


?>