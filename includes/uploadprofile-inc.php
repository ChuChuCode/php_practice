<?php
	session_start();
	if (!isset($_POST["upload_submit"]) || empty($_SESSION["userid"])){
		header("Location: ../index.php");
		exit();
	}
	$file = $_FILES["file"];
		
	// $file structure
	/**************************
	print_r($file);
	Array ( 
		[name] => file.jpg 
		[full_path] => file.jpg 
		[type] => image/jpeg 
		[tmp_name] => /Applications/XAMPP/xamppfiles/temp/phpFUmoRE 
		[error] => 0 
		[size] => 1181834 )
	**************************/
	$fileName = $file["name"];
	$fileTmpName = $file["tmp_name"];
	$fileSize = $file["size"];
	$fileError = $file["error"];
	$fileType = $file["type"];
	// split string
	$fileExtArray = explode(".", $fileName);
	$fileExt = strtolower( end ($fileExtArray) );
	
	// check file upload error message
	if ($fileError != 0){
		header("Location: ../index.php?upload=error");
		exit();
	}
	// check file size
	if ($fileSize > 5000000){
		header("Location: ../index.php?upload=size");
		exit();
	}
	$fileNewName = "profile_".$_SESSION["userid"].".".$fileExt;
	$fileDirectory = "../uploads/".$fileNewName;
	move_uploaded_file($fileTmpName,$fileDirectory);
	//Update profile_image
	include_once "dbconn-inc.php";
	$sql1 = 'UPDATE profile_image SET status=1 ,extension="'.$fileExt.'" WHERE userid = '.$_SESSION["userid"].';';
	mysqli_query($conn,$sql1);
	header("Location: ../index.php?upload=success");
	exit();