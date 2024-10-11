<?php
	if (isset($_POST["upload_submit"])){
		$file = $_FILES["file"];
		
		// $file structure
		
		/*
		print_r($file);
		Array ( 
			[name] => file.jpg 
			[full_path] => file.jpg 
			[type] => image/jpeg 
			[tmp_name] => /Applications/XAMPP/xamppfiles/temp/phpFUmoRE 
			[error] => 0 
			[size] => 1181834 )
		*/
		$fileName = $file["name"];
		$fileTmpName = $file["tmp_name"];
		$fileSize = $file["size"];
		$fileError = $file["error"];
		$fileType = $file["type"];
		// split string
		$fileExtArray = explode(".", $fileName);
		$fileExt = strtolower( end ($fileExtArray) );
		
		// check file upload error message
		if ($fileError !== 0){
			header("Location: ../UploadFile.php?upload=error");
			exit();
		}
		// check extension
		$allowedExt = array("jpg","jpeg","png","pdf");
		if (!in_array($fileExt,$allowedExt)){
			header("Location: ../UploadFile.php?upload=extension");
			exit();
		}
		// check file size
		if ($fileSize > 5000000){
			echo "The file is too big.";
			exit();
		}
		$fileNewName = uniqid("",true).".".$fileExt;
		$fileDirectory = "../uploads/".$fileNewName;
		move_uploaded_file($fileTmpName,$fileDirectory);
		header("Location: ../UploadFile.php?upload=success");
		exit();
	}else{
		header("Location: ../UploadFile.php?upload=image");
		exit();
	}