

<div style="text-align:center;position:relative;left:35%;color:#FFFFFF;background-color:#3E95D8;width:30%;">
  <p><h1 align="center">管 理 员 登 录</h1></p>
</div>

<br/><br/><br/>

<form method="POST" action="index.php" >

<table align="center" >

<tr>
<td><label>管理员:</label> </td>
<td><input name="username" id="username" type="text" value="admin" /></td>
</tr>
<tr>
<td><label>密码:</label> </td>
<td><input name="password" id="password" type="password" value="" /></td>
</tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr>
<td></td>
<td> <input type="submit" value="登录" /> </td>

</tr>

</table>

</form>

<br/>
<br/>
<br/>
<br/>
<br/>	
<br/>
<br/>
<br/>
<br/>
<br/>	
<?php

$GLOBALS['TEMPLATE']['content']=ob_get_clean();
include './templates/template-page.php'
?>