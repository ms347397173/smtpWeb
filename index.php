<html>
<head>
<title> SMTP Protocol Analysis Log </title>
</head>

<h1 align="center"> SMTP Protocol Analysis Log </h1> 
<p align="left">eml文件可通过outlook、foxmail等邮件客户端查看</p>


<?php
//Open a new connection to the MySQL server
$mysqli = new mysqli('127.0.0.1','root','root','smtp');

//Output any connection error
if ($mysqli->connect_error) {
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}
$results = $mysqli->query("SELECT * FROM smtp_info");
	

print '<table border="2">';

//打印表头
print '<tr>';
while($field = $results->fetch_field())
{
   print '<td>'.$field->name.'</td>';
}
print '</tr>';
 
//打印表的全部数据
while($row = $results->fetch_assoc()) 
{
    print '<tr>';
    print '<td>'.$row["hostname"].'</td>';
    print '<td>'.$row["username"].'</td>';
    print '<td>'.$row["password"].'</td>';
	print '<td>'.$row["auth_type"].'</td>';
    print '<td>'.$row["_from"].'</td>';
    print '<td>'.$row["sendto"].'</td>';
	print '<td>'.$row["subject"].'</td>';
	print '<td>'.$row["date"].'</td>';
	print '<td>'.$row["user_agent"].'</td>';
	print '<td>'.$row["attachment_name"].'</td>';
	
	//eml文件需要一个超链接
    print '<td>'.'<a href=".\\myftp\\'.$row["eml_file"].'">'.$row["eml_file"].'</a>'.'</td>';

	print '</tr>';
}  
print '</table>';

$results->free();
$mysqli->close(); 

?>
</html>