<?php
class PDOHelper {
	var $db;
	var $lastquery;
	function PDOHelper($servername, $username, $password, $db){
		try{
			$this->db = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
		} catch(PDOException $ex) {
			die("Failed to connect to the database");
		}
	}
	function query($query){
		$query = $this->db->prepare($query);
		$this->lastquery = $query->execute();
		return $query;
	}
	function fetch($resource){
		return $resource->fetch(PDO::FETCH_ASSOC);
	}
	function insertId(){
		return $this->db->lastInsertId();
	}
	function queryDone(){
		return $this->lastquery;
	}
	function getLastError(){
		return $this->db->errorInfo();
	}
	function startTransaction() {
		return $this->db->beginTransaction();
	}
	function commit() {
		return $this->db->commit();
	}
	function rollback() {
		return $this->db->rollback();
	}
	function numRows($resource){
		return $resource->rowCount(); 
	}
}
