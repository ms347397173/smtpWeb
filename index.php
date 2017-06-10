<?php

	if($_REQUEST['username']==NULL && $_REQUEST['password']==NULL)
	{
		echo "<script language='javascript' type='text/javascript'>";  
		echo "window.location.href='login.php'";  
		echo "</script>"; 
		exit;
	}
 
	$mysqli = new mysqli('127.0.0.1','root','root','smtp');

	//Output any connection error
	if ($mysqli->connect_error) {
		die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}
	
	$queryStr='SELECT password FROM user WHERE username="'.$_REQUEST['username'].'";';
	
	$results = $mysqli->query($queryStr);
	
	if($results->num_rows==1)
	{
		$sha1Password=sha1($_REQUEST['password']);
		$row = $results->fetch_assoc();
		$databasePassword=$row['password'];	
		
		if($sha1Password==$databasePassword)
		{
			//进入index.php
			
			//echo '验证成功';
		}
		else
		{
			//返回login.php
			
			echo "<script>alert('登录失败')</script>";
 
			echo "<script language='javascript' type='text/javascript'>";  
			echo "window.location.href='login.php'";  
			echo "</script>";  
			exit;

			
		}
	}
	else
	{
		echo "<script>alert('登录失败')</script>";
		
		echo "<script language='javascript' type='text/javascript'>";  
		echo "window.location.href='login.php'";  
		echo "</script>";
		exit;		
	}
	
	
	
	
?>
<?php 

$GLOBALS['TEMPLATE']['title']='SMTP Protocol Analysis Log';

ob_start();
date_default_timezone_set("PRC");  
?>

<div style="text-align:center;position:relative;left:35%;color:#FFFFFF;background-color:#3E95D8;width:30%;">
  <p><h1 align="center">邮 件 监 控 检 索</h1></p>
</div>

<form method="get" action="result.php" >

<table align="center" >

<tr>
	<td><label>开始时间:</label> </td> 
	<td><input name="startDate" id="startDate" type="date" value="<?php echo '20'.date('y-m-d'); ?>"/> </td>
	<td><input name="startTime" id="startTime" type="time" value="00:00:00" /> </td>
</tr>

<tr>
<td><label>结束时间:</label> </td>
<td><input name="endDate" id="endDate" type="date" value="<?php echo '20'.date('y-m-d'); ?>"/></td> 
<td><input name="endTime" id="endTime" type="time" value="00:00:00" /></td>
</tr>
<tr>
<td><label>发件人:</label> </td>
<td><input name="from" id="from" type="text" value="" /></td>
</tr>
<tr>
<td><label>收件人:</label> </td>
<td><input name="sendTo" id="sendTo" type="text" value="" /></td>
</tr>
<tr>
<td><label>标题:</label> </td>
<td><input name="subject" id="subject" type="text" value="" /></td>
</tr>
<tr>
<td><label>附件名:</label> </td>
<td><input name="attachementName" id="attachementName" type="text" value="" /></td>
</tr>
<tr>
<td><label>邮件代理:</label> </td>
<td><input name="userAgent" id="userAgent" type="text" value="" /></td>
</tr>
<tr>
<td><label>邮件内容:</label> </td>
<td><input name="mailContent" id="mailContent" type="text" value="" /></td>
</tr>
<tr>
<td> <input type="submit" value="搜索" /> </td>
<td> <input type="reset" value="重置输入" /> </td>
</tr>

</table>

</form>


<?php

$GLOBALS['TEMPLATE']['content']=ob_get_clean();
include './templates/template-page.php'
?>



	

