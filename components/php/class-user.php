<?php
// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once(LIB_PATH.DS.'object-database.php');

class User {
	protected static $class;
	
	public $userid;
	public $username;
	public $password;
	public $email;
	public $epoch;
	public $status;
	public $usertype;
	public $typeid;

	public static function find_all() 
	{
		return self::find_by_sql("SELECT * FROM user");
    }
  
	public static function find_with_limit($n=0) 
	{
	   return self::find_with_limit_and_sort($n, "null");
	}
   
	public static function find_with_limit_and_sort($n=0, $sort="") 
	{
	  	$sql = "SELECT * FROM user";
		if( $sort != "null" )
		{
			$sql .= " ORDER BY ".$sort." DESC ";
		}
		if ($n>-1) {
			$sql .= "LIMIT ".$n;
		}
		return self::find_by_sql($sql);
	}
  
	public static function find_by_id($id=0) 
	{
    	$result_array = self::find_by_sql("SELECT * FROM user WHERE userid={$id} LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
	}
  
    public static function find_attribute_by_id($id=0, $attribute="") {
    	$result_array = self::find_by_sql("SELECT {$attribute} FROM user LIMIT 1 ");
		$object = !empty($result_array) ? array_shift($result_array) : false;
		return $object->$attribute;
  }
  
	public static function find_by_sql($sql="") 
	{
    	global $database;
    	$result_set = $database->query($sql);
	    $object_array = array();
	    while ($row = $database->fetch_array($result_set)) 
		{
      	$object_array[] = self::instantiate($row);
    	}
    return $object_array;
	}
	
	public static function instantiate($record) 
	{
		 if (self::$class=="agent") $object = new Agent;
		 else if (self::$class=="client") $object = new Client;
		 else if (self::$class=="admin") $object = new Admin; 
		 else $object = new User;
		foreach($record as $attribute=>$value)
		{
		  if($object->has_attribute($attribute)) 
		  {
		    $object->$attribute = $value;
		  }
		}
		return $object;
	}
	
	public function save() {
	  // A new record won't have an id yet.
	  return isset($this->userid) ? $this->update() : $this->create();
	}
	
	public function update() {
	  global $database;
		$sql = "UPDATE user SET ";
		$sql .= "username='". $database->escape_value($this->username) ."', ";
		$sql .= "password='". $database->escape_value($this->password) ."', ";
		$sql .= "status='". $database->escape_value($this->status) ."', ";
		$sql .= "usertype='". $database->escape_value($this->usertype) ."', ";
		$sql .= "typeid='". $database->escape_value($this->typeid) ."', ";
		$sql .= "email='". $database->escape_value($this->email) ."' ";
		$sql .= "WHERE userid=". $database->escape_value($this->userid);
	  $database->query($sql);
	  return ($database->affected_rows() == 1) ? true : false;
	}

	
	public function create() 
	{
		global $database;
		$sql = "INSERT INTO user (";
	  	$sql .= "username, password, usertype, status, epoch, email";
	  	$sql .= ") VALUES ('";
		$sql .= $database->escape_value($this->username) ."', '";
		$sql .= $database->escape_value($this->password) ."', '";
		$sql .= $database->escape_value($this->usertype) ."', '";
		$sql .= $database->escape_value($this->status) ."', '";
		$sql .= $database->escape_value($this->epoch) ."', '";
		$sql .= $database->escape_value($this->email) ."')";
		if($database->query($sql)) {
			$this->userid = $database->insert_id();
			return true;
		} 
		else 
		{
	    	return false;
		}
	}
	
	public function delete() 
	{
		global $database;
	  	$sql = "DELETE FROM user";
	  	$sql .= " WHERE userid='{$this->userid}'";
	  	$sql .= " LIMIT 1";
	  	$database->query($sql);
	  	return ($database->affected_rows() == 1) ? true : false;
	}
		
	public static function authenticate($username="", $password="") 
	{
		global $database;
		$username = $database->escape_value($username);
		$password = $database->escape_value($password);
		$sql  = "SELECT * FROM user ";
		$sql .= "WHERE username = '{$username}' ";
		$sql .= "AND password = '{$password}' ";
		$sql .= "LIMIT 1";
		$result_array = self::find_by_sql($sql);		
		return !empty($result_array) ? array_shift($result_array) : false;
	}
	
	public static function authenticate_by_attribute($attribute="", $value="") {
    global $database;	
 	$sql  = "SELECT * FROM user ";
    $sql .= "WHERE {$attribute} = '{$value}' ";
    $sql .= "LIMIT 1";
    $result_array = self::find_by_sql($sql);
		return !empty($result_array) ? true : false;
	}
	
	public static function usertype($userid="") 
	{
		global $database;	
		$sql  = "SELECT agentid FROM user, agent ";
		$sql .= "WHERE {$userid} = agent.userid ";
    	$result_set = $database->query($sql);
		if (mysqli_num_rows($result_set))
		{
			$object=mysqli_fetch_object($result_set);
			$arr = array("agent", $object->agentid);
			return $arr;
		}
		else
		{
			$sql  = "SELECT clientid FROM user, client ";
			$sql .= "WHERE {$userid} = client.userid ";
 		   	$result_set = $database->query($sql);
			if (mysqli_num_rows($result_set))
			{
				$object=mysqli_fetch_object($result_set);
				$arr = array("client", $object->clientid);
				return $arr;
			}
			else
			{
				$sql  = "SELECT adminid FROM user, admin ";
				$sql .= "WHERE {$userid} = admin.userid ";
 			   	$result_set = $database->query($sql);
				if (mysqli_num_rows($result_set))
				{
					$object=mysqli_fetch_object($result_set);
					$arr = array("admin", $object->adminid);
					return $arr;
				}
				else return false;
			}	
		}		
	}

	protected function has_attribute($attribute) {
	  $object_vars = get_object_vars($this);
	  return array_key_exists($attribute, $object_vars);
	}
}

class Agent extends User {
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
	public $points;
	public $hoursspent;
 
