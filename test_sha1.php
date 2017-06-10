

<html>
<head>test</head>
<body>

<?php
$str = "Shanghai";
echo "字符串：".$str."<br>";
echo "TRUE - 原始 20 字符二进制格式：".sha1($str, TRUE)."<br>";
echo "FALSE - 40 字符十六进制数：".sha1($str)."<br>";
?>
  
</body>
</html>