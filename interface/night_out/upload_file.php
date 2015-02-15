<html>

<body>

<?php

include 'header.php';

if ( !isset($_POST['valid']) )		// Checks if the user came to this page without uploading a file
{
	echo "<br><br>Go back and upload file again! <br><br>" ;
	include 'footer.php';
	die () ;
}
$valid = $_POST['valid'] ;

$team_name = $_POST['team_name'] ;
$ques_num = $_POST['ques_num'] ;

include 'details.php';				//	IMPORTANT:	Check this file before running again

$allowedExts = array("c") ;			//	IMPORTANT: Select the type of file formats supported
$extension_error = "Invalid file format<br><br>Upload only C files" ;		//	IMPORTANT: Change this to the file formats supported

//	To find the extension of the file uploaded
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);
$extension = strtolower($extension) ;

include "db_connect.php" ;		// Database connection information. Set the connection variable as "$con"

if ( mysqli_connect_errno() )
	error_handling ( "Not able to connect to the server <br>Try again<br>" ) ;

echo "<center><div style=\"padding-top:40px;\">" ;

//	Check the extension of the file uploaded
if ( !in_array($extension, $allowedExts) )
	error_handling ( "$extension_error<br><br>Try again<br>" ) ;

//	File upload was unsuccessful
if ($_FILES["file"]["error"] > 0)
{
	$str_error = "Return Code: " . $_FILES["file"]["error"] . "<br>File upload not successful! Upload again!" ;
	$str_error .= "<br><br><br><br><br><br><br><br><br><br><br>" ;
	error_handling ( $str_error ) ;
}
else
{
	echo "<strong>Upload: </strong>" . $_FILES["file"]["name"] . "<br><br>";
	
	// Check if the Team folder has been created
	if ( !file_exists( "$dir_name/$team_name" ))
	{
		if ( !mkdir( "$dir_name/$team_name" ))
		{
			$str_error = "Not able to create TEAM directory!<br>Try again<br><br><br><br><br><br><br><br><br><br>" ;
			error_handling ( $str_error ) ;
		}
	}
	
	//	Check if the Problem folder has been created for the Team. Every team will have a directory for the problems attempted
	if ( !file_exists("$dir_name/$team_name/$ques_num" ))
	{
		if ( !mkdir("$dir_name/$team_name/$ques_num" ))
		{
			$str_error = "Not able to create PROBLEM directory!<br>Try again<br><br><br><br><br><br><br><br><br><br>" ;
			error_handling ( $str_error ) ;
		}
	}

	//	Change to the problem directory
	chdir ( "$dir_name/$team_name/$ques_num" ) ;

	//	Each upload by the Team is saved. Example for problem 1: 1_1.c 1_2.c 1_3.c for first, second and third attempt respectively
	$i = 1 ;
	while ( 1 )
	{
		$name = "$ques_num" . "_$i" ;
		$flag = 0 ;
		for ( $j = 0 ; $j < count($allowedExts) ; $j++ )
		{
			$file_name = "$name.$allowedExts[$j]" ;
			if ( file_exists($file_name) )
			{
				$flag = 1 ;
				break ;
			}
		}
		if ( $flag == 0 )
			break ;
		$i ++ ;
	}

	//	The next file name is selected and it is saved in the Team/Question directory
	$file_name = "$name.$extension" ;
	move_uploaded_file ( $_FILES["file"]["tmp_name"], $file_name ) ;

	echo "File Successfully uploaded to the server" ;

	// FROM HERE, THE CODE IS FOR C LANGUAGE. MAKE IT WORK FOR ALL THE LANGUAGES
	//	Check for successful compilation
	exec( "$gcc_command $file_name 2> error") ;

	//	Emit errors in the error file.
	if ( filesize("error") == 0 )
		echo "<p><h3 style=\"color:green;\"><strong>Compilation Successful!</strong></h3><br></p>" ;
	else
	{
		echo "<p><h3 style=\"color:red;\"><strong>Compilation Failed!</strong></h3></p><br>ERRORS:<br>" ;
		$errors = file_get_contents("error") ;
		$errors = nl2br ( $errors, false ) ;
		$str_error = $errors . "<br>Try again<br><br><br><br>";
		error_handling ( $str_error ) ;
	}

	// Check if the Test Cases Directory uploaded by the admin
	if ( !file_exists("../../../$test_case_dir/$ques_num") )
	{
		$str_error = "Test case directory not found!<br>Try again<br>" ;
		error_handling ( $str_error ) ;
	}
	
	// Check if the input and output files for the question is uploaded by the admin
	if ( !file_exists("../../../$test_case_dir/$ques_num/input") || !file_exists("../../../$test_case_dir/$ques_num/output") )
	{
		$str_error = "Test case not found!<br>Try again<br>" ;
		error_handling ( $str_error ) ;
	}
	
	// IMPORTANT: Change this for other languages
	// Execute the program. $output is NOT used. $result is the exit code returned by the timeout command
	exec ( "timeout $time_limit ./a.out < ../../../$test_case_dir/$ques_num/input > out", $output, $result ) ;

	//	Compare the exit code to check the type of error
	//	Run-time exceeded
	if ( $result == 124 )
	{
		$str_error = "<h1 style=\"color:red;\"><strong>Runtime Exceeded!<br></strong></h1><img src=\"img/time_out.png\" ><br>" ;
		error_handling ( $str_error ) ;
//		echo "Runtime Exceeded<br><img src=\"img/time_out.png\" ><br><br><br>" ;
	}
	
	//	Segmentation Fault
	else if ( $result == 139 )
	{
		$str_error = "<h1 style=\"color:red;\"><strong>Segmentation Fault!</strong></h1><br><img src=\"img/error.png\" ><br>\n" ;
		error_handling ( $str_error ) ;
	//	echo "Segmentation Fault!<br><img src=\"img/error.png\" ><br><br><br>\n" ;
	}
	
	// Compare the output from the uploaded file and the output uploaded by the admin
	exec ( "diff out ../../../$test_case_dir/$ques_num/output > diff" ) ;

	//	Wrong Answer
	if ( !filesize("diff") == 0 )
		echo "<h1 style=\"color:red;\"><strong>Wrong Answer!<br></strong></h1><img src=\"img/reject.png\" height=\"200px\" width=\"200px\"><br>" ;
	
	//	Answer Accepted. Update leaderboard
	else
	{
		echo "<h1 style=\"color:green;\"><strong>Solution Accepted!<br></strong></h1><img src=\"img/right.png\" height=\"200px\" width=\"200px\"><br><br>" ;
		
		// Fetch user leaderboard data
		$query = "select * from leaderboard where team='$team_name' ;" ;
		$result = mysqli_query ( $con, $query ) ;
		if ( $result == NULL )
			error_handling ( "Not able to update the leaderboard! <br>Try again<br>" ) ;
		
		//	Update the problem attribute to the time from the start of the contest in seconds. If problem was already solved, leave unchanged
		$row = mysqli_fetch_array ( $result ) ;
		if ( $row["problem_$ques_num"] == 0 )
		{
			$pre_star = $row['total_stars'] ;
			
			//	Fetch number of stars for the problem
			$query = "select * from questions where num=$ques_num ;" ;
			$result = mysqli_query ( $con, $query ) ;
			if ( $result == NULL )
				error_handling ( "Not able to update the leaderboard! <br>Try again<br>") ;
			
			$row = mysqli_fetch_array ( $result ) ;
			$star = $row['star'] ;
			
			//	Get difference of current time and start time, and convert it to seconds using a MySQL query
			$cur_time = date("Y-m-d H:i:s") ;
			$query = "select time_to_sec(timediff('$cur_time','$start_time')) as diff ;" ;
			$result = mysqli_query ( $con, $query ) ;
			if ( $result == NULL )
				error_handling ( "Not able to update the leaderboard! <br>Try again<br>") ;
			
			$row = mysqli_fetch_array ( $result ) ;
			$time = $row['diff'] ;
			
			//	New total stars
			if ( $pre_star == 0 )
				$sum = "total_stars=$star" ;
			else
				$sum = "total_stars=total_stars+$star" ;
			
			//	Update leaderboard
			$query = "update leaderboard set problem_$ques_num=$star, $sum, total_time=$time where team='$team_name' ;" ;
			$result = mysqli_query ( $con, $query ) ;
			if ( $result == NULL )
				error_handling ( "Not able to update the leaderboard! <br>Try again<br>") ;
		}
	}
	
	//	Change to the problem directory
	chdir ( "../../../" ) ;
}	

echo "
Click here to go back to the Contest page!<br><br>
<form action=\"contest.php\" method=\"post\">
<input type=\"submit\" value=\"Contest\">
<input type=text name=\"team_name\" value=\"$team_name\" style=\"display:none\">
<input type=text name=\"ques_num\" value=\"$ques_num\" style=\"display:none\">
</form>
" ;

echo "</div></center>";

include 'footer.php';

mysqli_close( $con ) ;

function error_handling ( $message )
{
	global $team_name, $ques_num ;

	echo $message . "<br><br>";
	echo "
	Click here to go back to the Contest page!<br><br>
	<form action=\"contest.php\" method=\"post\">
	<input type=\"submit\" value=\"Contest\">
	<input type=text name=\"team_name\" value=\"$team_name\" style=\"display:none\">
	<input type=text name=\"ques_num\" value=\"$ques_num\" style=\"display:none\">
	</form>
	<br><br><br>
	" ;

	echo "</div></center>";

	include 'footer.php';

	die () ;
}

?>

</body>

</html>
