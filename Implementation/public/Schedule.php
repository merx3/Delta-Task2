<?php
    require_once('../framework/scheduler.php');
	$schedules;
		
	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['workdays'])) {
		for($i=0;$i<7;$i++){
			if(Scheduler::getWorkdays()[$i]){
				Scheduler::arrangeHours($i);
				Scheduler::arrangeHours($i+7);
				Scheduler::addMoreHours($i);
				Scheduler::addMoreHours($i+7);
			}
		}
		Scheduler::rearrangeAveraging();
		Scheduler::dismissHours();
		$employees = Scheduler::getEmployees();
		foreach($employees as $em){
			$schedules[] = $em->getEmployeeSchedule();
		}		
    }
    else{
        header('Location:WelcomePage.php');
        die();
    }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Schedule</title>
<link href="stylesPages.css" rel="stylesheet" type="text/css" />
<style type="text/css">
</style>
</head>
<body class="bodyStyle">
<form method="post" class="formStyle">
<div>
<p><span class="WorkDaysStyle">Schedule</span></p>
</div>

<?php
	foreach($schedules as $sch){
		foreach ($sch['messages'] as $msg)
			echo $msg;
	}
?>

<table frame="border" class="formatTable" >
<tr class="formatSecondLineTable">
<td class="formatTable">Day</td>
<td class="formatTable">Shift</td>
<td class="formatTable">Employees</td>
</tr>

<?php
	
	for ($i = 0;$i < 14; $i++){
		for($j=0;$j<Scheduler::getNumShifts();$j++){
			echo "<tr>";
			echo "<td class=\"formatTable\">".($i + 1)."</td>";
			echo "<td class=\"formatTable\">".($j+1)."</td>";			
			foreach($schedules as $sch){
				if(in_array($j, $sch[$i])){
					echo $sch['employee_name']."<br/>";
				}
			}
			echo "<td class=\"formatTable\">"; 
			echo "</td>";
			echo "</tr>";
		}
	}
?>



</table>
<br>
</br>
<div >
<a href="WelcomePage.php"><input type="button" name="InfoOK" value="OK" class="formatButton"/></a>
</div>
</form>
</body>

</html>
