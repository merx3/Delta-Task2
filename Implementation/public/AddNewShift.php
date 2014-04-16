<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Add New Shift</title>
<link href="stylesPages.css" rel="stylesheet" type="text/css" />
<style type="text/css">
</style>
</head>
<body class="bodyStyle">
<form method="post" class="formStyle">
<div>
<p><span class="WorkDaysStyle">Add New Shift</span></p>
</div>
<table frame="border" class="formatTable" >
<tr class="formatSecondLineTable">
<td class="formatTable">From:</td>
<td class="formatTable"><input type="text" name="NewShiftFrom"/></td>
</tr>

<tr>
<td class="formatTable">To:</td>
<td class="formatTable"><input type="text" name="NewShiftTo"/></td>
</tr>
</table>
<div >
<ul class="days">
	<input type="button" name="AddShift" value="Add" class="formatButton"/>
	<input type="button" name="Cancel" value="Cancel" class="formatButton"/>
</ul>
</div>
</form>
</body>

</html>
