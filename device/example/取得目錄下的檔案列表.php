<?php
		//==================================取得檔案列表=========================================
		$dir = "../test1";
		//open directory

		if ($opendir = opendir($dir))
		{
			while (($file = readdir($opendir)) !==FALSE)
			{	echo "$file";	echo "</br>";	}
		}
		//==============================================
		$dir = "../test1";
		//open directory
		$r = array();
		$r = scandir($dir);
		
		echo "$r[2]";
		
		
		//=====================================創建檔案========================================
		mkdir("test\\test2");
		
		
		
		//=====================================上傳檔案========================================

		$uploads_dir = '/home/veeru/Desktop/veeruUploads';
		if(is_uploaded_file($_FILES['userfile']['tmp_name'])) 
		{
			echo  "File ".  $_FILES['userfile']['name']  ." uploaded successfully to 
			$uploads_dir/$dest.\n";
			$dest=  $_FILES['userfile'] ['name'];
			move_uploaded_file ($_FILES['userfile'] ['tmp_name'], "$uploads_dir/$dest");
		} 
		else 
		{
			echo "Possible file upload attack: ";
			echo "filename '". $_FILES['userfile']['tmp_name'] . "'.";
			print_r($_FILES);
		}
		
		
		//=====================================下載檔案========================================
		
		
		
		
		//=====================================刪除檔案========================================
		
		
		
		
		
?>