 	public function save() {
	  return isset($this->agentid) ? $this->update() : $this->create();
	}
	
	public function update() {
	  global $database;
		$sql = "UPDATE agent SET ";
		$sql .= "firstname='". $database->escape_value($this->firstname) ."', ";
		$sql .= "lastname='". $database->escape_value($this->lastname) ."', ";
		$sql .= "dateofbirth='". $database->escape_value($this->dateofbirth) ."', ";
		$sql .= "idnumber='". $database->escape_value($this->idnumber) ."', ";
		$sql .= "gender='". $database->escape_value($this->gender) ."', ";
		$sql .= "address='". $database->escape_value($this->address) ."', ";
		$sql .= "phonenumber='". $database->escape_value($this->phonenumber) ."', ";
		$sql .= "educationalbackground='". $database->escape_value($this->educationalbackground) ."', ";
		$sql .= "points='". $database->escape_value($this->points) ."', ";
		$sql .= "hoursspent='". $database->escape_value($this->hoursspent) ."' ";
		$sql .= "WHERE agentid=". $database->escape_value($this->agentid);
	  $database->query($sql);
	  return ($database->affected_rows() == 1) ? true : false;
	}
	
	 public function create() 
	{
		global $database;
		$sql = "INSERT INTO agent (";
	  	$sql .= "userid, firstname, lastname, dateofbirth, idnumber, gender, address, phonenumber, educationalbackground, points, hoursspent";
	  	$sql .= ") VALUES ('";
		$sql .= $database->escape_value($this->userid) ."', '";
		$sql .= $database->escape_value($this->firstname) ."', '";
		$sql .= $database->escape_value($this->lastname) ."', '";
		$sql .= $database->escape_value($this->dateofbirth) ."', '";
		$sql .= $database->escape_value($this->idnumber) ."', '";
		$sql .= $database->escape_value($this->gender) ."', '";
		$sql .= $database->escape_value($this->address) ."', '";
		$sql .= $database->escape_value($this->phonenumber) ."', '";
		$sql .= $database->escape_value($this->educationalbackground) ."', '";
		$sql .= $database->escape_value($this->points) ."', '";
		$sql .= $database->escape_value($this->hoursspent) ."')";
		if ($database->query($sql)) 
		{
			$this->agentid = $database->insert_id(); 
			return true;
		} 
		else 
		{
	    	return false;
		}
	}
	public function delete() 
	{
		global $database;
	  	$sql = "DELETE FROM agent";
	  	$sql .= " WHERE agentid= '{$this->agentid}'";
	  	$sql .= " LIMIT 1";
	  	$database->query($sql);
	  	return ($database->affected_rows() == 1) ? true : false;
	}
 
