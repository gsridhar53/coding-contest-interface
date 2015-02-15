
Steps to initialize the database:
1.	Run the "database/init.sql"
2.	Run the "add_ques/index.php" in the browser and insert the test questions in the "add_ques/Sample\ Questions" folder

Steps to initialize the interface:
1.	All the files have 644 permission, while the directories have 755 permissions
	find . -type f -exec chmod 644 {} \; #chmodfile
	find . -type d -exec chmod 755 {} \; #chmoddirectory

2.	The "Uploads" directory has 777 permission
	chmod 777 interface/night_out/uploads_corei3

NOTE:
1.	The testcases should not have an extra \n at the end of input. The line number should be same as the last input line. Same applies to output file as well.


