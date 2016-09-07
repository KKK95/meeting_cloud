<?php

		if(!isset($_SESSION))
		{  	session_start();	}			//用 session 函式, 看用戶是否已經登錄了

		require_once("../../connMysql.php");			//引用connMysql.php 來連接資料庫
	
		require_once("login_check.php");
		
		$path = '../';
		if ( isset($_GET['download_path']) && isset($_GET['file_name']) )			// $_GET['download_path'] 即為傳入要下載的檔案名稱 (含路徑)
		{
			$path = $path.$_GET['download_path']."/".$_GET['file_name'];
			header("Content-type:application");
			header("Content-Length: " .(string)(filesize($path)));
			header("Content-Disposition: attachment; filename=".$_GET['file_name']);
			readfile($path);
		}
		else
		{
			echo "file :".$path."not found";
		}
	
		if ( false !== ($rst = strpos($_GET['download_path'], "user_upload_space")) )		//在我的空間
			header("Location: my_upload_space.php?basic_path=".$_GET['download_path']); 
		else
			header("Location: group_upload_space.php?basic_path=".$_GET['download_path']);
		
?>