 public static function find_with_limit($n=0) {
	   return self::find_with_limit_and_sort($n, "null");
   }
   
  public static function find_with_limit_and_sort($n=0, $sort="") {
	 	self::$class = "agent";
	  	$sql = "SELECT * FROM user, agent ";
		$sql .= "WHERE user.userid = agent.userid ";
		if( $sort != "null" )
		{
			$sql .= "ORDER BY ".$sort." DESC ";
		}
		if ($n>-1) 
		{
			$sql .= "LIMIT ".$n;
		}
		return self::find_by_sql($sql);
  }
  
     public static function find_attribute_by_id($id=0, $attribute="") {
		self::$class = "agent";
    	$result_array = self::find_by_sql("SELECT {$attribute} FROM user, agent WHERE user.userid = agent.userid AND agentid = '{$id}' LIMIT 1 ");
		$object = !empty($result_array) ? array_shift($result_array) : false;
		return $object->$attribute;
  }
  
  public static function find_by_id($id=0) 
  {
	self::$class = "agent";
    $result_array = self::find_by_sql("SELECT * FROM user, agent WHERE user.userid = agent.userid AND agentid = '{$id}' LIMIT 1");
	return !empty($result_array) ? array_shift($result_array) : false;
  }
  
  public static function admin_find_by_id($id=0) 
  {
	self::$class = "agent";
    $result_array = self::find_by_sql("SELECT * FROM user, agent WHERE user.userid = agent.userid AND agentid = '{$id}' LIMIT 1");
	return !empty($result_array) ? array_shift($result_array) : false;
  }
}

class Client extends User {
	public $clientid;
	public $userid;
	public $firstname;
	public $lastname;
	public $address;
	public $hoursspent;
	public $points;

	public function save() {
	  // A new record won't have an id yet.
	  return isset($this->clientid) ? $this->update() : $this->create();
	}
	
	public function update() {
	  global $database;
		$sql = "UPDATE client SET ";
		$sql .= "firstname='". $database->escape_value($this->firstname) ."', ";
		$sql .= "lastname='". $database->escape_value($this->lastname) ."', ";
		$sql .= "hoursspent='". $database->escape_value($this->hoursspent) ."', ";
		$sql .= "points='". $database->escape_value($this->points) ."', ";
		$sql .= "address='". $database->escape_value($this->address) ."' ";
		$sql .= "WHERE clientid=". $database->escape_value($this->clientid);
	  $database->query($sql);
	  return ($database->affected_rows() == 1) ? true : false;
	}

	 public function create() 
	{
		global $database;
		$sql = "INSERT INTO client (";
	  	$sql .= "userid, points, hoursspent, firstname, lastname, address";
	  	$sql .= ") VALUES ('";
		$sql .= $database->escape_value($this->userid) ."', '";
		$sql .= $database->escape_value($this->points) ."', '";
		$sql .= $database->escape_value($this->hoursspent) ."', '";
		$sql .= $database->escape_value($this->firstname) ."', '";
		$sql .= $database->escape_value($this->lastname) ."', '";
		$sql .= $database->escape_value($this->address) ."')";
		if ($database->query($sql)) 
		{
			$this->clientid = $database->insert_id(); 
			return true;
		} 
		else 
		{
	    	return false;
		}
	}
	
