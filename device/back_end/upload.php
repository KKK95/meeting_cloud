<?php

		//device/back_end
		
		if(!isset($_SESSION))
		{  	session_start();	}			//�� session �禡, �ݥΤ�O�_�w�g�n���F

		require_once("../connMysql.php");			//�ޥ�connMysql.php �ӳs����Ʈw
	
		require_once("back_end/login_check.php");
		
		
		
		$path = '../';
		
		if (isset($_GET['upload_path']))
		{
			$path = $path . $_GET['upload_path'];
			$target_file = $path . basename($_FILES["fileToUpload"]["name"]);
			
			if ($_FILES["fileToUpload"]["size"] > 20000000) 
			{
				echo "Sorry, your file is too large.";
				$uploadOk = 0;
			}
			else
			{
				if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
					echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
				else{
					$status= "There was an error uploading the file, please try again!";
					$status.= "filename: " .  basename( $_FILES['fileToUpload']['name']);
					echo "$status";
				}
			}
		}
		
		if ($_GET['upload_path'])		//�b�ڪ��Ŷ�
			header("Location: my_upload_space.php?basic_path=".$_GET['upload_path']); 
		else
			header("Location: group_upload_space.php?basic_path=".$_GET['upload_path']);
		
		
		
		
?>