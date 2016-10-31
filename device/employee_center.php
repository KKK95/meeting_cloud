<?php

	header("Content-Type: text/html; charset=UTF-8");
			
	if(!isset($_SESSION))
	{  		session_start();	}			//用 session 函式, 看用戶是否已經登錄了

	require_once("../connMysql.php");			//引用connMysql.php 來連接資料庫
	
	require_once("back_end/login_check.php");
	
	$sql = "select scheduler.*, member.name
			from meeting_scheduler as scheduler, member
			where scheduler.group_id in 
			(select gl.group_id
				FROM group_leader as gl, group_member as gm
				where gm.member_id = '".$id."' or gl.member_id = '".$id."'
                group by gl.group_id
			)
			and member.id = scheduler.create_meeting_member_id
            order by scheduler.time desc";
			
	$result = $conn->query($sql);
	
	$json = array
	(
		"link" => array
		(
			"新增會議群組" => "build_group_form.php",
			"查看會議群組列表" => "em_group_list.php",
			"我的雲端空間" => "my_upload_space.php?basic_path=user_upload_space/".$_SESSION["id"],
			"會議群組雲端空間" => "group_upload_space_center.php?basic_path=group_upload_space",
			"登出系統" => "back_end/logout.php"
			
		),
	);
	/*
		$num_rows = $result->num_rows;	
		$today = date("Y-m-d");
		$end_meeting = 0;
	
	if ( $num_rows == 0 )
	{	echo "目前沒有關於你的會議";	}
	else
	{			
		$json['link']['obj_time_to_meeting'] = array();
		$json['link']['obj_time_to_meeting']['0'] = array();
		$json['link']['obj_time_to_meeting']['0date'] = array();
		$json['link']['obj_time_to_meeting']['0time'] = array();
		$json['link']['obj_time_to_meeting']['0leader'] = array();
		$json['link']['obj_time_to_meeting']['meeting_start'] = array();
		
		for($i=1 ; $i<=$num_rows ; $i++) 
		{
			$row=$result->fetch_array();
			$meeting_date = date("Y-m-d", strtotime($row['time']));
			$meeting_time = date("H:i", strtotime($row['time']));
			
			if ((strtotime($today) - strtotime($meeting_date)) > 0)		//昨天的事
			{	$end_meeting = $i;	break;	}
			$title = $row['title'];
			$create_meeting_member_id = $row['create_meeting_member_id'];
			
			array_push( $json['link']['obj_group']['0group_name'], $row['group_name']);
			array_push( $json['link']['obj_group']['查看'], "group.php?group_id=".$row['group_id']);
			"../back_end/meeting_start.php' style=\"color:#333333;width:auto;line-height:200%;\">";
//					echo $title;
			echo "</td>";
			
			echo "<td id=\"date\">$meeting_date</td>";
			echo "<td id=\"time\">$meeting_time</td>";
			echo "<td id=\"leader\">$create_meeting_member_id</td>";
			echo "</tr>";
			

		}
	}
	*/
	echo json_encode( $json );
?>