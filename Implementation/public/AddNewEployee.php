﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Add New Employee</title>
<link href="css/stylesPages.css" rel="stylesheet" type="text/css" />
</head>
<body class="bodyStyle">

    <form method="post" action="http://google.com" class="formStyle">
<div>
<p><span class="WorkDaysStyle">Add New Employee</span></p>
</div>
<div class="textStyle">
Name: <input type="text" name="Name of Employee"/>
</div>
        <?php echo "HELLLOOOOOOOOO"?>
<div>
<p class="textStyle">Free time</p>
</div>
<table frame="border" class="formatTable" >
<tr class="formatFirstLineTable">
<td class="formatTable">Day</td>
<td class="formatTable">From</td>
<td class="formatTable">To</td>
</tr>
<tr class="formatSecondLineTable">
<td class="formatTable">Monday</td>
<td class="formatTable"><input type="text" name="MondayFrom"/></td>
<td class="formatTable"><input type="text" name="MondayTo"/></td>
</tr>

<tr class="formatSecondLineTable">
<td class="formatTable">Tuesday</td>
<td class="formatTable"><input type="text" name="TuesdayFrom"/></td>
<td class="formatTable"><input type="text" name="TuesdayTo"/></td>
</tr>
<tr class="formatSecondLineTable">
<td class="formatTable">Wednesday</td>
<td class="formatTable"><input type="text" name="WednesdayFrom"/></td>
<td class="formatTable"><input type="text" name="WednesdayTo"/></td>
</tr>
<tr class="formatSecondLineTable">
<td class="formatTable">Thursday</td>
<td class="formatTable"><input type="text" name="ThursdayFrom"/></td>
<td class="formatTable"><input type="text" name="ThursdayTo"/></td>
</tr>
<tr class="formatSecondLineTable">
<td class="formatTable">Friday</td>
<td class="formatTable"><input type="text" name="FridayFrom"/></td>
<td class="formatTable"><input type="text" name="FridayTo"/></td>
</tr>
<tr class="formatSecondLineTable">
<td class="formatTable">Saturday</td>
<td class="formatTable"><input type="text" name="SaturdayFrom"/></td>
<td class="formatTable"><input type="text" name="SaturdayTo"/></td>
</tr>
<tr class="formatSecondLineTable">
<td class="formatTable">Sunday</td>
<td class="formatTable"><input type="text" name="SundayFrom"/></td>
<td class="formatTable"><input type="text" name="SundayTo"/></td>
</tr>
</table>
<br></br>
<div><input type="submit" value="Add" class="formatButton"/>
<input type="button" onclick="window.location = 'WelcomePage.php';" value="Cancel" class="formatButton"/>
</div?>

</form>
</body>

</html>
