<?php

	header("Content-Type: text/html; charset=UTF-8");
			
	if(!isset($_SESSION))
	{  		session_start();	}			//�� session �禡, �ݥΤ�O�_�w�g�n���F

	require_once("../connMysql.php");			//�ޥ�connMysql.php �ӳs����Ʈw
	
	require_once("login_check.php");
	
	$server_meeting_start_form = array
	(
		"form" => array
		(
			"server_meeting_start" => array 
			(
				"func" => "�|ĳ�D���ǳƷ|ĳ",
				"addr" => "server_meeting_start.php",
				"form" => array
				(
					"ip" => "none"
				)
			)
		),	
		"state" => array();
	);
	
	echo json_encode( $employee_center );
?>