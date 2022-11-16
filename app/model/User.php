<?php 
class User extends DB{
	function __construct(DB $conn){
		$this->conn = $conn->conn; 
		// Auth middleware
		if (!isset($_SESSION['userid'])) {
			header('location: '.URLROOT.'/app/login.php');
		}
	} 
	public function all(){  
		$sql = "SELECT * FROM `users`";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}

	public function find_users_not_in_judges($usertype, $users)
	{
		$sql = "SELECT * FROM `users` WHERE usertype = :usertype AND id NOT IN ($users)";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindValue(':usertype', $usertype); 
		$stmt->execute(); 
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}

	public function users_by_usertype($usertype)
	{
		$sql = "SELECT * FROM `users` WHERE usertype = :usertype";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindValue(':usertype', $usertype);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}
	public function edit($id){
		$sql = "SELECT * FROM `users` WHERE id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_OBJ);
	} 
	public function store($request){  
		$sql = "INSERT INTO `users`(`fullname`, `username`, `email`, `password`, `usertype`) VALUES (:fullname, :username, :email, :password, :usertype)";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindValue(':fullname', $request['fullname']);
		$stmt->bindValue(':username', $request['username']);
		$stmt->bindValue(':password', $request['password']);
		$stmt->bindValue(':email', $request['email']);
		$stmt->bindValue(':usertype', $request['usertype']);
		return($stmt->execute());
	} 
	public function change($request){ 
		$sql = "UPDATE `users` SET `fullname`= :fullname, `username`= :username, `email`= :email,`password`= :password, `usertype`= :usertype, `date_updated`= NOW() WHERE id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindValue(':id', $request['id']);
		$stmt->bindValue(':fullname', $request['fullname']);
		$stmt->bindValue(':username', $request['username']);
		$stmt->bindValue(':password', $request['password']);
		$stmt->bindValue(':email', $request['email']);
		$stmt->bindValue(':usertype', $request['usertype']); 
		return($stmt->execute()); 
	}
	public function destroy($id){ 
		$sql = "DELETE FROM `users` WHERE id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindValue(':id', $id); 
		return($stmt->execute()); 
	}

	public function getUser($id)
	{
		$sql = "SELECT * FROM `users` WHERE id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_OBJ); 
	}
	
	public function login($username, $password){
		$sql = "SELECT * FROM `users` WHERE `username` = :username AND `password` = :password";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindValue(':username', $username); 
		$stmt->bindValue(':password', $password);
		$stmt->execute();
		if ($stmt->rowcount() > 0) {
			$user = $stmt->fetch(PDO::FETCH_OBJ);
			$_SESSION['userid'] = $user->id;
			$_SESSION['usertype'] = $user->usertype;
			return 1; 
		}else{
			return 0;
		}

	}
	public function register($request){
		$sql = "INSERT INTO `users`(`fullname`, `username`, `email`, `password`) VALUES (:fullname, :username, :email, :password)";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindValue(':fullname', $request['fullname']);
		$stmt->bindValue(':username', $request['username']);
		$stmt->bindValue(':password', $request['password']);
		$stmt->bindValue(':email', $request['email']); 
		return($stmt->execute()); 

	}

	/*---Instantiation of Object dynamically---*/
	protected static $tbl_name = "users";

	function db_fields(){ 
		return $this->getFieldsOnOneTable(self::$tbl_name);
	}
	
	/*---Instantiation of Object dynamically---*/
	static function instantiate($record) {
		$object = new self;

		foreach($record as $attribute=>$value){
		  if($object->has_attribute($attribute)) {
		    $object->$attribute = $value;
		  }
		} 
		return $object;
	}
	
	
	/*--Cleaning the raw data before submitting to Database--*/
	private function has_attribute($attribute) {
	  // We don't care about the value, we just want to know if the key exists
	  // Will return true or false
	  return array_key_exists($attribute, $this->attributes());
	}

	protected function attributes() { 
		// return an array of attribute names and their values
	  
	  $attributes = array();
	  foreach($this->db_fields() as $field) {
	    if(property_exists($this, $field)) {
			$attributes[$field] = $this->$field;
		}
	  }
	  return $attributes;
	}
	
	protected function sanitized_attributes() {
	  
	  $clean_attributes = array();
	  // sanitize the values before submitting
	  // Note: does not alter the actual value of each attribute
	  foreach($this->attributes() as $key => $value){
	    $clean_attributes[$key] = $this->escape_value($value);
	  }
	  return $clean_attributes;
	}
	
	/*--Create,Update and Delete methods--*/
	public function save() {
	  // A new record won't have an id yet.
	  return isset($this->id) ? $this->update() : $this->create();
	}
	
	public function create() {
		
		// Don't forget your SQL syntax and good habits:
		// - INSERT INTO table (key, key) VALUES ('value', 'value')
		// - single-quotes around all values
		// - escape all values to prevent SQL injection
		$attributes = $this->sanitized_attributes();
		$sql = "INSERT INTO ".self::$tbl_name." (";
		$sql .= join(", ", array_keys($attributes));
		$sql .= ") VALUES ('";
		$sql .= join("', '", array_values($attributes));
		$sql .= "')";
		return	$this->InsertThis($sql);
	}

	public function update($id=0) {
	  
		$attributes = $this->sanitized_attributes();
		$attribute_pairs = array();
		foreach($attributes as $key => $value) {
		  $attribute_pairs[] = "{$key}='{$value}'";
		}
		$sql = "UPDATE ".self::$tbl_name." SET ";
		$sql .= join(", ", $attribute_pairs);
		$sql .= " WHERE id =". $id;
		return  $this->InsertThis($sql);
	 	
	}

	public function delete($id=0) {
		
		  $sql = "DELETE FROM ".self::$tbl_name;
		  $sql .= " WHERE id =". $id;
		  $sql .= " LIMIT 1 ";
		return  $this->InsertThis($sql);
		  
	}
}