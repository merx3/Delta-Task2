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
<form method="post" class="formStyle">
<div>
<p><span class="WorkDaysStyle">Work days</span></p>
</div>
<div >
<ul class="days">
	<?php $currentWD = Scheduler::getWorkdays();?>
	<input type="checkbox" name="monday" value="Monday" <?php if($currentWD[0]) { echo 'checked'; }?>/>Monday
	

	<input type="checkbox" name="tuesday" value="Tuesday" <?php if($currentWD[1]) { echo 'checked'; }?>/>Tuesday 

	<input type="checkbox" name="wednesday" value="Wednesday" <?php if($currentWD[2]) { echo 'checked'; }?>/>Wednesday 

	<input type="checkbox" name="thursday" value="Thursday" <?php if($currentWD[3]) { echo 'checked'; }?>/>Thursday 

	<input type="checkbox" name="friday" value="Friday" <?php if($currentWD[4]) { echo 'checked'; }?>/>Friday    

	<input type="checkbox" name="saturday" value="Saturday" <?php if($currentWD[5]) { echo 'checked'; }?>/>Saturday    

	<input type="checkbox" name="sunday" value="Sunday" <?php if($currentWD[6]) { echo 'checked'; }?>/>Sunday 
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
	<input type="button" value="Add" class="formatButton" onclick="window.location = 'AddNewEployee.php';"/>
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
<tr class="formatSecondLineTable">
<td class="formatTable">Morning</td>
<td class="formatTable">9-12</td>
<td><input type="button" value="Edit" class="formatButtonTable"/>
</td>
<td><input type="button" value="Delete" class="formatButtonTable"/>
</td>
</tr>

<tr>
<td class="formatTable">Evening</td>
<td class="formatTable">13-18</td>
<td><input type="button" value="Edit" class="formatButtonTable"/>
</td>
<td><input type="button" value="Delhttps://github.com/merx3/Delta-Task2.gitete" class="formatButtonTable"/>
</td>
</tr>
</table>
<br>
</br>

<div>
<input type="button" value="Generate Schedule" class="StyleGenerateSchedule"/>
<

</div>
</form>
</body>
</html>
