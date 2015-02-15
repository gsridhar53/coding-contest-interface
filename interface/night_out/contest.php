<html>

<?php include 'header.php';?>

<head>

<body >

<?php

$name = $_POST['team_name'] ;			// User information from previous page
$ques_num = $_POST['ques_num'] ;

echo "
<br>
<div id=\"div1\" style=\"background-color:rgba(40,40,40,0.2);width:900px ;margin:auto;padding:20px;border-radius: 10px;border:0.5px solid black ;\">
<table width=100%>
<tr>
<td>
<form action=\"leaderboard.php\" target=\"_blank\">
<input type=\"submit\" value=\"Leaderboard\">
</form>
</td>
" ;

echo "
<td align=\"right\">
<form action=\"index.php\">
<input type=\"submit\" value=\"Logout\">
</form>
</td>
</tr>
</table>
" ;

// The headings to be displayed for each question
$headings = array ( "Question Number", "Stars", "Question Title", "Description", "Input", "Output", "Constraints", "Example" ) ;

include "db_connect.php" ;		// Database connection information. Set the connection variable as "$con"

if ( mysqli_connect_errno() )
	error_handling ( "Not able to connect to the server <br>Try again<br>" ) ;

// Fetch question details from the database ( only the number of questions and the number of stars for the navigation box)
$query = "select * from questions order by num asc;" ;
$result = mysqli_query ( $con, $query ) ;
if ( $result == NULL )
	error_handling ( "Not able to query the database! <br>Try again<br>" ) ;

echo "
<center>
<form action=\"contest.php\" method=\"post\">
<select name=\"ques_num\">
" ;

// To disply Question navigation box in the contest page. Contains the list of all the question and also the stars alloted to them.
while ( $row = mysqli_fetch_array($result) )
{
	$num = $row['num'] ;
	$text = "Problem $num - " . $row['star'] . " stars" ;
	if ( $num == $ques_num ) 
		echo "<option value=\"$num\" SELECTED>$text</option>" ;
	else
		echo "<option value=\"$num\" >$text</option>" ;
}

echo "
</select>
<input type=\"submit\" value=\"Go\">
<input type=text name=\"team_name\" value=\"$name\" style=\"display:none\">
</form>
</center>
" ;

echo "<table><tr><td><br><br>" ;

// Get the column names of all the fiels in the Questions database. This is used to fetch each value of a particular column
$query = "desc questions ;" ;
$result = mysqli_query ( $con, $query ) ;
if ( $result == NULL )
	error_handling ( "Not able to query the database! <br>Try again<br>" ) ;

// Store the table attribute names in a array
$fields = array () ;
for ( $i = 0 ; $row = mysqli_fetch_array($result) ; $i ++ )
{
	$fields[$i] = $row['Field'] ;
}
$num_fields = $i ;

// Fetch the question of the requested question
$query = "select * from questions where num=$ques_num;" ;
$result = mysqli_query ( $con, $query ) ;
if ( $result == NULL )
	error_handling ( "Not able to query the database! <br>Try again<br>" ) ;

$row = mysqli_fetch_array($result) ;

for ( $i = 0 ; $i < $num_fields ; $i ++ )
{
	$x = $fields[$i] ;
	$text = $row[$x] ;
	$text = nl2br ( $text, false ) ;		//	Inserts HTML line breaks before all newlines in a string
	if ( $headings[$i] === "Stars" )		// Display the "star" image corresponding to the number of stars for that question
	{
		echo "<b>$headings[$i]:</b><br>";
		$star_count = (int) $text ;
		for ( $j = 0 ; $j < $star_count ; $j ++ )
		{
			echo "<img src=\"img/star.png\" width=\"20px\" height=\"20px\">";
		}
		echo "<br><br><br>";
	}
	else
		echo "<b>$headings[$i]:</b><br>$text<br><br><br>" ;
}
echo "</td><td valign=\"top\" style=\"padding-top:42px;\">";

// Display option to submit the source code
echo "
<b>Upload the source code here! </b><br><br>
<form action=\"upload_file.php\" method=\"post\" enctype=\"multipart/form-data\">
<input type=\"file\" name=\"file\" id=\"file\"><br><br>
<input type=\"submit\" name=\"submit\" value=\"Submit\">

<input type=text name=\"team_name\" value=\"$name\" style=\"display:none\">
<input type=text name=\"ques_num\" value=\"$ques_num\" style=\"display:none\">

<input type=text name=\"valid\" value=\"1\" style=\"display:none\">

</form>
</td></tr></table>
</div>
" ;

mysqli_close( $con ) ;

function error_handling ( $message )
{
echo $message . "<br><br>";
die () ;
}

?>

<?php include 'footer.php';?>

</body>

</html>
