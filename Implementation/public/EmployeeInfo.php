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

	Name: <input type="text" name="nameEmployeeInfo"/>

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
<td class="formatTable"><input type="text" name="MondayFromEI"/></td>
<td class="formatTable"><input type="text" name="MondayToEI"/></td>
</tr>

<tr>
<td class="formatTable">Tuesday</td>
<td class="formatTable"><input type="text" name="TuesdayFromEI"/></td>
<td class="formatTable"><input type="text" name="TuesdayToEI"/></td>
</tr>
<tr>
<td class="formatTable">Wednesday</td>
<td class="formatTable"><input type="text" name="WednesdayFromEI"/></td>
<td class="formatTable"><input type="text" name="WednesdayToEI"/></td>
</tr>
<tr>
<td class="formatTable">Thursday</td>
<td class="formatTable"><input type="text" name="ThursdayFromEI"/></td>
<td class="formatTable"><input type="text" name="ThursdayToEI"/></td>
</tr>
<tr>
<td class="formatTable">Friday</td>
<td class="formatTable"><input type="text" name="FridayFromEI"/></td>
<td class="formatTable"><input type="text" name="FridayToEI"/></td>

</tr>
<tr>
<td class="formatTable">Saturday</td>
<td class="formatTable"><input type="text" name="SaturdayFromEI"/></td>
<td class="formatTable"><input type="text" name="SaturdayToEI"/></td>
</tr>
<tr>
<td class="formatTable">Sunday</td>
<td class="formatTable"><input type="text" name="SundayFromEI"/></td>
<td class="formatTable"><input type="text" name="SundayToEI"/></td>

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
