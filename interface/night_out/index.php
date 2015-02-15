<html>

<?php include 'header.php';?>

<head>

<style>
#content
{
width:500px;
height:250px;
background-color:rgba(40,40,40,0.5);
border-radius: 20px ;
}
</style>

</head>

<body>

<br>
<center><h2 style="font-size:35px">Login</h2></center>
<center>
<div id=content style="padding-top:50px;">
	<form action="login.php" method="post">
	<table>
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
				Password:
			</td> 
			<td>
				<input type="password" name="pass">
			</td>
		</tr>
		<br>
	</table>
	<br>
	<input type="submit" value="Login">
	</form>

	<form action="register.php">
		<input type="submit" value="Register">
	</form>
</div>
</center>

<?php include 'footer.php';?>

</body>

</html>
