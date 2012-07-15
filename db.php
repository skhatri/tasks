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
?>

