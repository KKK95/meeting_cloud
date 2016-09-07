<?php

	header("Content-Type: text/html; charset=UTF-8");
			
	if(!isset($_SESSION))
	{  		session_start();	}			//用 session 函式, 看用戶是否已經登錄了

	require_once("../connMysql.php");			//引用connMysql.php 來連接資料庫
	
	require_once("back_end/login_check.php");
	$sql = "select s_r_n.ip from server_running_now as s_r_n, group_meeting_now as g_m_n where 
			s_r_n.server_id = g_m_n.server_id and g_m_n.member_id = '".$_SESSION["id"]."'";

	$result = $conn->query($sql);
	$row=$result->fetch_array();
	$server_ip = $row['ip'];
	
	$em_meeting_end = array
	(
		"contents" => array
		(
			"server_ip" => $server_ip
		),
		"link" => array
		(
			"meeting_end" => "back_end/em_meeting_end.php"
		)
		"state" =>array
		(
			"command" => "connect to local server"
		)
	);
	
	
	
?>