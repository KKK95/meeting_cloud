<?php

	header("Content-Type: text/html; charset=UTF-8");
			
	if(!isset($_SESSION))
	{  		session_start();	}			//用 session 函式, 看用戶是否已經登錄了

	require_once("../connMysql.php");			//引用connMysql.php 來連接資料庫
	
	require_once("login_check.php");
	
	$json = array
	(
		'form' => array
		(
			
		)
	);
?>

<html>

<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title>login test</title>
</head>

<body>
	<form name="form1" method="post" action="em_meeting_start.php">
		<table width="250" border="1" align="center">
			<tr valign="top"><td align="center">
			<p>輸入會議伺服器id</p>
			<p>server id<br>
				<input name="local_server_id" type="text" value="">
			</p>
			<p>group id<br>
				<input name="group_id" type="text" value="<?php echo $_GET['g_id'] ?>">
			</p>
			<p align="center">
				<input type="submit" name="login" value="login">
			</p>	
			</td></tr>
		</table>
	</form>
</body>

</html>