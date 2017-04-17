<html>
<head>
<title> SMTP Protocol Analysis Log </title>
</head>

<h1 align="center"> SMTP Protocol Analysis Log </h1> 


<?php
//Open a new connection to the MySQL server
$mysqli = new mysqli('127.0.0.1','root','root','smtp');

//Output any connection error
if ($mysqli->connect_error) {
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}
$results = $mysqli->query("SELECT * FROM smtp_info");
	

print '<table border="2">';

print '<tr>';
while($field = $results->fetch_field())
{
   print '<td>'.$field->name.'</td>';
}
print '</tr>';
 
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
	print '<td>'.$row["eml_file"].'</td>';
	//print '<td>'.'<a href="open_outlook.php">'.$row["eml_file"].'</a>'.'</td>';
    print '</tr>';
}  
print '</table>';

$results->free();
$mysqli->close(); 

?>
</html>