<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Add New Employee</title>
<link href="css/stylesPages.css" rel="stylesheet" type="text/css" />
</head>
<body class="bodyStyle">

<form method="post" action="action_pages/addemployee.php" class="formStyle">
<div>
<p><span class="WorkDaysStyle">Add New Employee</span></p>
</div>
<div class="textStyle">
Name: <input type="text" name="Name of Employee"/>
</div>
<div>
<p class="textStyle">Free time for First week</p>
</div>
<table frame="border" class="formatTable" >
<tr class="formatFirstLineTable">
<td class="formatTable">Day</td>
<td class="formatTable">From</td>
<td class="formatTable">To</td>
</tr>
<tr class="formatSecondLineTable">
<td class="formatTable">Monday</td>
<td class="formatTable"><input type="text" name="weeks[0][from]"/></td>
<td class="formatTable"><input type="text" name="weeks[0][to]"/></td>
</tr>

<tr class="formatSecondLineTable">
<td class="formatTable">Tuesday</td>
<td class="formatTable"><input type="text" name="weeks[1][from]"/></td>
<td class="formatTable"><input type="text" name="weeks[1][to]"/></td>
</tr>
<tr class="formatSecondLineTable">
<td class="formatTable">Wednesday</td>
<td class="formatTable"><input type="text" name="weeks[2][from]"/></td>
<td class="formatTable"><input type="text" name="weeks[2][to]"/></td>
</tr>
<tr class="formatSecondLineTable">
<td class="formatTable">Thursday</td>
<td class="formatTable"><input type="text" name="weeks[3][from]"/></td>
<td class="formatTable"><input type="text" name="weeks[3][to]"/></td>
</tr>
<tr class="formatSecondLineTable">
<td class="formatTable">Friday</td>
<td class="formatTable"><input type="text" name="weeks[4][from]"/></td>
<td class="formatTable"><input type="text" name="weeks[4][to]"/></td>
</tr>
<tr class="formatSecondLineTable">
<td class="formatTable">Saturday</td>
<td class="formatTable"><input type="text" name="weeks[5][from]"/></td>
<td class="formatTable"><input type="text" name="weeks[5][to]"/></td>
</tr>
<tr class="formatSecondLineTable">
<td class="formatTable">Sunday</td>
<td class="formatTable"><input type="text" name="weeks[6][from]"/></td>
<td class="formatTable"><input type="text" name="weeks[6][to]"/></td>
</tr>
</table>
<br></br>
<p class="textStyle">Free time for Second week</p>
</div>
<table frame="border" class="formatTable" >
<tr class="formatFirstLineTable">
<td class="formatTable">Day</td>
<td class="formatTable">From</td>
<td class="formatTable">To</td>
</tr>
<tr class="formatSecondLineTable">
<td class="formatTable">Monday</td>
<td class="formatTable"><input type="text" name="weeks[7][from]"/></td>
<td class="formatTable"><input type="text" name="weeks[7][to]"/></td>
</tr>

<tr class="formatSecondLineTable">
<td class="formatTable">Tuesday</td>
<td class="formatTable"><input type="text" name="weeks[8][from]"/></td>
<td class="formatTable"><input type="text" name="weeks[8][to]"/></td>
</tr>
<tr class="formatSecondLineTable">
<td class="formatTable">Wednesday</td>
<td class="formatTable"><input type="text" name="weeks[9][from]"/></td>
<td class="formatTable"><input type="text" name="weeks[9][to]"/></td>
</tr>
<tr class="formatSecondLineTable">
<td class="formatTable">Thursday</td>
<td class="formatTable"><input type="text" name="weeks[10][from]"/></td>
<td class="formatTable"><input type="text" name="weeks[10][to]"/></td>
</tr>
<tr class="formatSecondLineTable">
<td class="formatTable">Friday</td>
<td class="formatTable"><input type="text" name="weeks[11][from]"/></td>
<td class="formatTable"><input type="text" name="weeks[11][to]"/></td>
</tr>
<tr class="formatSecondLineTable">
<td class="formatTable">Saturday</td>
<td class="formatTable"><input type="text" name="weeks[12][from]"/></td>
<td class="formatTable"><input type="text" name="weeks[12][to]"/></td>
</tr>
<tr class="formatSecondLineTable">
<td class="formatTable">Sunday</td>
<td class="formatTable"><input type="text" name="weeks[13][from]"/></td>
<td class="formatTable"><input type="text" name="weeks[13][to]"/></td>
</tr>
</table>
<br></br>
<div><input type="submit" value="Add" class="formatButton"/>
<input type="button" onclick="window.location = 'WelcomePage.php';" value="Cancel" class="formatButton"/>
</div>

</form>
</body>

</html>
