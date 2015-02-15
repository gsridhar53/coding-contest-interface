<html>

<?php include 'header.php';?>

<head>
<style>
td
{
	padding: 5px;
}

th
{
	background-color:#0F1F4C;
	color:white;
	padding: 5px;
}
</style>
</head>

<body>

<?php

echo "
<br><br>
<center>
	<img src=\"img/icon.png\" height=100px width=100px>
	<img src=\"img/llogo.png\" height=70px width=441px>
	<br><br><br>
";

include "db_connect.php" ;		// Database connection information. Set the connection variable as "$con"

if ( mysqli_connect_errno() )
	error_handling ( "Not able to connect to the server <br>Try again<br>" ) ;

// Get attributes of the leaderboard table and store it in an array
$query = "desc leaderboard ;" ;
$result = mysqli_query ( $con, $query ) ;
if ( $result == NULL )
	error_handling ( "Not able to query the database! <br>Try again<br>" ) ;

echo "
<table style=\"border-collapse: collapse;\" border=\"1\">
<tr>
	<th>Rank</th>
" ;

$disp_fields = array () ;		// This array is used to store the names of the renamed attributes
$index = 0 ;
$fields = array () ;
for ( $i = 0 ; $row = mysqli_fetch_array($result) ; $i ++ )
{
	// Rename some of the attributes
	if ( !strcmp($row['Field'], "total_time") )
		$disp = "Total Time" ;
	else if ( !strcmp($row['Field'], "total_stars") )
		$disp = "Total Stars" ;
	else if ( !strcmp($row['Field'], "team") )
		$disp = "Team Name" ;
	else if ( !strcmp($row['Field'], "id") )		//	No need to display Id in leaderboard
	{
		$i -- ;
		continue ;
	}
	else
		$disp = $row['Field'] ;
	
	$fields[$i] = $row['Field'] ;
	echo "
	<th><center>$disp</center></th>
	" ;
}
$num_fields = $i ;

echo "
</tr>
" ;

// Fetch the leaderboard table
$query = "select * from leaderboard order by total_stars desc, total_time asc ;" ;
$result = mysqli_query ( $con, $query ) ;
if ( $result == NULL )
	error_handling ( "Not able to query the leaderboard! <br>Try again<br>" ) ;

$j = 1 ;
while ( $row = mysqli_fetch_array($result) )
{
	echo "<tr>" ;
	echo "<td><center>$j</center></td>" ;		// Rank of the Team

	//	Display other details from the table
	for ( $i = 0 ; $i < $num_fields ; $i ++ )
	{
		$temp = $row[$fields[$i]] ;
		
		if ( !is_string($temp) && ($temp == NULL || $temp == 0) )		// When the entry is empty, put "-" in the leaderboard
			echo "<td><center>-</center></td>" ;
		else
			echo "<td><center>$temp</center></td>" ;
	}
	echo "</tr>" ;
	$j ++ ;
}

echo "
</table>
</center>
" ;

mysqli_close( $con ) ;

function error_handling ( $message )
{
	echo $message . "<br><br>";
	die () ;
}

?>
<br><br><br><br><br><br><br><br><br>

<?php include 'footer.php';?>

</body>

</html>
