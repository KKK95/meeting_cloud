<?php

	header("Content-Type: text/html; charset=UTF-8");
			
	if(!isset($_SESSION))
	{  		session_start();	}			//用 session 函式, 看用戶是否已經登錄了

	require_once("../connMysql.php");			//引用connMysql.php 來連接資料庫
	
	require_once("back_end/login_check.php");
	
	if ($_GET['basic_path'] == "none")		//列出member 所有的共享空間 (需查詢資料庫)
	{}
	else if ($_GET['path'] == "none")		//沒必要把basic_path 和 path 合起來
	{}
	else									//把basic_path 和 path 合起來
	{}
	
	//有path, path = none 即到file root
	//path != none 即到該file
	
	
	
	
?>