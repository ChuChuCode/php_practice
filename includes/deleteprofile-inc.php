<?php
	session_start();
	include_once "dbconn-inc.php";
	$userid = $_SESSION["userid"];
	// get extension name
	$sql = "SELECT extension from profile_image WHERE userid =".$userid." LIMIT 1;";
	
	$result = mysqli_query($conn,$sql);
	$resultCheck = mysqli_num_rows($result);
	if ($resultCheck < 0){
		echo "SQL wrong";
	}
	$row = mysqli_fetch_assoc($result);
	$fileExt =  $row["extension"];

	$fileName = "../uploads/profile_".$userid.".".$fileExt;
	
	if (!unlink($fileName)){
		echo "File was not deleted";
	}else{
		echo "File was deleted";
	}
	// Update status
	$sql1 = "UPDATE profile_image SET STATUS = 0,extension=NULL WHERE userid=".$userid.";";
	mysqli_query($conn,$sql1);

	header("Location: ../index.php?delete=success");