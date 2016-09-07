<?php 
	if(!isset($_SESSION))
	{  		session_start();	}			//用 session 函式, 看用戶是否已經登錄了

	require_once("../connMysql.php");			//引用connMysql.php 來連接資料庫
	
	require_once("back_end/login_check.php");
	
	$member_ip = $_POST['member_ip'];
	
	$sql = "select g_m_n.member_ip, m.member_name
			from group_meeting_now as g_m_n, member as m
			where g_m_n.member_ip = '".$member_ip."' 
			and   g_m_n.member_id = m.member_id";
			
	$result = $conn->query($sql);
	$row=$result->fetch_array();
	$json = array
	(
		"contents" => array
		(
			"member_name" => $row['member_name'],
			"member_ip" => $row['member_ip']
		),
		"state" => "none"
	);
	
	echo json_encode( $json );
/*	
	$json['contents']['meeting_member']['member'] = array();
	$json['contents']['meeting_member']['member_ip'] = array();
	$json['contents']['meeting_member']['group_id'] = array();

	for($i=1;$i<=$num_rows;$i++)
	{
		$row=$result->fetch_array();				//rs 在這裏, fetch_assoc 的 index 只能用字串, 而 fetch_array 能用數字和字串作 index

		array_push( $json ['link']['group_manager']['member'], $row['name']);
		array_push( $json ['link']['group_manager']['member_id'], $row['id'] );
		
		
		if ($leader_id == $_SESSION["id"] && $leader_id != $row['id'])			//如果是leader, 就會擁有刪除成員的link
		{
			array_push( $json['link']['group_manager']['del_member'], "del_group_member.php?member_id=".$row['id']."&group_id=".$_GET['group_id'] );
		}
		
	}
*/
?>