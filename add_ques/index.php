<html>

<body>

<form id="add" action="add.php" method="post">
<table>
	<tr>
		<td>Question Number</td>
		<td><input type="text" name="num"></td>
	</tr>
	<tr>
		<td>Number of stars</td>
		<td><input type="text" name="star"></td>
	</tr>
	<tr>
		<td>Question Name</td>
		<td><input type="text" name="name"></td>
	</tr>
	<tr>
		<td>Question Description</td>
		<td><textarea rows="10" cols="50" name="desc" form="add"></textarea></td>
	</tr>
	<tr>
		<td>Input Description</td>
		<td><textarea rows="10" cols="50" name="input" form="add"></textarea></td>
	</tr>
	<tr>
		<td>Output Description</td>
		<td><textarea rows="10" cols="50" name="output" form="add"></textarea></td>
	</tr>
	<tr>
		<td>Constraints</td>
		<td><textarea rows="10" cols="50" name="const" form="add"></textarea></td>
	</tr>
	<tr>
		<td>Sample Input/Output</td>
		<td><textarea rows="10" cols="50" name="examp" form="add"></textarea></td>
	</tr>
	<tr>
		<td><input type="submit"></td>
	</tr>
</table>
</form>

</body>

</html>
