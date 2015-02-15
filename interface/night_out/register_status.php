<html>

<?php include 'header.php';?>

<body>

<?php

// User information from the "Register" page
$name = $_POST['name'] ;
$actual_name = $_POST['actual_name'] ;
$pass1 = $_POST['pass1'] ;
$pass2 = $_POST['pass2'] ;
$sem = $_POST['sem'] ;
$phone = $_POST['phone'] ;
$email = $_POST['email'] ;

// Check if any of the field is NULL
if ( $name == NULL || $actual_name == NULL || $pass1 == NULL || $pass2 == NULL || $sem == NULL || $phone == NULL || $email == NULL )
	error_handling ( "No field must be empty<br><br><br>Try again<br>", "register.php", "Register Again" ) ;

// Do this in order to prevent SQL injection. Remove all ' and "" from the input
$replace = array ( "'", "\"" ) ;
$name = str_replace($replace, "", $name) ;
$actual_name = str_replace($replace, "", $actual_name) ;
$pass1 = str_replace($replace, "", $pass1) ;
$pass2 = str_replace($replace, "", $pass2) ;
$phone = str_replace($replace, "", $phone) ;
$sem = str_replace($replace, "", $sem) ;
$email = str_replace($replace, "", $email) ;

if ( strcmp($pass1, $pass2) )
	error_handling ( "Password entered is not same <br><br><br>Try again<br>", "register.php", "Register Again" ) ;

// Check length of all the inputs
if ( strlen($name) > 20 || strlen($actual_name) > 20 )
	error_handling ( "Name field cannot be more than 20 characters<br><br><br>Try again<br>", "register.php", "Register Again" ) ;

if ( strlen($pass1) > 20 )
	error_handling ( "Password field cannot be more than 20 characters<br><br><br>Try again<br>", "register.php", "Register Again" ) ;

if ( strlen($sem) > 20 )
	error_handling ( "Sem and Branch field cannot be more than 20 characters<br><br><br>Try again<br>", "register.php", "Register Again" ) ;

// Regular expression matching for phone number
if ( !preg_match ( "/^[0-9]{10}$/", $phone ) )
	error_handling ( "Phone number is not valid <br><br><br>Try again<br>", "register.php", "Register Again" ) ;

// Validate Email address
if ( !filter_var($email, FILTER_VALIDATE_EMAIL) )
	error_handling ( "Email address is not valid <br><br><br>Try again<br>", "register.php", "Register Again" ) ;

if ( strlen($email) > 40 )
	error_handling ( "Email field cannot be more than 40 characters<br><br><br>Try again<br>", "register.php", "Register Again" ) ;

include "db_connect.php" ;			// Database connection information. Set the connection variable as "$con"

if ( mysqli_connect_errno () )
	error_handling ( "<br><br><center>Not able to connect to the server <br><br><br>Try again<br></center>", "register.php", "Register Again" ) ;

// Check if the team name already exists
$query = "select * from users where name='$name' ;" ;
$result = mysqli_query ( $con, $query ) ;
if ( mysqli_num_rows($result) > 0 )
	error_handling ( "Team already exists<br><br><br>Try again<br>", "register.php", "Register Again" ) ;

// Insert into the "users" table
$query = "insert into users values ('$name', '$actual_name', '$pass1', '$sem', '$phone', '$email') ;" ;
$result = mysqli_query ( $con, $query ) ;
if ( $result == NULL )
	error_handling ( "<br><br><center>Not able to add Team to the database!<br><br> <br>Try again<br></center>", "register.php", "Register Again" ) ;

// Insert into the "leaderboard" table
$query = "insert into leaderboard (team) values ('$name') ;" ;
$result = mysqli_query ( $con, $query ) ;
if ( $result == NULL )
	error_handling ( "<br><br><center>Not able to add Team to the leaderboard! <br><br><br>Try again<br></center>", "register.php", "Register Again" ) ;
	
$img="team.png";
$size=" height=\"210px\" width=\"300px\" ";
echo '<br><br><br>
<center><img src="img/'.$img.' " '.$size.'/></center>';
echo "<br><br><center>New Team created with Teamname $name <br><br></center>" ;

mysqli_close( $con ) ;

function error_handling ( $message, $target, $text )
{
$img="error.png";
$size=" height=\"50px\" width=\"50px\" ";
echo '<br>
<center><img src="img/'.$img.' " '.$size.'/></center>';
echo "<br><br><center>".$message . "<br><br></center>";
echo "
	<center>
	<form action=\"$target\">
		<input type=\"submit\" value=\"$text\">
	</form>
	</center>
	<br><br><br><br><br><br><br><br>
" ;
include 'footer.php';
die () ;
}

?>

<center>
	<form action="index.php" method="post">
		<input type="submit" value="Login">
	</form>
<br><br><br>
</center>

<?php include 'footer.php';?>

</body>

</html>
