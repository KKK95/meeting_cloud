<?php

	header("Content-Type: text/html; charset=UTF-8");
	
	if(!isset($_SESSION))
	{  		session_start();	}			//�� session �禡, �ݥΤ�O�_�w�g�n���F

	require_once("../../connMysql.php");			//�ޥ�connMysql.php �ӳs����Ʈw
	
	require_once("login_check.php");			
	
	$group_id = $_POST["group_id"];
	$today = date("Y-m-d H:i:s");
	$meeting_title = $_POST['meeting_title'];
	$create_meeting_member_id = $_POST['create_meeting_member_id'];
	$meeting_time = $_POST['meeting_time'];
	
	if ($group_id != "" && $create_meeting_member_id != "")
	{
		if (((strtotime($meeting_time) - strtotime($today))/ (60*60)) > 0)				//�s�W���|ĳ���w����b�L�h
		{
			$sql = "INSERT INTO meeting_scheduler value('', '".$group_id."', '".$meeting_title."', '".$create_meeting_member_id."', '".$meeting_time."')";
			$result = $conn->query($sql);
		}
	}

		header("Location: employee_center.php");
	
?>