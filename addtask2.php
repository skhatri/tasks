<?php
class DB {

	function getConnection() {	
		$host = "localhost";
		$pass = "dev";
		$usr = "dev";
		$conn = mysql_connect($host, $usr, $pass) or die(getError("error connecting"));
		mysql_select_db("todo") or die(getError("error in finding resource"));
	}
	
	function executeQuery($query) {
		$result = mysql_query($query) or die(getError("error executing query"));
		return $result;
	}

	function close($conn) {
          if($conn) {
            mysql_close($conn);
          }
        }

}

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
<!doctype html>
<html>
<head>
<title>Display Tasks</title>
<script type="text/javascript" href="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" href="js/bootstrap.min.js"></script>
<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>
</head>
<body>

<div class="container">
<div class="alert">
<h2><i class="icon-ok icon-black"></i>&#160;TODO Tasks</h2>
</div>
<div class="alert alert-info">
<form>
  <input type="text" class="input input-xlarge" name="task"/>
  <button class="btn btn-primary" name="add"><i class="icon-plus-sign icon-white"></i>&#160;Add Task</button>
  <button class="btn btn-danger" name="delete"><i class="icon-trash icon-white"></i>&#160;Delete All Tasks</button>
</form>
</div>
<table class="table table-bordered table-striped">
<tr>
<th>Tasks</th>
</tr>
<?php
        $db = new DB();
	$tasks = new Tasks($db);
	$tasks->deletealltasks();
	$tasks->addtask();
	$taskList = $tasks->showtasks();
	foreach($taskList as $task) {
?>
	<tr><td><?php echo $task; ?></td></tr>
<?php
	}
?>
</table>
</div>
</body>
</html>
