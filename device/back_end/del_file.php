<?php


		if(!isset($_SESSION))
		{  	session_start();	}			//�� session �禡, �ݥΤ�O�_�w�g�n���F

		require_once("../../connMysql.php");			//�ޥ�connMysql.php �ӳs����Ʈw
	
		require_once("login_check.php");
		
		$path = '../';
		
		if ( isset($_GET['basic_path']) && isset($_GET['file_name']) )
		{
			$path = $path.$_GET['basic_path']."/".$_GET['file_name'];
			
			if(file_exists($path))
			{	unlink($path);	}	//�N�ɮקR��
			else
			{	echo"�ɮפ��s�b"	}
		}
		
		if ( false !== ($rst = strpos($_GET['basic_path'], "user_upload_space")) )		//�b�ڪ��Ŷ�
			header("Location: my_upload_space.php?basic_path=".$_GET['basic_path']); 
		else
			header("Location: group_upload_space.php?basic_path=".$_GET['basic_path']);
?>