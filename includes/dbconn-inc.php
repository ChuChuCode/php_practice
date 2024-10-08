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
