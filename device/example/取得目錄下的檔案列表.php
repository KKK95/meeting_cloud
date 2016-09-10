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
		
		
		$path = '../';
		if ( isset($_GET['download_path']) && isset($_GET['file_name']) )			// $_GET['download_path'] 即為傳入要下載的檔案名稱 (含路徑)
		{
			$path = $path.$_GET['download_path']."/".$_GET['file_name'];
			header("Content-type:application");
			header("Content-Length: " .(string)(filesize($path)));
			header("Content-Disposition: attachment; filename=".$_GET['file_name']);
			readfile($path);
		}
		
		//=====================================下載資料夾========================================
		
		
		//緊記, 在header 前不能輸出任何文字, 不然下載下來的檔案會出錯
				
				$zip = new ZipArchive;
				$path = './';					//  ./路徑/目標檔案/
				$zip_file = $_GET['file_name'].".zip";		//zip name
				$rootPath = realpath($path);
				$zip->open($zip_file, ZipArchive::CREATE);
				$files = new RecursiveIteratorIterator(
					new RecursiveDirectoryIterator($rootPath),
					RecursiveIteratorIterator::LEAVES_ONLY
				);
				
				foreach ($files as $name => $file)
				{
					// Skip directories (they would be added automatically)
					if (!$file->isDir())
					{
				//		echo "file";
						// Get real and relative path for current file
						$filePath = $file->getRealPath();
						$relativePath = substr($filePath, strlen($rootPath) + 1);

						// Add current file to archive
						$zip->addFile($filePath, $relativePath);
					}
				}

				// Zip archive will be created only after closing object
				$zip->close();
				
				header('Content-Description: File Transfer');
				header('Content-Type: application/octet-stream');
				header('Content-Disposition: attachment; filename='.basename($zip_file));
				header('Content-Transfer-Encoding: binary');
				header('Expires: 0');
				header('Cache-Control: must-revalidate');
				header('Pragma: public');
				header('Content-Length: ' . (string)(filesize($zip_file)));
				readfile($zip_file);

				
				
		//=====================================刪除檔案========================================
		
		
		if(file_exists($path))	//檔案存在否?
		{	unlink($path);	}	//將檔案刪除
		
		
		
		
		
		

		//=====================================重新命名檔案========================================
		$a = 'upload_space/食屎';
		$b = 'upload_space/'.$_GET['rename'];
		
		if (rename($a,$b) )
			echo "success";
		
		//127.0.0.1:8080/test1/change_file_name.php?rename=cry_cry.jpg
		
		// $a=原來檔名  , $b=新的檔名

?>