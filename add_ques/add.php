<html>

<body>

<?php

$num = $_POST["num"] ;
$star = $_POST["star"] ;
$name = $_POST["name"] ;
$desc = $_POST["desc"] ;
$input = $_POST["input"] ;
$output = $_POST["output"] ;
$const = $_POST["const"] ;
$examp = $_POST["examp"] ;

include "db_connect.php" ;		// Database connection information. Set the connection variable as "$con"

if ( mysqli_connect_errno() )
{
	echo "Not able to connect to the server" ;
	die () ;
}

// Insert into the database
$query = "insert into questions values ($num, $star,'$name','$desc','$input','$output','$const','$examp') ;" ;
$result = mysqli_query ( $con, $query ) ;
if ( $result == NULL )
{
	echo "Not able to insert into the database" ;
	die () ;
}

// Check if this is the first Question. 
if ( $num == 1 )
	;
else
{
	$temp = $num - 1 ;		// Previous problem number

	// Add column to the Leaderboard
	$query = "alter table leaderboard add column problem_$num int default NULL after problem_$temp ;" ;
	$result = mysqli_query ( $con, $query ) ;
	if ( $result == NULL )
	{
		echo "Not able to insert into the leaderboard" ;
		die () ;
	}
}

echo "Question successfully added to the database" ;

mysqli_close( $con ) ;

?>

<br><br>
Click here to add another question
<form action="index.php">
	<input type="submit">
</form>

</body>

</html>
