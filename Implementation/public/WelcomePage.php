<?php require_once('../framework/scheduler.php'); ?>
<?php require_once('../framework/employee.php'); ?>﻿
﻿
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Work days</title>
<link href="css/stylesPages.css" rel="stylesheet" type="text/css" />
<style type="text/css">
</style>
</head>

<body class="bodyStyle">
<form method="post" action="Schedule.php" class="formStyle">
<div>
<p><span class="WorkDaysStyle">Work days</span></p>
</div>
<div >
<ul class="days">
	<?php $currentWD = Scheduler::getWorkdays();?>
	<input type="checkbox" name="workdays[]" value="Monday" <?php if($currentWD[0]) { echo 'checked'; }?>/>Monday
	

	<input type="checkbox" name="workdays[]" value="Tuesday" <?php if($currentWD[1]) { echo 'checked'; }?>/>Tuesday 

	<input type="checkbox" name="workdays[]" value="Wednesday" <?php if($currentWD[2]) { echo 'checked'; }?>/>Wednesday 

	<input type="checkbox" name="workdays[]" value="Thursday" <?php if($currentWD[3]) { echo 'checked'; }?>/>Thursday 

	<input type="checkbox" name="workdays[]" value="Friday" <?php if($currentWD[4]) { echo 'checked'; }?>/>Friday    

	<input type="checkbox" name="workdays[]" value="Saturday" <?php if($currentWD[5]) { echo 'checked'; }?>/>Saturday    

	<input type="checkbox" name="workdays[]" value="Sunday" <?php if($currentWD[6]) { echo 'checked'; }?>/>Sunday 
</ul>
</div>
<br>
</br>

<div class="textStyle">
Work places count: <input type="number" min="1" max="4" step="1" value=<?php echo "\"".Scheduler::getNumWorkplaces()."\"";?> name="WorkPlacesCount">
</div>
<br>
</br>
<div class="textStyle">
Employee min work hours (for 2 weeks): <input type="number" min="20" max="40" step="1" value=<?php echo "\"".Scheduler::getMinWorkHours()."\"";?> name="EmployeeMinHours"/>

</div>
<br>
</br>
<div class="textStyle">
Employee max work hours (for 2 weeks): <input type="number" min="20" max="40" step="1" value=<?php echo "\"".Scheduler::getMaxWorkHours()."\"";?> name="EmployeeMaxHours"/>
</div>
<br>
</br>
<div>
	<span class="textStyle">Employees</span> 
	<input type="button" value="Add" class="formatButton" onclick="window.location = 'AddNewEmployee.php';"/>
</div>
<div>
<ul>
<?php
	$employees = Scheduler::getEmployees(); 
	for($i=0;$i<count($employees);$i++){
		echo "<li><a href=\"EmployeeInfo.php?id=".$i."\">".$employees[$i]->getName()."</a></li>";
	}
?>

</ul>
</div>
<br>
</br>
<div class="textStyle">
Shifts <input type="button" value="Add" onclick="window.location = 'AddNewShift.php';" class="formatButton"/>
</div>
<br>
</br>

<table frame="border" class="formatTable" >
<tr class="formatFirstLineTable">
<td class="formatTable">Shift</td>
<td class="formatTable">Work hours</td>
<td class="formatTable"></td>
<td class="formatTable"></td>
</tr>
    
<?php
    $numShift = Scheduler::getNumShifts();
    $shiftStart = Scheduler::getShiftStart();
    $hoursInShift = Scheduler::getHoursInShift();
    for ($i=1;$i<$numShift;$i++){
        echo "<tr class=\"formatSecondLineTable\">";
        echo "<td class=\"formatTable\">".$i."</td>";
        echo "<td class=\"formatTable\">".$shiftStart[$i]."-".($shiftStart[$i] + $hoursInShift)."</td>";
        echo "<td><input type=\"button\" value=\"Edit\" class=\"formatButtonTable\"/>";
        echo "</td>";
        echo "<td><a href='delete/php?item=shift&id=".($i-1)."'><input type=\"button\" value=\"Delete\" class=\"formatButtonTable\"/></a>";
        echo "</td>";
        echo "</tr>";
    }
?>

</table>
<br>
</br>

<div>
<input type="submit" value="Generate Schedule" class="StyleGenerateSchedule"/>


</div>
</form>
</body>
</html>
