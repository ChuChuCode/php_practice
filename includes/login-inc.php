<?php
	if (!isset($_POST["login"])){
		header("Location: ../index.php?login=error");
		exit();
	}
	include_once "dbconn-inc.php";
	$username = mysqli_real_escape_string($conn,$_POST['username']);
	$pwd = mysqli_real_escape_string($conn,$_POST['pwd']);
	
	// SQL statement
	$sql = "SELECT user_id,user_pwd FROM users WHERE user_userid = ? LIMIT 1;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt,$sql)){
		return "SQL statement failed!";
	}
	
	// s = string, i = integer, b = BLOB, d = double 
	mysqli_stmt_bind_param($stmt, "s", $username);
	// Run database
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	$resultCheck = mysqli_num_rows($result);
	
	if ($resultCheck > 0){
		$row = mysqli_fetch_assoc($result);
		if (!password_verify($pwd,$row["user_pwd"])){
			header("Location: ../index.php?login=password");
			exit();
		}
		session_start();
		$_SESSION["userid"] = $row["user_id"];
		header("Location: ../index.php?login=success");
	}
	if (password_verify($pwd,$hashedpwd)){
		echo "Password is correct!";
	}