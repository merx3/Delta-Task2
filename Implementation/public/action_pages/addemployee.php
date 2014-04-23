<?php    
    require_once('../../framework/db_connection.php');
    require_once('../../framework/db_functions.php');
    require_once('../../framework/scheduler.php');
    require_once('../../framework/employee.php');
?>
   
<?php    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['weeks'])) {
        $weeks = $_POST['weeks'];
        $name = $_POST['empl_name'];
        if (strlen($name) < 3) {
            throw new Exception("Name is too short.");
        }
        if (!is_array($weeks)) {
            throw new Exception("Invalid POST request.");
        }
        foreach ($weeks as $weekday) {
            if (!ctype_digit($weekday['from']) || !ctype_digit($weekday['to'])) {
                throw new Exception("Invalid POST request. Start or end hour is not int.");
            }
            $day_start = (int)$weekday['from'];
            $day_end = (int)$weekday['to'];
            $empl_free_time[] = array('from'=>$day_start, 'to'=>$day_end);
        }
                
        $employees = Scheduler::getEmployees();
        $new_employee = Employee::constructEmployee(0, $name, $empl_free_time);
        
        echo "Created new_employee :<br/>";
        echo "Id: ".$new_employee->getId()."<br/>";
        echo "Name: ".$new_employee->getName()."<br/>";
        echo "....hopefully added to DB<br/>";
        $employees[] = $new_employee;
        Scheduler::setEmployees($employees);
        //header('Location:WelcomePage.php');
        //die();
    }
    else{
        header('Location:../WelcomePage.php');
        die();
    }
?>