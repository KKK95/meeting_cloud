﻿<?php
	
		if(!isset($_SESSION))
		{  		session_start();	}			//用 session 函式, 看用戶是否已經登錄了

		require_once("../connMysql.php");			//引用connMysql.php 來連接資料庫
		
		require_once("back_end/login_check.php");
		
		$path = "";
		$first_dir = 0;
		$first_file = 0;
		
		if ( isset($_GET['path']) )			//無論如何一定會有 basic_path
			$path = $_GET['basic_path']."/".$_GET['path'];
		else
			$path = $_GET['basic_path'];
		
		//open directory
		
		$json = array
		(
			"link" => array
			(	
				"共享空間" => "upload_space.php?basic_path=none",
				"上傳檔案" => "upload.php?upload_path=".$path
			),
			"form" => array
			(
				"make_dir" => array
				(
					"func" => "建立目錄",
					"addr" => "make_dir.php?basic_path=".$path,
					"form" => array
					(	"name" => "none"	)
				)
			)
		);
		echo "$path ";
		if ($opendir = opendir($path))
		{
			while (($file = readdir($opendir)) !==FALSE)
			{	
				//if ($file != "." && $file != ".." && strtolower(substr($file, strrpos($file, '.') + 1)) == 'xml')			這個是指定某種檔案
				echo "$file ";
				if ($file != "." && $file != "..")				//有點就不是目錄
				{
					
					if ( strstr($file, '.') )
					{
						echo stristr($file, '.');
						if( $first_file == 0 )
						{
							$first_file = 1;
							$json ['link']['obj_file_manager'] = array();
							$json ['link']['obj_file_manager']['0'] = array();
							$json ['link']['obj_file_manager']['download'] = array();
							$json ['link']['obj_file_manager']['del_file'] = array();
						}
						array_push( $json ['link']['obj_file_manager']['0'], $file);
						array_push( $json ['link']['obj_file_manager']['download'], "download.php?path=".$path."/".$file);
						array_push( $json ['link']['obj_file_manager']['del_file'], "del_file.php?path=".$path."/".$file);
					
					}
					else											//沒點就是目錄
					{
						if( $first_dir == 0 )
						{
							$first_dir = 1;
							$json ['link']['obj_dir_manager'] = array();
							$json ['link']['obj_dir_manager']['0'] = array();
							$json ['link']['obj_dir_manager']['dir_entry'] = array();
							$json ['link']['obj_dir_manager']['download'] = array();
							$json ['link']['obj_dir_manager']['del_file'] = array();
							
						}
						array_push( $json ['link']['obj_dir_manager']['0'], $file);
						array_push( $json ['link']['obj_dir_manager']['dir_entry'], "my_upload_space.php?basic_path=".$path."&path=".$file);
						array_push( $json ['link']['obj_dir_manager']['download'], "download.php?path=".$path."/".$file);
						array_push( $json ['link']['obj_dir_manager']['del_file'], "del_file.php?path=".$path."/".$file);
					}
				}
			}
		}
		
		//有path, path = none 即到file root
		//path != none 即到該file
	
	echo json_encode( $json );
	
	
?>