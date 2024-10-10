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
<title>ChuChu</title>
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
        $_SESSION["Account_id"] = "12";
    ?>
    <?php
        // include other files
        include "header.php";
    ?>
<iframe frameborder="0" src="https://itch.io/embed/2327248?border_width=5&amp;dark=true" width="560" height="175">
    <a href="https://chuchu-akabu.itch.io/biball">BiBALL by ChuChu_Akabu</a>
</iframe>
</body>

</html>
