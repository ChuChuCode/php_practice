<?php
	include_once "dbconn-inc.php";

	$first = $_POST['first'];
	$last = $_POST['last'];
	$email = $_POST['email'];
	$UserID = $_POST['UserID'];
	$pwd = $_POST['pwd'];

	$sql = "INSERT INTO users (user_first,user_last,user_email,user_userid,user_pwd) VALUES ('$first','$last','$email','$UserID','$pwd');";

	mysqli_query($conn,$sql);

	header("Location: ../practice.php/?signup=success");