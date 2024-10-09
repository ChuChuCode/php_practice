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
        echo $resultCheck;
        if ($resultCheck > 0){
            while($row = mysqli_fetch_assoc($result)){
                echo $row["user_userid"];
            }
        }
    }
    // Use Prepared Statements
    function userList_Statement($conn){
        $data = "kerwinchu";
        $sql = "SELECT * FROM users WHERE user_userid = ?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)){
            echo "SQL statement failed!";
        } else {
            // s = string, i = integer, b = BLOB, d = double 
            mysqli_stmt_bind_param($stmt, "s", $data);
            // Run database
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            while($row = mysqli_fetch_assoc($result)){
                echo $row["user_userid"];
            }
        }
    }
