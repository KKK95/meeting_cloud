<?php

	header("Content-Type: text/html; charset=UTF-8");
			
	if(!isset($_SESSION))
	{  		session_start();	}			//用 session 函式, 看用戶是否已經登錄了

	require_once("../connMysql.php");			//引用connMysql.php 來連接資料庫
	
	require_once("login_check.php");
	
	$state = "會議進行中";
	
	$server_meeting_running = array
	(
		"link" => array
		(
			"會議結束" => "server_meeting_end.php"
		),
		"state" => array()
	);
	
	echo json_encode( $server_meeting_running );
?>