<?php
    function db_getWorkdays($dbconn){
        $query = 'SELECT DISTINCT day FROM shifts ORDER BY day ASC';
	$result = mysqli_query($dbconn, $query);
	$workdays = array();
	while($row = mysqli_fetch_assoc($result)){
            $workdays[] = (int)($row["day"]); 
	}
        return $workdays;
    }

    function db_getEmployeesCount($dbconn){
	$result_col_name = 'COUNT';
        $query = 'SELECT COUNT(*) AS '.$result_col_name.' FROM employees';
	$result = mysqli_query($dbconn, $query);
	$row = mysqli_fetch_assoc($result);
	$num_employees = $row[$result_col_name];
        return (int)$num_employees;
    }

    function db_getShiftsCount($dbconn){
	$result_col_name = 'shifts_in_day';
        $query = 'SELECT COUNT(day) AS '.$result_col_name.' FROM shifts GROUP BY day LIMIT 1';
	$result = mysqli_query($dbconn, $query);
	$row = mysqli_fetch_assoc($result);
	$num_employees = $row[$result_col_name];
        return (int)$num_employees;
    }

    function db_getEmployeeName($dbconn, $empl_id){
	if(!is_int($empl_id)){
	    throw new Exception('not valid employee id');
	}
	$result_col_name = 'name';
        $query = 'SELECT name AS '.$result_col_name.' FROM employees WHERE employee_id='.$empl_id.' LIMIT 1';
	$result = mysqli_query($dbconn, $query);
	$row = mysqli_fetch_assoc($result);
	$empl_name = $row[$result_col_name];
        return $empl_name;
    }

    function db_getEmployeeShifts($dbconn, $empl_id){
	if(!is_int($empl_id)){
	    throw new Exception('not valid employee id');
	}
        $query = 'SELECT shifts.shift_id,day,start,end,shift_number,seat_number FROM shifts ';
	$query .= 'JOIN employee_shifts es ON shifts.shift_id = es.shift_id ';
	$query .= 'WHERE es.employee_id='.$empl_id.' ';
	$query .= 'ORDER BY day, start';

	$result = mysqli_query($dbconn, $query);
	$shifts = array();
	while($row = mysqli_fetch_assoc($result)){
            $shifts[] = $row; 
	}
        return $shifts;
    }
	
    function db_getEmployeeFreeTime($dbconn, $empl_id){
	if(!is_int($empl_id)){
	    throw new Exception('not valid employee id');
	}
        $query = 'SELECT * FROM employee_free_times ';
	$query .= 'WHERE employee_id ='.$empl_id;

	$result = mysqli_query($dbconn, $query);
	$free_times = array();
	while($row = mysqli_fetch_assoc($result)){
            $free_times[] = $row; 
	}
        return $free_times;
    }

    function db_getAllShifts($dbconn){
        $query = 'SELECT * FROM shifts ';
	$query .= 'ORDER BY day, start';

	$result = mysqli_query($dbconn, $query);
	$shifts = array();
	while($row = mysqli_fetch_assoc($result)){
            $shifts[] = $row; 
	}
        return $shifts;
    }

    function db_getShiftsInDay($dbconn, $day){
	if(!is_int($day)){
	    throw new Exception('not valid day');
	}
        $query = 'SELECT * FROM shifts ';
	$query .= 'WHERE day='.$day.' ';
	$query .= 'ORDER BY day, start';

	$result = mysqli_query($dbconn, $query);
	$shifts = array();
	while($row = mysqli_fetch_assoc($result)){
            $shifts[] = $row; 
	}
        return $shifts;
    }
?>
