<?php
class PDOHelper {
	var $db;
	function PDOHelper($servername, $username, $password, $db){
		$this->db = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
	}
	function query($query){
		$query = $this->db->prepare($query);
		$query->execute();
		return $query;
	}
	function fetch($resource){
		return $resource->fetch(PDO::FETCH_ASSOC);
	}
}