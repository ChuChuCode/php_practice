<?php
	// If user didn't use button to submit but enter this php file
	if (!isset($_POST["user_signup"])){
		header("Location: ../practice.php?signup=error");
		exit();
	}
	include_once "dbconn-inc.php";
	// Prevent from sql injection
	$first = mysqli_real_escape_string($conn,$_POST['first']);
	$last = mysqli_real_escape_string($conn,$_POST['last']);
	$email = mysqli_real_escape_string($conn,$_POST['email']);
	$UserID = mysqli_real_escape_string($conn,$_POST['UserID']);
	$pwd = mysqli_real_escape_string($conn,$_POST['pwd']);
	// If user doesn't fill the form
	if (empty($first) || empty($last) || empty($email) || empty($UserID) || empty($pwd)){
		header("Location: ../practice.php?signup=empty");
		exit();
	}
	if (!preg_match("/^[a-zA-Z]*$/",$first) || !preg_match("/^[a-zA-Z]*$/",$last)){
		header("Location: ../practice.php?signup=char");
		exit();
	}
	if (!filter_var($email,FILTER_VALIDATE_EMAIL)){
		header("Location: ../practice.php?signup=email&first=$first&last=$last&UserID=$UserID");
		exit();
	}

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
		header("Location: ../practice.php/?signup=sqlerror");
		exit();
	} else {
		mysqli_stmt_bind_param($stmt, "sssss", $first,$last,$email,$UserID,$pwd);
		mysqli_stmt_execute($stmt);
	}
	header("Location: ../practice.php/?signup=success");
	exit();