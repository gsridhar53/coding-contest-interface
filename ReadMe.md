
Live Website at http://www.sjceresults.com/coding

===================================================

Either use the database dump present in the database folder or initialize a new database

Steps to dump the database:
1.	Drop the existing database names "coding" and create a new one
2.	The database dump is present in "databse/addedQuestions.sql". Use "mysqldump"
OR
Steps to initialize the database:
1.	Run the "database/init.sql" (First remove the database named "coding" )
2.	Run the "add_ques/index.php" in the browser and insert the test questions in the "add_ques/Sample\ Questions" folder

Steps to initialize the interface:
1.	All the files have 644 permission, while the directories have 755 permissions
	find . -type f -exec chmod 644 {} \; #chmodfile
	find . -type d -exec chmod 755 {} \; #chmoddirectory

2.	The "Uploads" directory has 777 permission
	chmod 777 interface/night_out/uploads_corei3

NOTE:
1.	The testcases should not have an extra \n at the end of input. The line number should be same as the last input line. Same applies to output file as well.


