<?php
    require_once('db_connection.php');

    function db_getWorkdays(){
        $query = 'SELECT DISTINCT day FROM shifts ORDER BY day ASC';
	$result = mysqli_query($dbhandle, $query);
	$workdays = array();
	while($row = mysqli_fetch_assoc($resul)){
            $workdays[] = (int)($row["day"]); 
	}
        return $workdays;
    }
?>
