<?php
		//device/back_end
		
		if(!isset($_SESSION))
		{  	session_start();	}			//�� session �禡, �ݥΤ�O�_�w�g�n���F

		require_once("../../connMysql.php");			//�ޥ�connMysql.php �ӳs����Ʈw
	
		require_once("login_check.php");
		
		$datetime = date("Y-m-d H:i:s");
		
		$meeting_id = $_GET['meeting_id'];
		
		$question_id = $_GET['question_id'];
		
		$answer = $_SESSION['answer'];
		
		if( isset($question) )
		{
				$sql = "UPDATE server_running_now SET answer = '".$answer."'  
						where server_id = '".$meeting_id."' and meeting_id = '".$meeting_id."'";	
				if	($conn->query($sql))
					echo "�o�e���\";
				else
					echo "�o�e����";
		}
		
		//									�n��
		header("Location: group_chat_room.php?group_id=".$_GET['group_id']."&msg_volume=0"); 
?>