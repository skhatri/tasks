<?php

class Tasks {	
	private $db;
 	function __construct($db) {
	 $this->db = $db;
        }

	function showtasks() {
		$user = "";
		$conn = $this->db->getConnection();

		$query = "select * from tasks t";
		$result = $this->db->executeQuery($query);
		$users = array();
		while ($row = mysql_fetch_assoc($result)) {
			$user = $row['name'];
			array_push($users, $user);
		}
	 	$this->db->close($conn);
		return $users;
	}

	function addtask() {
		if (isset($_GET["task"])) {
			$conn = $this->db->getConnection();
			$task=$_GET["task"];
			$query = "insert into tasks values('".$task."')";
			$this->db->executeQuery($query);
		        $this->db->close($conn);
		}
	}

	function deletealltasks() {
		if (isset($_GET["delete"])) {
			$conn = $this->db->getConnection();
			$query = "delete from tasks";
			$this->db->executeQuery($query);
			$this->db->close($conn);
		}
	}
}
?>

