<?php
		//device/back_end
		
		if(!isset($_SESSION))
		{  	session_start();	}			//�� session �禡, �ݥΤ�O�_�w�g�n���F

		require_once("../../connMysql.php");			//�ޥ�connMysql.php �ӳs����Ʈw
	
		require_once("login_check.php");
		
		$datetime = date("Y-m-d H:i:s");
		
		$msg = $_POST['msg'];
		
		$record_id = $_GET['group_id'];
		
		$member_id = $_SESSION["id"];
		
		if( isset($msg) && isset($group_id))
		{
			if(!empty($msg))
			{
				$sql = "INSERT INTO group_meeting_record value('record_id','$member_id','$datetime','$msg')";
				
				if	($conn->query($sql))
					echo "�o�e���\";
				else
					echo "�o�e����";
			}
		}
		
		if (false !== ($rst = strpos($member_id, "ls"))				//server �e���N�^��server ����
		header("Location: server_meeting_runngin.php"); 
		else
		header("Location: em_meeting_runngin.php"); 
?>