<?php require_once('../framework/scheduler.php'); ?>
<?php require_once('../framework/employee.php'); ?>﻿
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Employee Info</title>
<link href="stylesPages.css" rel="stylesheet" type="text/css" />
</head>

<body class="bodyStyle">
<form method="post" class="formStyle"> 
<div>
<p><span class="WorkDaysStyle">Employee Info</span></p>
</div>
<div >
<ul class="days">
	<?php $EmployeeName = Scheduler::getEmployees();?>
	Name: <?php echo($EmployeeName[($_GET["id"])]->getName());  ?>

	<input type="button" name="editEmployeeName" value="Edit" class="formatButton"/>
</ul>
</div>
<div >
<ul class="days">

	Free Time  <input type="button" name="editFreeTime" value="Edit" class="formatButton"/>
</ul>

</div>
<br></br>
<table frame="border" class="formatTable" >
<tr class="formatFirstLineTable">
<td class="formatTable">First Week</td>
<td class="formatTable">From</td>
<td class="formatTable">To</td>
</tr>
<tr class="formatSecondLineTable">
<td class="formatTable">Monday</td>
<?php $EmployeeDayStart = Scheduler::getEmployees();?>
<?php $EmployeeDayStartInit=$EmployeeDayStart[($_GET["id"])]->getStartHours() ?> 
<?php $EmployeeDayEnd = Scheduler::getEmployees();?>
<?php $EmployeeDayEndInit=$EmployeeDayEnd[($_GET["id"])]->getEndHours() ?> 
<td class="formatTable"><?php echo($EmployeeDayStartInit[0]); ?> </td>
<td class="formatTable"><?php echo($EmployeeDayEndInit[0]); ?></td>
</tr>

<tr>
<td class="formatTable">Tuesday</td>
<td class="formatTable"><?php echo($EmployeeDayStartInit[1]); ?> </td></td>
<td class="formatTable"><?php echo($EmployeeDayEndInit[1]); ?></td>
</tr>
<tr>
<td class="formatTable">Wednesday</td>
<td class="formatTable"><?php echo($EmployeeDayStartInit[2]); ?></td> </td>
<td class="formatTable"><?php echo($EmployeeDayEndInit[2]); ?></td>
</tr>
<tr>
<td class="formatTable">Thursday</td>
<td class="formatTable"><?php echo($EmployeeDayStartInit[3]); ?> </td></td>
<td class="formatTable"><?php echo($EmployeeDayEndInit[3]); ?></td>
</tr>
<tr>
<td class="formatTable">Friday</td>
<td class="formatTable"><?php echo($EmployeeDayStartInit[4]); ?></td> </td>
<td class="formatTable"><?php echo($EmployeeDayEndInit[4]); ?></td>

</tr>
<tr>
<td class="formatTable">Saturday</td>
<td class="formatTable"><?php echo($EmployeeDayStartInit[5]); ?></td> </td>
<td class="formatTable"><?php echo($EmployeeDayEndInit[5]); ?></td>
</tr>
<tr>
<td class="formatTable">Sunday</td>
<td class="formatTable"><?php echo($EmployeeDayStartInit[6]); ?></td> </td>
<td class="formatTable"><?php echo($EmployeeDayEndInit[6]); ?></td>

</tr>
</table>
<br></br>
<table frame="border" class="formatTable" >
<tr class="formatFirstLineTable">
<td class="formatTable">Second Week</td>
<td class="formatTable">From</td>
<td class="formatTable">To</td>
</tr>
<tr class="formatSecondLineTable">
<td class="formatTable">Monday</td>
<td class="formatTable"><?php echo($EmployeeDayStartInit[7]); ?> </td>
<td class="formatTable"><?php echo($EmployeeDayEndInit[7]); ?></td>
</tr>

<tr>
<td class="formatTable">Tuesday</td>
<td class="formatTable"><?php echo($EmployeeDayStartInit[8]); ?> </td></td>
<td class="formatTable"><?php echo($EmployeeDayEndInit[8]); ?></td>
</tr>
<tr>
<td class="formatTable">Wednesday</td>
<td class="formatTable"><?php echo($EmployeeDayStartInit[9]); ?></td> </td>
<td class="formatTable"><?php echo($EmployeeDayEndInit[9]); ?></td>
</tr>
<tr>
<td class="formatTable">Thursday</td>
<td class="formatTable"><?php echo($EmployeeDayStartInit[10]); ?> </td></td>
<td class="formatTable"><?php echo($EmployeeDayEndInit[10]); ?></td>
</tr>
<tr>
<td class="formatTable">Friday</td>
<td class="formatTable"><?php echo($EmployeeDayStartInit[11]); ?></td> </td>
<td class="formatTable"><?php echo($EmployeeDayEndInit[11]); ?></td>

</tr>
<tr>
<td class="formatTable">Saturday</td>
<td class="formatTable"><?php echo($EmployeeDayStartInit[12]); ?></td> </td>
<td class="formatTable"><?php echo($EmployeeDayEndInit[12]); ?></td>
</tr>
<tr>
<td class="formatTable">Sunday</td>
<td class="formatTable"><?php echo($EmployeeDayStartInit[13]); ?></td> </td>
<td class="formatTable"><?php echo($EmployeeDayEndInit[13]); ?></td>

</tr>
</table>
<br></br>
<div >
<ul class="days">

	<input type="button" name="BackOfEmployeeInfo" value="Back" class="formatButton"/>
	
	<input type="button" name="editOfEmployeeInfo" value="Edit" class="formatButton"/>
</ul>
</div>

</form>
</body>

</html>
