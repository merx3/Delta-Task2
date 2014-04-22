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
	$num_shifts = $row[$result_col_name];
        return (int)$num_shifts;
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
        $query = 'SELECT shifts.shift_id,day,start,end,is_taken,shift_number,seat_number FROM shifts ';
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

    function db_getWorkDesc($dbconn){
        $query = 'SELECT * FROM work_desc ';
	$result = mysqli_query($dbconn, $query);
	$row = mysqli_fetch_assoc($result);
        return $row;
    }
    
   /* function db_addEmployee($dbconn, $employee){
        if($employee instanceof Employee){            
            
            
            _addEmployeeToEmployeeTable($dbconn, $employee);
            
        }
        else{
            throw new Exception("Provided employee object is invalid");
        }
    }
    
    function _addEmployeeToEmployeeTable($dbconn, &$employee){
        $sql = 'INSERT INTO employees (employee_id, name) VALUES(?, ?)';
        
        $stmt;
        
        if($employee->getId() == 0){
            $stmt = mysqli_prepare($dbconn, $sql);
            mysqli_stmt_bind_param($stmt, 'is', $employee->getId(), $employee->getName());
        }
        else{
            $sql = 'INSERT INTO employees (employee_id, name) VALUES(NULL, ?)';
            $stmt = mysqli_prepare($dbconn, $sql);
            mysqli_stmt_bind_param($stmt, 's', $employee->getName());
        }
        
        if (mysqli_stmt_execute($stmt)) {
            return mysqli_insert_id();
        }
            
        throw new Exception("Could not execute query to table employees");
    }
    
    function _addEmployeeToEmployeeFreeTimeTable($dbconn, &$employee){
        $sql = 'INSERT INTO employee_free_times (employee_id, day, start, end) VALUES(?, ?, ?, ?)';
        $empl_startHours = $employee->getStartHours();
        $empl_endHours = $employee->getEndHours();
        for($i=0;$i<count($empl_startHours);$i++){
            if ($stmt = mysqli_prepare($dbconn, $sql)) {
                mysqli_stmt_bind_param($stmt, 'iiii', $employee->getId(), $i, $empl_startHours[$i], $empl_endHours[$i]);

                if (!mysqli_stmt_execute($stmt)) {
                    throw new Exception("Could not execute query to table employees_free_times for employee ".$employee->getId());
                }
            }
            else{
                throw new Exception("Could not execute query to table employees_free_times for employee ".$employee->getId());
            }            
        }
    }
    
    function _addEmployeeToEmployeeShifts($dbconn, &$employee){
        $sql = 'INSERT INTO employees (employee_id, shift_id, is_taken, shift_number, seat_number) VALUES(?, ?, ?, ?, ?)';
        
        
	$empl_availableShifts = $$employee->getAvailableShifts();
	$empl_workShifts = $$employee->getWorkShifts();
        for ($i=0;$i<count($empl_workShifts);$i++){
            $work_shifts = db_getShiftsInDay($dbconn, $i);
            for($j=0;$j<count($work_shifts);$j++){
                if ($empl_availableShifts[$i][$j]) {
                    if ($stmt = mysqli_prepare($dbconn, $sql)) {
                        $is_taken = $empl_workShifts[$i][$j]==0 ? 0:1;
                        mysqli_stmt_bind_param($stmt, 'iiiii', $employee->getId(), $work_shifts[$j]['shift_id'], $is_taken, $j, 1);

                        if (!mysqli_stmt_execute($stmt)) {
                            throw new Exception("Could not execute query to table employees");
                        }
                    }else
                    {
                        throw new Exception("Could not prepare statement");
                    }
                }
            }
        }
    }*/
?>
