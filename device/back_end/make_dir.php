<?php

		if(!isset($_SESSION))
		{  	session_start();	}			//用 session 函式, 看用戶是否已經登錄了

		require_once("../connMysql.php");			//引用connMysql.php 來連接資料庫
		
		require_once("back_end/login_check.php");

		if ( isset($_POST['name']) && isset($_GET['basic_path'] )			//無論如何一定會有 basic_path
		{
			$path = $_GET['basic_path']."\\".$_GET['name'];
			mkdir("test\\test2");
		}	
		else
		{
			echo "nothing value";
		}

		if ($_GET['upload_path'])		//在我的空間
			header("Location: my_upload_space.php?basic_path=".$_GET['upload_path']); 
		else
			header("Location: group_upload_space.php?basic_path=".$_GET['upload_path']);
?>