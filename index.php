<?php 

$GLOBALS['TEMPLATE']['title']='SMTP Protocol Analysis Log';

ob_start();
date_default_timezone_set("PRC");  
?>

<div style="color:red">
  <h3><p>eml文件可通过outlook、foxmail等邮件客户端查看</p></h3>
</div>

<div style="color:#00FF00">
  <h3><p>邮件检索</p></h3>
</div>

<form method="get" action="result.php" >
<table>
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



	

