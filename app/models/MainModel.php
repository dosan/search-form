<?php 

class MainModel
{

	/**
	* Every model needs a database connection, passed to the model
	* @param object $db A PDO database connection
	*/
	public $db;
	function __construct($db) {
		try {
			$this->db = $db;
		} catch (PDOException $e) {
			exit('Database connection could not be established.');
		}
	}

	public function querySqlWithTryCatch($sql){
		try {
			$query = $this->db->prepare($sql);
			$query->execute();
		} catch (PDOException $e) {
			exit(CONNECTION_FAILED);
		}
		return $query;
	}
	public function getArrayResult($query){
		if(! $query) return false;
		$result = array();
		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			$result[] = $row;
		}
		return $result;
	}
}