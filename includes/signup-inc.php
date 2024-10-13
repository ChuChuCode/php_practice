<?php
	// If user didn't use button to submit but enter this php file
	if (!isset($_POST["signup"])){
		header("Location: ../index.php?signup=error");
		exit();
	}
	include_once "dbconn-inc.php";
	// Prevent from sql injection
	$first = mysqli_real_escape_string($conn,$_POST['first']);
	$last = mysqli_real_escape_string($conn,$_POST['last']);
	$email = mysqli_real_escape_string($conn,$_POST['email']);
	$UserID = mysqli_real_escape_string($conn,$_POST['UserID']);
	$pwd = password_hash(mysqli_real_escape_string($conn,$_POST['pwd']),PASSWORD_DEFAULT);

	// If user doesn't fill the form
	if (empty($first) || empty($last) || empty($email) || empty($UserID) || empty($pwd)){
		header("Location: ../index.php?signup=empty");
		exit();
	}
	if (!preg_match("/^[a-zA-Z]*$/",$first) || !preg_match("/^[a-zA-Z]*$/",$last)){
		header("Location: ../index.php?signup=char");
		exit();
	}
	if (!filter_var($email,FILTER_VALIDATE_EMAIL)){
		header("Location: ../index.php?signup=email&first=$first&last=$last&UserID=$UserID");
		exit();
	}

	//Insert into users
	$sql = "INSERT INTO users (user_first,user_last,user_email,user_userid,user_pwd) VALUES 
		(?,?,?,?,?);";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt,$sql)){
		header("Location: ../index.php/?signup=sqlerror");
		exit();
	} else {
		mysqli_stmt_bind_param($stmt, "sssss", $first,$last,$email,$UserID,$pwd);
		mysqli_stmt_execute($stmt);
	}
	//Get userid
	$user_info = getUserID($conn,$first,$last,$email,$UserID);
	//Insert into profile
	$sql1 = "INSERT INTO profile_image (userid,status,extension) VALUES (".
			$user_info["user_id"].",0,NULL);";
	mysqli_query($conn,$sql1);
	header("Location: ../index.php/?signup=success");
	exit();
	