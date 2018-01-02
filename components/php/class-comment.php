<?php
require_once(LIB_PATH.DS.'object-database.php');
require_once(LIB_PATH.DS.'class-list.php');
require_once(LIB_PATH.DS.'class-user.php');
class Comment {
	
	public $commentid;
	public $userid;
	public $targetid; //commentid, ProjectID
	public $type; // comment, reply
	public $dateandtime;
	public $ext;
	public $comment;
	
	protected static $key = "commentid";
	protected static $table="comments";
	protected static $db_fields = array('commentid', 'userid', 'targetid', 'type', 'dateandtime', 'ext', 'comment');
	//no primary key
	public static $db_defaults = array('userid'=>0, 'targetid'=>0, 'type'=>'null', 'dateandtime'=>'0', 'ext'=>'null', 'comment'=>'no comment');
	
  public static function find_with_limit_type_and_target($n=0 , $type="", $tid=0) {
	  	$sql = "SELECT * FROM comments ";
		$sql .= " WHERE targetid={$tid} ";
		$sql .= " AND type='{$type}' ";
		if ($n>-1)
			$sql .= " LIMIT ".$n;
		$sql .= " ORDER BY commentid DESC ";
		return self::find_by_sql($sql);
  }

/*  public static function find_by_attribute_and_value($attribute="", $value="") {
    return self::find_by_sql("SELECT * FROM comments WHERE {$attribute}={$value}");
  }*/	

  public static function find_by_id($id=0) {
    $result_array = self::find_by_sql("SELECT * FROM comments WHERE commentid={$id} LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
  }
  
    public static function find_by_sql($sql="") {
    global $database;
    $result_set = $database->query($sql);
    $object_array = array();
    while ($row = $database->fetch_array($result_set)) {
      $object_array[] = self::instantiate($row);
    }
    return $object_array;
  }
public function target_comment_username(){
	if ($this->type != "reply" ) return "no reply";
	$target_comment = $this->find_by_id($this->targetid);
	$target_comment_user = User::find_by_id($target_comment->userid);
	return $target_comment_user->username;	
} 

public function create() {
		global $database;
	  $sql = "INSERT INTO ".self::$table." (";
	  $sql .= "userid, targetid, type, comment, ext, dateandtime";
	  $sql .= ") VALUES ('";
		$sql .= $database->escape_value($this->userid) ."', '";
		$sql .= $database->escape_value($this->targetid) ."', '";
		$sql .= $database->escape_value($this->type) ."', '";
		$sql .= $database->escape_value($this->comment) ."', '";
		$sql .= $database->escape_value($this->ext) ."', '";
		$sql .= $database->escape_value($this->dateandtime) ."')";
		if($database->query($sql)) {
	    	$this->commentid = $database->insert_id();
	   		return true;
	  } else {
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

	public static function instantiate($record) {
		$object = new Comment;
		foreach($record as $attribute=>$value){
		  if($object->has_attribute($attribute)) {
		    $object->$attribute = $value;
			if(strpos($attribute,"list")){
				$object->{$attribute."_str"}=$object->$attribute;
				$object->$attribute = UserList::array_by_list($object->$attribute, $attribute);
			}
		  }
		}
		return $object;
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
}?>