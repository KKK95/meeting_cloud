<?php
		//device/back_end
		
		if(!isset($_SESSION))
		{  	session_start();	}			//�� session �禡, �ݥΤ�O�_�w�g�n���F

		require_once("../../connMysql.php");			//�ޥ�connMysql.php �ӳs����Ʈw
	
		require_once("login_check.php");
		
		$datetime = date("Y-m-d H:i:s");
		
		$meeting_id = $_GET['meeting_id'];
		
		$question = $_SESSION['question'];
		
		$sql = "select * from meeting_question as m_q where meeting_id = '".$meeting_id."'";
		$result = $conn->query($sql);
		$num_rows = $result->num_rows;	
		$question_id = $num_rows + 1;
		
		if( isset($question) )
		{
				$sql = "INSERT INTO meeting_question value('$meeting_id','$question_id' ,'$question','' ,'$datetime')";
				
				if	($conn->query($sql))
					echo "�o�e���\";
				else
					echo "�o�e����";
		}
		
		//									�n��
		header("Location: group_chat_room.php?group_id=".$_GET['group_id']."&msg_volume=0"); 
?>