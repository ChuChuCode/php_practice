<?php
    $dbServerName = "localhost";
    $dbUserName = "root";
    $dbPassword = "";
    $dbName = "phppractice";

    $conn = mysqli_connect($dbServerName, $dbUserName, $dbPassword, $dbName);

    function userList($conn){
        $sql = "SELECT * FROM users;";
        $result = mysqli_query($conn,$sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck > 0){
            while($row = mysqli_fetch_assoc($result)){
                echo $row["user_userid"];
            }
        }
    }
    // Use Prepared Statements
    function getUserInfo($conn,$userid){
        $sql = 
            "SELECT 
                u.user_first as user_first,
                u.user_last as user_last,
                u.user_email as user_email,
                u.user_userid as user_userid,
                u.user_id as user_id,
                p.status as status,
                p.extension as extension
            FROM users as u join profile_image as p
            on u.user_id = p.userid WHERE u.user_id = ? LIMIT 1;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)){
            echo "SQL statement failed!";
        } else {
            // s = string, i = integer, b = BLOB, d = double 
            mysqli_stmt_bind_param($stmt, "i", $userid);
            // Run database
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $result_array = array();
            while($row = mysqli_fetch_assoc($result)){
                $result_array[] =  $row;
            }
            return $result_array[0];
        }
    }
    function getUserID($conn,$first,$last,$email,$UserID){
        $sql = "SELECT user_id from users where 
            user_first=? 
            and user_last=?
            and user_email=?
            and user_userid=? LIMIT 1;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)){
            echo "SQL statement failed!";
        } else {
            // s = string, i = integer, b = BLOB, d = double 
            mysqli_stmt_bind_param($stmt, "ssss", $first,$last,$email,$UserID);
            // Run database
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $result_array = array();
            while($row = mysqli_fetch_assoc($result)){
                $result_array[] =  $row;
            }
            return $result_array[0];
        }
    }