	public function delete() 
	{
		global $database;
	  	$sql = "DELETE FROM client";
	  	$sql .= " WHERE clientid= '{$this->clientid}'";
	  	$sql .= " LIMIT 1";
	  	$database->query($sql);
	  	return ($database->affected_rows() == 1) ? true : false;
	}
	
	 public static function find_with_limit($n=0) {
		self::$class = "client";
		return self::find_with_limit_and_sort($n, "null");
   }
	
  public static function find_with_limit_and_sort($n=0, $sort="") {
		self::$class = "client";
	  	$sql = "SELECT * FROM user, client ";
		$sql .= "WHERE user.userid = client.userid ";
		if( $sort != "null" ){
			$sql .= "ORDER BY ".$sort." DESC ";
		}
		if ($n>-1)
			$sql .= "LIMIT ".$n;
		return self::find_by_sql($sql);
  }
  public static function find_attribute_by_id($id=0, $attribute="") {
	self::$class = "client";
    $result_array = self::find_by_sql("SELECT {$attribute} FROM user, client WHERE user.userid = client.userid AND clientid= '{$id}' LIMIT 1 ");
	$object = !empty($result_array) ? array_shift($result_array) : false;
	return $object->$attribute;
  }
  public static function find_by_id($id=0) {
	self::$class = "client";
    $result_array = self::find_by_sql("SELECT * FROM user, client WHERE user.userid = client.userid AND clientid = '{$id}' LIMIT 1");
	return !empty($result_array) ? array_shift($result_array) : false;
  }
  
}
class Admin extends User 
{
	public $adminid;
	public $userid;
	
public function save() {
	  // A new record won't have an id yet.
	  return isset($this->clientid) ? $this->update() : $this->create();
	}
	
	public function update() 
	{
	}

	 public function create() 
	{
		global $database;
		$sql = "INSERT INTO admin (";
	  	$sql .= "userid";
	  	$sql .= ") VALUES ('";
		$sql .= $database->escape_value($this->userid) ."')";
		if ($database->query($sql)) 
		{
			$this->adminid = $database->insert_id(); 
			return true;
		} 
		else 
		{
	    	return false;
		}
	}
	
		public function delete() 
	{
		self::$class = "admin";
		global $database;
	  	$sql = "DELETE FROM admin";
	  	$sql .= " WHERE adminid= '{$this->adminid}'";
	  	$sql .= " LIMIT 1";
	  	$database->query($sql);
	  	return ($database->affected_rows() == 1) ? true : false;
	}
	
	public static function find_with_limit($n=0) 
	{	
		self::$class = "admin";
 	    return self::find_with_limit_and_sort($n, "null");
	}
	
	public static function find_with_limit_and_sort($n=0, $sort="") 
	{
		self::$class = "admin";
	  	$sql = "SELECT * FROM user, admin ";
		$sql .= "WHERE user.userid = admin.userid ";
		if( $sort != "null" ){
			$sql .= "ORDER BY ".$sort." DESC ";
		}
		if ($n>-1)
			$sql .= "LIMIT ".$n;
		return self::find_by_sql($sql);
  }
  public static function find_attribute_by_id($id=0, $attribute="") {
		self::$class = "admin";
	    $result_array = self::find_by_sql("SELECT {$attribute} FROM user, admin WHERE user.userid = admin.userid AND adminid='{$id}' LIMIT 1 ");
		$object = !empty($result_array) ? array_shift($result_array) : false;
		return $object->$attribute;
  }
  public static function find_by_id($id=0) {
	self::$class = "admin";
    $result_array = self::find_by_sql("SELECT * FROM user, admin WHERE user.userid = admin.userid AND adminid='{$id}' LIMIT 1");
	return !empty($result_array) ? array_shift($result_array) : false;
  }
  
}
?>