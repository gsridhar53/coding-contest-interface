<html>

<head>

<style>
.content
{
width:900px;
height:700px;
background-color:rgba(40,40,40,0.5);
border-radius: 20px ;
padding-top:0.5px;
}
</style>

</head>

<body>

<?php include 'header.php';?>

<br>
<br>
<center>
	<img src="img/main.png" width=528px height=46px>
</center>
<br>
<br>
<div class="content" style="margin:auto;padding-left:20px;">
	<p style="font-size:20px;">
	<center>
		<b>
			<u>RULES</u>
		</b>
	</center>
	</p>
	<p>1.Each question will have specified number of stars which shows its weightage. Higher the number of stars, more points you will get.</p>
	<p>2.If there is a <b>TIE</b> then the parameters like code efficiency and submission time will be considered.</p>
	<p>3.The code must be uploaded in the provided section for compilation!</p>
	<p>4.The contest will be from <b>17th Oct, 10 45 PM to 18th Oct, 6 AM </b></p>
	<p>5.Compiler used is "gcc". <br>Linux users, use the following command to compile your programs in your systems
		<center>
			<b>"gcc -Wall -lm file_name.c"</b>
		</center>
	</p>
	<br>Windows users, use the following online compiler(which uses "gcc")<br>http://www.compileonline.com/compile_c_online.php
	<p>6.Please note the format(CAPS LOCK, spaces, new line etc) of the smaple output carefully. Your output should exactly match with the expected output.</p>
	<p>7.The Results you may get when you upload your file are :<br> I.&nbsp Compiler error <br>II. Compilation successful,wrong answer! <br> III.Time Limit exceeded! <br> IV.Compilation successful, Answer accepted!</p>
	<center>
		<p>
		<b>ALL THE BEST!!!</b>
		</p>
	</center>

<?php
echo "
<center>Click here to goto the contest page!<br><br></center>
<center><form action=\"night_out/\">
<input type=\"submit\" value=\"Contest\" style=\"width:80px;height:30px\">
</form></center>
" ;
?>

</div>
<br>

<?php include 'footer.php';?>

</body>

</html>
