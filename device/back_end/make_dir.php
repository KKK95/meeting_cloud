<?php

		if(!isset($_SESSION))
		{  	session_start();	}			//�� session �禡, �ݥΤ�O�_�w�g�n���F

		require_once("../connMysql.php");			//�ޥ�connMysql.php �ӳs����Ʈw
		
		require_once("back_end/login_check.php");

		if ( isset($_POST['name']) && isset($_GET['basic_path'] )			//�L�צp��@�w�|�� basic_path
		{
			$path = $_GET['basic_path']."\\".$_GET['name'];
			mkdir("test\\test2");
		}	
		else
		{
			echo "nothing value";
		}

		if ($_GET['upload_path'])		//�b�ڪ��Ŷ�
			header("Location: my_upload_space.php?basic_path=".$_GET['upload_path']); 
		else
			header("Location: group_upload_space.php?basic_path=".$_GET['upload_path']);
?>