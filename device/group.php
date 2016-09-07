<?php 
	if(!isset($_SESSION))
	{  		session_start();	}			//用 session 函式, 看用戶是否已經登錄了

	require_once("../connMysql.php");			//引用connMysql.php 來連接資料庫
	
	require_once("back_end/login_check.php");
	
	$sql = "select gl.leader_id, m.name
			from group_leader as gl, member as m
			where 
			gl.group_id = '".$_GET['group_id']."' and m.id = gl.leader_id";
			
	$result=$conn->query($sql);
	$row=$result->fetch_array();
	
	$leader_id = $row['leader_id'];
	$leader_name = $row['name'];					//先抓出群組中的隊長
	
	$sql = "select m.id, m.name 
			from group_member as gm, member as m, group_leader as gl
			where 
			gm.group_id = '".$_GET['group_id']."'
			and (gm.member_id = m.id or gl.leader_id = m.id)
			and gl.group_id = gm.group_id
			group by m.id";

	$result=$conn->query($sql);						//再抓出群組中的成員
	
	$state = "";
	
	$json = array
	(
		"content" => array
		(
//			"leader_name" => $leader_name,
//			"leader_id" => $leader_id,
//			"member_name_id" => array ()
		),
		"link" => array
		(	
			"my_upload_space" => "upload_space.php?basic_path=".$_SESSION["id"]."&path=".$_GET['group_id'],
			"group_upload_space" => "group_upload_space.php?basic_path=".$_GET['group_id']."&path=none",
			"group_manager" => array()
		),
		"form" => array
		(
			array 
			(
				"func" => "新增會員到此群組",
				"addr" => "back_end/add_member_to_group.php",
				"form" => array
				(
					"group_id" => $_GET['group_id'],
					"member_id" => "none"
				)
			),
			array
			(
				"func" => "會議開始",
				"addr" => "back_end/em_meeting_start.php",
				"form" => array
				(
					"local_server_id" => "none",
					"group_id" => $_GET['group_id'],
					"member_ip" => "none"
				)
			)
		),	
		"state" => array()
	);
	$num_rows = $result->num_rows;	
	if ($num_rows==1)
	{	$state = "";	}	
	else
	{	
		//$json['link']['會議開始'] => "em_meeting_start_form.php?group_id=".$_GET['group_id'];
		$json['link']['group_manager']['member'] = array();
		$json['link']['group_manager']['member_id'] = array();
		if ($leader_id == $_SESSION["id"])
		{
			$json['link']['group_manager']['del_member'] = array();
		}
		$state = "有群組成員";
		for($i=1;$i<=$num_rows;$i++)
		{
			$row=$result->fetch_array();				//rs 在這裏, fetch_assoc 的 index 只能用字串, 而 fetch_array 能用數字和字串作 index

			array_push( $json ['link']['group_manager']['member'], $row['name']);
			array_push( $json ['link']['group_manager']['member_id'], $row['id'] );
			
			
			if ($leader_id == $_SESSION["id"] && $leader_id != $row['id'])			//如果是leader, 就會擁有刪除成員的link
			{
				array_push( $json['link']['group_manager']['del_member'], "back_end/del_group_member.php?member_id=".$row['id']."&group_id=".$_GET['group_id'] );
			}
			
		}
	}
	
	
	echo json_encode( $json );

?>

