<html>

<?php include 'header.php';?>

<head>

<style>
#content
{
width:500px;
height:375px;
background-color:rgba(40,40,40,0.5);
border-radius: 20px ;
}
</style>

</head>

<body>

<br>
<center><h2 style="font-size:35px">Register</h2></center>
<center>
<div id=content style="padding-top:50px;">
	<form action="register_status.php" method="post">
	<table>
		<tr>
			<td>
				Name: <br><br>
			</td>
			<td>
				<input type="text" name="actual_name"><br><br>
			</td>
		</tr>
		<tr>
			<td>
				Username: <br><br>
			</td>
			<td>
				<input type="text" name="name"><br><br>
			</td>
		</tr>
		<tr>
			<td>
				Password: <br><br>
			</td>
			<td>
				<input type="password" name="pass1"><br><br>
			</td>
		</tr>
		<tr>
			<td>
				Re-enter Password: <br><br>
			</td>
			<td>
			<input type="password" name="pass2"><br><br>
			</td>
		</tr>
		<tr>
			<td>
				Sem & Branch: <br><br>
			</td>
			<td>
			<input type="text" name="sem"><br><br>
			</td>
		</tr>
		<tr>
			<td>
				Phone: (+91) <br><br>
			</td>
			<td>
			<input type="text" name="phone"><br><br>
			</td>
		</tr>
		<tr>
			<td>
				E-Mail: <br><br>
			</td>
			<td>
			<input type="text" name="email"><br><br>
			</td>
		</tr>
	</table>
	<br>
	<input type="submit" value="Register">
	</form>
</div>
</center>

<?php include 'footer.php';?>

</body>

</html>
