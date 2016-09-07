﻿<?php

	header("Content-Type: text/html; charset=UTF-8");
	
	if(!isset($_SESSION))
	{  		session_start();	}			//用 session 函式, 看用戶是否已經登錄了

	require_once("../../connMysql.php");			//引用connMysql.php 來連接資料庫
	
	require_once("login_check.php");			
	
	$no_values = NULL;
	$lsid = $_POST["local_server_id"];
	$gid = $_POST["group_id"];
	$member_ip = $_POST["member_ip"]
																//正在運行的主機會在server_running_now資料表中填上自己的id, 當主機關閉時會在資料表中刪除自己的id
	$sql = "select group_id, ip from server_running_now where server_id = '".$lsid."'";			//查看lsid(會議主機id) 是否有在運行和空閒
	
	$result = $conn->query($sql);
	
	$row=$result->fetch_array();
	
	if ($row['group_id'] == $gid || $row['group_id'] == NULL)									//
	{
		if ($row['group_id'] == NULL)
		{
			$sql = "UPDATE server_running_now SET group_id = '".$gid."'  where server_id = '".$lsid."'";
			$result = $conn->query($sql);
			$sql = "UPDATE group_meeting_now SET member_id = '".$_SESSION["id"]."' and server_id = '".$lsid."' and member_ip = '".$member_ip."'";
			$result = $conn->query($sql);
		}
		else
		{
			$sql = "UPDATE group_meeting_now SET member_id = '".$_SESSION["id"]."' and member_ip = '".$member_ip."' where server_id = '".$lsid."'";
			$result = $conn->query($sql);
		}
		
		header("Location: em_meeting_running.php");
	}
	else
	{
		header("Location: employee_center.php");
	}
	
?>