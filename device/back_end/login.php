<?php

	header("Content-Type: text/html; charset=UTF-8");
	
	require_once ('../../connMysql.php');			//�ޥ�connMysql.php �ӳs����Ʈw
	
	session_start();						//�� session �禡
	
	$sql = "SELECT id,pw,access FROM member WHERE id='".$_POST["id"]."'";		//sql �d�߻y�k, �d�߫�|�⵲�G��^�� $sql
		
	$result=$conn->query($sql);									//��W���d�߫��O���� mysql_query �d��, ��result�o��d�ߪ����G
	
	$row=$result->fetch_array();								//�u�n�@����
		
	$id = $row['id'];
		
	$pw = $row['pw'];
	
	$access = $row['access'];
	
	if (	isset($_SESSION["id"]) && ($_SESSION ["id"] != "")	)
	{	
		//�n����, �o�شN���}�F, ���|��ڧA�b���������v���޾ɧA�h���P������
			if ($row['access']=="em")
				header("Location: employee_center.php"); 
			else if ($row['access']=="ls")
			{
				echo "ok\n";
				header("Location: local_server_center.php"); 
			}
	}
	if (	!isset($_SESSION["id"]) && !isset($_SESSION ["pw"])	)
	{
		
		if ($_POST["pw"] == $pw)		//�p�G�K�X���T
		{
			$_SESSION["id"] = $id;
			$_SESSION["access"] = $access;
			if(	isset($_POST["rememberme"]) && ( $_POST["rememberme"] == "true" )	)		//�p�G�ݨ� index ���� rememberme ���Ŀ�, �Nsetcookie
			{	
				setcookie("id", $_POST["id"], time()+365*24*60*60);							//cookie �W�� id, �����ȬO $_POST["id"], �ɶ��O�@�~
				setcookie("pw", $_POST["pw"], time()+365*24*60*60);
			}
			else
			{
				setcookie("id", $_POST["id"], time()+365*24*60*60);
				setcookie("pw", $_POST["pw"], time()-100);
			}
//			echo	"�n�J���\";

			if ($row['access']=="em")
			{
				echo "ok\n";
				header("Location: employee_center.php"); 
			}	
			else if ($row['access']=="ls")
			{
				echo "ok\n";
				header("Location: local_server_center.php"); 
			}
		}
		else							//�p�G�K�X�����T
		{
			echo "wrong pw\n";
			header("Location: index.php?loginfail=true"); 
		}
		
	}

?>