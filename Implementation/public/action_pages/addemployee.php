<?php    
    echo "<html><head></head><body>WORK SONAFABITC</body></html>";
    require_once('../../framework/db_connection.php');
    require_once('../../framework/db_functions.php');
?>
   
<?php

    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['weeks'])) {
        echo "<html><head></head><body>HELAAA</body></html>";
        $weeks = $_POST['weeks'];
        if (strlen($_POST['name']) < 3) {
            throw new Exception("Name is too short.");
        }
        $name = $_POST['name'];
        $empl_free_time=array();
        foreach ($weeks as $weekday) {
            if (!is_numeric($weekday['start']) || !is_numeric($weekday['end'])) {
                throw new Exception("Invalid POST request.");
            }
            $day_start = (int)$weekday['start'];
            $day_end = (int)$weekday['end'];
            $empl_free_time[] = array('start'=>$day_start, 'end'=>$day_end);
        }
        db_addEmployee($db_conn, $name, $empl_free_time);
    }
    else{
        echo "<html><head></head><body>HELAAA3</body></html>";
    }
?>
