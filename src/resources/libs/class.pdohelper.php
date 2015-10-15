<?php
class PDOHelper {
	var $db;
	function PDOHelper($servername, $username, $password, $db){
		try{
			$this->db = new PDO("mysql:host=$servername;dbname=$db", $username, $password);}
		} catch(PDOException $ex) {
			die("Failed to connect to the database");
		}
	}
	function query($query){
		$query = $this->db->prepare($query);
		$query->execute();
		return $query;
	}
	function fetch($resource){
		return $resource->fetch(PDO::FETCH_ASSOC);
	}
	function insertId(){
		return $db->lastInsertId();
	}
}