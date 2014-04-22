<?php    
    require_once('../../framework/db_connection.php');
    require_once('../../framework/db_functions.php');
?>
   
<?php
    echo "<html><head></head><body>";
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['weeks'])) {
        echo "Post recieved<br/>";
        $weeks = $_POST['weeks'];
        $name = $_POST['empl_name'];
        if (strlen($name) < 3) {
            throw new Exception("Name is too short.");
        }
        if (!is_array($weeks)) {
            throw new Exception("Invalid POST request.");
        }
        echo "Checks finished!<br/>";
        $empl_free_time=array();
        foreach ($weeks as $weekday) {
            if (!ctype_digit($weekday['start']) || !ctype_digit($weekday['end'])) {
                throw new Exception("Invalid POST request. Start or end hour is not int.");
            }
            $day_start = (int)$weekday['start'];
            $day_end = (int)$weekday['end'];
            $empl_free_time[] = array('start'=>$day_start, 'end'=>$day_end);
        }
        
        echo "Created temp arrays:<br/>";
        echo "<pre>";
        print_r($empl_free_time);
        echo "--------from <br/>";
        print_r($weeks);
        echo "</pre><<<<<<<<<<<<<<<<<<<,";
        
        
        $employees = Scheduler::getEmployees();
        $new_employee = new Employee(0, $name, $empl_free_time);
        
        echo "Created new_employee :<br/>";
        echo "Id: ".$new_employee->getId()."<br/>";
        echo "Name: ".$new_employee->getName()."<br/>";
        echo "....hopefully added to DB<br/>";
        $employees[] = $new_employee;
        Scheduler::setEmployees($employees);
        header('Location:WelcomePage.php');
        die();
    }
    else{
        echo "<html><head></head><body>HELAAA3</body></html>";
    }
    
    echo "</body></html>";
?>