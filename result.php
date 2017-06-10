

<?php
	$GLOBALS['TEMPLATE']['title']='搜索结果';
	

	date_default_timezone_set("PRC");
	
	$whereSign=0;
	
	//处理时间日期
	if($_REQUEST['startDate']!=null)
	{
		if($_REQUEST['startTime']!=null)
		{
			$startDateTime=$_REQUEST['startDate'].' '.$_REQUEST['startTime'];
		}
		else
		{
			$startDateTime=$_REQUEST['startDate'].' 00:00:00';
		}
	}
	else
	{
		$startDateTime=null;
	}
	if($_REQUEST['endDate']!=null)
	{
		if($_REQUEST['endTime']!=null)
		{
			$endDateTime=$_REQUEST['endDate'].' '.$_REQUEST['endTime'];
		}
		else
		{
			$endDateTime=$_REQUEST['endDate'].' 00:00:00';
		}
	}
	else
	{
		$endDateTime=null;
	}
	
	$queryStr='SELECT * FROM smtp_info';
	
	$dateTimeQueryStr=null;
	$sign=0;
	if(strcmp($startDateTime,$endDateTime)!=0)
	{
		$whereSign=1;

		if($startDateTime!=null)
		{
			$dateTimeQueryStr.='date>="';
			$dateTimeQueryStr.=$startDateTime;
			$dateTimeQueryStr.='"';
			$sign=1;
		}
		if($endDateTime!=null)
		{
			if($sign==1)
			{
				$dateTimeQueryStr.=' AND date<="';
				$dateTimeQueryStr.=$endDateTime;
				$dateTimeQueryStr.='"';
			}
			else
			{
				$dateTimeQueryStr.='date<= "';
				$dateTimeQueryStr.=$endDateTime;
				$dateTimeQueryStr.='"';
			}
		}
	
	}
	//echo $dateTimeQueryStr;
	
	//检查发件人
	if($_REQUEST['from']!=null)
	{
		$whereSign=1;
		$fromQueryStr='_from LIKE "%'.$_REQUEST['from'].'%"';
	}
	else
	{
		$fromQueryStr=null;
	}
	
	//检查收件人
	if($_REQUEST['sendTo']!=null)
	{
		$whereSign=1;
		$sendToQueryStr='sendto LIKE "%'.$_REQUEST['sendTo'].'%"';
	}
	else
	{
		$sendToQueryStr=null;
	}
	
	//检查标题
	if($_REQUEST['subject']!=null)
	{
		$whereSign=1;
		$subjectQueryStr='subject LIKE "%'.$_REQUEST['subject'].'%"';
	}
	else
	{
		$subjectQueryStr=null;
	}
	
	//检查附件名
	if($_REQUEST['attachementName']!=null)
	{
		$whereSign=1;
		$attachmentNameQueryStr='attachment_name LIKE "%'.$_REQUEST['attachementName'].'%"';
	}
	else
	{
		$attachmentNameQueryStr=null;
	}
	
	//检查邮件代理
	if($_REQUEST['userAgent']!=null)
	{
		$whereSign=1;
		$userAgentQueryStr='user_agent LIKE "%'.$_REQUEST['userAgent'].'%"';
	}
	else
	{
		$userAgentQueryStr=null;
	}
	
	//检查邮件内容
	if($_REQUEST['mailContent']!=null)
	{
		$whereSign=1;
		//打开eml文件检索内容
		
	}
	else
	{
		$mailContentQueryStr=null;
	}
	
	
	//加入所有条件
	if($whereSign==1)
	{	
		$queryStr.=' WHERE ';
		$hasAnd=false;
		if($dateTimeQueryStr!=null)
		{
			$hasAnd=true;
			$queryStr.=$dateTimeQueryStr;
		}
		if($fromQueryStr!=null)
		{
			if($hasAnd)
				$queryStr.=' AND ';
			$hasAnd=true;
			$queryStr.=$fromQueryStr;
		}
		if($sendToQueryStr!=null)
		{
			if($hasAnd)
				$queryStr.=' AND ';
			$hasAnd=true;
			$queryStr.=$sendToQueryStr;
		}
		if($subjectQueryStr!=null)
		{
			if($hasAnd)
				$queryStr.=' AND ';
			$hasAnd=true;
			$queryStr.=$subjectQueryStr;
		}
		if($attachmentNameQueryStr!=null)
		{
			if($hasAnd)
				$queryStr.=' AND ';
			$hasAnd=true;
			$queryStr.=$attachmentNameQueryStr;
		}
		if($userAgentQueryStr!=null)
		{
			if($hasAnd)
				$queryStr.=' AND ';
			$hasAnd=true;
			$queryStr.=$userAgentQueryStr;
		}

	}	
	//echo $queryStr;
	
	ob_start();
	
	
	//Open a new connection to the MySQL server
	$mysqli = new mysqli('127.0.0.1','root','root','smtp');

	//Output any connection error
	if ($mysqli->connect_error) {
		die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}
	$results = $mysqli->query($queryStr);
	
	if($results->num_rows>0)
	{
		print '<div style="text-align:center;background-color:#3E95D8;width:100%;"><p><h1> 搜索结果(共找到'.$results->num_rows.'条邮件记录)</h1></p></div>';
		print '<br/><br/><br/><br/>';
		
		print '<div style="font-size:10px;font-family:sans-serif">';
		print '<table border="0">';
		//打印表头
		print '<tr>';
		while($field = $results->fetch_field())
		{
			print '<th>'.$field->name.'</th>';
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
			print '<td>'.'<a href="..\\myftp\\'.$row["eml_file"].'">'.$row["eml_file"].'</a>'.'</td>';

			print '</tr>';
		}  
		print '</table>';
		print '</div>';
		
	}
	else
	{
		echo '<h2>no data for search</h2>';
	}
	
	
	
?>

<!--
<table>
<tr>
<td>startDate=</td> 
<td><?php echo $_REQUEST['startDate'];?></td> 
</tr>
<tr>
	<td>startTime=</td> 
	<td><?php echo $_REQUEST['startTime'];?></td>
</tr>
<tr>
	<td>endDate=</td> 
	<td><?php echo $_REQUEST['endDate'];?></td>
</tr>
<tr>
	<td>endTime=</td> 
	<td><?php echo $_REQUEST['endTime'];?></td>
</tr>
<tr>
	<td>from=</td> 
	<td><?php echo $_REQUEST['from'];?></td>
</tr>
<tr>
	<td>sendTo=</td> 
	<td><?php echo $_REQUEST['sendTo'];?></td>
</tr>
<tr>
	<td>subject=</td> 
	<td><?php echo $_REQUEST['subject'];?></td>
</tr>
<tr>
	<td>attachementName=</td> 
	<td><?php echo $_REQUEST['attachementName'];?></td>
</tr>
<tr>
	<td>userAgent=</td> 
	<td><?php echo $_REQUEST['userAgent'];?></td>
</tr>
<tr>
	<td>mailContent=</td> 
	<td><?php echo $_REQUEST['mailContent'];?></td>
</tr>

</table>
-->

<?php 
	$GLOBALS['TEMPLATE']['content']=ob_get_clean();
	include './templates/template-page.php'
?>
