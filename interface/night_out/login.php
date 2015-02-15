<html>

<?php include 'header.php';?>

<body>

<?php

$name = $_POST['name'] ;		// Login information from previous page
$pass = $_POST['pass'] ;

if ( $name == NULL || $pass == NULL )
	error_handling ( "<br><br><br><br><br><br><center>No field must be empty <br><br>Try again<br></center>", "index.php", "Login" ) ;
	
$replace = array ( "'", "\"" ) ;				// Do this in order to prevent SQL injection. Remove all ' and "" from the input
$name = str_replace($replace, "", $name) ;
$pass = str_replace($replace, "", $pass) ;

include "db_connect.php" ;		// Database connection information. Set the connection variable as "$con"

if ( mysqli_connect_errno () )
	error_handling ( "<br><br><br><center>Not able to connect to the server <br><br><img src=\"img/wrong.png\" width=150px height=150px><br><br>Try again<br></center>", "index.php", "Login" ) ;

// Check if the user is present
$query = "select * from users where name='$name' ;" ;
$result = mysqli_query ( $con, $query ) ;
if ( mysqli_num_rows($result) != 1 )
	error_handling ( "<br><br><br><center>Team name not found!!!<br><br><img src=\"img/wrong.png\" width=150px height=150px><br><br>Try again!</center>", "index.php", "Login" ) ;

// Check if the passord is correct	
$row = mysqli_fetch_array($result) ;
if ( !( $name == $row['name'] && $pass == $row['pass'] ) )
	error_handling ( "<br><br><br><center>Password Incorrect<br><br><img src=\"img/wrong.png\" width=150px height=150px><br>Try again<br>", "index.php", "Login" ) ;

$img = "accept.png";
	
echo '<br><br><center><img src="img/'.$img.'"/></center>';
echo "<br><center>Login Successful! </center> " ;
echo '<center><p style="font-size: 40px;">';
echo "Welcome $name</p></center>" ;

echo "
<center>Click here to goto the contest page!<br><br></center>
<center><form action=\"contest.php\" method=\"post\">
<input type=\"submit\" value=\"Contest\">
<input type=text name=\"team_name\" value=\"$name\" style=\"display:none\">
<input type=text name=\"ques_num\" value=\"1\" style=\"display:none\">
</form></center>
" ;

mysqli_close( $con ) ;

function error_handling ( $message, $target, $text )
{
echo $message ."<br><br>";
echo "
	<center>
	<form action=\"$target\" method=\"post\">
	<input type=\"submit\" value=\"$text\">
	</form></center>
	<br><br><br><br><br><br><br><br><br>
" ;
include 'footer.php';
die () ;
}

?>

</body>
<?php include 'footer.php';?>
</html>
