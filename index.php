<?php
    // let session can go through other pages
    session_start();
    // include db connection php -> Use $conn
    include_once "includes/dbconn-inc.php";
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="static/errorHandler.css">
<title>ChuChu Webpage</title>
</head>

<body>
    <?php
        // Make a function
        function BreakLine(){
            echo "<br>";
        }
        // Cookie name, Variable, Due time
        setcookie("Account","Kerwin",time()+86400);
        //  Delete cookie
        // setcookie("Account","Kerwin",time()-86400);
        // Session
        //$_SESSION["userid"] = "1";
    ?>
    <?php
        // include other files
        include "header.php";
    ?>
    <?php
        // Show Login/Upload Message
        if (isset($_GET["login"])){
            $login_msg = $_GET["login"];
            switch ($login_msg){
                case "error":
                    echo "<p class='error'>Something wrong. Bring you back to Homepage.</p>";
                    break;
                case "success":
                    echo "<p class='success'>Login Success!</p>";
                    break;
            }
        }
        // Show Login UI
        if (empty($_SESSION["userid"]))
        {
            // Login System
            echo 
            '<p>Login</p>
            <form method="POST" action="includes/login-inc.php">
                <input type="text" name="username" placeholder="User Name">
                <br>
                <input type="password" name="pwd" placeholder="Password">
                <br>
                <button type="submit" name="login">Login</button>
            </form>
            <br>
            <p>Sign Up</p>
            <!-- Signup system-->
            <form method="POST" action="includes/signup-inc.php">';
            if (!isset($_GET["first"])){
				echo "<input type='text' name='first' placeholder='Firstname'>";
			}else{
				$first = $_GET["first"];
				echo "<input type='text' name='first' placeholder='Firstname' value='$first'>";
			}
			BreakLine();
			if (!isset($_GET["last"])){
				echo "<input type='text' name='last' placeholder='Lastname'>";
			}else{
				$last = $_GET["last"];
				echo "<input type='text' name='last' placeholder='Lastname' value='$last'>";
			}
            echo
			'<br>
			<input type="text" name="email" placeholder="Email">
			<br>';
			if (!isset($_GET["UserID"])){
				echo "<input type='text' name='UserID' placeholder='User Name'>";
			}else{
				$UserID = $_GET["UserID"];
				echo "<input type='text' name='UserID' placeholder='User Name' value='$UserID'>";
			}
            echo
            '<br>
            <input type="password" name="pwd" placeholder="Password">
            <br>
            <button type="submit" name="signup" >Sign Up</button>
            </form>
            <br>';
        }
        // Show User Info
        else{
            $user_id = $_SESSION["userid"];
            // Image and Information Show
            $user_info = getUserInfo($conn,$user_id);
            echo
            '<div>
                <p> User Name : '.$user_info["user_userid"].'</p>
                <p> E-mail : '.$user_info["user_email"].'</p>';
            if ($user_info["status"] == 1){
                echo "<img src='uploads/profile_".
                    $user_info["user_id"].".".$user_info["extension"]."' width='100' height='100'>";
            }else{
                echo '<img src="uploads/Default.png" width="100" height="100">';
            }
            echo
            '</div>
            <!--Upload Image-->
            <form method="post" action="includes/uploadprofile-inc.php" enctype="multipart/form-data">
                Upload Profile : 
                <input type="file" name="file" accept="image/png, image/jpeg, image/jpg"/>
                <button type="submit" name="upload_submit">Upload</button>
            </form>
            <!--Logout-->
            <form method="post" action="includes/logout-inc.php">
                <button type="submit" name="logout">Logout</button>
            </form>';
        }
    ?>
<iframe frameborder="0" src="https://itch.io/embed/2327248?border_width=5&amp;dark=true" width="560" height="175">
    <a href="https://chuchu-akabu.itch.io/biball">BiBALL by ChuChu_Akabu</a>
</iframe>
</body>

</html>
