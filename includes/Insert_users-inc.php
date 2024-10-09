<?php
	include_once "dbconn-inc.php";
	// Prevent from sql injection
	$first = mysqli_real_escape_string($conn,$_POST['first']);
	$last = mysqli_real_escape_string($conn,$_POST['last']);
	$email = mysqli_real_escape_string($conn,$_POST['email']);
	$UserID = mysqli_real_escape_string($conn,$_POST['UserID']);
	$pwd = mysqli_real_escape_string($conn,$_POST['pwd']);

	/*
	$sql = "INSERT INTO users (user_first,user_last,user_email,user_userid,user_pwd) VALUES 
		('$first','$last','$email','$UserID','$pwd');";

	mysqli_query($conn,$sql);
	*/
	//Use Prepared Statements
	$sql = "INSERT INTO users (user_first,user_last,user_email,user_userid,user_pwd) VALUES 
		(?,?,?,?,?);";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt,$sql)){
		echo "SQL Error!!";
	} else {
		mysqli_stmt_bind_param($stmt, "sssss", $first,$last,$email,$UserID,$pwd);
		mysqli_stmt_execute($stmt);
	}
	header("Location: ../practice.php/?signup=success");