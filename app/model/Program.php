<?php 
class Program extends DB{
	function __construct(DB $conn){
		$this->conn = $conn->conn; 
		// Auth middleware
		if (!isset($_SESSION['userid'])) {
			header('location: '.URLROOT.'/app/login.php');
		}
	} 
	public function all(){  
		$sql = "SELECT * FROM `program` LEFT JOIN `category` ON program.category_id = category.category_id";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}

	public function all_programs_by_event_id($id){  
		$sql = "SELECT * FROM `program` LEFT JOIN `category` ON program.category_id = category.category_id WHERE `event_id`= :id ";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}

	public function program_by_id($id)
	{
		$sql = "SELECT * FROM `program` WHERE program_id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_OBJ);
	}
	

	public function edit($id){
		$sql = "SELECT * FROM `program` WHERE program_id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_OBJ);
	} 
	public function store($request){  
		
	} 
	public function change($request){ 
		
	}
	public function destroy($id){ 
		$sql = "DELETE FROM `program` WHERE program_id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindValue(':id', $id); 
		return($stmt->execute()); 
	}


	
	/*---Instantiation of Object dynamically---*/
	protected static $tbl_name = "program";

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
		$sql .= " WHERE program_id =". $id;
		return  $this->InsertThis($sql);
	 	
	}

	public function delete($id=0) {
		
		  $sql = "DELETE FROM ".self::$tbl_name;
		  $sql .= " WHERE program_id =". $id;
		  $sql .= " LIMIT 1 ";
		return  $this->InsertThis($sql);
		  
	}
}