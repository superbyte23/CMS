<?php

class DB
{ 
	protected $host= DB_HOST;
	protected $user= DB_USER;
	protected $db= DB_NAME;
	protected $pass= DB_PASS;
 	protected $query = "";
 	protected $sql_string = "";
	protected $conn;
	public $last_query;
	private $magic_quotes_active;
	private $real_escape_string_exists;
    /**
     * [__construct description]
     */
	function __construct(){
	 	try {
	 		$this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->db,$this->user,$this->pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")); 
	 	 	$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	 	 	$this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
	 	} catch (PDOException $e) {
	 		return $e->getMessage();
	 	}
	} 
	public function setQuery($sql='') {
		try { 
			$this->query = $this->conn->prepare($sql);
			$this->query->execute();
		  } catch (PDOException $e) {
		    echo "Failed to get query handle: " . $e->getMessage() . "\n";
		    exit;
		  }
		
	} 
	public function result(){
		$data = $this->query->fetch(PDO::FETCH_OBJ);
		return $data;
	}

	function results_obj() {
		
		$results = $this->query->fetchAll(PDO::FETCH_OBJ);
		return $results;
	}

	public function results_assoc(){
		$data = $this->query->fetchAll(PDO::FETCH_ASSOC);
		return $data;
	}

	public function rowCount() {
		return $this->query->rowCount();
	}
 
	// main functions

	function InsertThis($sql='') {
		$this->sql_string=$sql;
		$this->query = $this->conn->prepare($this->sql_string);
		
		if($this->query->execute()) {
	   	 	return true;
	 	 } else {
	    	return false;
	  	}
	}

	public function getFieldsOnOneTable($tbl_name) {
	
		$this->setQuery("DESC ".$tbl_name);
		$rows = $this->results_obj();
		
		$f = array();
		for ( $x=0; $x<count( $rows ); $x++ ) {
			$f[] = $rows[$x]->Field;
		}
		
		return $f;
	}

	public function fetch_array($result) {
		return mysqli_fetch_array($result);
	}
	//gets the number or rows	

	public function insert_id() {
    // get the last id inserted over the current db connection
		return $this->conn->lastInsertId();
	}
  
	public function affected_rows() {
		return mysqli_affected_rows($this->conn);
	}
	
	 public function escape_value( $value ) {
		if( $this->real_escape_string_exists ) { // PHP v4.3.0 or higher
			// undo any magic quote effects so mysql_real_escape_string can do the work
			if( $this->magic_quotes_active ) { $value = stripslashes( $value ); }
			$value = mysql_real_escape_string( $value );
		} else { // before PHP v4.3.0
			// if magic quotes aren't already on then add slashes manually
			if( !$this->magic_quotes_active ) { $value = addslashes( $value ); }
			// if magic quotes are active, then the slashes already exist
		}
		return $value;
   	}
	
}

?>